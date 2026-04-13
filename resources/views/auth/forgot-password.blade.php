@extends('layouts.app')

@section('title', 'Відновлення пароля')

@section('content')
    <div class="max-w-md mx-auto bg-zinc-900/40 border border-zinc-800 rounded-2xl p-6">
        <h1 class="text-2xl font-semibold text-white mb-6">Відновлення пароля</h1>

        @if (session('status'))
            <div class="mb-4 rounded-xl border border-green-500 bg-green-900/30 p-4 text-green-200">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full rounded-xl bg-zinc-900/60 border border-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    autofocus
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full bg-white hover:bg-zinc-100 text-zinc-900 font-medium py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-zinc-400">
                    Надіслати посилання для скидання пароля
                </button>
            </div>
        </form>

        <div class="mt-4 text-sm text-white/70">
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-200">Повернутися до входу</a>
        </div>
    </div>
@endsection