<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Motor - Maju Jaya Motor</title>

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
        .form-group select,
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
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .info {
            color: #6b7280;
            font-size: 13px;
            margin-top: 5px;
        }

        .foto-lama {
            width: 180px;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
            display: block;
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

        .btn-update {
            background-color: #2563eb;
            color: white;
        }

        .btn-update:hover {
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

            <h2>Edit Data Motor</h2>

            <form
                action="{{ route('motor.update', $motor->id) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_motor">Nama Motor</label>

                    <input
                        type="text"
                        id="nama_motor"
                        name="nama_motor"
                        value="{{ old('nama_motor', $motor->nama_motor) }}"
                        placeholder="Contoh: Honda Beat 125"
                    >

                    @error('nama_motor')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="merk">Merk Motor</label>

                    <input
                        type="text"
                        id="merk"
                        name="merk"
                        value="{{ old('merk', $motor->merk) }}"
                        placeholder="Contoh: Honda"
                    >

                    @error('merk')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tipe">Tipe Motor</label>

                    <input
                        type="text"
                        id="tipe"
                        name="tipe"
                        value="{{ old('tipe', $motor->tipe) }}"
                        placeholder="Contoh: Beat"
                    >

                    @error('tipe')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tahun">Tahun</label>

                    <input
                        type="number"
                        id="tahun"
                        name="tahun"
                        value="{{ old('tahun', $motor->tahun) }}"
                        placeholder="Contoh: 2025"
                    >

                    @error('tahun')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga">Harga Motor</label>

                    <input
                        type="number"
                        id="harga"
                        name="harga"
                        value="{{ old('harga', $motor->harga) }}"
                        placeholder="Contoh: 25000000"
                    >

                    @error('harga')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stok">Stok</label>

                    <input
                        type="number"
                        id="stok"
                        name="stok"
                        value="{{ old('stok', $motor->stok) }}"
                        placeholder="Contoh: 5"
                    >

                    @error('stok')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="foto">Foto Motor</label>

                    @if ($motor->foto)
                        <img
                            src="{{ asset('storage/' . $motor->foto) }}"
                            alt="{{ $motor->nama_motor }}"
                            class="foto-lama"
                        >
                    @endif

                    <input
                        type="file"
                        id="foto"
                        name="foto"
                        accept="image/*"
                    >

                    <div class="info">
                        Kosongkan jika tidak ingin mengganti foto.
                    </div>

                    @error('foto')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>

                    <select id="status" name="status">

                        <option value="tersedia"
                            {{ old('status', $motor->status) == 'tersedia' ? 'selected' : '' }}>
                            Tersedia
                        </option>

                        <option value="terjual"
                            {{ old('status', $motor->status) == 'terjual' ? 'selected' : '' }}>
                            Terjual
                        </option>

                    </select>

                    @error('status')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>

                    <textarea
                        id="deskripsi"
                        name="deskripsi"
                        placeholder="Masukkan deskripsi motor..."
                    >{{ old('deskripsi', $motor->deskripsi) }}</textarea>

                    @error('deskripsi')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="buttons">

                    <button
                        type="submit"
                        class="btn btn-update"
                    >
                        Update
                    </button>

                    <a
                        href="{{ route('motor.index') }}"
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