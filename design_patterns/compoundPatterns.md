## Составные паттерны. Паттерны паттернов

Паттерны часто используются вместе и комбинируются в реализациях проектировочных решений.

Составной паттерн объединяет два и более паттерна для решения распространенной или общей проблемы.

### Пример: Построить "утиную" программу и наделить ее интересными возможностями с помощью нескольких паттернов.

#### 1. Создание интерфейса Quackable.
От реализации этого интерфейса зависит поддержка метода quack() разными классами.

```php
interface Quackable {
    public function quack();
}
```
___

#### 2. Реализация классов, реализующих интерфейс Quackable
Создание нескольких разновидностей уток.

Обычная утка:
```php
class MallardDuck implements Quackable {
    public function quack() {
        echo 'Quack';
    }
}
```

Утка с красной головой:
```php
class RedheadDuck implements Quackable {
    public function quack() {
        echo 'Quack';
    }
}
```

Утка приманка:
```php
class DuckCall implements Quackable {
    public function quack() {
        echo 'Qwak!';
    }
}
```

Резиновая утка:
```php
class RubberDuck implements Quackable {
    public function quack() {
        echo 'Squeak!';
    }
}
```
___

#### 3. Имитатор - программа, которая создает нескольких уток и заставляет их крякать.
```php
class DuckSimulator {
    public function simulate() {
        $mallardDuck = new MallardDuck();
        $redheadDuck = new RedheadDuck();
        $duckCall = new DuckCall();
        $rubberDuck = new RubeberDuck();
        
        $this->quack($mallardDuck);
        $this->quack($redheadDuck);
        $this->quack($duckCall);
        $this->quack($rubberDuck);
    }
    
    private function quack(Quackable $duck) {
        $duck->quack();
    }
}
```
___

#### 4. Там, где есть утки, найдется место и гусям.
Класс Goose представляет другую водоплавающую птицу - гуся:
```php
class Goose {
    public function honk() {
        echo 'Honk';
    }
}
```

Допустим, нужно чтобы объект Goose мог использоваться везде, где могут использоваться объекты Duck.

В конце концов, гуси тоже издают звуки, умеют летать и плавать.

Так почему бы не включить их в программу?
___

#### 5. Включение гусей в программу с утками.
Понадобится паттерн `Адаптер`.

Программа работает с реализациями Quakable. Поскольку гуси не поддерживают метод quack(), можно воспользоваться
адаптером для превращения гуся в утку:
```php
class GooseAdapter implements Quackable {
    private Goose $goose;
    
    public function __construct(Goose $goose) {
        $this->goose = $goose;
    }
    
    public function quack() {
        $this->goose->honk();
    }
}
```
___

#### 6. Необходимо изменить Имитатор.
Нужно лишь создать объект Goose, упаковать его в адаптер, реализующий Quackable, - и можно работать:
```php
class DuckSimulator {
    public function simulate() {
        $mallardDuck = new MallardDuck();
        $redheadDuck = new RedheadDuck();
        $duckCall = new DuckCall();
        $rubberDuck = new RubeberDuck();
        
        $gooseDuck = new GooseAdapter(new Goose());
        
        $this->quack($mallardDuck);
        $this->quack($redheadDuck);
        $this->quack($duckCall);
        $this->quack($rubberDuck);
        $this->quack($gooseDuck);
    }
    
    private function quack(Quackable $duck) {
        $duck->quack();
    }
}
```
___

#### 8. Пробный запуск.
```php
$simulator = new DuckSimulator();
$simulator->simulate();
```
___

#### Допустим, необходимо подсчитать общее количество кряков, издаваемых утиной стаей. 

#### Как реализовать возможность подсчета без изменения классов уток? Какой паттерн поможет?

#### 8. Реализация механизма подсчета утиных кряков.
Наделить уток новым поведением (подсчет), упаковав их в объекте-декораторе. Изменять Duck для этого не придется.
```php
class QuackCounter implements Quackable {
    private Quackable $duck;
    private static int $numberOfQuacks = 0; // статическая переменная для подсчета всех кряков.
    
    public function __construct(Quackable $duck) {
        $this->duck = $duck;
    }
    
    public function quack() {
        $this->duck->quack();
        $this->numberOfQuacks++;
    }
    
    public static function getQuacks() {
        return $this->numberOfQuacks;
    }
}
```
___

