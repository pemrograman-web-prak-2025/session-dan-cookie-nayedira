<?php
//app/Http/Controllers/MatkulControllers.php
namespace App\Http\Controllers;

use App\Models\matkul;
use Illuminate\Http\Request;

class MatkulControllers extends Controller
{
    public function index() // Menampilkan daftar mata kuliah
    {
        $matkuls = matkul::all();
        $progresses = \App\Models\progress::with('matkul')->get();
        return view('matkul.index', compact('matkuls', 'progresses'));
    }
    //simpan matkul baru
    public function store(Request $request)
    {
        $request->validate([
            'matkul_name' => 'required|string|max:50',
            'dosen_name' => 'required|string|max:50',
            'sks' => 'required|integer|min:1|max:9',
            'semester' => 'required|integer|min:1|max:14',
            'matkul_desc' => 'required|string',
            'jadwal_hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jadwal_jam' => 'required|string|max:7',
        ]);
        matkul::create ($request->all());
        return redirect()->back()->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    //tampilkan detail matkul
    public function show($id)
    {
        $matkul = matkul::with('progresses')->findOrFail($id);
        return view('matkul.show', compact('matkul'));
    }
}