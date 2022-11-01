<?php
// Метод вынесен в отдельный класс
class Loader
{
    public function load($url)
    {
        return file_get_contents($url);
    }
}
//=====================================================================================================================
// В конструктор передается объект класса Loader
class Parser
{
    private Loader $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    public function getPage($url): bool|string
    {
        return $this->loader->load($url);
    }
}
class Exchanger
{
    private Loader $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    public function getRate($currency): bool|string
    {
        return $this->loader->load('...?id=' . $currency);
    }
}
//======================================================================================================================
// Может быть другая реализация класса Loader
class SuperLoader extends Loader
{
    public function load($url)
    {
        return '<html>123</html>';
    }
}
//======================================================================================================================
// Сам код.
if (TEST) {
    $loader = new SuperLoader();
} else {
    $loader = new Loader();
}

$parser = new Parser($loader);
$parser->getPage('...');

$exchanger = new Exchanger($loader);
$exchanger->getRate('USD');
