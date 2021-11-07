<?php declare(strict_types=1);

namespace App\Recipe;


use App\Model\RecipeItem\RecipeItemInterface;

class RecipeLoader {

    public function getRecipe(RecipeItemInterface $recipeItem): string
    {
        $recipe = sprintf("%s\n", $recipeItem->__toString());

        foreach ($recipeItem->getIngredients() as $ingredient) {
            $recipe .= sprintf("\t%s\n", $ingredient->__toString());
        }

        return $recipe;
    }
}