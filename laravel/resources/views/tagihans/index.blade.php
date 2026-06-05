@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Tagihan</h1>
  @if(session('message'))<div class="p-3 bg-green-100">{{ session('message') }}</div>@endif
  <div class="bg-white p-4 rounded shadow mb-6">
    @if(auth()->user()->role === 'pemilik')
      <form method="POST" action="{{ route('pemilik.tagihans.store') }}">
        @csrf
        <div class="grid grid-cols-3 gap-2">
          <input name="user_id" placeholder="User ID" class="border p-2" required />
          <input name="total_tagihan" placeholder="Total" class="border p-2" required />
          <button class="bg-emerald-600 text-white px-4 py-2 rounded">Buat Tagihan</button>
        </div>
      </form>
    @endif
  </div>
  <div class="bg-white p-4 rounded shadow">
    <table class="w-full">
      <thead><tr><th>#</th><th>User</th><th>Total</th><th>Status</th></tr></thead>
      <tbody>
        @foreach($tagihans as $t)
          <tr class="border-t"><td class="px-2 py-1">{{ $t->id }}</td><td class="px-2 py-1">{{ $t->user->name ?? $t->user_id }}</td><td class="px-2 py-1">Rp {{ number_format($t->total_tagihan,0,',','.') }}</td><td class="px-2 py-1">{{ $t->status }}</td></tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
