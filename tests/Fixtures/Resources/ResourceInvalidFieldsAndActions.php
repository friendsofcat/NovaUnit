<?php

namespace FriendsOfCat\NovaUnit\Tests\Fixtures\Resources;

use Illuminate\Http\Request;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Actions\ActionValidFields;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Filters\FakeSelectFilter;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

class ResourceInvalidFieldsAndActions extends Resource
{
    public static $model = MockModel::class;

    public function fields(Request $request)
    {
        return [
            Text::make('Alpha', 'field_alpha'),
            new \stdClass(),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new ActionValidFields(),
            new \stdClass(),
        ];
    }

    public function filters(Request $request)
    {
        return [
            new FakeSelectFilter(),
            new \stdClass(),
        ];
    }
}
