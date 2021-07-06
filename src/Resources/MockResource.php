<?php

namespace FriendsOfCat\NovaUnit\Resources;

use FriendsOfCat\NovaUnit\MockComponent;
use FriendsOfCat\NovaUnit\Traits\ActionAssertions;
use FriendsOfCat\NovaUnit\Traits\FieldAssertions;
use FriendsOfCat\NovaUnit\Traits\FilterAssertions;

class MockResource extends MockComponent
{
    use ActionAssertions, FieldAssertions, FilterAssertions;
}
