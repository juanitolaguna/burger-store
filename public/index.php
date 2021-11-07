<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Commands\BurgerStoreCommands;
use App\Factory\YamlBurgerFactory;
use App\Recipe\RecipeLoader;
use App\Utils;

$burgerFactory = new YamlBurgerFactory(Utils::projectRoot() . "/data/");
$recipeLoader = new RecipeLoader();
$burgerStoreCommands = new BurgerStoreCommands($burgerFactory, $recipeLoader);

$burgerStoreCommands->exec($argv);


