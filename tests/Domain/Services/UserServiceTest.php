<?php

namespace Tests\Domain\Services;

use App\Domain\Models\Tables\User;
use App\Domain\Services\UserService;
use App\Exceptions\BusinessExceptions\UserCannotDeleteItselfException;
use App\Exceptions\BusinessExceptions\UserNotFoundException;
use Faker\Provider\pt_BR\Person;
use Tests\Fixture;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    /**
     * @var UserService
     */
    private $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker->addProvider(new Person($this->faker));
        $this->userService = app()->make(UserService::class);
    }

    /**
     * @test
     */
    public function should_find_all_three_users()
    {
        Fixture::create(User::class, 3);

        $users = $this->userService->findAll();

        $this->assertCount(3, $users);
    }

    /**
     * @test
     */
    public function should_find_none()
    {
        $users = $this->userService->findAll();

        $this->assertCount(0, $users);
    }

    /**
     * @test
     */
    public function should_create_an_user()
    {
        $userData = Fixture::make(User::class)->toArray();

        $user = $this->userService->create($userData);

        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * @test
     */
    public function should_update_an_user_changing_its_name()
    {
        $user = Fixture::create(User::class);

        $originalName = $user->name;

        $user = $this->userService->update($user->id, ['name' => $this->faker->name]);

        $this->assertNotEquals($originalName, $user->name);
    }

    /**
     * @test
     */
    public function should_find_one_by_name()
    {
        $name = $this->faker->name;

        $user = Fixture::create(User::class, 1, ['name' => $name]);

        $foundUser = $this->userService->findOneBy('name', $name);

        $this->assertTrue($user->is($foundUser));
    }

    /**
     * @test
     */
    public function should_not_finding_an_user_because_it_do_not_exists_throwing_exception()
    {
        $this->expectException(UserNotFoundException::class);

        $this->userService->findOneBy('name', $this->faker->name);
    }

    /**
     * @test
     */
    public function should_not_finding_an_user_because_it_was_deleted_throwing_exception()
    {
        $id = Fixture::create(User::class)->id;

        $this->userService->delete($id);

        $this->expectException(UserNotFoundException::class);

        $this->userService->findOneBy('id', $id);
    }

    /**
     * @test
     */
    public function should_not_delete_an_user_because_its_you_throwing_exception()
    {
        $user = Fixture::create(User::class);

        $this->actingAs($user);

        $this->expectException(UserCannotDeleteItselfException::class);

        $this->userService->delete($user->id);
    }

    /**
     * @test
     */
    public function should_find_all_three_users_with_same_role_id()
    {
        Fixture::create(User::class, 3);

        $users = $this->userService->findBy('role_id', 1);

        $this->assertCount(3, $users);
    }
}
