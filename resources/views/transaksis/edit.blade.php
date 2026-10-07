<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Transaksi - Maju Jaya Motor</title>

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

        .info-box {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 25px;
            line-height: 1.6;
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
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 15px;
            background-color: white;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #2563eb;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .harga-info {
            margin-top: 8px;
            color: #6b7280;
            font-size: 13px;
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

            <h2>Edit Transaksi</h2>

            <div class="info-box">
                <strong>Kode Transaksi:</strong>
                {{ $transaksi->kode_transaksi }}
                <br>

                <strong>Catatan:</strong>
                Harga motor akan mengikuti harga terbaru dari data motor.
            </div>

            <form
                action="{{ route('transaksis.update', $transaksi->id) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="form-group">

                    <label for="pelanggan_id">
                        Pelanggan
                    </label>

                    <select
                        name="pelanggan_id"
                        id="pelanggan_id"
                    >

                        <option value="">
                            -- Pilih Pelanggan --
                        </option>

                        @foreach($pelanggans as $pelanggan)

                            <option
                                value="{{ $pelanggan->id }}"
                                {{ old('pelanggan_id', $transaksi->pelanggan_id) == $pelanggan->id ? 'selected' : '' }}
                            >
                                {{ $pelanggan->nama }} - {{ $pelanggan->no_hp }}
                            </option>

                        @endforeach

                    </select>

                    @error('pelanggan_id')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="motor_id">
                        Motor
                    </label>

                    <select
                        name="motor_id"
                        id="motor_id"
                    >

                        <option value="">
                            -- Pilih Motor --
                        </option>

                        @foreach($motors as $motor)

                            <option
                                value="{{ $motor->id }}"
                                data-harga="{{ $motor->harga }}"
                                data-stok="{{ $motor->stok }}"
                                {{ old('motor_id', $transaksi->motor_id) == $motor->id ? 'selected' : '' }}
                            >
                                {{ $motor->nama_motor }}
                                - {{ $motor->merk }}
                                - Rp {{ number_format($motor->harga, 0, ',', '.') }}
                                - Stok: {{ $motor->stok }}
                            </option>

                        @endforeach

                    </select>

                    @error('motor_id')
                        <div class="error">{{ $message }}</div>
                    @enderror

                    <div
                        id="infoMotor"
                        class="harga-info"
                    ></div>

                </div>


                <div class="form-group">

                    <label for="jumlah">
                        Jumlah Pembelian
                    </label>

                    <input
                        type="number"
                        name="jumlah"
                        id="jumlah"
                        value="{{ old('jumlah', $transaksi->jumlah) }}"
                        min="1"
                    >

                    @error('jumlah')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="metode_pembayaran">
                        Metode Pembayaran
                    </label>

                    <select
                        name="metode_pembayaran"
                        id="metode_pembayaran"
                    >

                        <option value="">
                            -- Pilih Metode Pembayaran --
                        </option>

                        <option
                            value="Cash"
                            {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'Cash' ? 'selected' : '' }}
                        >
                            Cash
                        </option>

                        <option
                            value="Cicilan"
                            {{ old('metode_pembayaran', $transaksi->metode_pembayaran) == 'Cicilan' ? 'selected' : '' }}
                        >
                            Cicilan
                        </option>

                    </select>

                    @error('metode_pembayaran')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="uang_muka">
                        Uang Muka / DP
                    </label>

                    <input
                        type="number"
                        name="uang_muka"
                        id="uang_muka"
                        value="{{ old('uang_muka', $transaksi->uang_muka) }}"
                        min="0"
                        step="1000"
                    >

                    @error('uang_muka')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="status_pembayaran">
                        Status Pembayaran
                    </label>

                    <select
                        name="status_pembayaran"
                        id="status_pembayaran"
                    >

                        <option value="">
                            -- Pilih Status Pembayaran --
                        </option>

                        <option
                            value="Lunas"
                            {{ old('status_pembayaran', $transaksi->status_pembayaran) == 'Lunas' ? 'selected' : '' }}
                        >
                            Lunas
                        </option>

                        <option
                            value="Cicil"
                            {{ old('status_pembayaran', $transaksi->status_pembayaran) == 'Cicil' ? 'selected' : '' }}
                        >
                            Cicil
                        </option>

                    </select>

                    @error('status_pembayaran')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="form-group">

                    <label for="tanggal_transaksi">
                        Tanggal Transaksi
                    </label>

                    <input
                        type="date"
                        name="tanggal_transaksi"
                        id="tanggal_transaksi"
                        value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi->format('Y-m-d')) }}"
                    >

                    @error('tanggal_transaksi')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                <div class="buttons">

                    <button
                        type="submit"
                        class="btn btn-update"
                    >
                        Update Transaksi
                    </button>

                    <a
                        href="{{ route('transaksis.index') }}"
                        class="btn btn-kembali"
                    >
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>


    <script>

        const motorSelect =
            document.getElementById('motor_id');

        const jumlahInput =
            document.getElementById('jumlah');

        const infoMotor =
            document.getElementById('infoMotor');


        function tampilkanInfoMotor() {

            const selectedOption =
                motorSelect.options[motorSelect.selectedIndex];

            if (!selectedOption || !selectedOption.value) {

                infoMotor.innerHTML = '';

                return;
            }

            const harga =
                selectedOption.dataset.harga;

            const stok =
                selectedOption.dataset.stok;

            infoMotor.innerHTML =
                'Harga motor: <strong>Rp ' +
                Number(harga).toLocaleString('id-ID') +
                '</strong> | Stok tersedia: <strong>' +
                stok +
                '</strong>';

            jumlahInput.max = stok;

        }


        motorSelect.addEventListener(
            'change',
            tampilkanInfoMotor
        );

        tampilkanInfoMotor();

    </script>

</body>
</html>