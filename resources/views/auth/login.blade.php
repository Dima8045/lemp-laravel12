@extends('layouts.app')

@section('title', 'Блог на Laravel 12 - Вхід')

@section('content')
    <div class="max-w-md mx-auto bg-zinc-900/40 border border-zinc-800 rounded-2xl p-6">
        <h1 class="text-2xl font-semibold text-white mb-6">Вхід</h1>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
            @csrf

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

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        id="remember"
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    >
                    <label for="remember" class="ml-2 block text-sm text-white">
                        Запам'ятати мене
                    </label>
                </div>

                <a href="{{ route('password.request') }}" class="text-sm text-blue-400 hover:text-blue-200">
                    Забули пароль?
                </a>
            </div>

            <div>
                <button
                    type="submit"
                    class="w-full bg-white hover:bg-zinc-100 text-zinc-900 font-medium py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-zinc-400"
                >
                    Увійти
                </button>
            </div>
        </form>
    </div>
@endsection