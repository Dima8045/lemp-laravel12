<?php

namespace App\Repositories;

use App\Enums\UserRole;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function getPaginated(int $perPage): LengthAwarePaginator
    {
        $query = User::query();

        $sort = request('sort', 'id');
        $direction = request('direction', 'asc');

        // Дозволені поля для сортування
        $allowedSorts = ['id', 'name', 'email', 'role', 'created_at'];

        if (in_array($sort, $allowedSorts)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('id', 'asc');
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function updateRole(int $id,  UserRole $role): bool
    {
        return User::where('id', $id)->update(['role' => $role->value]);
    }
}
