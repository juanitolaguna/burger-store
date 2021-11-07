<?php

declare(strict_types=1);

namespace App\Factory;

use App\Exception\IngredientNotFoundException;
use App\Exception\RecipeNotFoundException;
use App\Exception\UnsupportedBurgerTypeException;
use App\Exception\UnsupportedIngredientTypeException;
use App\Model\Ingredient\BottomBread;
use App\Model\Ingredient\Cheese;
use App\Model\Ingredient\IngredientInterface;
use App\Model\Ingredient\Mayonnaise;
use App\Model\Ingredient\TopBread;
use App\Model\RecipeItem\Burger;
use App\Model\RecipeItem\RecipeItemInterface;
use App\Utils;
use Error;
use Exception;
use Symfony\Component\Yaml\Yaml;

class YamlBurgerFactory implements BurgerFactoryInterface
{

    private string $path;

    /**
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }


    /**
     * @throws RecipeNotFoundException
     * @throws IngredientNotFoundException
     */
    public function createRecipeItem(string $type): RecipeItemInterface
    {
        $data = $this->getData($type);
        return $this->createBurger($type, $data['Ingredients']);
    }

    /**
     * @param string $type
     * @return mixed
     * @throws RecipeNotFoundException
     */
    public function getData(string $type): mixed
    {
        try {
            $data = Yaml::parseFile($this->path . $type . ".yml");
        } catch (Exception $e) {
            throw new RecipeNotFoundException($type);
        }
        return $data;
    }

    /**
     * @param string $type
     * @param IngredientInterface[] $ingredients
     * @return Burger
     */
    public function createBurger(string $type, array $ingredients): RecipeItemInterface
    {
        $burger = new Burger($type);
        $namespace = 'App\Model\Ingredient\\';

        foreach ($ingredients as $key => $val) {
            try {
                $classname = $namespace . $key;
                /** @var IngredientInterface $ingredient */
                $ingredient = new $classname($val['type'], $val['color'] ?? 'default');
            } catch (Error $e) {
                throw new IngredientNotFoundException($key);
            }
            $burger->addIngredient($ingredient);
        }

        return $burger;
    }
}