<?php

use lesson04\example02\cart\Cart;
use lesson04\example02\cart\cost\SimpleCost;
use lesson04\example02\cart\storage\SessionStorage;

require_once __DIR__ . '/vendor/autoload.php';

##################################
class Container
{
    private $definitions = [];

    public function set($id, $callback)
    {
        $this->definitions[$id] = $callback;
    }

    public function get($id)
    {
        if (!isset($this->definitions[$id])) {
            throw new \Exception('Undefined component ' . $id);
        }
        return call_user_func($this->definitions[$id], $this);
    }
}
##################################
$container = new Container();
$container->set('cart.storage', function (Container $container) {
    return new SessionStorage('cart');
});
$container->set('cart.calculator', function (Container $container) {
    return new SimpleCost();
});
$container->set('cart', function (Container $container) {
    return new Cart(
        $container->get('cart.storage'),
        $container->get('cart.calculator')
    );
});
##################################

$cart = $container->get('cart');

$cart->add(1, 3, 100);
print_r($cart->getItems());
