### High Cohesion (Высокая степень зацепления)

Это уже относится к внутренним данным. 

В примере есть метод filterEmail. Как он туда попал? Он не работает с классом, объектом, а просто фильтрует email.
```php
class Employee
{
    private $name;
    private $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function rename($name)
    {
        $this->name = $name;
    }

    public function changeEmail($email)
    {
        $this->email = $email;
    }

    public function filterEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
```

Нужно либо вынести в отдельный хелпер:
```php
class Employee
{
    private $name;
    private $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function rename($name)
    {
        $this->name = $name;
    }

    public function changeEmail($email)
    {
        $this->email = $email;
    }
}

class Filter
{
    public static function email($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
```

Или
```php
class Employee
{
    private $name;
    private $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = self::filterEmail($email);
    }

    public function rename($name)
    {
        $this->name = $name;
    }

    public function changeEmail($email)
    {
        $this->email = self::filterEmail($email);
    }

    private static function filterEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
```

Суть в том, что все данные внутри объекта должны быть "на одной волне".
