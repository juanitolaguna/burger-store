<?php
declare(strict_types=1);

namespace App\Factory;

use App\Exception\UnsupportedBurgerTypeException;
use App\Model\Ingredient\BottomBread;
use App\Model\Ingredient\Cheese;
use App\Model\Ingredient\Mayonnaise;
use App\Model\Ingredient\TopBread;
use App\Model\RecipeItem\Burger;
use App\Model\RecipeItem\RecipeItemInterface;
use App\Utils;
use Symfony\Component\Yaml\Yaml;

class DefaultBurgerFactory implements BurgerFactoryInterface
{


    public function createRecipeItem(string $type): RecipeItemInterface
    {

        $burger = Yaml::parseFile(Utils::projectRoot() . "/data/hamburger.yml");

        echo print_r($burger, true);

        $burger = new Burger($type);
        $burger
            ->addIngredient(new TopBread(TopBread::TYPE_SESAME))
            ->addIngredient(new Mayonnaise())
            ->addIngredient(new Cheese(Cheese::TYPE_CHEDDAR))
            ->addIngredient(new BottomBread(BottomBread::TYPE_PLAIN));

        return $burger;

    }
}