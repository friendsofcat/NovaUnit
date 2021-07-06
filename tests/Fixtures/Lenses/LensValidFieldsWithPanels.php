<?php

namespace FriendsOfCat\NovaUnit\Tests\Fixtures\Lenses;

use Illuminate\Http\Request;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Actions\ActionNoFields;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Actions\ActionValidFields;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Panel;

class LensValidFieldsWithPanels extends Lens
{
    public static function query(LensRequest $request, $query)
    {
    }

    public function fields(Request $request)
    {
        return [
            Text::make('Alpha', 'field_alpha'),
            new Panel('Panel', [
                Number::make('Beta', 'field_beta'),
            ]),
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
