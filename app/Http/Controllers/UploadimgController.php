<?php

namespace App\Http\Controllers;

use App\Uploadimg;
use Illuminate\Http\Request;

class UploadimgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Uploadimg::latest()->paginate(5);

        return view('ponpes.uploadimg.index', compact('data'));
        // return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ponpes.uploadimg.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nm = $request->src_img;
        $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalName();
        $files = 'img';

        $upload = new Uploadimg();
        $upload->nama_img = $request->nama_img;
        $upload->src_img = $namaFile;

        $nm->move($files, $namaFile);
        $upload->save();

        // dd('berhasil');
        return redirect('upload')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Uploadimg  $uploadimg
     * @return \Illuminate\Http\Response
     */
    public function show(Uploadimg $uploadimg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Uploadimg  $uploadimg
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Uploadimg::find($id);
        return view('ponpes.uploadimg.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Uploadimg  $uploadimg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ubah = Uploadimg::find($id);
        $awal = $ubah->src_img; //nama uploadimg
        // $awal->getClientOriginalName();

        $files = public_path() . '/img'; //nama folder yang di tujuh

        $dt = [
            'nama_img' => $request['nama_img'],
            'src_img' => $awal,
        ];

        $request->src_img->move($files, $awal);
        $ubah->update($dt);

        return redirect('upload')->with('success', 'berhasil edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Uploadimg  $uploadimg
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $image = Uploadimg::find($id);

            unlink("img/" . $image->src_img);

            Uploadimg::where("id_img", $image->id_img)->delete();
            return redirect('uploadimg')->with('success', 'Data berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect('uploadimg')->withErrors($th->getMessage());
        }
    }
}
