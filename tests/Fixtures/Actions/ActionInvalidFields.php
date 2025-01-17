<?php

namespace FriendsOfCat\NovaUnit\Tests\Fixtures\Actions;

use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Text;

class ActionInvalidFields extends Action
{
    public function fields()
    {
        return [
            Text::make('Alpha', 'field_alpha'),
            new \stdClass(),
        ];
    }
}
