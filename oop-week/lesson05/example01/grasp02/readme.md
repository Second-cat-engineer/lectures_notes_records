### Creator (Создатель)

Шаблон определяет, кто должен создавать объект (фактически, это применение шаблона «Информационный эксперт» к
проблеме создания объектов): целесообразно назначить классу «B» обязанность создавать экземпляры класса «A»,
если «B» производит следующие действия по отношению к «A»:

    Содержит или агрегирует;
    Записывает;
    Активно использует;
    Обладает данными инициализации.

Альтернативой является шаблон проектирования «Фабрика» (создание объектов концентрируется в отдельном классе).

Пример:
```php
$cart = new Cart(new SessionStorage('cart'), new SimpleCost());

$cart->add(5, 6, 100);
echo $cart->getCost();
```

Второй пример:
```php
$employee = $service->recruitEmployee(
    new Name('Вася', 'Пупкин'),
    new Phone(7, '92000000000'),
    new Address('Россия', 'Липецкая обл.', 'г. Пушкин', 'ул. Ленина', 1)
);
```
Объекты Name, Phone, Address создали снаружи, потому что для них есть все данные снаружи.
Но не передали объект Employee, т.к. не все данные есть снаружи (генератора id нет).
Поэтому объект Employee создает метод recruitEmployee(), т.к. он уже знает где взять id.
```php
public function recruitEmployee(Name $name, Phone $phone, Address $address)
    {
        $employee = new Employee($this->idGenerator->nextId(), $name, new PhonesCollection([$phone]), $address);
        $this->employeeRepository->save($employee);
        return $employee;
    }
```
___
