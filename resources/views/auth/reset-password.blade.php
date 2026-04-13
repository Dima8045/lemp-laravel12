@extends('layouts.app')

@section('title', 'Скидання пароля')

@section('content')
    <div class="max-w-md mx-auto bg-zinc-900/40 border border-zinc-800 rounded-2xl p-6">
        <h1 class="text-2xl font-semibold text-white mb-6">Скинути пароль</h1>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $email) }}"
                    required
                    class="w-full rounded-xl bg-zinc-900/60 border border-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    autofocus
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-white">Новий пароль</label>
                <input
                    id="password"
                    type="password"
                    name="password"
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
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full rounded-xl bg-zinc-900/60 border border-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <button type="submit" class="bg-zinc-100 text-zinc-900 px-4 py-2 rounded-lg font-medium hover:bg-white transition">
                Скинути пароль
            </button>
        </form>

        <div class="mt-4 text-sm text-white/70">
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-200">Повернутися до входу</a>
        </div>
    </div>
@endsection