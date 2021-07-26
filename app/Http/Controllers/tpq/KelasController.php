<?php

namespace App\Http\Controllers\tpq;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Ustad;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kelas::latest()->get();

        // dd($data . 'berhasil');
        return view('tpq.kelas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ustad = Ustad::latest()->get();
        if ($ustad->count() == 0) {
            return redirect('kelas')->with('warning', 'Maaf ! Tidak ada "Guru" yang dimasukkan ke dalam sistem, hubungi Administrator untuk menyelesaikan permasalahan ini.');
        }
        return view('tpq.kelas.create', compact('ustad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guru = new Ustad();
        foreach ($guru->get() as $guru) {
            $arr[] = $guru->id_ustad;
        }
        $g = implode(', ', $arr);
        $message = [
            'required' => ':attribute tidak boleh kosong !!',
            'numeric' => 'Maaf data yang di inputkan salah, Data Harus Berupa Angka',
            'uniuee' => 'Maaf Kode Harus Uniq/ Data Sudah Ada'
        ];
        $request->validate([
            'kode_kelas' => 'required|string|max:10|unique:kelas,kode_kelas',
            'nama'      => 'required|string|max:100',
            'kapasitas' => 'required|numeric|max:100',
            'jenjang'   => 'required|in:Awwaliyah,Wustha,Ulya ',
            'wali_kelas' => 'required|in:' . $g,
        ], $message);
        Kelas::create([
            'kode_kelas' => $request->kode_kelas,
            'nama'      => $request->nama,
            'kapasitas' => $request->kapasitas,
            'jenjang'   => $request->jenjang,
            'wali_kelas' => $request->wali_kelas
        ]);
        return redirect('kelas')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ustad   = Ustad::latest()->get();
        if ($ustad->count() == 0) {
            return redirect('kelas.index')->with('warning', 'Maaf ! Tidak ada "ustad" yang dimasukkan ke dalam sistem, hubungi Administrator untuk menyelesaikan permasalahan ini.');
        }
        $data   = Kelas::where('id_kelas', $id);
        if ($data->count() == 0) {
            return redirect('kelas.index');
        }
        // dd($ustad, $data, 'berhasil');
        $data = $data->first();
        return view('tpq.kelas.edit', compact('data', 'ustad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $guru = new Ustad();
        foreach ($guru->get() as $guru) {
            $arr[] = $guru->id_ustad;
        }
        $g = implode(', ', $arr);
        $message = [
            'required' => ':attribute tidak boleh kosong !!',
            'numeric' => 'Maaf data yang di inputkan salah, Data Harus Berupa Angka',
            'uniuee' => 'Maaf Kode Harus Uniq/ Data Sudah Ada'
        ];
        $request->validate([
            'kode_kelas' => 'required|string|max:10|unique:kelas,kode_kelas',
            'nama'      => 'required|string|max:100',
            'kapasitas' => 'required|numeric|max:100',
            'jenjang'   => 'required|in:Awwaliyah,Wustha,Ulya ',
            'wali_kelas' => 'required|in:' . $g,
        ], $message);
        $list = [
            'kode_kelas' => $request->kode_kelas,
            'nama'      => $request->nama,
            'kapasitas' => $request->kapasitas,
            'jenjang'   => $request->jenjang,
            'wali_kelas' => $request->wali_kelas
        ];
        $data = Kelas::where('id_kelas', $id);
        if ($data->count() == 0) {
            return redirect('kelas')->with('error', 'Gagal Di edit');
        }
        $data->update($list);
        return redirect('kelas')->with('success', 'Data Berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::find($id);
        if ($kelas->delete()) {
            return back()->with('success', 'Data berhasil di hapus');
        } else {
            return back()->with('error', 'Data gagal di hapus');
        }
    }
}
