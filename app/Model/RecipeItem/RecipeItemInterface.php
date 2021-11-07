<?php declare(strict_types=1);

namespace App\Model\RecipeItem;

use App\Model\Ingredient\IngredientInterface;

interface RecipeItemInterface {

    /**
     * @param IngredientInterface $ingredient
     */
    public function addIngredient(IngredientInterface $ingredient): self;

    /**
     * @return IngredientInterface[]
     */
    public function getIngredients(): array;

    public function __toString(): string;

}