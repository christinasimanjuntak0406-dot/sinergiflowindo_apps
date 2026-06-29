<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Baru</title>
</head>
<body>

    <h2>Pesanan Baru Masuk</h2>

    <p><strong>Nama Pengirim</strong> {{ $order->nama_pengirim }}</p>

    <p><strong>Email Pengirim:</strong> {{ $order->email_pengirim }}</p>
    <p><strong>Subject</strong> {{ $order->subjek }}</p>
    <p><strong>Isi Pesan</strong> {{ $order->isi_pesan }}</p>
    <p><strong>No HP:</strong> {{ $order->nomor_telepon}}</p>
    <p>{{ $order->message }}</p>

</body>
</html>