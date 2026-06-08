<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penghuni - Kosmate</title>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- FontAwesome untuk Ikon Modern -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
        }
        .navbar {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 15px 0;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
        }
        .welcome-box {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 16px;
            color: white;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 18 rgba(0, 0, 0, 0.03);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: #ffffff;
            margin-bottom: 24px;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
        }
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid #f1f5f9;
            padding: 20px 24px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .card-body {
            padding: 24px;
        }
        .info-kamar-card {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: white;
        }
        .badge-status {
            padding: 8px 14px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        .btn-primary {
            background-color: #3b82f6;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }
        .btn-danger {
            background-color: #ef4444;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .table {
            margin-bottom: 0;
        }
        .table th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        .table td {
            padding: 16px;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }
    </style>
</head>
<body>

    <!-- NAVBAR PREMIUM -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand text-white d-flex align-items-center" href="#">
                <i class="fa-solid font-awesome fa-building-user me-2 text-primary"></i> KOSMATE
            </a>
            <div class="d-flex align-items-center">
                <span class="text-light me-3 d-none d-sm-inline">Selamat Datang, <strong class="text-white">{{ $user->name }}</strong></span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger px-3 py-2 rounded-pill fw-bold">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- NOTIFIKASI SYSTEM -->
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show rounded-4 mb-4" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- WELCOME BANNER -->
        <div class="welcome-box d-flex align-items-center justify-content-between row g-3">
            <div class="col-md-8">
                <h2 class="fw-bold mb-1">Halo, {{ $user->name }}! 👋</h2>
                <p class="mb-0 opacity-75">Pantau status hunian, kelola pembayaran bulanan kos, dan laporkan keluhan kendala fasilitas kamar Anda di sini.</p>
            </div>
            <div class="col-md-4 text-md-end text-start">
                <span class="badge bg-white text-primary px-3 py-2 rounded-pill fw-bold">Role: Penyewa Aktif</span>
            </div>
        </div>

        <div class="row g-4">
            <!-- SEKSI KIRI (INFO KAMAR & KOMPLAIN) -->
            <div class="col-lg-4">
                
                <!-- [FITUR 1] Dashboard Informasi Kamar -->
                <div class="card info-kamar-card">
                    <div class="card-body text-center py-4">
                        <div class="icon-box bg-blur mb-3 mx-auto d-flex align-items-center justify-content-center rounded-circle" style="width: 60px; height: 60px; background: rgba(255,255,255,0.1);">
                            <i class="fa-solid fa-door-open fs-3 text-warning"></i>
                        </div>
                        <h3 class="fw-bold mb-1">Kamar {{ $user->no_kamar ?? 'A-03' }}</h3>
                        <p class="opacity-75 mb-3">Tagihan Bulanan Anda</p>
                        <h2 class="fw-extrabold text-warning mb-4">Rp {{ number_format($infoKamar['harga'] ?? 1500000) }}</h2>
                        
                        <div class="bg-danger text-white p-3 rounded-4 fw-bold small d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-calendar-days me-2"></i> Jatuh Tempo: {{ date('d M Y', strtotime($infoKamar['jatuh_tempo'] ?? '+1 month')) }}
                        </div>
                    </div>
                </div>

                <!-- [FITUR 3] Formulir Komplain Fasilitas -->
                <div class="card">
                    <div class="card-header d-flex align-items-center text-danger">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> Laporkan Masalah Fasilitas
                    </div>
                    <div class="card-body">
                        <form action="{{ route('penghuni.kirim_komplain') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-medium text-secondary">Fasilitas Bermasalah</label>
                                <input type="text" name="judul_komplain" class="form-control" placeholder="Contoh: AC Bocor, Air Mati" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-medium text-secondary">Detail Kendala</label>
                                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan detail agar segera diperbaiki oleh pemilik..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 py-2.5">
                                <i class="fa-solid fa-paper-plane me-1"></i> Kirim Laporan Keluhan
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            <!-- SEKSI KANAN (KONFIRMASI NOMINAL PEMBAYARAN) -->
            <div class="col-lg-8">
                
                <!-- [FITUR 2] Konfirmasi Pembayaran Tanpa Gambar -->
                <div class="card">
                    <div class="card-header d-flex align-items-center text-primary">
                        <i class="fa-solid fa-wallet me-2"></i> Konfirmasi Transaksi Pembayaran Kos
                    </div>
                    <div class="card-body">
                        <form action="{{ route('penghuni.upload_pembayaran') }}" method="POST">
                            @csrf
                            <input type="hidden" name="nomor_kamar" value="{{ $user->no_kamar ?? 'A-03' }}">
                            
                            <div class="mb-3">
                                <label class="form-label fw-medium text-secondary">Jumlah Nominal yang Ditransfer (Rp)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light fw-bold text-secondary">Rp</span>
                                    <input type="number" name="jumlah_bayar" class="form-control" value="{{ $infoKamar['harga'] ?? 1500000 }}" required>
                                </div>
                                <div class="form-text text-muted mt-2">
                                    <i class="fa-solid fa-circle-info me-1"></i> Cukup pastikan nominal transfer sesuai. Riwayat akan dicatat untuk diverifikasi pemilik kos.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary px-4 py-2.5 mt-2">
                                <i class="fa-solid fa-paper-plane me-1"></i> Konfirmasi Pembayaran
                            </button>
                        </form>
                    </div>
                </div>

                <!-- [FITUR 4] Riwayat Transaksi & Cetak Kuitansi -->
                <div class="card">
                    <div class="card-header d-flex align-items-center text-secondary">
                        <i class="fa-solid fa-clock-history me-2"></i> Riwayat Pembayaran Kos Anda
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th class="ps-4">Tanggal Unggah</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th class="text-center pe-4">Aksi / Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayatBayar as $bayar)
                                    <tr>
                                        <td class="ps-4 fw-medium">{{ date('d M Y H:i', strtotime($bayar->created_at)) }}</td>
                                        <td class="fw-bold text-dark">Rp {{ number_format($bayar->jumlah_bayar) }}</td>
                                        <td>
                                            @if($bayar->status == 'approved')
                                                <span class="badge-status bg-success text-white"><i class="fa-solid fa-check me-1"></i> Disetujui</span>
                                            @elseif($bayar->status == 'pending')
                                                <span class="badge-status bg-warning text-dark"><i class="fa-solid fa-spinner fa-spin me-1"></i> Pending</span>
                                            @else
                                                <span class="badge-status bg-danger text-white"><i class="fa-solid fa-xmark me-1"></i> Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="text-center pe-4">
                                            @if($bayar->status == 'approved')
                                                <a href="{{ route('penghuni.cetak_kuitansi', $bayar->id) }}" target="_blank" class="btn btn-sm btn-success px-3 py-2 rounded-3 fw-bold shadow-sm">
                                                    <i class="fa-solid fa-print me-1"></i> Cetak PDF
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-light text-muted px-3 py-2 rounded-3" disabled>Belum Tersedia</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-receipt fs-2 mb-3 d-block text-secondary opacity-50"></i>
                                            Belum ada riwayat unggahan transaksi pembayaran kos.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>