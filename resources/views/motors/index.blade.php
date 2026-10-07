<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Data Motor - Maju Jaya Motor</title>

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
        font-size: 28px;
        color: #1f2937;
    }

    .btn {
        display: inline-block;
        padding: 10px 18px;
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

    .btn-edit {
        background-color: #f59e0b;
        color: white;
    }

    .btn-hapus {
        background-color: #dc2626;
        color: white;
    }

    .alert {
        padding: 14px 18px;
        background-color: #d1fae5;
        color: #065f46;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .table-box {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        background-color: #1f2937;
        color: white;
        padding: 14px;
        text-align: left;
    }

    td {
        padding: 14px;
        border-bottom: 1px solid #e5e7eb;
    }

    tr:hover {
        background-color: #f9fafb;
    }

    .aksi {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .aksi form {
        display: inline;
    }

    .foto {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
    }

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
    }

    .tersedia {
        background-color: #dcfce7;
        color: #166534;
    }

    .terjual {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .kosong {
        text-align: center;
        padding: 30px;
        color: #6b7280;
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

        <a href="{{ route('motor.index') }}" class="active">
            Data Motor
        </a>

        <a href="{{ route('pelanggans.index') }}">
            Data Pelanggan
        </a>

        <a href="{{ route('transaksis.index') }}">
            Nota Pembelian
        </a>

        <a href="{{ route('transaksis.index') }}">
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

        <h1>Data Motor</h1>

        <a
            href="{{ route('motor.create') }}"
            class="btn btn-tambah"
        >
            + Tambah Motor
        </a>

    </div>


    @if (session('success'))

        <div class="alert">
            {{ session('success') }}
        </div>

    @endif


    <!-- TABLE -->
    <div class="table-box">

        <table>

            <thead>

                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama Motor</th>
                    <th>Merk</th>
                    <th>Tipe</th>
                    <th>Tahun</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>


            <tbody>

                @forelse ($motors as $motor)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>


                        <td>

                            @if ($motor->foto)

                                <img
                                    src="{{ asset('storage/' . $motor->foto) }}"
                                    alt="{{ $motor->nama_motor }}"
                                    class="foto"
                                >

                            @else

                                Tidak ada foto

                            @endif

                        </td>


                        <td>
                            {{ $motor->nama_motor }}
                        </td>


                        <td>
                            {{ $motor->merk }}
                        </td>


                        <td>
                            {{ $motor->tipe }}
                        </td>


                        <td>
                            {{ $motor->tahun }}
                        </td>


                        <td>
                            Rp {{ number_format($motor->harga, 0, ',', '.') }}
                        </td>


                        <td>
                            {{ $motor->stok }}
                        </td>


                        <td>

                            @if ($motor->status == 'tersedia')

                                <span class="status tersedia">
                                    Tersedia
                                </span>

                            @else

                                <span class="status terjual">
                                    Terjual
                                </span>

                            @endif

                        </td>


                        <td>

                            <div class="aksi">

                                <a
                                    href="{{ route('motor.show', $motor->id) }}"
                                    class="btn btn-detail"
                                >
                                    Detail
                                </a>


                                <a
                                    href="{{ route('motor.edit', $motor->id) }}"
                                    class="btn btn-edit"
                                >
                                    Edit
                                </a>


                                <form
                                    action="{{ route('motor.destroy', $motor->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data motor ini?')"
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


                @empty

                    <tr>

                        <td
                            colspan="10"
                            class="kosong"
                        >
                            Belum ada data motor.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
```

</body>
</html>
