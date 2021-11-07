<?php

declare(strict_types=1);

namespace App\Model\Ingredient;

use App\Color;
use App\Exception\UnsupportedColorException;
use App\Exception\UnsupportedIngredientTypeException;

class BottomBread implements IngredientInterface
{
    public const TYPE_PLAIN = 'plain';
    private string $type;
    private string $color;

    /**
     * @throws UnsupportedColorException
     * @throws UnsupportedIngredientTypeException
     */
    public function __construct(string $type, string $color = 'default')
    {
        $this->validate($type);
        $this->type = $type;
        $this->color = Color::getColorCode($color);
    }

    /**
     * @param string $type
     * @return void
     * @throws UnsupportedIngredientTypeException
     */
    private function validate(string $type): void
    {
        if (!in_array($type, $this->getSupportedTypes(), true)) {
            throw new UnsupportedIngredientTypeException(__CLASS__, $type);
        }
    }

    private function getSupportedTypes(): array
    {
        return [
            self::TYPE_PLAIN,
        ];
    }

    public function __toString(): string
    {
        return sprintf("%sBottom Bread: %s\e[0m", $this->color, $this->type);
    }
}