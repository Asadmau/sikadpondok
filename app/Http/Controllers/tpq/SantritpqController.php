<?php

namespace App\Http\Controllers\tpq;

use App\Http\Controllers\Controller;
use App\Pekerjaan;
use App\Santritpq;
use App\Tahunakdemik;
use Illuminate\Http\Request;

class SantritpqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Santritpq::latest()->get();

        // dd($data, 'berhasil');
        return view('tpq.siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs   = Pekerjaan::get();
        $ta    = Tahunakdemik::where('status', 'A')->get();
        if ($jobs->count() == 0) {
            return redirect('siswa')->with('warning', 'Maaf ! Tidak ada "Daftar Pekerjaan" yang dimasukkan ke dalam sistem, hubungi Administrator untuk menyelesaikan permasalahan ini.');
        }
        if ($ta->count() == 0) {
            return redirect('siswa')->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        }
        return view('tpq.siswa.create', compact('jobs', 'ta'));
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
            'required' => ':attribute Tidak boleh Kosong',
            'mimes' => 'format yang anda masukkan salah ! formar jpg, jpeg, png',
            'numeric' => 'format Berupa angka',
        ];
        $request->validate([
            'nisn'              => 'required|numeric|unique:santritpq',
            'nama'              => 'required|string|max:100',
            'tmp_lahir'         => 'required|string|max:20',
            'tgl_lahir'         => 'required|date',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'alamat'            => 'string',
            'nama_ayah'         => 'required|string|max:100',
            'pekerjaan_ayah' => 'required',
            'photo_ayah'    => 'sometimes|image|max:2512|mimes:jpeg,jpg,png|required',
            'nama_ibu'          => 'required|string|max:100',
            'pekerjaan_ibu'  => 'required',
            'photo_ibu'     => 'sometimes|image|max:2512|mimes:jpeg,jpg,png|required',
            'hp_wa'           => 'string|max:20',
            'jenjang'   => 'required|in:Awwaliyah,Wustha,Ulya',
            'photo_santri'         => 'sometimes|image|max:2512|mimes:jpeg,jpg,png|required',
            'tahun_akademik'         => 'required',
        ], $message);
        $rand        = rand(000, 999);
        if ($request->hasFile('photo_santri')) {
            $loc = 'img/tpq/siswa';
            $file   = $request->file('photo_santri');
            $ext    = $file->getClientOriginalExtension();

            $foto_santri = 'siswa_' . $rand . '_' . date('YmdHis') . '.' . $ext;

            //moving
            $file->move($loc, $foto_santri);
        } else {
            $foto_santri = NULL;
        }

        if ($request->hasFile('photo_ayah')) {
            $uploadPath = 'img/tpq/wali';
            $file   = $request->file('photo_ayah');
            $ext    = $file->getClientOriginalExtension();

            $foto_ayah = 'ayah_' . $rand . '_' . date('YmdHis') . '.' . $ext;

            //moving
            $file->move($uploadPath, $foto_ayah);
        } else {
            $foto_ayah = NULL;
        }

        if ($request->hasFile('photo_ibu')) {
            $uploadPath = 'img/tpq/wali';
            $file   = $request->file('photo_ibu');
            $ext    = $file->getClientOriginalExtension();

            $foto_ibu = 'ibu_' . $rand . '_' . date('YmdHis') . '.' . $ext;

            //moving
            $file->move($uploadPath, $foto_ibu);
        } else {
            $foto_ibu = NULL;
        }

        Santritpq::create([
            'nisn'              => $request->nisn,
            'nama'              => $request->nama,
            'tmp_lahir'         => $request->tmp_lahir,
            'tgl_lahir'         => $request->tgl_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'alamat'            => $request->alamat,
            'tahun_akademik'    => $request->tahun_akademik,
            'nama_ayah'         => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'photo_ayah'    => $foto_ayah,
            'nama_ibu'          => $request->nama_ibu,
            'pekerjaan_ibu'  => $request->pekerjaan_ibu,
            'photo_ibu'     => $foto_ibu,
            'hp_wa'           => $request->hp_wa,
            'jenjang'           => $request->jenjang,
            'photo_santri'         => $foto_santri,
            'status' => "A",
        ]);
        return redirect('siswa')->with('success', 'Berhasil menambahkan Santri');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Santritpq  $santritpq
     * @return \Illuminate\Http\Response
     */
    public function show(Santritpq $santritpq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Santritpq  $santritpq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobs   = Pekerjaan::get();
        $ta = Tahunakdemik::get();
        if ($jobs->count() == 0) {
            return redirect('siswa')->with('warning', 'Maaf ! Tidak ada "Daftar Pekerjaan" yang dimasukkan ke dalam sistem, hubungi Administrator untuk menyelesaikan permasalahan ini.');
        }
        if ($ta->count() != 1) {
            return redirect('siswa')->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        }

        $data   = Santritpq::where('id_santri_tpq', $id);
        if ($data->count() == 0) {
            return redirect('siswa');
        }
        $data = $data->first();
        return view('tpq.siswa.edit', compact('data', 'jobs', 'ta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Santritpq  $santritpq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $message = [
            'required' => ':attribute Tidak boleh Kosong',
            'mimes' => 'format yang anda masukkan salah ! formar jpg, jpeg, png',
            'numeric' => 'format Berupa angka',
        ];
        $request->validate([
            'nama'              => 'required|string|max:100',
            'tmp_lahir'         => 'required|string|max:20',
            'tgl_lahir'         => 'required|date',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            'alamat'            => 'string',
            'nama_ayah'         => 'required|string|max:100',
            'pekerjaan_ayah' => 'required',
            'photo_ayah'    => 'sometimes|image|max:2512|mimes:jpeg,jpg,png|required',
            'nama_ibu'          => 'required|string|max:100',
            'pekerjaan_ibu'  => 'required',
            'photo_ibu'     => 'sometimes|image|max:2512|mimes:jpeg,jpg,png|required',
            'hp_wa'           => 'string|max:20',
            'jenjang'   => 'required|in:Awwaliyah,Wustha,Ulya',
            'photo_santri'         => 'sometimes|image|max:2512|mimes:jpeg,jpg,png|required',
            'tahun_akademik'         => 'required',
        ], $message);

        $rand        = rand(000, 999);
        $old         = Santritpq::findOrFail($id);

        if ($request->hasFile('photo_santri')) {
            $loc = 'img/tpq/siswa';
            $file   = $request->file('photo_santri');
            $ext    = $file->getClientOriginalExtension();

            $foto_santri = 'siswa_' . $rand . '_' . date('YmdHis') . '.' . $ext;
            unlink("img/tpq/siswa/" . $old->photo_santri);

            //moving
            $file->move($loc, $foto_santri);
        } else {
            $foto_santri = $old->photo_santri;
        }

        if ($request->hasFile('photo_ayah')) {
            $uploadPath = 'img/tpq/wali';
            $file   = $request->file('photo_ayah');
            $ext    = $file->getClientOriginalExtension();

            $foto_ayah = 'ayah_' . $rand . '_' . date('YmdHis') . '.' . $ext;
            // Storage::disk('foto')->delete($old->photo_ayah);
            unlink("img/tpq/wali/" . $old->photo_ayah);
            //moving
            $file->move($uploadPath, $foto_ayah);
        } else {
            $foto_ayah = $old->photo_ayah;
        }

        if ($request->hasFile('photo_ibu')) {
            $uploadPath = 'img/tpq/wali';
            $file   = $request->file('photo_ibu');
            $ext    = $file->getClientOriginalExtension();

            $foto_ibu = 'ibu_' . $rand . '_' . date('YmdHis') . '.' . $ext;
            // Storage::disk('foto')->delete($old->photo_ibu);
            unlink("img/tpq/wali/" . $old->photo_ibu);
            //moving
            $file->move($uploadPath, $foto_ibu);
        } else {
            $foto_ibu = $old->photo_ibu;
        }

        $list = [
            'nisn'              => $request->nisn,
            'nama'              => $request->nama,
            'tmp_lahir'         => $request->tmp_lahir,
            'tgl_lahir'         => $request->tgl_lahir,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'alamat'            => $request->alamat,
            'tahun_akademik'    => $request->tahun_akademik,
            'nama_ayah'         => $request->nama_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'photo_ayah'    => $foto_ayah,
            'nama_ibu'          => $request->nama_ibu,
            'pekerjaan_ibu'  => $request->pekerjaan_ibu,
            'photo_ibu'     => $foto_ibu,
            'hp_wa'           => $request->hp_wa,
            'jenjang'           => $request->jenjang,
            'photo_santri'         => $foto_santri,
            'status' => $request->status,
        ];

        $old->update($list);
        return redirect('siswa')->with('success', 'Berhasil mengubah biodata santri TPQ');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Santritpq  $santritpq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patch = Santritpq::findOrFail($id);

        if ($patch->photo_santri != NULL) {
            unlink("img/tpq/siswa/" . $patch->photo_santri);
        }
        if ($patch->photo_ayah != NULL) {
            unlink("img/tpq/wali/" . $patch->photo_ayah);
        }
        if ($patch->photo_ibu != NULL) {
            unlink("img/tpq/wali/" . $patch->photo_ibu);
        }

        $patch->delete();

        return redirect('siswa')->with('success', 'Berhasil menghapus Ustad');
    }
}
