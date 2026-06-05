@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Daftar Calon Penyewa</h1>
  <div class="bg-white rounded-lg shadow p-4">
    <table class="w-full table-auto">
      <thead>
        <tr class="text-left">
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Nama</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">No HP</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr class="border-t">
            <td class="px-4 py-2">{{ $u->id }}</td>
            <td class="px-4 py-2">{{ $u->name }}</td>
            <td class="px-4 py-2">{{ $u->email }}</td>
            <td class="px-4 py-2">{{ $u->no_hp }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
