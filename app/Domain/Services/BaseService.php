<?php

namespace App\Domain\Services;

use App\Exceptions\SystemExceptions\ServiceException;

/**
 * @property UserService userService
 * @property PostService postService
 */
class BaseService
{
    const SERVICES = [
        'userService' => UserService::class,
        'postService' => PostService::class,
    ];

    public function __get($service)
    {
        if (!array_key_exists($service, self::SERVICES)) {
            throw new ServiceException();
        }

        $classname = self::SERVICES[$service];

        return app()->make($classname);
    }
}
