<?php
declare(strict_types=1);

namespace App\Model\RecipeItem;

use App\Model\Ingredient\IngredientInterface;

class Burger implements RecipeItemInterface
{
    /**
     * @var IngredientInterface[]
     */
    private array $ingredients;

    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }


    public function addIngredient(IngredientInterface $ingredient): self
    {
        $this->ingredients[] = $ingredient;
        return $this;
    }

    public function getIngredients(): array
    {
        return $this->ingredients;
    }


    public function __toString(): string
    {
        return sprintf('Burger (%s)', $this->type);
    }

}