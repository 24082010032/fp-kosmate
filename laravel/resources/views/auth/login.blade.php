@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center py-16" style="background: radial-gradient(circle at top, rgba(236,72,153,0.15), transparent 35%), radial-gradient(circle at bottom right, rgba(16,185,129,0.15), transparent 30%);">
  <div class="mx-auto w-full max-w-md rounded-4xl bg-white/95 p-8 shadow-2xl shadow-slate-200">
    <div class="text-center mb-8">
      <p class="text-sm font-semibold uppercase tracking-[0.4em] text-pink-600">Masuk ke Kosmate</p>
      <h1 class="mt-4 text-3xl font-bold text-slate-900">Login ke dashboard Anda</h1>
      <p class="mt-2 text-slate-500">Gunakan email dan kata sandi yang sudah terdaftar.</p>
    </div>

    @if(session('error'))
      <div class="mb-4 rounded-3xl bg-red-100 px-4 py-3 text-sm text-red-700">{{ session('error') }}</div>
    @endif
    @if($errors->any())
      <div class="mb-4 rounded-3xl bg-rose-50 px-4 py-3 text-sm text-rose-700">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
      @csrf
      <label class="block text-sm font-medium text-slate-700">Email</label>
      <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-pink-400" />

      <label class="block text-sm font-medium text-slate-700">Password</label>
      <input type="password" name="password" required class="w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-pink-400" />

      <button class="w-full rounded-3xl bg-pink-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-pink-300/30 transition hover:bg-pink-700">Login</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-pink-600 hover:underline">Daftar Calon Penyewa</a></p>
  </div>
</div>
@endsection
