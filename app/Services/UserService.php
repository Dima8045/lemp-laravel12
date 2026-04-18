<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function changeRole(int $id, UserRole $role): bool
    {
        return $this->userRepository->updateRole($id, $role);
    }
}