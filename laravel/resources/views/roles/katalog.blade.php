@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">
    <h1 class="text-3xl font-bold mb-6 text-slate-800">Katalog Kamar Tersedia</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($kamars as $kamar)
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-2xl font-bold text-slate-800">Kamar {{ $kamar->tipe_kamar }}</h2>
                <p class="text-emerald-600 font-medium mt-1">Status: {{ $kamar->status }}</p>
                <p class="text-slate-500 mt-2 text-lg font-semibold">Rp{{ number_format($kamar->harga, 0, ',', '.') }}</p>
                
                <div class="mt-6 flex flex-col gap-3">
                    <a href="{{ route('calon-penyewa.kamar.detail', $kamar->id) }}" 
                       class="w-full text-center bg-slate-100 text-slate-700 hover:bg-slate-200 px-4 py-2 rounded-xl font-semibold transition">
                        Lihat Detail
                    </a>

                    <form action="{{ route('calon-penyewa.booking', $kamar->id) }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" 
                                class="w-full bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-xl font-semibold transition">
                            Booking Sekarang
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection