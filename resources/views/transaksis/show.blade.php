<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nota Transaksi - Maju Jaya Motor</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f6f8;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 850px;
            margin: 40px auto;
        }

        .nota {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #1f2937;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .header h1 {
            color: #1f2937;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #6b7280;
            font-size: 14px;
        }

        .judul {
            text-align: center;
            margin-bottom: 25px;
        }

        .judul h2 {
            font-size: 22px;
            color: #1f2937;
        }

        .info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .info-box {
            padding: 15px;
            background-color: #f9fafb;
            border-radius: 6px;
        }

        .info-box strong {
            display: block;
            margin-bottom: 5px;
            color: #1f2937;
        }

        .info-box span {
            color: #4b5563;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        table th {
            background-color: #1f2937;
            color: white;
            padding: 13px;
            text-align: left;
        }

        table td {
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
        }

        .total {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }

        .total-box {
            width: 350px;
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 6px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 7px 0;
        }

        .total-row.grand-total {
            border-top: 2px solid #1f2937;
            margin-top: 8px;
            padding-top: 12px;
            font-size: 18px;
            font-weight: bold;
        }

        .status {
            margin-top: 25px;
            padding: 15px;
            text-align: center;
            border-radius: 6px;
            font-weight: bold;
        }

        .status-lunas {
            background-color: #dcfce7;
            color: #166534;
        }

        .status-cicil {
            background-color: #fef3c7;
            color: #92400e;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 11px 20px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-print {
            background-color: #2563eb;
            color: white;
        }

        .btn-print:hover {
            background-color: #1d4ed8;
        }

        .btn-kembali {
            background-color: #6b7280;
            color: white;
        }

        .btn-kembali:hover {
            background-color: #4b5563;
        }

        @media print {

            body {
                background-color: white;
            }

            .container {
                width: 100%;
                margin: 0;
            }

            .nota {
                box-shadow: none;
                padding: 20px;
            }

            .buttons {
                display: none;
            }
        }

        @media (max-width: 600px) {

            .info {
                grid-template-columns: 1fr;
            }

            .total-box {
                width: 100%;
            }

            .nota {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="nota">

            <div class="header">
                <h1>MAJU JAYA MOTOR</h1>

                <p>
                    Showroom Motor Terpercaya
                </p>
            </div>

            <div class="judul">
                <h2>NOTA PEMBELIAN</h2>
            </div>


            <div class="info">

                <div class="info-box">

                    <strong>Kode Transaksi</strong>

                    <span>
                        {{ $transaksi->kode_transaksi }}
                    </span>

                </div>


                <div class="info-box">

                    <strong>Tanggal Transaksi</strong>

                    <span>
                        {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}
                    </span>

                </div>


                <div class="info-box">

                    <strong>Nama Pelanggan</strong>

                    <span>
                        {{ $transaksi->pelanggan->nama }}
                    </span>

                </div>


                <div class="info-box">

                    <strong>No. HP</strong>

                    <span>
                        {{ $transaksi->pelanggan->no_hp }}
                    </span>

                </div>

            </div>


            <table>

                <thead>

                    <tr>
                        <th>Motor</th>
                        <th>Merk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>
                            {{ $transaksi->motor->nama_motor }}
                        </td>

                        <td>
                            {{ $transaksi->motor->merk }}
                        </td>

                        <td>
                            Rp {{ number_format($transaksi->harga_motor, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $transaksi->jumlah }}
                        </td>

                        <td>
                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                        </td>

                    </tr>

                </tbody>

            </table>


            <div class="total">

                <div class="total-box">

                    <div class="total-row">

                        <span>
                            Metode Pembayaran
                        </span>

                        <strong>
                            {{ $transaksi->metode_pembayaran }}
                        </strong>

                    </div>


                    <div class="total-row">

                        <span>
                            Uang Muka / DP
                        </span>

                        <strong>
                            Rp {{ number_format($transaksi->uang_muka, 0, ',', '.') }}
                        </strong>

                    </div>


                    <div class="total-row grand-total">

                        <span>
                            Total Pembayaran
                        </span>

                        <strong>
                            Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                        </strong>

                    </div>

                </div>

            </div>


            @if($transaksi->status_pembayaran == 'Lunas')

                <div class="status status-lunas">
                    STATUS PEMBAYARAN: LUNAS
                </div>

            @else

                <div class="status status-cicil">
                    STATUS PEMBAYARAN: CICIL
                </div>

            @endif


            <div class="buttons">

                <button
                    onclick="window.print()"
                    class="btn btn-print"
                >
                    🖨 Cetak Nota
                </button>

                <a
                    href="{{ route('transaksis.index') }}"
                    class="btn btn-kembali"
                >
                    Kembali
                </a>

            </div>

        </div>

    </div>

</body>
</html>