#### 9. Необходимо изменить Имитатор, чтобы в ней создавались декорированные реализации Quackable.
Теперь каждый объект Quackable, экземпляр которого создается в программе, должен упаковываться в декоратор QuackCounter.
Если не сделать, то вызовы quack() не будут учитываться при подсчете.
```php
class DuckSimulator {
    public function simulate() {
        $mallardDuck = new QuackCounter(new MallardDuck());
        $redheadDuck = new QuackCounter(new RedheadDuck());
        $duckCall = new QuackCounter(new DuckCall());
        $rubberDuck = new QuackCounter(new RubeberDuck());
        
        $gooseDuck = new GooseAdapter(new Goose());
        
        $this->quack($mallardDuck);
        $this->quack($redheadDuck);
        $this->quack($duckCall);
        $this->quack($rubberDuck);
        $this->quack($gooseDuck);
        
        echo QuackCounter::getQuacks(); // Вывод количества кряков.
    }
    
    private function quack(Quackable $duck) {
        $duck->quack();
    }
}
```
___

#### Декорированное поведение обеспечивается только для декорированных объектов.
Основная проблема с упаковкой объектов: при использовании недекорированного объекта вы лишаетесь декорированного
поведения.

Поэтому нужно объединить операции создания экземпляров с декорированием, инкапсулируя их в специальном методе.

#### 10. Фабрика для производства уток.
Необходимо позаботиться о том, чтобы все утки обязательно были упакованы в декоратор. Для создания декорированных уток
будет построена целая фабрика. Она должна производить целое семейство продуктов, состоящее из разных утиных
разновидностей, поэтому необходим паттерн `Абстрактная Фабрика`.

```php
abstract class AbstractDuckFactory {
    abstract public function createMallardDuck(): Quackable;
    abstract public function createRedheadDuck(): Quackable;
    abstract public function createDuckCall(): Quackable;
    abstract public function createRubberDuck(): Quackable;
}
```

Первая версия фабрики создает уток без декораторов:
```php
class DuckFactory extends AbstractDuckFactory {
    public function createMallardDuck(): Quackable {
        return new MallardDuck();
    }
    public function createRedheadDuck(): Quackable {
        return new RedheadDuck();
    }
    
    public function createDuckCall(): Quackable {
        return new DuckCall();
    }
    
    public function createRubberDuck(): Quackable {
        return new RubberDuck();
    }
}
```

Вторая версия - фабрика с декораторами:
```php
class CountingDuckFactory extends AbstractDuckFactory {
    public function createMallardDuck(): Quackable {
        return new QuackCounter(new MallardDuck());
    }
    public function createRedheadDuck(): Quackable {
        return new new QuackCounter(RedheadDuck());
    }
    
    public function createDuckCall(): Quackable {
        return new new QuackCounter(DuckCall());
    }
    
    public function createRubberDuck(): Quackable {
        return new new QuackCounter(RubberDuck());
    }
}
```
___

#### 11. Перевод имитатора на использование фабрики.
Как работает паттерн `Абстрактная Фабрика`? Создается полиморфный метод, который получает фабрику и использует ее для
создания объектов. Передавая разные фабрики, можно создавать разные семейства продуктов в одном методе.

Новая версия метода simulate() получает фабрику и использует ее для создания уток:
```php
class DuckSimulator {
    public function simulate(AbstractDuckFactory $duckFactory) {
        $mallardDuck = $duckFactory->createMallardDuck();
        $redheadDuck = $duckFactory->createRedheadDuck();
        $duckCall = $duckFactory->createDuckCall();
        $rubberDuck = $duckFactory->createRubberDuck();
        
        $gooseDuck = new GooseAdapter(new Goose());
        
        $this->quack($mallardDuck);
        $this->quack($redheadDuck);
        $this->quack($duckCall);
        $this->quack($rubberDuck);
        $this->quack($gooseDuck);
        
        echo QuackCounter::getQuacks(); // Вывод количества кряков.
    }
    
    private function quack(Quackable $duck) {
        $duck->quack();
    }
}
```
___

#### Теперь нужно управлять утиными стаями.
Управлять разными утками по отдельности слишком хлопотно. Нельзя ли выполнять операции со всеми утками сразу или даже
выделить несколько утиных "семейств", которые отслеживаются отдельно от других?

Необходим механизм создания коллекций уток, и даже субколлекций. Также было бы желательно иметь возможность применять
операции ко всему множеству уток. Какой паттерн поможет?

#### 12. Создание утиной стаи (точнее стаю с реализацией Quackable).
Паттерн `Компоновщик` - тот, что позволяет интерпретировать коллекцию объектов как отдельный объект.

