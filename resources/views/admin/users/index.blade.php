@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold">Керування користувачами</h1>
</div>

<div class="overflow-x-auto rounded-xl border border-zinc-800">
    <table class="w-full text-left border-collapse">
        <thead class="bg-zinc-900/50 text-zinc-400 text-sm uppercase tracking-wider">
            <tr>
                <th class="p-4 border-b border-zinc-800">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="hover:text-white flex items-center gap-1">
                        ID ⇅
                    </a>
                </th>
                <th class="p-4 border-b border-zinc-800">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="hover:text-white flex items-center gap-1">
                        Ім'я ⇅
                    </a>
                </th>
                <th class="p-4 border-b border-zinc-800">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'email', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="hover:text-white flex items-center gap-1">
                        Email ⇅
                    </a>
                </th>
                <th class="p-4 border-b border-zinc-800">
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'role', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="hover:text-white flex items-center gap-1">
                        Роль ⇅
                    </a>
                </th>
                <th class="p-4 border-b border-zinc-800 text-right">Дії</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-800">
            @forelse($users as $user)
                <tr class="hover:bg-zinc-900/30 transition">
                    <td class="p-4 text-sm text-zinc-400">{{ $user->id }}</td>
                    <td class="p-4">
                        <div class="font-medium text-white">{{ $user->name }}</div>
                    </td>
                    <td class="p-4 text-sm text-zinc-400">{{ $user->email }}</td>
                    <td class="p-4">
                        <select class="role-select bg-zinc-800 border border-zinc-700 text-zinc-300 rounded px-2 py-1 text-sm hover:border-zinc-600 focus:border-zinc-500 focus:outline-none" data-user-id="{{ $user->id }}">
                            @foreach(\App\Enums\UserRole::cases() as $role)
                            <option value="{{ $role->value }}" {{ $user->role === $role ? 'selected' : '' }}>
                                {{ ucfirst($role->value) }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex justify-end gap-3">
                            <!-- Можна додати дії, якщо потрібно -->
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-zinc-500 italic">Користувачів не знайдено</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-8 pagination-dark">
    {{ $users->links() }}
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.role-select').forEach(function(select) {
        select.addEventListener('change', function() {
            const userId = this.getAttribute('data-user-id');
            const newRole = this.value;

            fetch(`/admin/users/${userId}/change-role`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    role: newRole
                })
            })
            .then(response => response.json())
            .then(data => {
                showMessage(data.message, data.status);
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('Сталася невідома помилка', 'error');
            });
        });

        select.setAttribute('data-original-value', select.value);
    });
});

function showMessage(message, type) {
    const alertClass = type === 'success' ? 'bg-green-900/30 border border-green-500 text-green-200' : 'bg-red-900/30 border border-red-500 text-red-200';
    const alert = document.createElement('div');
    alert.className = `border-l-4 p-4 mb-4 ${alertClass}`;
    alert.textContent = message;

    const main = document.querySelector('main');
    main.insertBefore(alert, main.firstChild);

    setTimeout(() => {
        alert.remove();
    }, 5000);
}
</script>
@endsection