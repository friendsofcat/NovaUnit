<?php

namespace FriendsOfCat\NovaUnit\Tests\Fixtures\Resources;

use Illuminate\Http\Request;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Actions\ActionNoFields;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Actions\ActionValidFields;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Resource;

class ResourceForFieldTests extends Resource
{
    public static $model = MockModel::class;

    public function fields(Request $request)
    {
        return [
            Text::make('Alpha', 'field_alpha')
                ->rules('max:128'),
            Number::make('Beta', 'field_beta')
                ->showOnIndex()->showOnDetail()->showOnCreating()->showOnUpdating(),
            Number::make('Gamma', 'field_gamma')
                ->hideFromIndex()->hideFromDetail()->hideWhenCreating()->hideWhenUpdating(),
            Text::make('Delta', 'field_delta')
                ->nullable()->sortable(),
            Text::make('Epsilon', 'field_epsilon')
                ->creationRules('min:8')
                ->updateRules('min:16'),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new ActionValidFields(),
            new ActionNoFields(),
        ];
    }
}
