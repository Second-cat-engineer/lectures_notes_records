## Составные паттерны. Паттерны паттернов

Паттерны часто используются вместе и комбинируются в реализациях проектировочных решений.

Составной паттерн объединяет два и более паттерна для решения распространенной или общей проблемы.

### Пример: Построить "утиную" программу и наделить ее интересными возможностями с помощью нескольких паттернов.

#### 1. Создание интерфейса Quackable.
От реализации этого интерфейса зависит поддержка метода quack() разными классами.

```php
interface Quackable() {
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
class DuckCounter implements Quackable {
    private Quackable $duck;
    private int $numberOfQuacks = 0;
    
    public function __construct(Quackable $duck) {
        $this->duck = $duck;
    }
    
    public function quack() {
        $this->duck->quack();
        $this->numberOfQuacks++;
    }
    
    public function getQuacks() {
        return $this->numberOfQuacks;
    }
}
```
___

####
####
####