<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MotorController extends Controller
{
    /**
     * Menampilkan semua data motor.
     */
    public function index()
    {
        $motors = Motor::latest()->get();

        return view('motors.index', compact('motors'));
    }

    /**
     * Menampilkan form tambah motor.
     */
    public function create()
    {
        return view('motors.create');
    }

    /**
     * Menyimpan data motor baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:255',
            'merk' => 'required|string|max:100',
            'tipe' => 'required|string|max:100',
            'tahun' => 'required|integer|min:1900|max:2100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:tersedia,terjual',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('motors', 'public');
        }

        Motor::create($data);

        return redirect()
            ->route('motor.index')
            ->with('success', 'Data motor berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail motor.
     */
    public function show(Motor $motor)
    {
        return view('motors.show', compact('motor'));
    }

    /**
     * Menampilkan form edit motor.
     */
    public function edit(Motor $motor)
    {
        return view('motors.edit', compact('motor'));
    }

    /**
     * Mengupdate data motor.
     */
    public function update(Request $request, Motor $motor)
    {
        $request->validate([
            'nama_motor' => 'required|string|max:255',
            'merk' => 'required|string|max:100',
            'tipe' => 'required|string|max:100',
            'tahun' => 'required|integer|min:1900|max:2100',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'required|in:tersedia,terjual',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {

            if ($motor->foto && Storage::disk('public')->exists($motor->foto)) {
                Storage::disk('public')->delete($motor->foto);
            }

            $data['foto'] = $request->file('foto')->store('motors', 'public');
        }

        $motor->update($data);

        return redirect()
            ->route('motor.index')
            ->with('success', 'Data motor berhasil diperbarui.');
    }

    /**
     * Menghapus data motor.
     */
    public function destroy(Motor $motor)
    {
        if ($motor->foto && Storage::disk('public')->exists($motor->foto)) {
            Storage::disk('public')->delete($motor->foto);
        }

        $motor->delete();

        return redirect()
            ->route('motor.index')
            ->with('success', 'Data motor berhasil dihapus.');
    }
}