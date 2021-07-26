<?php

namespace App\Http\Controllers\tpq;

use App\Http\Controllers\Controller;
use App\Ustad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Symfony\Component\Console\Input\Input;

class UstadController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('cekstatus');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ustad::latest()->get();
        return view('tpq.ustad.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tpq.ustad.create');
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
                'nama_lengkap' => 'required|string',
                'nip' => 'required|numeric|unique:ustad|min:9',
                'tmp_lahir' => 'required|string',
                'tgl_lahir' => 'required',
                'jenis_kelamin' => 'required|string',
                'thn_ajaran' => 'required',
                'alamat_ustad' => 'required|string',
                'no_hp_ustad' => 'required|string|max:15',
                'profile_img' => 'sometimes|image|max:1000|mimes:jpeg,jpg,png',
            ]);
            if ($validasi->fails()) {
                return redirect()->route('ustad.create')->withErrors($validasi);
            }

            $rand        = rand(000, 999);

            if ($request->hasFile('profile_img')) {
                $loc = 'img/tpq/ustad';
                $file   = $request->file('profile_img');
                $ext    = $file->getClientOriginalExtension();

                $profile_ust = 'ustad_' . $rand . '_' . date('YmdHis') . '.' . $ext;
                //moving
                $file->move($loc, $profile_ust);
            } else {
                $profile_ust = NULL;
            }
            $data = [
                'nama_lengkap' => $request->input('nama_lengkap'),
                'nip' => $request->input('nip'),
                'tmp_lahir' => $request->input('tmp_lahir'),
                'tgl_lahir' => $request->input('tgl_lahir'),
                'alamat_ustad' => $request->input('alamat_ustad'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'thn_ajaran' => $request->input('thn_ajaran'),
                'no_hp_ustad' => $request->input('no_hp_ustad'),
                'profile_img' => $profile_ust
            ];
            Ustad::create($data);
            return redirect()->route('ustad.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->route('ustad.create')->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ustad  $ustad
     * @return \Illuminate\Http\Response
     */
    public function show(Ustad $ustad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ustad  $ustad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Ustad::find($id);
        return view('tpq.ustad.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ustad  $ustad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $msg = [
            'required' => ':attribute tidak boleh kosong!',
            'mimes' => 'Ekstensi file salah! Hanya jpeg, jpg, png'
        ];
        $validasi = Validator::make($request->all(), [
            'nama_lengkap' => 'required',
            'nip' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'thn_ajaran' => 'required',
            'alamat_ustad' => 'required',
            'no_hp_ustad' => 'required',
            'profile_img' => 'sometimes|image|max:1000|mimes:jpeg,jpg,png',
        ], $msg);
        if ($validasi->fails()) {
            return back()->withErrors($validasi);
        }
        // $uploadPath  = 'files';
        $rand        = rand(000, 999);
        $old         = Ustad::findOrFail($id);

        if ($request->hasFile('profile_img')) {
            $loc = 'img/tpq/ustad';
            $file   = $request->file('profile_img');
            $ext    = $file->getClientOriginalExtension();

            $profile_ust = 'ustad_' . $rand . '_' . date('YmdHis') . '.' . $ext;
            unlink("img/tpq/ustad/" . $old->profile_img);
            //moving
            $file->move($loc, $profile_ust);
        } else {
            $profile_ust = $old->profile_img;
        }
        $dt = [
            'nama_lengkap' => $request->input('nama_lengkap'),
            'nip' => $request->input('nip'),
            'tmp_lahir' => $request->input('tmp_lahir'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'alamat_ustad' => $request->input('alamat_ustad'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'thn_ajaran' => $request->input('thn_ajaran'),
            'no_hp_ustad' => $request->input('no_hp_ustad'),
            'profile_img' => $profile_ust
        ];
        $old->update($dt);
        return redirect()->route('ustad.index')->with('success', 'Data berhasil Di Edit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ustad  $ustad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patch = Ustad::findOrFail($id);

        if ($patch->profile_img != NULL) {
            unlink("img/tpq/ustad/" . $patch->profile_img);
        }

        $patch->delete();

        return redirect('ustad')->with('success', 'Berhasil menghapus Ustad');;
    }
}
