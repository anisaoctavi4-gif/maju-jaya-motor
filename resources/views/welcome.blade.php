<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Maju Jaya Motor</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f3f4f6;
            min-height: 100vh;
        }

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

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            color: #111827;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #6b7280;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .card h3 {
            color: #6b7280;
            font-size: 15px;
            margin-bottom: 12px;
        }

        .number {
            color: #111827;
            font-size: 32px;
            font-weight: bold;
        }

        .welcome-box {
            background: white;
            margin-top: 25px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .welcome-box h2 {
            color: #111827;
            margin-bottom: 10px;
        }

        .welcome-box p {
            color: #6b7280;
            line-height: 1.6;
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .content {
                margin-left: 0;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <h2>Maju Jaya Motor</h2>

        <div class="sidebar-menu">

            <a href="{{ route('dashboard') }}" class="active">
                Dashboard
            </a>

            <a href="{{ route('motor.index') }}">
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
            <h1>Dashboard</h1>
            <p>Selamat datang di Sistem Informasi Maju Jaya Motor.</p>
        </div>


        <!-- CARDS -->
        <div class="cards">

            <div class="card">
                <h3>Total Motor</h3>

                <div class="number">
                    {{ $totalMotor }}
                </div>
            </div>


            <div class="card">
                <h3>Total Pelanggan</h3>

                <div class="number">
                    {{ $totalPelanggan }}
                </div>
            </div>


            <div class="card">
                <h3>Total Pembelian</h3>

                <div class="number">
                    {{ $totalPembelian }}
                </div>
            </div>


            <div class="card">
                <h3>Total Transaksi</h3>

                <div class="number">
                    {{ $totalTransaksi }}
                </div>
            </div>

        </div>


        <!-- WELCOME -->
        <div class="welcome-box">

            <h2>Selamat Datang, Admin!</h2>

            <p>
                Gunakan menu di sebelah kiri untuk mengelola
                data motor, data pelanggan, nota pembelian,
                dan transaksi Maju Jaya Motor.
            </p>

        </div>

    </div>

</body>
</html>