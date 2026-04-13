@extends('layouts.app')

@section('title', 'Блог на Laravel 12 - Реєстрація')

@section('content')
    <div class="max-w-md mx-auto bg-zinc-900/40 border border-zinc-800 rounded-2xl p-6">
        <h1 class="text-2xl font-semibold text-white mb-6">Реєстрація</h1>

        <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-white">Ім'я</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full rounded-xl bg-zinc-900/60 border border-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full rounded-xl bg-zinc-900/60 border border-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-white">Пароль</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="w-full rounded-xl bg-zinc-900/60 border border-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-white">Підтвердження пароля</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    class="w-full rounded-xl bg-zinc-900/60 border border-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @error('password_confirmation')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button
                    type="submit"
                    class="w-full bg-white hover:bg-zinc-100 text-zinc-900 font-medium py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-zinc-400"
                >
                    Зареєструватися
                </button>
            </div>
        </form>
    </div>
@endsection