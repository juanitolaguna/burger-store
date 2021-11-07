<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Commands\BurgerStoreCommands;
use App\Factory\YamlBurgerFactory;
use App\Recipe\RecipeLoader;

$burgerFactory = new YamlBurgerFactory();
$recipeLoader = new RecipeLoader();
$burgerStoreCommands = new BurgerStoreCommands($burgerFactory, $recipeLoader);

echo $burgerStoreCommands->getBurger('hamburger');
echo $burgerStoreCommands->getBurger('cheeseburger');


