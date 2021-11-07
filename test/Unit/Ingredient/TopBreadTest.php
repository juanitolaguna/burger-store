<?php
declare(strict_types=1);

namespace Test\Unit\Ingredient;

use App\Exception\UnsupportedIngredientTypeException;
use App\Model\Ingredient\TopBread;
use PHPUnit\Framework\TestCase;

class TopBreadTest extends TestCase
{
    /** @test */
    public function it_instantiates_with_supported_types()
    {
        $topBread = new TopBread(TopBread::TYPE_PLAIN);
        $this->assertInstanceOf(TopBread::class, $topBread);
    }

    /** @test */
    public function it_throws_validation_error_on_wrong_type() {
        $type = 'unsupported';
        $this->expectExceptionObject(new UnsupportedIngredientTypeException(TopBread::class, $type));
        $topBread = new TopBread($type);
    }


}