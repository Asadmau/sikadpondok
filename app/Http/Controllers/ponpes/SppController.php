<?php

namespace App\Http\Controllers\ponpes;

use App\Http\Controllers\Controller;
use App\Spp_pondok;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Spp_pondok::all();
        return view('ponpes.pembayaran-spp.spp.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $semua = [];
        $key = 0;
        $data = $request->data;
        foreach ($data as $key => $value) {
            $key += 1;
            $semua[$key] = $value;
        }

        $post = Spp_pondok::create([
            //     //     
            'nama' => json_encode($semua, TRUE),
            'total' => $request->total,
            // $post = ['nama' => json_encode($data, TRUE)];
        ]);
        // return $post;
        return redirect('spp-pondok')->with('success', 'Berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Spp_pondok  $spp_pondok
     * @return \Illuminate\Http\Response
     */
    public function show(Spp_pondok $spp_pondok)
    {
        $nama = json_decode($spp_pondok->nama);
        // dd($nama);
        return view('ponpes.pembayaran-spp.spp.detail', ['spp_pondok' => $spp_pondok, 'nama' => $nama]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Spp_pondok  $spp_pondok
     * @return \Illuminate\Http\Response
     */
    public function edit(Spp_pondok $spp_pondok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spp_pondok  $spp_pondok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spp_pondok $spp_pondok)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spp_pondok  $spp_pondok
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Spp_pondok::find($id);

        if ($data->delete() == 0) {
            return back()->with('error', 'Data Gagal di hapus');
        } else {
            return back()->with('success', 'Data Berhasil Di Hapus');
        }
    }
}
