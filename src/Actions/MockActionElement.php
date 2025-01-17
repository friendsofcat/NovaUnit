<?php

namespace FriendsOfCat\NovaUnit\Actions;

use Laravel\Nova\Actions\Action;
use PHPUnit\Framework\Assert as PHPUnit;

class MockActionElement
{
    private $action;

    public function __construct(Action $action)
    {
        $this->action = $action;
    }

    /**
     * Assert that the action can be shown on the index view.
     *
     * @param string $message
     * @return $this
     */
    public function assertShownOnIndex(string $message = ''): self
    {
        PHPUnit::assertTrue($this->action->showOnIndex, $message);

        return $this;
    }

    /**
     * Assert that the action is hidden from the index view.
     *
     * @param string $message
     * @return $this
     */
    public function assertHiddenFromIndex(string $message = ''): self
    {
        PHPUnit::assertFalse($this->action->showOnIndex, $message);

        return $this;
    }

    /**
     * Assert that the action can be shown on the detail view.
     *
     * @param string $message
     * @return $this
     */
    public function assertShownOnDetail(string $message = ''): self
    {
        PHPUnit::assertTrue($this->action->showOnDetail, $message);

        return $this;
    }

    /**
     * Assert that the action is hidden from the detail view.
     *
     * @param string $message
     * @return $this
     */
    public function assertHiddenFromDetail(string $message = ''): self
    {
        PHPUnit::assertFalse($this->action->showOnDetail, $message);

        return $this;
    }

    /**
     * Assert that the action can be shown on table rows.
     *
     * @param string $message
     * @return $this
     */
    public function assertShownOnTableRow(string $message = ''): self
    {
        PHPUnit::assertTrue($this->action->showOnTableRow, $message);

        return $this;
    }

    /**
     * Assert that the action is hidden from table rows.
     *
     * @param string $message
     * @return $this
     */
    public function assertHiddenFromTableRow(string $message = ''): self
    {
        PHPUnit::assertFalse($this->action->showOnTableRow, $message);

        return $this;
    }
}
