<?php
declare(strict_types=1);

namespace App\Factory;

use App\Exception\UnsupportedBurgerTypeException;
use App\Model\Ingredient\BottomBread;
use App\Model\Ingredient\Cheese;
use App\Model\Ingredient\IngredientInterface;
use App\Model\Ingredient\Mayonnaise;
use App\Model\Ingredient\TopBread;
use App\Model\RecipeItem\Burger;
use App\Model\RecipeItem\RecipeItemInterface;
use App\Utils;
use Symfony\Component\Yaml\Yaml;

class YamlBurgerFactory implements BurgerFactoryInterface
{

    /**
     */
    public function createRecipeItem(string $type): RecipeItemInterface
    {
        $data = Yaml::parseFile(Utils::projectRoot() . "/data/$type.yml");

        $burger = new Burger($type);
        $namespace = 'App\Model\Ingredient\\';


        foreach ($data['Ingredients'] as $key => $val) {
            $classname = $namespace . $key;
            /** @var IngredientInterface $ingredient */
            $ingredient = new $classname($val['type'], $val['color'] ?? 'default');
            $burger->addIngredient($ingredient);
        }

        return $burger;
    }
}