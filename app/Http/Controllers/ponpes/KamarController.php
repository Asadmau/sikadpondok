<?php

namespace App\Http\Controllers\ponpes;

use App\Http\Controllers\Controller;
use App\Kamar;
use App\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $kamar = DB::table('kamar')->join('pengurus', 'kamar.ketua_id', '=', 'pengurus.id_pengurus')->select('id_kamar', 'nama', 'kapasitas', 'pengurus.nama_pengurus as nama_ketua')->orderBy('id_kamar', 'desc')->get();
        $kamar = Kamar::latest()->paginate(10);
        // return $kamar;
        return view('ponpes.kamar.index', compact('kamar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $pengurus = Pengurus::latest()->get(); //tampilkan data pengurus
        $pengurus = Pengurus::get();
        if ($pengurus->count() == 0) {
            return redirect('kamar')->with('warning', 'Maaf ! Tidak ada "Data Pengurus Kosong" yang dimasukkan ke dalam sistem, hubungi Administrator untuk menyelesaikan permasalahan ini.');
        }
        return view('ponpes.kamar.create', compact('pengurus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validasi = Validator::make($request->all(), [
                'nama' => 'required',
                'ketua_id' => 'required',
                'kapasitas' => 'required',
            ]);
            if ($validasi->fails()) {
                return redirect()->route('kamar.create')->withErrors($validasi);
            }
            $data = [
                'nama' => $request->input('nama'),
                'ketua_id' => $request->input('ketua_id'),
                'kapasitas' => $request->input('kapasitas'),
                'kategori' => "BARU",
            ];

            Kamar::create($data);
            return redirect()->route('kamar.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->route('kamar.create')->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function show(Kamar $kamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kamar = Kamar::find($id);
        $pengurus = Pengurus::latest()->get();

        return view('ponpes.kamar.edit', compact('kamar', 'pengurus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validasi = Validator::make($request->all(), [
                'nama' => 'required',
                'ketua_id' => 'required',
                'kapasitas' => 'required',
                'kategori' => 'required',
            ]);
            if ($validasi->fails()) {
                return redirect()->route('kamar.edit')->withErrors($validasi);
            }
            $data = [
                'nama' => $request->input('nama'),
                'ketua_id' => $request->input('ketua_id'),
                'kapasitas' => $request->input('kapasitas'),
                'kategori' => $request->input('kategori'),
            ];

            Kamar::where('id_kamar', '=', $id)->update($data);
            return redirect()->route('kamar.index')->with('success', 'Data berhasil Edit.');
        } catch (\Throwable $th) {
            // return redirect()->route('kamar.create')->withErrors($th->getMessage());
            return redirect()->route('kamar.edit', $id)->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kamar  $kamar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kamar = Kamar::find($id);
        if ($kamar->delete()) {
            return back()->with('success', 'berhasil di hapus');
        } else {
            return back()->with('error', 'gagal di hapus');
        }
    }
}
