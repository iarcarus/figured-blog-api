<?php

namespace Tests\Domain\Repositories\Tables;

use App\Domain\Models\Tables\User;
use App\Domain\Repositories\Tables\UserRepository;
use Faker\Provider\pt_BR\Person;
use Tests\Fixture;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker->addProvider(new Person($this->faker));
        $this->repository = new UserRepository();
    }

    /**
     * @test
     */
    public function should_create_an_user()
    {
        $userData = Fixture::make(User::class)->toArray();

        $userData['password'] = bcrypt('Figured@2019');

        $user = $this->repository->create($userData);

        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * @test
     */
    public function should_update_an_user_changing_its_name()
    {
        $user = Fixture::create(User::class);

        $originalName = $user->name;

        $user = $this->repository->update($user, ['name' => $this->faker->name]);

        $this->assertNotEquals($originalName, $user->name);
    }

    /**
     * @test
     */
    public function should_find_an_user()
    {
        $user = Fixture::create(User::class);

        $foundUser = $this->repository->find($user->id);

        $this->assertTrue($user->is($foundUser));
    }

    /**
     * @test
     */
    public function should_not_finding_an_user_because_it_was_deleted()
    {
        $id = Fixture::create(User::class)->id;

        $this->repository->delete($id);

        $user = $this->repository->find($id);

        $this->assertNull($user);
    }
}
