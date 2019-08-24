<?php

namespace App\Domain\Services;

use App\Domain\Models\Tables\User;
use App\Domain\Repositories\Tables\UserRepository;
use App\Exceptions\BusinessExceptions\UserCannotDeleteItselfException;
use App\Exceptions\BusinessExceptions\UserNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class UserService extends BaseService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAll(): Collection
    {
        return $this->repository->query()->get();
    }

    public function createOrUpdate($id, array $attributes)
    {
        /** @var User $user */
        $user = $this->userService->findBy('id', $id)->first();

        if (!$user instanceof User) {
            return $this->userService->create($attributes);
        }

        return $this->repository->update($user, $attributes);
    }

    public function create(array $attributes): User
    {
        $attributes['password'] = bcrypt($attributes['password'] ?? env('DEFAULT_PASSWORD', 'Figured@2019'));

        return $this->repository->create($attributes);
    }

    public function update(int $id, array $attributes): User
    {
        $user = $this->userService->findOneBy('id', $id);

        return $this->repository->update($user, $attributes);
    }

    public function findOneBy($key, $value): User
    {
        /** @var User $user */
        $user = $this->userService->findBy($key, $value)->first();

        if (!$user instanceof User) {
            throw new UserNotFoundException();
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

        if ($user->isLoggedUser()) {
            throw new UserCannotDeleteItselfException();
        }

        return $this->repository->delete($user->id);
    }
}
