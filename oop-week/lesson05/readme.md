## Урок 5. Свойства, методы, события, исключения.

- Как не превратить проект в хаос;
- Взгляд на объект со стороны;
- Давать ли прямой доступ к свойствам;
- Создание и обработка событий (Event);
- Использование исключений (Exception);
- Делаем однонаправленные зависимости;
- Связи между уровнями абстракции.

___
### Паттерны из которых можно вывести все низкоуровневые паттерны - GRASP

1. [Information Expert (Информационный эксперт)](./example01/grasp01/readme.md)
2. [Creator (Создатель)](./example01/grasp02/readme.md)
3. [Controller (Контроллер)](./example01/grasp03/readme.md)
4. [Low Coupling (Низкая связанность)](./example01/grasp04/readme.md)
5. [High Cohesion (Высокая степень зацепления)](./example01/grasp05/readme.md)
6. [Polymorphism (Полиморфизм)](./example01/grasp06/readme.md)
7. [Pure Fabrication (Чистая выдумка)](./example01/grasp07/readme.md)
8. [Indirection (Посредник)](./example01/grasp08/readme.md)
9. [Protected Variations (Устойчивый к изменениям)](./example01/grasp09/readme.md)

Шаблоны GRASP — это хорошо документированные, стандартизированные и проверенные временем принципы объектно-ориентированного анализа.
___


### Рассмотрение встроенных интерфейсов в PHP.

```php
$phones = ['88001', '88002', '88003'];

foreach ($phones as $phone) {
    echo $phone . PHP_EOL;
}

echo $phones[2] . PHP_EOL;

$phones[2] = '88007';

$phones[] = '88006';
```


Пока нет никакой логики можно использовать массив. Как только добавится логика, например, нельзя чтоб элементы
повторялись.

Можно сделать коллекцию:
```php
class PhoneCollection
{
    private array $phones = [];

    public function __construct(array $phones)
    {
        $this->phones = array_values(array_unique($phones));
    }

    public function add($phone)
    {
        if ($this->has($phone)) {
            throw new \DomainException('Phone already exists.');
        }
        $this->phones[] = $phone;
    }

    public function remove($phone)
    {
        if (!$this->has($phone)) {
            throw new \DomainException('Phone not found.');
        }
        $this->phones = array_values(array_diff($this->phones, [$phone]));
    }

    public function has($phone): bool
    {
        return in_array($phone, $this->phones);
    }

    public function asArray(): array
    {
        return $this->phones;
    }
    
    public function filter()
    {
        //...
    }
}

$phones = new PhoneCollection(['88001', '88002', '88003']);

foreach ($phones->asArray() as $phone) {
    echo $phone . PHP_EOL;
}
```


Если нужно передать эту коллекцию в какую-нибудь функцию, так как в этом случае не будет копирования как при передаче
массива.

Можно ли сделать так, чтобы внутри коллекции метод asArray не использовать?

Можно использовать интерфейс `Iterator`.
```php
class PhoneCollection implements Iterator
{
    //...
    
    private $index = 0;
    
    public function current()
    {
        return $this->phones[$this->index];
    }

    public function next()
    {
        $this->index++;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid()
    {
        return $this->index < count($this->phones);
    }

    public function rewind()
    {
        $this->index = 0;
    }
}
```
Это встроенный в php интерфейс, который предоставляет возможность любому объекту работать как массив (возможность 
проходить foreach по свойствам).

Теперь этот код:
```php
foreach ($phones as $key => $phone) {
    echo $phone . PHP_EOL;
}
```

Будет равен коду:
```php
$phones->rewind();
while ($phones->valid()) {
    $key = $phones->key();
    $phone = $phones->current();
    echo $phone . PHP_EOL;
    $phones->next();
}
```

А что делать если какой-то из методов уже реализован?

Можно использовать интерфейс `IteratorAggregate`, реализовать метод getIterator(), который должен вернуть объект
реализующий интерфейс Iterator.
```php
class PhoneCollection implements IteratorAggregate
{
    //... 
    
    public function getIterator()
    {
        return new PhoneIterator(array_values($this->phones));
    }
}

class PhoneIterator implements \Iterator
{
    private $phones = [];
    private $index = 0;

    public function __construct(array $phones)
    {
        $this->phones = $phones;
    }

    public function current()
    {
        return $this->phones[$this->index];
    }

    public function next()
    {
        $this->index++;
    }

    public function key()
    {
        return $this->index;
    }

    public function valid()
    {
        return $this->index < count($this->phones);
    }

    public function rewind()
    {
        $this->index = 0;
    }
}


$phones = new PhoneCollection(['88001', '88002', '88003']);

foreach ($phones as $phone) {
    echo $phone . PHP_EOL;
}
```

Но писать каждый раз свою реализацию класса PhoneIterator, это очень неудобно.

Есть встроенный класс `ArrayIterator`, в котором уже реализованы эти методы.
```php
class PhoneCollection implements IteratorAggregate
{
    //... 
    
    public function getIterator()
    {
        return new ArrayIterator($this->phones);
    }
}

$phones = new PhoneCollection(['88001', '88002', '88003']);

foreach ($phones as $phone) {
    echo $phone . PHP_EOL;
}
```


Как сделать так, чтобы нижеуказанные вызовы работали для коллекции?
```php
$phones = new PhoneCollection(['88001', '88002', '88003']);

$phones[2] = '123445';
$phones[] = '144231';
```
Есть интерфейс `ArrayAccess`. 

