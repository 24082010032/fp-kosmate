@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Komplain</h1>
  @if(session('message'))<div class="p-3 bg-green-100">{{ session('message') }}</div>@endif
  <div class="bg-white p-4 rounded shadow mb-6">
    <form method="POST" action="{{ auth()->user()->role === 'pemilik' ? '#' : route('penghuni.komplains.store') }}">
      @csrf
      <textarea name="isi_komplain" class="w-full border p-2" placeholder="Tulis komplain..." required></textarea>
      <button class="mt-2 bg-pink-500 text-white px-4 py-2 rounded">Kirim Komplain</button>
    </form>
  </div>
  <div class="bg-white p-4 rounded shadow">
    <table class="w-full">
      <thead><tr><th>#</th><th>User</th><th>Isi</th><th>Status</th></tr></thead>
      <tbody>
        @foreach($komplains as $k)
          <tr class="border-t"><td class="px-2 py-1">{{ $k->id }}</td><td class="px-2 py-1">{{ $k->user->name }}</td><td class="px-2 py-1">{{ $k->isi_komplain }}</td><td class="px-2 py-1">{{ $k->status }}</td></tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
