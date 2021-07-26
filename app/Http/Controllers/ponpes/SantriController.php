<?php

namespace App\Http\Controllers\ponpes;

use App\Http\Controllers\Controller;
use App\Kamar;
use App\Pekerjaan;
use App\Santri;
use App\Tahunakdemik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = DB::table('santri')->join('kamar', 'santri.kamar_id', '=', 'kamar.id_kamar')->select('id_santri', 'nis', 'nama', 'tmp_lahir', 'tgl_lahir', 'jenis_kelamin', 'jenjang', 'alamat', 'kamar.nama_kamar as nm_kamar', 'thn_akademik', 'nama_ayah', 'nama_ibu', 'foto_santri', 'foto_wali', 'nope')->orderBy('id_santri', 'desc')->paginate(10);

        $data = Santri::latest()->get();

        // dd($data);
        // return $data;
        return view('ponpes.santri.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $kamar = Kamar::latest()->get();
        $jobs   = Pekerjaan::get();
        $ta    = Tahunakdemik::where('status', 'A')->get();
        if ($jobs->count() == 0) {
            return redirect('santri')->with('warning', 'Maaf ! Tidak ada "Daftar Pekerjaan" yang dimasukkan ke dalam sistem, hubungi Administrator untuk menyelesaikan permasalahan ini.');
        }
        if ($ta->count() == 0) {
            return redirect('santri')->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        }
        return view('ponpes.santri.create', compact('jobs', 'ta'));
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
            $mesage = [
                'required' => ':attribute wajib di isi',
                'unique' => 'nis data harus uniq'
            ];
            $request->validate([
                'nis' => 'required|numeric|unique:santri|min:9',
                'nama' => 'required',
                'tmp_lahir' => 'required',
                'tgl_lahir' => 'required',
                'alamat' => 'required',
                'tahun_akademik' => 'required',
                'nama_ayah' => 'required',
                'nama_ibu' => 'required',
                'pekerjaan_ayah' => 'required',
                'pekerjaan_ibu' => 'required',
                'jenis_kelamin' => 'required',
                'jenjang' => 'required',
                'foto_wali' => 'mimes:jpeg,jpg,png,gif|required',
                'foto_santri' => 'mimes:jpeg,jpg,png,gif|required',
                'nope' => 'required|numeric|min:10',
            ], $mesage);
            if ($files = $request->file('foto_santri')) {
                $destinationPath = 'img/santri'; // upload path
                $extsantri = 'santri_' . rand(100, 900) . '_' . date('YmdHis') . '.' . $files->getClientOriginalName();
                $files->move($destinationPath, $extsantri);
            }
            if ($files = $request->file('foto_wali')) {
                $destinationPath = 'img/wali'; // upload path
                $extwali = 'wali_' . rand(100, 900) . '_' . date('YmdHis') . '.' .  $files->getClientOriginalName();
                $files->move($destinationPath, $extwali);
            }
            $insert = new Santri([
                'nis' => $request->get('nis'),
                'nama' => $request->get('nama'),
                'tmp_lahir' => $request->get('tmp_lahir'),
                'tgl_lahir' => $request->get('tgl_lahir'),
                'jenjang' => $request->get('jenjang'),
                'jenis_kelamin' => $request->get('jenis_kelamin'),
                'alamat' => $request->get('alamat'),
                'tahun_akademik' => $request->get('tahun_akademik'),
                'pekerjaan_ayah' => $request->get('pekerjaan_ayah'),
                'pekerjaan_ibu' => $request->get('pekerjaan_ibu'),
                'nama_ayah' => $request->get('nama_ayah'),
                'nama_ibu' => $request->get('nama_ibu'),
                'nope' => $request->get('nope'),
                'foto_santri' => $extsantri,
                'foto_wali' => $extwali,
                'status' => "A",
                'kategori' => "BARU"
            ]);
            // dd($insert);
            $insert->save();
            return redirect()->route('santri.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->route('santri.create')->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobs   = Pekerjaan::get();
        $ta = Tahunakdemik::where('status', 'A')->get();
        if ($jobs->count() == 0) {
            return redirect('santri')->with('warning', 'Maaf ! Tidak ada "Daftar Pekerjaan" yang dimasukkan ke dalam sistem, hubungi Administrator untuk menyelesaikan permasalahan ini.');
        }
        if ($ta->count() != 1) {
            return redirect('santri')->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        }

        $data   = Santri::where('id_santri', $id);
        if ($data->count() == 0) {
            return redirect('santri');
        }
        $data = $data->first();
        return view('ponpes.santri.edit', compact('data', 'jobs', 'ta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $msg = [
            'required' => ':attribute tidak boleh kosong!',
            'mimes' => 'Ekstensi file salah! Hanya jpeg, jpg, png, gif'
        ];
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenjang' => 'required',
            'alamat' => 'required',
            'tahun_akademik' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'foto_wali' => 'sometimes|image|mimes:jpeg,jpg,png,gif',
            'foto_santri' => 'sometimes|image|mimes:jpeg,jpg,png,gif',
            'nope' => 'required|numeric|min:10',
            'status' => 'required',
            'pekerjaan_ayah' => 'required',
            'pekerjaan_ibu' => 'required',
            'kategori' => 'required'
        ], $msg);
        if ($validasi->fails()) {
            return back()->withErrors($validasi);
        }
        // $uploadPath  = 'files';
        $rand        = rand(000, 999);
        $old         = Santri::findOrFail($id);

        if ($request->hasFile('foto_santri')) {
            $loc = 'img/santri';
            $file   = $request->file('foto_santri');
            $ext    = $file->getClientOriginalExtension();

            $photo_santri = 'santri_' . $rand . '_' . date('YmdHis') . '.' . $ext;
            unlink('img/santri/' . $old->foto_santri);
            //moving
            $file->move($loc, $photo_santri);
        } else {
            $photo_santri = $old->foto_santri;
        }

        if ($request->hasFile('foto_wali')) {
            $loc = "img/wali";
            $file   = $request->file('foto_wali');
            $ext    = $file->getClientOriginalExtension();

            $photo_wali = 'wali_' . $rand . '_' . date('YmdHis') . '.' . $ext;
            unlink("img/wali/" . $old->foto_wali);

            //moving
            $file->move($loc, $photo_wali);
        } else {
            $photo_wali = $old->foto_wali;
        }
        $dt = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'tmp_lahir' => $request->tmp_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenjang' => $request->jenjang,
            'alamat' => $request->alamat,
            'tahun_akademik' => $request->tahun_akademik,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'nope' => $request->nope,
            'foto_santri' => $photo_santri,
            'foto_wali' => $photo_wali,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'status' => $request->status,
            'kategori' => $request->kategori
        ];
        // $santri = Santri::find($id);
        // dd($insert);
        // $santri->update($dt);
        $old->update($dt);
        return redirect()->route('santri.index')->with('success', 'Data berhasil Di Edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Santri  $santri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patch = Santri::findOrFail($id);

        if ($patch->foto_santri != NULL) {
            // Storage::disk('foto')->delete($patch->foto_santri);
            unlink("img/santri/" . $patch->foto_santri);
        }
        if ($patch->foto_wali != NULL) {
            // Storage::disk('foto')->delete($patch->foto_wali);
            unlink("img/wali/" . $patch->foto_wali);
        }
        $patch->delete();

        return redirect('santri')->with('success', 'Berhasil menghapus Santri');;
    }
}
