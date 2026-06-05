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
          <!-- TOMBOL DASHBOARD SUDAH DIPERBAIKI SINKRON TOTAL DENGAN WEB.PHP -->
          @if(auth()->user()->role === 'penghuni')
            <a href="{{ route('penghuni.dashboard') }}" class="nav-link">Dashboard</a>
          @elseif(auth()->user()->role === 'pemilik')
            <a href="{{ route('pemilik.dashboard') }}" class="nav-link">Dashboard</a>
          @else
            <a href="{{ route('calon-penyewa.dashboard') }}" class="nav-link">Dashboard</a>
          @endif

          @if(auth()->user()->role === 'pemilik')
            <a href="{{ route('pemilik.settings') }}" class="nav-link">Pengaturan</a>
          @endif
          
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button class="ml-2 text-sm text-red-600 hover:underline">Logout</button>
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