```php
class Flock implements Quackable {
    private $quackers = [];
    
    public function add(Quackable $quacker) {
        $this->quackers[] = $quacker;
    }
    
    public function quack() {
        // Здесь можно заморочиться и сделать Итератор, а можно просто foreach
        foreach ($this->quackers as $quacker) {
            $quacker->quack();
        }
    }
}
```
___

#### 13. Необходимо изменить Имитатор, чтобы утки вписывались в новую структуру.
```php
class DuckSimulator {
    public function simulate(AbstractDuckFactory $duckFactory) {
        $mallardDuck = $duckFactory->createMallardDuck();
        $redheadDuck = $duckFactory->createRedheadDuck();
        $duckCall = $duckFactory->createDuckCall();
        $rubberDuck = $duckFactory->createRubberDuck();
        
        $gooseDuck = new GooseAdapter(new Goose()); // Гусь
        
        
        $flockOfDucks = new Flock(); // Создание объекта Flock, и заполнение его реализациями Quackable.
        $flockOfDucks->add($redheadDuck);
        $flockOfDucks->add($duckCall);
        $flockOfDucks->add($rubberDuck);
        $flockOfDucks->add($gooseDuck);
        
        
        $flockOfMallards = new Flock();
        $flockOfMallards->add($mallardDuck);
        $flockOfMallards->add($duckFactory->createMallardDuck());
        $flockOfMallards->add($duckFactory->createMallardDuck());
        $flockOfMallards->add($duckFactory->createMallardDuck());
        
        $flockOfDucks->add($flockOfMallards); // Добавление стаи обычных уток в общую стаю.
        
        $this->quack($flockOfDucks);
        
        echo QuackCounter::getQuacks(); // Вывод количества кряков.
    }
    
    private function quack(Quackable $duck) {
        $duck->quack();
    }
}
```

В примере, посвященной паттерну Компоновщик, листовые узлы и комбинации имели совпадающие наборы методов.
Из-за этого для листовых узлов могли вызываться методы, не имеющие смысла (например, метод add() для Duck).
Преимуществом такого подходя является прозрачность: клиенту не нужно было знать, имеет ли он дело с листом или 
комбинацией, - он просто вызывал одни и те же методы в обеих ситуациях.

В этом примере методы комбинаций, относящиеся к управлению дочерними элементами, отделены от листовых узлов (только
Flock содержит методы add()). Такая архитектура обладает большей безопасностью (клиент не может вызывать для 
компонентов бессмысленные методы), но она менее прозрачна.
___

#### А если необходимо наблюдать за отдельными утками? Как получать информацию о них в реальном времени?
Использовать паттерн `Наблюдатель`.

#### 14. Определить интерфейс наблюдаемого объекта.
Интерфейс наблюдаемого объекта содержит методы регистрации и оповещения наблюдателей (опущен метод для удаления 
наблюдателей):
```php
interface QuackObservable {
    public function registerObserver(Observer $observer);
    public function notifyObservers();
}
```

Необходимо проследить за тем, чтобы интерфейс был реализован всеми Quackable:
```php
interface Quackable extends QuackObservable {
    public function quack();
}
```
___

#### 15. Теперь нужно позаботиться о том, чтобы все конкретные классы, реализующие Quackable, могли использоваться в качестве QuackObservable.
Задачу можно решить, реализуя регистрацию и оповещение в каждом классе.

Однако, можно инкапсулировать код регистрации и оповещения в другом классе - Observable - и объединить его с
QuackObservable.

В таком случае реальный код пишется только один раз, а в QuackObservable достаточно включить код делегирования вызовов
вспомогательному классу Observable.

Вспомогательный класс Observable:
```php
class Observable implements QuackObservable {
    private $observers = [];
    private QuackObservable $duck;
    
    public function __construct(QuackObservable $duck) {
        $this->duck = $duck;
    }
    
    public function registerObserver(Observer $observer) {
        $this->observers[] = $observer;
    }
    
    public function notifyObservers() {
        foreach ($this->observers as $observer) {
            $observer->update($this->duck);
        }
    }
}
```
___

#### 16. Интеграция вспомогательного класса Observable с классами Quackable.
Все, что нужно, - это позаботиться о том, чтобы классы Quackable содержали комбинированные объекты Observable и умели
делегировать им операции. После этого они готовы к использованию в качестве Observable.

