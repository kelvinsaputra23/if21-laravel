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

        dd(
            env('BLOB_READ_WRITE_TOKEN'),
            env('VERCEL_BLOB_BASE_URL'),
            env('VERCEL_BLOB_STORE_ID')
        );
        $input = $request->validate([
            'nama' => 'required',
            'npm' => 'required|unique:mahasiswas',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required',
            'asal_sma' => 'required',
            'foto' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:5120', // max 5MB
            'prodi_id' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            try {
                $file = $request->file('foto');
                $fileName = $file->getClientOriginalName();

                $response = Http::withToken(env('BLOB_READ_WRITE_TOKEN'))
                    ->attach('file', file_get_contents($file), $fileName)
                    ->post(env('VERCEL_BLOB_BASE_URL') . '/upload', [
                        'access' => 'public', // atau 'private'
                        'storeId' => env('VERCEL_BLOB_STORE_ID'), // pastikan ini ada dan benar
                    ]);

                if ($response->successful() && isset($response->json()['url'])) {
                    $input['foto'] = $response->json()['url'];
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
