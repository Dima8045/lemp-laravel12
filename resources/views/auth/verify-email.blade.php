@extends('layouts.app')

@section('title', 'Підтвердження email')

@section('content')
<div class="max-w-md mx-auto mt-16">
    <div class="bg-zinc-900/50 border border-zinc-800 rounded-2xl p-8 shadow-sm">
        
        <h1 class="text-2xl font-semibold text-white mb-4 text-center">
            Підтвердіть email
        </h1>

        <p class="text-zinc-400 text-center mb-6 leading-relaxed">
            Дякуємо за реєстрацію! Перед початком роботи підтвердіть свою email-адресу,
            перейшовши за посиланням, яке ми щойно надіслали вам.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm text-green-400 text-center">
                Нове посилання для підтвердження було надіслано на вашу email-адресу.
            </div>
        @endif

        <div class="flex flex-col gap-4">
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full bg-white text-black py-3 rounded-xl font-semibold hover:bg-zinc-200 transition"
                >
                    Надіслати ще раз
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full text-zinc-400 hover:text-white transition"
                >
                    Вийти
                </button>
            </form>
        </div>

    </div>
</div>
@endsection