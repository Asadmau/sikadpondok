<?php

namespace App\Http\Controllers;

use App\Kamar;
use App\Regiskamar;
use App\Santri;
use App\Tahunakdemik;
use Illuminate\Http\Request;

class RegcobaController extends Controller
{
    private $modulUrl;
    private $ta;

    public function __construct()
    {
        $this->modulUrl = route('reg-kamar');
        $this->ta = Tahunakdemik::where('status', 'A')->get();
    }

    public function index()
    {
        $data = Kamar::latest()->get();
        return view('ponpes.kamar.regis-kamar.index', compact('data'));
    }
    //register 
    public function register($id)
    {
        if ($this->ta->count() != 1) {
            return redirect($this->modulURL)->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        }
        $cekKamar = Kamar::where('id_kamar', $id)->get();
        if ($cekKamar->count() != 1) {
            return redirect($this->modulURL)->with('warning', 'Tidak Ada Kelas');
        }
        $ceSantri = Santri::where('status', 'A')->get();
        if ($ceSantri->count() == 0) {
            return redirect($this->modulURL)->with('warning', 'Tidak Ada Santri "Aktif" Tersedia');
        }
        $reg_kamar = Regiskamar::where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        $reg_quota = Regiskamar::where('kamar', $id)->where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        if ($reg_kamar->count() == 0) {
            // $data['santri'] = Santri::where('status', 'A')->where('kategori', $cekKamar[0]->kategori);
            $data['santri'] = Santri::where('status', 'A');
        } else {
            foreach ($reg_kamar as $r) {
                $nama[] = $r->nama; //dengan table di register
            }
            $data['santri'] = Santri::where('status', 'A')->whereNotIn('id_santri', $nama);

            // $data['santri'] = Santri::where('status', 'A')->where('kategori', $cekKamar[0]->kategori)->whereNotIn('id_santri', $nama);
        }
        //dd($reg_kamar);
        // $no = 1;
        $data['numShow'] = 50;
        $data['kapasitas'] = $cekKamar[0]->kapasitas - $reg_quota->count();
        $data['kamar'] = Kamar::where('id_kamar', $id)->get()->first();
        return view('ponpes.kamar.regis-kamar.register', compact('data'));
    }

    //store
    public function store(Request $r, $kamar)
    {
        // if ($this->ta->count() != 1) {
        //     return redirect($this->modulURL)->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        // }

        // $cekKamar = Kamar::where('id_kamar', $kamar)->get();
        // if ($cekKamar->count() != 1) {
        //     return redirect($this->modulURL)->with('warning', 'Tidak Ada kamar');
        // }
        // $ceRK = Regiskamar::where('kamar', $kamar)->where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        // $quota = $cekKamar[0]->kapasitas - $ceRK->count();

        // if ($r->reg == NULL) {
        //     return redirect(route('rk.regis', $kamar))->with('warning', 'Anda harus memilih');
        // } else {
        //     $ceQuota = $quota - count($r->reg);
        //     if ($ceQuota < 0) {
        //         return redirect($this->modulURL)->with('warning', 'Melampaui kuota yang diizinkan');
        //     }
        //     foreach ($r->reg as $id) {
        //         $res[] = [
        //             'santri' => $id,
        //             'tahun_akademik' => $this->ta[0]->id_tahun_akademik,
        //             'kamar' => $kamar
        //         ];
        //     }
        // }

        // Regiskamar::insert($res);
        // return redirect(route('reg-kamar.register', $kamar));
        //
        if ($this->ta->count() != 1) {
            return redirect($this->modulUrl)->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        }

        $cekKamar = Kamar::where('id_kamar', $kamar)->get();
        if ($cekKamar->count() != 1) {
            return redirect($this->modulUrl)->with('warning', 'Tidak Ada kamar');
        }
        $ceRK = Regiskamar::where('kamar', $kamar)->where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        $quota = $cekKamar[0]->kapasitas - $ceRK->count();

        if ($r->reg == NULL) {
            return redirect(route('reg-kamar.register', $kamar))->with('warning', 'Anda harus memilih');
        } else {
            $ceQuota = $quota - count($r->reg);
            if ($ceQuota < 0) {
                return redirect($this->modulUrl)->with('warning', 'Melampaui kuota yang diizinkan');
            }
            foreach ($r->reg as $id) {
                $res[] = [
                    'nama' => $id,
                    'tahun_akademik' => $this->ta[0]->id_tahun_akademik,
                    'kamar' => $kamar
                ];
            }
        }

        Regiskamar::insert($res);
        return redirect(route('reg-kamar.register', $kamar));
    }
    //list kamar
    public function list_kamar($kamar)
    {
        if ($this->ta->count() != 1) {
            return redirect($this->modulUrl)->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        }
        $cekKamar = Kamar::where('id_kamar', $kamar)->get();
        if ($cekKamar->count() != 1) {
            return redirect($this->modulUrl)->with('warning', 'Tidak Ada Kamar');
        }
        $data['santri'] = Regiskamar::where('kamar', $kamar)->where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        if ($data['santri']->count() == 0) {
            return redirect($this->modulUrl)->with('warning', 'Belum Ada Santri yang didaftarkan di kamar ini');
        }
        $data['registered'] = $data['santri']->count();
        $data['kamar'] = Kamar::where('id_kamar', $kamar)->get()->first();
        return view('ponpes.kamar.regis-kamar.registered', compact('data'));
    }

    //destroy
    public function destroy($kamar, $id)
    {
        $patch = Regiskamar::where('id_regis_kamar', $id);
        if ($patch->count() == 0) {
            return redirect(route('reg-kamar.list', $kamar))->with('warning', 'Data Tidak Tersedia');
        }
        $patch->delete();
        return redirect(route('reg-kamar.list', $kamar))->with('success', 'Data Dihapus');
    }
}
