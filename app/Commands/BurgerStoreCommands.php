<?php

declare(strict_types=1);

namespace App\Commands;

use App\Exception\UnsupportedBurgerTypeException;
use App\Factory\BurgerFactoryInterface;
use App\Recipe\RecipeLoader;
use App\Utils;

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
     * @throws UnsupportedBurgerTypeException
     */
    public function exec(array $argv): void
    {
        if ($argv[1] === "burger:list") {
            $this->getBurgerList();
            return;
        }

        $args = explode(":", $argv[1]);

        if ($args[0] == "burger" && $args[1] == "recipe" && isset($args[2])) {
            echo $this->getBurger($args[2]);
        } else {
            echo sprintf("Command: [%s] - does not exsist\n", $argv[1]);
        }
    }

    /**
     * @throws UnsupportedBurgerTypeException
     */
    private function getBurger(string $type): string
    {
        $burger = $this->burgerFactory->createRecipeItem($type);
        return $this->recipe->getRecipe($burger);
    }

    private function getBurgerList()
    {
        $fileList = glob(Utils::projectRoot() . "/data/*");

        foreach ($fileList as $filename) {
            if (is_file($filename)) {
                echo basename($filename, ".yml"), "\n";
            }
        }
    }
}