<?php

namespace App\Domain\Services;

use App\Domain\Models\Collections\Post;
use App\Domain\Repositories\Collections\PostRepository;
use App\Exceptions\BusinessExceptions\PostNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class PostService extends BaseService
{
    /**
     * @var PostRepository
     */
    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAll(): Collection
    {
        return $this->repository->query()->orderByDesc('created_at')->get();
    }

    public function createOrUpdate(string $id, array $attributes)
    {
        /** @var Post $post */
        $post = $this->postService->findBy('_id', $id)->first();

        if (!$post instanceof Post) {
            return $this->postService->create($attributes);
        }

        return $this->repository->update($post, $attributes);
    }

    public function create(array $attributes): Post
    {
        $attributes['author']  = logged_user()->toArray();

        return $this->repository->create($attributes);
    }

    public function update(string $id, array $attributes): Post
    {
        $post = $this->postService->findOneBy('_id', $id);

        return $this->repository->update($post, $attributes);
    }

    public function findOneBy($key, $value): Post
    {
        /** @var Post $post */
        $post = $this->postService->findBy($key, $value)->first();

        if (!$post instanceof Post) {
            throw new PostNotFoundException();
        }

        return $post;
    }

    public function findBy($key, $value): Collection
    {
        return $this->repository->query()->where($key, $value)->get();
    }

    public function delete(string $id)
    {
        $post = $this->postService->findOneBy('_id', $id);

        return $this->repository->delete($post->id);
    }
}
