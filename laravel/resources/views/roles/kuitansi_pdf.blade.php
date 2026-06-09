<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuitansi Resmi Kosmate - #{{ $pembayaran->id }}</title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; max-width: 600px; margin: 40px auto; padding: 20px; border: 2px dashed #000; background: #fff; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .content { margin: 20px 0; line-height: 1.8; }
        .footer { text-align: right; margin-top: 45px; }
        hr { border: none; border-top: 1px dashed #000; }
    </style>
</head>
<body>
    <div class="header">
        <h2>KUITANSI DIGITAL KOSMATE</h2>
        <p>Nota Bukti Pembayaran Hunian Kos Valid</p>
    </div>
    <div class="content">
        <p><strong>No. Transaksi :</strong> KSM-{{ $pembayaran->id }}-{{ date('Ymd', strtotime($pembayaran->created_at)) }}</p>
        <p><strong>Kamar Hunian :</strong> Kamar {{ $pembayaran->nomor_kamar }}</p>
        <p><strong>Waktu Bayar    :</strong> {{ date('d F Y H:i', strtotime($pembayaran->created_at)) }} WIB</p>
        <hr>
        <h3>TOTAL LUNAS: Rp {{ number_format($pembayaran->jumlah_bayar) }} ,-</h3>
        <hr>
        <p style="color: green; font-weight: bold; text-align: center; letter-spacing: 2px;">=== STATUS VERIFIKASI: VALID / AMAN ===</p>
    </div>
    <div class="footer">
        <p>Surabaya, {{ date('d M Y') }}</p>
        <br><br>
        <p>( Manajemen Pelayanan Kosmate )</p>
    </div>

    <script>
        // Memicu pop-up print printer bawaan laptop/komputer secara otomatis
        window.onload = function() { window.print(); }
    </script>
</body>
</html>