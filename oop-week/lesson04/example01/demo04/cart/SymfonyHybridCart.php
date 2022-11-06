<?php

namespace lesson04\example01\demo04\cart;

class SymfonyHybridCart extends Cart
{
    private $session;
    private $sessionKey;
    private $tableName;
    private $tokenStorage;
    private $entityManager;

    public function __construct(
        Session $session,
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage,
        $sessionKey = 'cart',
        $tableName = 'cart'
    )
    {
        $this->session = $session;
        $this->sessionKey = $sessionKey;
        $this->tableName = $tableName;
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
    }

    protected function loadItems()
    {
        if ($this->items === null) {
            if ($user = $this->getUser()) {
                $this->items = []; // $this->entityManager->createQueryBuilder()->...;
            } else {
                $this->items = $this->session->get($this->sessionKey, []);
            }
        }
    }

    protected function saveItems()
    {
        if ($user = $this->getUser()) {
            // $this->entityManager->createQueryBuilder()->...;
        } else {
            $this->session->set($this->sessionKey, $this->items);
        }
    }

    private function getUser()
    {
        $token = $this->tokenStorage->getToken();
        if ($token !== null) {
            $user = $token->getUser();
            if ($user instanceof User) {
                return $user;
            }
        }
        return null;
    }
}

class User
{
    public function getId()
    {

    }
}