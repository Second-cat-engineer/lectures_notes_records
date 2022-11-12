### Protected Variations (Устойчивый к изменениям)

Если для изменения компонента нужно его переписывать, то это плохо. Лучше сделать так чтоб он был легко изменять.


Пример с корзиной, которой неважно какой стор используется и какая скидка должна применяться, требуемые компоненты
просто передаются в нее:
```php
class Cart
{
    private $storage;
    private $calculator;
    
    public function __construct(StorageInterface $storage, CalculatorInterface $calculator)
    {
        $this->storage = $storage;
        $this->calculator = $calculator;
    }
    
    //...
}

interface StorageInterface
{
    public function load();
    public function save(array $items);
}

interface CalculatorInterface
{
    public function getCost(array $items);
}
```
___


Пример со SwiftMailer, то что можно передать туда какой угодно транспорт, и плагины.
```php
$transport = new Swift_MailTransport();

$mailer = new Swift_Mailer($transport);

$message = Swift_Message::newInstance('Wonderful Subject')
    ->setFrom(['test@mail.ru' => 'test'])
    ->setTo(['test@mail.ru' => 'test'])
    ->setBody('message');

$mailer->send($message);
```

```php
$mailer = new Swift_Mailer(new Swift_NullTransport());

class EchoPlugin implements Swift_Events_SendListener
{
    public function beforeSendPerformed(Swift_Events_SendEvent $evt) {
        echo 'Before sending: ' . $evt->getMessage()->getSubject() . PHP_EOL;
    }

    public function sendPerformed(Swift_Events_SendEvent $evt) {
        echo 'After sending: ' . $evt->getMessage()->getSubject() . PHP_EOL;
    }
}

$mailer->registerPlugin(new EchoPlugin());

$message = Swift_Message::newInstance('Wonderful Subject')
    ->setFrom(['test@mail.ru' => 'test'])
    ->setTo(['test@mail.ru' => 'test'])
    ->setBody('message');

$mailer->send($message);
```
___

