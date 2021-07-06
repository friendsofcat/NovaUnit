<?php

namespace FriendsOfCat\NovaUnit;

abstract class MockComponent
{
    protected $component;

    public function __construct($component)
    {
        $this->component = $component;
    }
}
