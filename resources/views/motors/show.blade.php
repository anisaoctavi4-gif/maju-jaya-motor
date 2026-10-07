<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Motor - Maju Jaya Motor</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .button {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-kembali {
            background: #6c757d;
            color: white;
        }

        .btn-edit {
            background: #ffc107;
            color: #000;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .detail-wrapper {
            display: flex;
            gap: 35px;
            flex-wrap: wrap;
        }

        .foto {
            width: 380px;
            min-height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f1f1;
            border-radius: 10px;
            overflow: hidden;
        }

        .foto img {
            width: 100%;
            max-height: 350px;
            object-fit: cover;
        }

        .no-foto {
            color: #777;
            font-size: 16px;
        }

        .detail {
            flex: 1;
            min-width: 300px;
        }

        .detail-item {
            margin-bottom: 16px;
        }

        .detail-item strong {
            display: block;
            color: #555;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .detail-item span {
            font-size: 17px;
        }

        .harga {
            font-size: 24px !important;
            font-weight: bold;
            color: #198754;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px !important;
            font-weight: bold;
        }

        .tersedia {
            background: #d1e7dd;
            color: #0f5132;
        }

        .terjual {
            background: #f8d7da;
            color: #842029;
        }

        .deskripsi {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .deskripsi h3 {
            margin-top: 0;
        }

        .deskripsi p {
            line-height: 1.7;
            color: #555;
        }

        .actions {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>Detail Motor</h1>

        <a href="{{ route('motor.index') }}" class="button btn-kembali">
            ← Kembali
        </a>
    </div>

    <div class="card">

        <div class="detail-wrapper">

            <!-- FOTO MOTOR -->
            <div class="foto">
                @if($motor->foto)
                    <img src="{{ asset('storage/' . $motor->foto) }}" alt="{{ $motor->nama_motor }}">
                @else
                    <div class="no-foto">
                        Belum ada foto motor
                    </div>
                @endif
            </div>

            <!-- DATA MOTOR -->
            <div class="detail">

                <div class="detail-item">
                    <strong>Nama Motor</strong>
                    <span>{{ $motor->nama_motor }}</span>
                </div>

                <div class="detail-item">
                    <strong>Merk</strong>
                    <span>{{ $motor->merk }}</span>
                </div>

                <div class="detail-item">
                    <strong>Tipe</strong>
                    <span>{{ $motor->tipe }}</span>
                </div>

                <div class="detail-item">
                    <strong>Tahun</strong>
                    <span>{{ $motor->tahun }}</span>
                </div>

                <div class="detail-item">
                    <strong>Harga</strong>
                    <span class="harga">
                        Rp {{ number_format($motor->harga, 0, ',', '.') }}
                    </span>
                </div>

                <div class="detail-item">
                    <strong>Stok</strong>
                    <span>{{ $motor->stok }} unit</span>
                </div>

                <div class="detail-item">
                    <strong>Status</strong>

                    @if($motor->status == 'tersedia')
                        <span class="status tersedia">
                            Tersedia
                        </span>
                    @else
                        <span class="status terjual">
                            Terjual
                        </span>
                    @endif
                </div>

            </div>

        </div>

        <!-- DESKRIPSI -->
        <div class="deskripsi">

            <h3>Deskripsi Motor</h3>

            @if($motor->deskripsi)
                <p>{{ $motor->deskripsi }}</p>
            @else
                <p>Belum ada deskripsi untuk motor ini.</p>
            @endif

        </div>

        <!-- TOMBOL -->
        <div class="actions">

            <a href="{{ route('motor.edit', $motor->id) }}"
               class="button btn-edit">
                ✏️ Edit Motor
            </a>

            <a href="{{ route('motor.index') }}"
               class="button btn-kembali">
                Kembali ke Data Motor
            </a>

        </div>

    </div>

</div>

</body>
</html>