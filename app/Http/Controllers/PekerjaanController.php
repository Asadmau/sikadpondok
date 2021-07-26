<?php

namespace App\Http\Controllers;

use App\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pekerjaan::latest()->get();
        return view('pekerjaan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pekerjaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mesage = [
            'require' => ':attribute Tidak boleh Kosong'
        ];

        $request->validate(['nama' => 'required|string|max:50'], $mesage);

        $dt = Pekerjaan::create([
            'nama' => $request->nama,
        ]);

        if ($dt->count == 0) {
            return redirect('pekerjaan')->with('success', 'Data Berhasil  Ditambahkan');
        } else {
            return redirect('pekerjaan')->with('error', 'Data Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pekerjaan::find($id);

        return view('pekerjaan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mesage = [
            'require' => ':attribute Tidak boleh Kosong'
        ];

        $request->validate(['nama' => 'required|string|max:50'], $mesage);

        $data = [
            'nama' => $request->nama,
        ];
        $data = Pekerjaan::where('id_pekerjaan', $id);
        if ($data->count() == 0) {
            return redirect('pekerjaan')->with('error', 'Data Gagal Di Edit');
        }
        $data->update($data);
        return redirect('pekerjaan')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pekerjaan::find($id);

        if ($data->delete()) {
            return back()->with('success', 'Data Berhasil di hapus');
        } else {
            return back()->with('error', 'Data Gagal Di Edit');
        }
    }
}
