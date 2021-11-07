<?php declare(strict_types=1);

namespace Test\Utils;

use App\Exception\IngredientNotFoundException;
use App\Exception\RecipeNotFoundException;
use App\Factory\YamlBurgerFactory;
use App\Model\RecipeItem\RecipeItemInterface;
use App\Utils;
use PHPUnit\Framework\TestCase;

class YamlBurgerFactoryTest extends TestCase {

    /** @test  */
    public function it_throws_recipe_not_found_exception_on_wrong_type() {
        $nonExistentRecipe = 'non_existent_recipe';
        $this->expectExceptionObject(new RecipeNotFoundException($nonExistentRecipe));
        $factory = new YamlBurgerFactory(Utils::projectRoot() . "/test/Unit/testdata/");
        $factory->createRecipeItem($nonExistentRecipe);
    }

    /** @test */
    public function it_throws_ingredient_does_not_exsist_exception() {
        $recipe = 'brokenrecipe';
        $this->expectException(IngredientNotFoundException::class);
        $factory = new YamlBurgerFactory(Utils::projectRoot() . "/test/Unit/testdata/");
        $factory->createRecipeItem($recipe);
    }

    /** @test */
    public function int_creates_a_valid_object_on_valid_recipe(){
        $recipe = 'recipe';
        $factory = new YamlBurgerFactory(Utils::projectRoot() . "/test/Unit/testdata/");
        $burger = $factory->createRecipeItem($recipe);
        $this->assertInstanceOf(RecipeItemInterface::class, $burger);
    }

    public function it_throws_type_missing_for_ingredient_exception(){
      //ToDo:...
    }




}