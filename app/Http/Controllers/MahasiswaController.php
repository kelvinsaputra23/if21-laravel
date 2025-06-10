<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all();
        return view('mahasiswa.create', compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'nama' => 'required',
            'npm' => 'required|unique:mahasiswas',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required',
            'asal_sma' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prodi_id' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            try {
                // Upload ke Vercel Blob
                $file = $request->file('foto');
                $fileContents = file_get_contents($file->getRealPath());
                $fileName = uniqid('mahasiswa_') . '.' . $file->getClientOriginalExtension();

                $response = Http::attach(
                    'file',
                    $fileContents,
                    $fileName
                )->post('https://blob.vercel-storage.com/api/upload', [
                    // Jika perlu, tambahkan parameter autentikasi di sini
                ]);

                if ($response->successful() && isset($response['url'])) {
                    $input['foto'] = $response['url'];
                } else {
                    return back()->withErrors(['foto' => 'Vercel Blob upload error: ' . $response->body()]);
                }
            } catch (\Exception $e) {
                return back()->withErrors(['foto' => 'Vercel Blob error: ' . $e->getMessage()]);
            }
        }

        Mahasiswa::create($input);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
