<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\ChangeRoleRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
        private UserRepositoryInterface $user
    )
    {
    }

    public function index(): View
    {
        $users = $this->user->getPaginated(5);

        return view('admin.users.index', compact('users'));
    }

    public function changeRole(ChangeRoleRequest $request, int $id)
    {
        $request->validated();

        $role = UserRole::from($request->input('role'));

        if ($this->userService->changeRole($id, $role)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Роль користувача оновлено успішно.',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Не вдалося оновити роль користувача.',
        ], 500);
    }
}