Теперь реализация класса `PhoneCollection` выглядит так: 
```php
class PhoneCollection implements IteratorAggregate, ArrayAccess
{
    private $phones = [];

    public function __construct(array $phones)
    {
        $this->phones = array_unique($phones);
    }

    public function add($phone)
    {
        if ($this->has($phone)) {
            throw new \DomainException('Phone already exists.');
        }
        $this->phones[] = $phone;
    }

    public function remove($phone)
    {
        if (!$this->has($phone)) {
            throw new \DomainException('Phone not found.');
        }
        $this->phones = array_diff($this->phones, [$phone]);
    }

    public function has($phone)
    {
        return in_array($phone, $this->phones);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->phones);
    }

    // Реализация методов `ArrayAccess`.

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->phones);
    }

    public function offsetGet($offset)
    {
        return $this->phones[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if ($this->has($value)) {
            throw new \DomainException('Phone already exists.');
        }
        if ($offset) {
            $this->phones[$offset] = $value;
        } else {
            $this->phones[] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->phones[$offset]);
    }
}

$phones = new PhoneCollection(['88001', '88002', '88003']);

echo $phones[2] . PHP_EOL;

unset($phones[2]);
$phones[4] = '89004';
$phones[] = '89005';
$phones[] = '89006';

foreach ($phones as $phone) {
    echo $phone . PHP_EOL;
}
```

Если сейчас попробовать вывести количество элементов `count($phones)` он вернет 1, так как считает количество объектов.

Можно добавить интерфейс `Countable`, и реализовать метод `count()`.
```php
class PhoneCollection implements IteratorAggregate, ArrayAccess, Countable
{
    //...
    
    public function count()
    {
        return count($this->phones);
    }
}
```

Таким образом, можно сделать так, что будет доступ только к чтению, а на редактирование нет и т.д.

Также допустим нужно сериализовать этот объект. Можно сделать `serialize($phones);`. Но допустим есть поля, которые
не должны попасть (пароль, хеши всякие). Тогда можно реализовать интерфейс `Serializable`, и в методах serialize,
unserialize реализовать логику.
```php
class PhoneCollection implements IteratorAggregate, ArrayAccess, Countable, Serializable
{
    //...
    
    public function serialize()
    {
        return implode(';', $this->phones);
    }

    public function unserialize($serialized)
    {
        $this->phones = explode(';', $serialized);
    }
}
```


#### В PHP уже есть класс, который реализует эти интерфейсы - `ArrayObject`.
```php
class ArrayObject implements IteratorAggregate, ArrayAccess, Serializable, Countable
{
}
```

Поэтому можно наследоваться от этого класса, и переопределить те методы, в которых у нас своя логика.


#### Внутри методов итератора можно реализовать какую-нибудь ленивую загрузки из файла или БД.
___

#### В php есть встроенный итератор для перебора вложенного массива:
```php
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

$iterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator([
        1 => [
            [111, 112, 113],
            [121, 122, 123],
        ],
        2 => [
            [211, 212, 213],
        ],
    ])
);

foreach ($iterator as $item) {
    echo $item . PHP_EOL;
}
```

результат:
```txt
    111
    112
    113
    121
    122
    123
    211
    212
    213
```
___

#### В php есть встроенный итератор `DirectoryIterator`
```php
use DirectoryIterator;

$dir = dirname(dirname(__DIR__));

$iterator = new DirectoryIterator($dir);

foreach ($iterator as $item) {
    echo $item->isDir() ? 'Dir: ' : 'File: ';
    echo $item->getFilename() . PHP_EOL;
}
```

Для вложенных директорий:
```php
use DirectoryIterator;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

$dir = dirname(dirname(__DIR__));

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS)
);

foreach ($iterator as $item) {
    echo $item->isDir() ? 'Dir: ' : 'File: ';
    echo $item->getPath() . DIRECTORY_SEPARATOR . $item->getFilename() . PHP_EOL;
}
```

___

#### Пример с файлом csv.
Реализован свой класс, который реализует интерфейс `Iterator`
```php
use Iterator;

class CsvFileIterator implements Iterator
{
    private $file;
    private $key = 0;
    private $current;

    public function __construct($file) {
        $this->file = fopen($file, 'r');
    }

    public function __destruct() {
        fclose($this->file);
    }

    public function rewind() {
        rewind($this->file);
        $this->current = fgetcsv($this->file);
        $this->key = 0;
    }

    public function valid() {
        return !feof($this->file);
    }

    public function key() {
        return $this->key;
    }

    public function current() {
        return explode(';', $this->current[0]);
    }

    public function next() {
        $this->current = fgetcsv($this->file);
        $this->key++;
    }
}


$iterator = new CsvFileIterator(__DIR__ . '/list.csv');
foreach ($iterator as $row) {
    print_r($row);
    
    // Допустим какое-то условие выполнилось, тогда можно сделать break; и выйти.
}
```

Позволит экономить память, т.к. при каждой итерации читается одна строка из файла (файл может быть хоть какого объема).

В Yii2 есть такая штука:
```php
foreach (Post::find()->each() as $post) {
    //...
}
```

Можно использовать генераторы:
```php
function openCsv($fileName)
{
    $file = fopen($fileName, 'r');
    while (!feof($file)) {
        yield explode(';', fgetcsv($file)[0]);
    }
    fclose($file);
}

$rows = openCsv(__DIR__ . '/list.csv');

foreach ($rows as $row) {
    print_r($row);
    break;
}
```
___
___

