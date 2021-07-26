<?php

namespace App\Http\Controllers\ponpes;

use App\Http\Controllers\Controller;
use App\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengurus = Pengurus::latest()->paginate(5);
        return view('ponpes.pengurus.index', compact('pengurus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ponpes.pengurus.create');
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
                'nik' => 'required|numeric|unique:pengurus|min:9',
                'nama_pengurus' => 'required',
                'tmp_lahir' => 'required',
                'tgl_lahir' => 'required',
                'jk' => 'required',
                'alamat' => 'required',
                'thn_akademik' => 'numeric|required',
                'foto_pengurus' => 'mimes:jpeg,jpg,png,gif|required',
            ]);
            if ($validasi->fails()) {
                return redirect()->route('pengurus.create')->withErrors($validasi);
            }

            $nm = $request->foto_pengurus;
            $destinationPath = 'img/pengurus'; // upload path
            $ext = date('YmdHis') . rand(100, 999) . "." . $nm->getClientOriginalName();
            $nm->move($destinationPath, $ext);
            $data = [
                'nama_kamar' => $request->input('nama_kamar'),
                'nik' => $request->input('nik'),
                'nama_pengurus' => $request->input('nama_pengurus'),
                'tmp_lahir' => $request->input('tmp_lahir'),
                'tgl_lahir' => $request->input('tgl_lahir'),
                'jk' => $request->input('jk'),
                'alamat' => $request->input('alamat'),
                'thn_akademik' => $request->input('thn_akademik'),
                'foto_pengurus' => $ext,
            ];
            Pengurus::create($data);
            return redirect()->route('pengurus.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->route('pengurus.create')->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function show(Pengurus $pengurus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Pengurus::find($id);
        return view('ponpes.pengurus.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'foto_pengurus' => 'sometimes|image|mimes:jpeg,jpg,png,gif'
        ]);
        // $ubah = Pengurus::find($id);
        // $awal = $ubah->foto_pengurus; //nama uploadimg
        // // $awal->getClientOriginalName();

        // $files = public_path() . '/img/pengurus'; //nama folder yang di tujuh
        //input edit
        $rand        = rand(000, 999);
        $old         = Pengurus::findOrFail($id);

        if ($request->hasFile('foto_pengurus')) {
            $loc = '/img/pengurus';
            $file   = $request->file('foto_pengurus');
            $ext    = $file->getClientOriginalExtension();

            $photo_pengurus = 'santri_' . $rand . '_' . date('YmdHis') . '.' . $ext;
            unlink('/img/pengurus/' . $old->foto_pengurus);
            //moving
            $file->move($loc, $photo_pengurus);
        } else {
            $photo_pengurus = $old->foto_pengurus;
        }
        $update = [
            'nik' => $request->nik,
            'nama_pengurus' => $request->nama_pengurus,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'alamat' => $request->alamat,
            'thn_akademik' => $request->thn_akademik,
            'foto_pengurus' => $photo_pengurus
        ];
        //move and save
        // $request->foto_pengurus->move($files, $awal);
        $old->update($update);

        return redirect('pengurus')->with('success', 'berhasil edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patch = Pengurus::findOrFail($id);

        if ($patch->foto_pengurus != NULL) {
            unlink("img/pengurus/" . $patch->foto_pengurus);
        }
        $patch->delete();

        return redirect('pengurus')->with('success', 'Berhasil menghapus Pengurus');;
    }
}
