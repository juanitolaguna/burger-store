<?php declare(strict_types=1);

namespace App\Commands;

use App\Exception\UnsupportedIngredientTypeException;
use App\Factory\BurgerFactoryInterface;
use App\Recipe\RecipeLoader;

class BurgerStoreCommands
{
    /**
     * @var BurgerFactoryInterface
     */
    private $burgerFactory;

    /**
     * @var RecipeLoader
     */
    private $recipe;

    /**
     * @param BurgerFactoryInterface $burgerFactory
     * @param RecipeLoader $recipe
     */
    public function __construct(BurgerFactoryInterface $burgerFactory, RecipeLoader $recipe)
    {
        $this->burgerFactory = $burgerFactory;
        $this->recipe = $recipe;
    }


    /**
     * @throws UnsupportedIngredientTypeException
     */
    public static function exec(): void
    {
        echo "test\n";
        throw new UnsupportedIngredientTypeException(__CLASS__, 'test');
    }

    /**
     * @throws \App\Exception\UnsupportedBurgerTypeException
     */
    public function getBurger(string $type): string
    {
        $burger = $this->burgerFactory->createRecipeItem($type);
        return $this->recipe->getRecipe($burger);
    }
}