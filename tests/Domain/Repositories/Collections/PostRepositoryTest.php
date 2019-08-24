<?php

namespace Tests\Domain\Repositories\Collections;

use App\Domain\Models\Collections\Post;
use App\Domain\Repositories\Collections\PostRepository;
use Faker\Provider\en_US\Text;
use Faker\Provider\pt_BR\Person;
use Tests\Fixture;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    /**
     * @var PostRepository
     */
    private $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker->addProvider(new Person($this->faker));
        $this->faker->addProvider(new Text($this->faker));
        $this->repository = new PostRepository();

        $this->app['db']->connection('mongodb')->drop();
    }

    /**
     * @test
     */
    public function should_create_an_post()
    {
        $postData = Fixture::make(Post::class)->toArray();

        $post = $this->repository->create($postData);

        $this->assertInstanceOf(Post::class, $post);
    }

    /**
     * @test
     */
    public function should_update_an_post_changing_its_tittle()
    {
        $post = Fixture::create(Post::class);

        $originalTittle = $post->tittle;

        $post = $this->repository->update($post, ['tittle' => $this->faker->title]);

        $this->assertNotEquals($originalTittle, $post->tittle);
    }

    /**
     * @test
     */
    public function should_find_an_post()
    {
        $post = Fixture::create(Post::class);

        $foundPost = $this->repository->find($post->id);

        $this->assertTrue($post->is($foundPost));
    }

    /**
     * @test
     */
    public function should_not_finding_an_post_because_it_was_deleted()
    {
        $id = Fixture::create(Post::class)->id;

        $this->repository->delete($id);

        $post = $this->repository->find($id);

        $this->assertNull($post);
    }
}
