<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Data Transaksi - Maju Jaya Motor</title>

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
        min-height: 100vh;
    }

    /* SIDEBAR */
    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 250px;
        height: 100vh;
        background: #111827;
        color: white;
        padding: 25px 15px;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 22px;
    }

    .sidebar-menu {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .sidebar-menu a {
        text-decoration: none;
        color: #d1d5db;
        padding: 13px 15px;
        border-radius: 8px;
        transition: 0.2s;
    }

    .sidebar-menu a:hover {
        background: #374151;
        color: white;
    }

    .sidebar-menu a.active {
        background: #374151;
        color: white;
    }

    .logout-form {
        margin-top: 25px;
    }

    .logout-button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: #dc2626;
        color: white;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
    }

    .logout-button:hover {
        background: #b91c1c;
    }

    /* CONTENT */
    .content {
        margin-left: 250px;
        padding: 30px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header h1 {
        color: #1f2937;
        font-size: 28px;
    }

    .btn {
        display: inline-block;
        padding: 11px 18px;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-tambah {
        background-color: #2563eb;
        color: white;
    }

    .btn-tambah:hover {
        background-color: #1d4ed8;
    }

    .btn-detail {
        background-color: #16a34a;
        color: white;
    }

    .btn-detail:hover {
        background-color: #15803d;
    }

    .btn-edit {
        background-color: #f59e0b;
        color: white;
    }

    .btn-edit:hover {
        background-color: #d97706;
    }

    .btn-hapus {
        background-color: #dc2626;
        color: white;
    }

    .btn-hapus:hover {
        background-color: #b91c1c;
    }

    .alert {
        padding: 14px 18px;
        background-color: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .table-card {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th {
        background-color: #1f2937;
        color: white;
        padding: 13px;
        text-align: left;
        white-space: nowrap;
    }

    table td {
        padding: 13px;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    table tr:hover {
        background-color: #f9fafb;
    }

    .badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .badge-lunas {
        background-color: #dcfce7;
        color: #166534;
    }

    .badge-cicil {
        background-color: #fef3c7;
        color: #92400e;
    }

    .aksi {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .aksi .btn {
        padding: 7px 11px;
        font-size: 12px;
    }

    .kosong {
        text-align: center;
        padding: 35px;
        color: #6b7280;
    }

    form {
        display: inline;
    }

    /* RESPONSIVE */
    @media (max-width: 700px) {
        .sidebar {
            position: relative;
            width: 100%;
            height: auto;
        }

        .content {
            margin-left: 0;
        }

        .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }
</style>
```

</head>

<body>

```
<!-- SIDEBAR -->
<div class="sidebar">

    <h2>Maju Jaya Motor</h2>

    <div class="sidebar-menu">

        <a href="{{ route('dashboard') }}">
            Dashboard
        </a>

        <a href="{{ route('motor.index') }}">
            Data Motor
        </a>

        <a href="{{ route('pelanggans.index') }}">
            Data Pelanggan
        </a>

        <a href="{{ route('transaksis.index') }}" class="active">
            Nota Pembelian
        </a>

        <a href="{{ route('transaksis.index') }}" class="active">
            Transaksi
        </a>

    </div>

    <!-- LOGOUT -->
    <form
        action="{{ route('logout') }}"
        method="POST"
        class="logout-form"
    >
        @csrf

        <button
            type="submit"
            class="logout-button"
        >
            Logout
        </button>
    </form>

</div>


<!-- CONTENT -->
<div class="content">

    <div class="header">

        <h1>Data Transaksi</h1>

        <a
            href="{{ route('transaksis.create') }}"
            class="btn btn-tambah"
        >
            + Tambah Transaksi
        </a>

    </div>


    @if(session('success'))

        <div class="alert">
            {{ session('success') }}
        </div>

    @endif


    <!-- TABLE -->
    <div class="table-card">

        @if($transaksis->count() > 0)

            <table>

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Pelanggan</th>
                        <th>Motor</th>
                        <th>Jumlah</th>
                        <th>Total Bayar</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>

                </thead>


                <tbody>

                    @foreach($transaksis as $transaksi)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $transaksi->kode_transaksi }}
                                </strong>
                            </td>

                            <td>
                                {{ $transaksi->pelanggan->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $transaksi->motor->nama_motor ?? '-' }}
                            </td>

                            <td>
                                {{ $transaksi->jumlah }}
                            </td>

                            <td>
                                Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $transaksi->metode_pembayaran }}
                            </td>

                            <td>

                                @if($transaksi->status_pembayaran == 'Lunas')

                                    <span class="badge badge-lunas">
                                        Lunas
                                    </span>

                                @else

                                    <span class="badge badge-cicil">
                                        Cicil
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}
                            </td>

                            <td>

                                <div class="aksi">

                                    <a
                                        href="{{ route('transaksis.show', $transaksi->id) }}"
                                        class="btn btn-detail"
                                    >
                                        Nota
                                    </a>

                                    <a
                                        href="{{ route('transaksis.edit', $transaksi->id) }}"
                                        class="btn btn-edit"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('transaksis.destroy', $transaksi->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-hapus"
                                        >
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="kosong">

                <h3>Belum ada transaksi</h3>

                <p>
                    Silakan tambahkan transaksi baru.
                </p>

            </div>

        @endif

    </div>

</div>
```

</body>
</html>
