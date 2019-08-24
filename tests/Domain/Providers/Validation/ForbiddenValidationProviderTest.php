<?php

namespace Tests\Domain\Providers\Validation;

use Faker\Provider\pt_BR\Person;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ForbiddenValidationProviderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->faker->addProvider(new Person($this->faker));
    }

    /**
     * @test
     */
    public function should_return_forbidden_error()
    {
        $validator = Validator::make(['name' => $this->faker->name], [
            'name' => 'forbidden'
        ]);

        $this->assertNotEmpty($validator->errors()->all());
        $this->assertEquals($validator->errors()->first(), trans('validation.forbidden', ['attribute' => 'name']));
    }
}
