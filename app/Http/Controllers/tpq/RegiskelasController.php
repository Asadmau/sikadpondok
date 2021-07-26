<?php

namespace App\Http\Controllers\tpq;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Regiskelas;
use App\Santritpq;
use App\Tahunakdemik;
use Illuminate\Http\Request;

class RegiskelasController extends Controller
{
    private $modulURL;
    private $ta;

    public function __construct()
    {
        $this->modulURL = route('regiskelas.rk');
        $this->ta = Tahunakdemik::where('status', 'A')->get();
    }
    public function index()
    {
        $data = Kelas::latest()->get();

        // dd($data);
        return view('tpq.kelas.regis.index', compact('data'));
    }
    public function register($id)
    {
        if ($this->ta->count() != 1) {
            return redirect($this->modulURL)->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        }
        $ceKelas = Kelas::where('id_kelas', $id)->get();
        if ($ceKelas->count() != 1) {
            return redirect($this->modulURL)->with('warning', 'Tidak Ada Kelas');
        }
        $ceSantri = Santritpq::where('status', 'A')->get();
        if ($ceSantri->count() == 0) {
            return redirect($this->modulURL)->with('warning', 'Tidak Ada Santri "Aktif" Tersedia');
        }
        $reg_kelas = Regiskelas::where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        $reg_quota = Regiskelas::where('kelas', $id)->where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        if ($reg_kelas->count() == 0) {
            $data['santritpq'] = Santritpq::where('status', 'A')->where('jenjang', $ceKelas[0]->jenjang);
        } else {
            foreach ($reg_kelas as $r) {
                $nama[] = $r->nama;
            }
            $data['santritpq'] = Santritpq::where('status', 'A')->where('jenjang', $ceKelas[0]->jenjang)->whereNotIn('id_santri_tpq', $nama);
        }
        //dd($reg_kelas);
        // $no = 1;
        $data['numShow'] = 50;
        $data['kapasitas'] = $ceKelas[0]->kapasitas - $reg_quota->count();
        $data['kelas'] = Kelas::where('id_kelas', $id)->get()->first();
        return view('tpq.kelas.regis.register', compact('data'));
    }
    //store
    public function store(Request $r, $kelas)
    {
        if ($this->ta->count() != 1) {
            return redirect($this->modulURL)->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        }

        $ceKelas = Kelas::where('id_kelas', $kelas)->get();
        if ($ceKelas->count() != 1) {
            return redirect($this->modulURL)->with('warning', 'Tidak Ada Kelas');
        }
        $ceRK = Regiskelas::where('kelas', $kelas)->where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        $quota = $ceKelas[0]->kapasitas - $ceRK->count();

        if ($r->reg == NULL) {
            return redirect(route('rk.regis', $kelas))->with('warning', 'Anda harus memilih');
        } else {
            $ceQuota = $quota - count($r->reg);
            if ($ceQuota < 0) {
                return redirect($this->modulURL)->with('warning', 'Melampaui kuota yang diizinkan');
            }
            foreach ($r->reg as $id) {
                $res[] = [
                    'nama' => $id,
                    'tahun_akademik' => $this->ta[0]->id_tahun_akademik,
                    'kelas' => $kelas
                ];
            }
        }

        Regiskelas::insert($res);
        return redirect(route('rk.regis', $kelas));
        // if ($this->ta->count() != 1) {
        //     return redirect($this->modulURL)->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        // }

        // $ceKelas = Kelas::where('id_kelas', $id)->get();
        // if ($ceKelas->count() != 1) {
        //     return redirect($this->modulURL)->with('warning', 'Tidak Ada Kelas');
        // }
        // $ceRK = Regiskelas::where('kelas', $id)->where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        // $quota = $ceKelas[0]->kapasitas - $ceRK->count();

        // if ($r->reg == NULL) {
        //     return redirect(route('rk.regis', $id))->with('warning', 'Anda harus memilih');
        // } else {
        //     $ceQuota = $quota - count($r->reg);
        //     if ($ceQuota < 0) {
        //         return redirect($this->modulURL)->with('warning', 'Melampaui kuota yang diizinkan');
        //     }
        //     foreach ($r->reg as $id) {
        //         $res[] = [
        //             'nama' => $id,
        //             'tahun_akademik' => $this->ta[0]->id_tahun_akademik,
        //             'kelas' => $id
        //         ];
        //     }
        // }

        // Regiskelas::insert($res);
        // return redirect(route('rk.regis', $id));
    }

    public function list_kelas($kelas)
    {
        if ($this->ta->count() != 1) {
            return redirect($this->modulURL)->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        }
        $ceKelas = Kelas::where('id_kelas', $kelas)->get();
        if ($ceKelas->count() != 1) {
            return redirect($this->modulURL)->with('warning', 'Tidak Ada Kelas');
        }
        $data['santritpq'] = Regiskelas::where('kelas', $kelas)->where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        if ($data['santritpq']->count() == 0) {
            return redirect($this->modulURL)->with('warning', 'Belum Ada Santri yang didaftarkan di Kelas ini');
        }
        // $no = 1;
        $data['registered'] = $data['santritpq']->count();
        $data['kelas'] = Kelas::where('id_kelas', $kelas)->get()->first();
        return view('tpq.kelas.regis.registered', compact('data'));

        // if ($this->ta->count() != 1) {
        //     return redirect($this->modulURL)->with('warning', 'Kesalahan ! Hubungi Administrator terkait Tahun Akademik');
        // }
        // $ceKelas = Kelas::where('id_kelas', $id)->get();
        // if ($ceKelas->count() != 1) {
        //     return redirect($this->modulURL)->with('warning', 'Tidak Ada Kelas');
        // }
        // $data['santritpq'] = Regiskelas::where('kelas', $id)->where('tahun_akademik', $this->ta[0]->id_tahun_akademik)->get();
        // if ($data['santritpq']->count() == 0) {
        //     return redirect($this->modulURL)->with('warning', 'Belum Ada Santri yang didaftarkan di Kelas ini');
        // }
        // $data['registered'] = $data['santritpq']->count();
        // $data['kelas'] = Kelas::where('id_kelas', $id)->get()->first();
        // return view('tpq.kelas.regis.registered', compact('data'));
    }
    //destroy
    public function destroy($kelas, $id)
    {
        $patch = Regiskelas::where('id_regis_kelas', $id);
        if ($patch->count() == 0) {
            return redirect(route('rk.list', $kelas))->with('warning', 'Data Tidak Tersedia');
        }
        $patch->delete();
        return redirect(route('rk.list', $kelas))->with('success', 'Data Dihapus');
    }
}
