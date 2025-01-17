<?php

namespace FriendsOfCat\NovaUnit\Tests\Fixtures\Resources;

use Illuminate\Http\Request;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use Laravel\Nova\Resource;

class ResourceNoFieldsOrActions extends Resource
{
    public static $model = MockModel::class;

    public function fields(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }
}
