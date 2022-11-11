### Pure Fabrication (Чистая выдумка)

В случае когда не из реального мира.

Например генератор id
```php
class IdGenerator
{
    public function nextId(): int
    {
        return rand(10000, 99999);
    }
}
```
