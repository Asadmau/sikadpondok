<?php

namespace App\Http\Controllers;

use App\Tahunakdemik;
use Illuminate\Http\Request;

class TahunakademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tahunakdemik::latest()->get();
        return view('tahunak.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tahunak.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute Tidak Boleh Kosong',
            'string' => 'inputan Harus Berupa Angka'
        ];

        $request->validate([
            'nama' => 'required|string|max:5',
        ], $message);

        Tahunakdemik::create([
            'nama' => $request->nama,
            'status' => 'N'
        ]);

        return redirect('tahun-akademik')->with('success', 'Data Berhasil Di tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tahunakdemik  $tahunakdemik
     * @return \Illuminate\Http\Response
     */
    public function show(Tahunakdemik $tahunakdemik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tahunakdemik  $tahunakdemik
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Tahunakdemik::find($id);

        return view('tahunak.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tahunakdemik  $tahunakdemik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mesage = [
            'required' => ':attribute Tidak boleh Kosong'
        ];

        $request->validate(['nama' => 'required|string|max:5'], $mesage);

        $data = [
            'nama' => $request->nama,
        ];
        $data = Tahunakdemik::where('id_Tahun_akademik', $id)->update($data);
        if ($data == 0) {
            return redirect('tahun-akademik')->with('error', 'Data Gagal Di Edit');
        }
        return redirect('tahun-akademik')->with('success', 'Data Berhasil edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tahunakdemik  $tahunakdemik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Tahunakdemik::find($id);

        if ($data->delete()) {
            return back()->with('success', 'Data Berhasil di hapus');
        } else {
            return back()->with('error', 'Data Gagal Di Hapus');
        }
    }

    public function apply($id)
    {
        $status = Tahunakdemik::where('id_tahun_akademik', $id)->firstOrFail();
        $st = ($status->status == 'A') ? 'N' : 'A';

        Tahunakdemik::where('status', 'A')->update(['status' => 'N']);
        Tahunakdemik::where('id_tahun_akademik', $id)->update(['status' => $st]);
        return redirect('tahun-akademik');
    }
}