Пример для MallardDuck, остальные классы выглядят аналогично:
```php
class MallardDuck implements Quackable {
    private Observable $observable; // Каждая реализация содержит объект Observable
    
    public function __construct() {
        $this->observable = new Observable($this);
    }

    public function quack() {
        echo 'Quack';
        $this->notifyObservers(); // Наблюдатели оповещаются о вызовах quack();
    }
    
    public function registerObserver(Observer $observer) {
        $this->observable->registerObserver($observer); // Вызов метода делегируется вспомогательному объекту.
    }
    
    public function notifyObservers() {
        $this->observable->notifyObservers(); // Вызов метода делегируется вспомогательному объекту.
    }
}
```

Для QuackCounter;
```php
class QuackCounter implements Quackable {
    private Quackable $duck;
    private static int $numberOfQuacks = 0; // статическая переменная для подсчета всех кряков.
    
    public function __construct(Quackable $duck) {
        $this->duck = $duck;
    }
    
    public function quack() {
        $this->duck->quack();
        $this->numberOfQuacks++;
    }
    
    public static function getQuacks() {
        return $this->numberOfQuacks;
    }
    
    public function registerObserver(Observer $observer) {
        $this->duck->registerObserver($observer);
    }
    
    public function notifyObservers() {
        $this->duck->notifyObservers();
    }
}
```

Пример для Flock:
```php
class Flock implements Quackable {
    private $quackers = [];
    
    public function add(Quackable $quacker) {
        $this->quackers[] = $quacker;
    }
    
    public function quack() {
        // Здесь можно заморочиться и сделать Итератор, а можно просто foreach
        foreach ($this->quackers as $quacker) {
            $quacker->quack();
        }
    }
    
    public function registerObserver(Observer $observer) {
        // При регистрации Flock как наблюдателя автоматически регистрируется все, что содержится во Flock, то есть все
        // реализации Quackable, будь то Duck или другой объект Flock.
        foreach ($this->quackers as $quacker) {
            $quacker->registerObserver($observer)
        }
    }
    
    // Каждая реализация Quackable выполняет оповещение самостоятельно, поэтому Flock ничего делать не придется.
    public function notifyObservers() {} 
}
```
___

#### 17. Создание наблюдателя.
Реализовано все необходимое для наблюдаемых объектов; теперь нужны наблюдатели. 
Интерфейс Observer:
```php
interface Observer {
    public function update(QuackObservable $duck);
}
```

Наблюдатель:
```php
class Quackologist implements Observer {
    public function update(QuackObservable $duck) {
        echo 'Quackologist: ' . $duck . ' just quacked.';
    }
}
```
___

#### 18. Обновление кода имитатора.
```php
class DuckSimulator {
    public function simulate(AbstractDuckFactory $duckFactory) {
        $mallardDuck = $duckFactory->createMallardDuck();
        $redheadDuck = $duckFactory->createRedheadDuck();
        $duckCall = $duckFactory->createDuckCall();
        $rubberDuck = $duckFactory->createRubberDuck();
        
        $gooseDuck = new GooseAdapter(new Goose()); // Гусь
        
        
        $flockOfDucks = new Flock(); // Создание объекта Flock, и заполнение его реализациями Quackable.
        $flockOfDucks->add($redheadDuck);
        $flockOfDucks->add($duckCall);
        $flockOfDucks->add($rubberDuck);
        $flockOfDucks->add($gooseDuck);
        
        
        $flockOfMallards = new Flock();
        $flockOfMallards->add($mallardDuck);
        $flockOfMallards->add($duckFactory->createMallardDuck());
        $flockOfMallards->add($duckFactory->createMallardDuck());
        $flockOfMallards->add($duckFactory->createMallardDuck());
        
        $flockOfDucks->add($flockOfMallards); // Добавление стаи обычных уток в общую стаю.
        
        // Создание объекта Quackologist и назначение его наблюдателем для Flock
        $quackologist = new Quackologist();
        $flockOfDucks->registerObserver($quackologist);
        
        $this->quack($flockOfDucks);
        
        echo QuackCounter::getQuacks(); // Вывод количества кряков.
    }
    
    private function quack(Quackable $duck) {
        $duck->quack();
    }
}
```
___

#### Что было сделано?

- Сначала потребовалось, чтобы класс Goose тоже мог бы использоваться в качестве Quackable. Паттерн `Адаптер`.
- Затем было решено, что вызовы quack() должны подсчитываться. Паттерн `Декоратор` (QuackCounter).
- Но клиент мог забыть добавить декоратор QuackCounter к объекту. Паттерн `Абстрактная Фабрика` для создания экземпляров.
- Возникли проблемы управления многочисленными объектами Duck, Goose и Quackable. Паттерн `Компоновщик` для группировки 
объектов в коллекции.
- Потребовалось организовать оповещение клиента о вызовах quack(). Паттерн `Наблюдатель`


