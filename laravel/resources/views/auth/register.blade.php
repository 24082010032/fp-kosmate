@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-80px)] flex items-center justify-center py-16" style="background: radial-gradient(circle at top, rgba(16,185,129,0.10), transparent 35%), radial-gradient(circle at bottom left, rgba(236,72,153,0.12), transparent 30%);">
  <div class="mx-auto w-full max-w-lg rounded-4xl bg-white/95 p-8 shadow-2xl shadow-slate-200">
    <div class="text-center mb-8">
      <span class="inline-flex rounded-full bg-emerald-100 px-4 py-2 text-sm font-semibold text-emerald-700">Daftar Calon Penyewa</span>
      <h1 class="mt-4 text-3xl font-bold text-slate-900">Buat akun Kosmate Anda</h1>
      <p class="mt-2 text-slate-500">Isi data singkat untuk mulai mencari kamar dan mengajukan pemesanan.</p>
    </div>

    @if($errors->any())
      <div class="mb-4 rounded-3xl bg-rose-50 px-4 py-3 text-sm text-rose-700">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
      @csrf
      <div>
        <label class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
        <input name="name" value="{{ old('name') }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-emerald-400" />
      </div>
      <div>
        <label class="block text-sm font-medium text-slate-700">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-emerald-400" />
      </div>
      <div class="grid gap-5 md:grid-cols-2">
        <div>
          <label class="block text-sm font-medium text-slate-700">Password</label>
          <input type="password" name="password" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-emerald-400" />
        </div>
        <div>
          <label class="block text-sm font-medium text-slate-700">Konfirmasi Password</label>
          <input type="password" name="password_confirmation" required class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-emerald-400" />
        </div>
      </div>
      <input type="hidden" name="role" value="calon_penyewa">
      <div>
        <label class="block text-sm font-medium text-slate-700">No. HP (opsional)</label>
        <input name="no_hp" value="{{ old('no_hp') }}" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none focus:border-emerald-400" />
      </div>
      <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
        Akun yang dibuat di sini akan langsung menjadi <strong>Calon Penyewa</strong>.
      </div>
      <button class="w-full rounded-3xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-300/30 transition hover:bg-emerald-700">Daftar Sekarang</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:underline">Login di sini</a></p>
  </div>
</div>
@endsection
