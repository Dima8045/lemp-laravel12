<?php

namespace App\Repositories\Interfaces;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function create(array $data): User;

    public function findByEmail(string $email): ?User;

    public function getPaginated(int $perPage): LengthAwarePaginator;

    public function updateRole(int $id,  UserRole $role): bool;
}
