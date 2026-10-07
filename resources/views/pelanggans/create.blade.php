<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pelanggan - Maju Jaya Motor</title>

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

        .navbar {
            background-color: #1f2937;
            color: white;
            padding: 20px 40px;
        }

        .navbar h1 {
            font-size: 24px;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 40px auto;
        }

        .card {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .card h2 {
            margin-bottom: 25px;
            color: #1f2937;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 15px;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .buttons {
            display: flex;
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

        .btn-simpan {
            background-color: #2563eb;
            color: white;
        }

        .btn-simpan:hover {
            background-color: #1d4ed8;
        }

        .btn-kembali {
            background-color: #6b7280;
            color: white;
        }

        .btn-kembali:hover {
            background-color: #4b5563;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h1>Maju Jaya Motor</h1>
    </div>

    <div class="container">

        <div class="card">

            <h2>Tambah Data Pelanggan</h2>

            <form action="{{ route('pelanggans.store') }}" method="POST">

                @csrf

                <div class="form-group">
                    <label for="nama">Nama Pelanggan</label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Budi Santoso"
                    >

                    @error('nama')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>

                    <textarea
                        id="alamat"
                        name="alamat"
                        placeholder="Masukkan alamat pelanggan"
                    >{{ old('alamat') }}</textarea>

                    @error('alamat')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor HP</label>

                    <input
                        type="text"
                        id="no_hp"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        placeholder="Contoh: 081234567890"
                    >

                    @error('no_hp')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="buttons">

                    <button
                        type="submit"
                        class="btn btn-simpan"
                    >
                        Simpan
                    </button>

                    <a
                        href="{{ route('pelanggans.index') }}"
                        class="btn btn-kembali"
                    >
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>