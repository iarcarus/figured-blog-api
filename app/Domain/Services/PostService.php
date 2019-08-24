<?php

namespace App\Domain\Services;

use App\Domain\Models\Collections\Post;
use App\Domain\Repositories\Collections\PostRepository;
use App\Exceptions\BusinessExceptions\PostCannotDeleteItselfException;
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
        return $this->repository->query()->get();
    }

    public function createOrUpdate($id, array $attributes)
    {
        /** @var Post $user */
        $user = $this->userService->findBy('id', $id)->first();

        if (!$user instanceof Post) {
            return $this->userService->create($attributes);
        }

        return $this->repository->update($user, $attributes);
    }

    public function create(array $attributes): Post
    {
        $attributes['password'] = bcrypt($attributes['password'] ?? env('DEFAULT_PASSWORD', 'Figured@2019'));

        return $this->repository->create($attributes);
    }

    public function update(int $id, array $attributes): Post
    {
        $user = $this->userService->findOneBy('id', $id);

        return $this->repository->update($user, $attributes);
    }

    public function findOneBy($key, $value): Post
    {
        /** @var Post $user */
        $user = $this->userService->findBy($key, $value)->first();

        if (!$user instanceof Post) {
            throw new PostNotFoundException();
        }

        return $user;
    }

    public function findBy($key, $value): Collection
    {
        return $this->repository->query()->where('users.' . $key, $value)->get();
    }

    public function delete(int $id)
    {
        $user = $this->userService->findOneBy('id', $id);

        if ($user->isLoggedPost()) {
            throw new PostCannotDeleteItselfException();
        }

        return $this->repository->delete($user->id);
    }
}
