<?php declare(strict_types=1);

namespace App\Factory;

use App\Model\RecipeItem\RecipeItemInterface;

interface BurgerFactoryInterface {
    public function createRecipeItem(string $type): RecipeItemInterface;
}