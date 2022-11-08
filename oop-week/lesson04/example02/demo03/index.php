<?php

use lesson04\example02\cart\Cart;
use lesson04\example02\cart\cost\SimpleCost;
use lesson04\example02\cart\storage\SessionStorage;

require_once __DIR__ . '/vendor/autoload.php';

##################################

class Container
{
    private $definitions = [];
    private $shared = [];

    public function set($id, $callback)
    {
        $this->shared[$id] = null;
        $this->definitions[$id] = [
            'callback' => $callback,
            'shared' => false,
        ];
    }

    public function setShared($id, $callback)
    {
        $this->shared[$id] = null;
        $this->definitions[$id] = [
            'callback' => $callback,
            'shared' => true,
        ];
    }

    public function get($id)
    {
        if (isset($this->shared[$id])) {
            return $this->shared[$id];
        }

        if (!array_key_exists($id, $this->definitions)) {
            throw new \Exception('Undefined component ' . $id);
        }

        $definition = $this->definitions[$id];
        $component = call_user_func($definition['callback'], $this);
        if ($definition['shared']) {
            $this->shared[$id] = $component;
        }

        return $component;
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

$container->setShared('cart', function (Container $container) {
    return new Cart(
        $container->get('cart.storage'),
        $container->get('cart.calculator')
    );
});

##################################

$cart = $container->get('cart');
$cart->add(1, 3, 100);
print_r($cart->getItems());

$cart2 = $container->get('cart');
print_r($cart2->getItems());
