<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Kosmate</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>body{background:linear-gradient(180deg,#f8fafc, #fff);} .nav-link{color:#374151}</style>
</head>
<body class="min-h-screen">
  <header class="bg-white shadow">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
      <a href="{{ route('welcome') }}" class="font-bold text-xl">Kosmate</a>
      <nav class="space-x-4 flex items-center">
        @auth
          {{-- Navigasi Dashboard Khusus Non-Pemilik --}}
          @if(auth()->user()->role === 'penghuni')
            <a href="{{ route('penghuni.dashboard') }}" class="nav-link">Dashboard</a>
          @elseif(auth()->user()->role === 'calon_penyewa')
            <a href="{{ route('calon-penyewa.dashboard') }}" class="nav-link">Dashboard</a>
          @endif

          {{-- Tombol Dashboard & Pengaturan Milik Pemlik Sudah Dihapus Total dari Sini --}}
          
          {{-- Tombol Logout --}}
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button class="ml-2 text-sm text-red-600 hover:underline font-semibold">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="nav-link">Login</a>
          <a href="{{ route('register') }}" class="nav-link">Daftar</a>
        @endauth
      </nav>
    </div>
  </header>

  <main class="py-8">
    @yield('content')
  </main>
</body>
</html>