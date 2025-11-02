<?php
//app/Http/Controllers/ProgressController.php

namespace App\Http\Controllers;

use App\Models\progress;
use App\Models\matkul;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    //tampilkan semua progress
    public function index()
    {
        $progresses = progress::with('matkul')->get();
        return view('progress.index', compact('progresses'));
    }
    
    // show create form
    public function create()
    {
        $matkuls = matkul::all();
        return view('progress.create', compact('matkuls'));
    }
    //simpan progress baru
    public function store(Request $request)
    {
        $request->validate([
            'absensi' => 'required|boolean',
            'topik' => 'required|string|max:100',
            'topic_desc' => 'nullable|string|max:255',
            'status' => 'required|in:Online,Offline,Asynchronus',
            'jenis' => 'required|in:Kelas,Kuis,UTS,UAS',
            'rating_materi' => 'required|integer|min:1|max:5',
            'rating_paham' => 'required|integer|min:1|max:5',
            'matkul_id' => 'required|exists:matkul,matkul_id',
            'tugas' => 'nullable|string|max:255',
            'review' => 'required|integer|min:0|max:1',
            'notes' => 'nullable|string|max:255'
        ]);

        $data = $request->all();
        // Provide defaults for optional fields so DB doesn't reject missing non-null columns
        if (!array_key_exists('topic_desc', $data)) {
            $data['topic_desc'] = '';
        }
        // Normalize tugas to 0/1 if form uses 'Ada'/'Tidak Ada'
        if (isset($data['tugas'])) {
            if ($data['tugas'] === 'Ada' || $data['tugas'] === '1') {
                $data['tugas'] = 1;
            } elseif ($data['tugas'] === 'Tidak Ada' || $data['tugas'] === '0') {
                $data['tugas'] = 0;
            }
        } else {
            $data['tugas'] = 0;
        }
        $data['created_at'] = now();
        progress::create($data);
        return redirect()->route('progresses.index')->with('success', 'Progress berhasil ditambahkan.');
    }

    //tampilkan detail progress berdasarkan matkul
    public function byMatkul($matkul_id)
    {
        $progresses = progress::where('matkul_id', $matkul_id)->with('matkul')->get();
        return view('progress.byMatkul', compact('progresses'));
    }

    // show edit form
    public function edit($id)
    {
        $progress = progress::findOrFail($id);
        $matkuls = matkul::all();
        return view('progress.edit', compact('progress','matkuls'));
    }

    // update progress
    public function update(Request $request, $id)
    {
        $request->validate([
            'absensi' => 'required|boolean',
            'topik' => 'required|string|max:100',
            'topic_desc' => 'nullable|string|max:255',
            'status' => 'required|in:Online,Offline,Asynchronus',
            'jenis' => 'required|in:Kelas,Kuis,UTS,UAS',
            'rating_materi' => 'required|integer|min:1|max:5',
            'rating_paham' => 'required|integer|min:1|max:5',
            'matkul_id' => 'required|exists:matkul,matkul_id',
            'tugas' => 'nullable|string|max:255',
            'review' => 'required|integer|min:0|max:1',
            'notes' => 'nullable|string|max:255'
        ]);

        $progress = progress::findOrFail($id);
        $data = $request->all();
        if (!array_key_exists('topic_desc', $data)) {
            $data['topic_desc'] = '';
        }
        if (isset($data['tugas'])) {
            if ($data['tugas'] === 'Ada' || $data['tugas'] === '1') {
                $data['tugas'] = 1;
            } elseif ($data['tugas'] === 'Tidak Ada' || $data['tugas'] === '0') {
                $data['tugas'] = 0;
            }
        } else {
            $data['tugas'] = 0;
        }

        $progress->update($data);
        return redirect()->route('progresses.index')->with('success', 'Progress berhasil diperbarui.');
    }

    // delete progress
    public function destroy($id)
    {
        $progress = progress::findOrFail($id);
        $progress->delete();
        return redirect()->route('progresses.index')->with('success', 'Progress berhasil dihapus.');
    }
}