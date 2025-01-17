<?php

namespace FriendsOfCat\NovaUnit\Constraints;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Panel;
use PHPUnit\Framework\Constraint\Constraint;

class HasValidFields extends Constraint
{
    private $allowPanels;

    public function __construct(bool $allowPanels = false)
    {
        $this->allowPanels = $allowPanels;
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return 'contains valid fields only';
    }

    public function matches($other): bool
    {
        foreach ($other as $field) {
            if ($this->allowPanels && $field instanceof Panel) {
                if (! $this->matches($field->data)) {
                    return false;
                }
            } elseif (! $field instanceof Field) {
                return false;
            }
        }

        return true;
    }
}
