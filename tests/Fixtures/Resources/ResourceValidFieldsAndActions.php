<?php

namespace FriendsOfCat\NovaUnit\Tests\Fixtures\Resources;

use Illuminate\Http\Request;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Actions\ActionNoFields;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Actions\ActionValidFields;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Filters\FakeBooleanFilter;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Filters\FakeSelectFilter;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

class ResourceValidFieldsAndActions extends Resource
{
    public static $model = MockModel::class;

    public function fields(Request $request)
    {
        return [
            Text::make('Alpha', 'field_alpha'),
            Number::make('Beta', 'field_beta'),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new ActionValidFields(),
            new ActionNoFields(),
        ];
    }

    public function filters(Request $request)
    {
        return [
            new FakeSelectFilter(),
            new FakeBooleanFilter(),
        ];
    }
}
