<?php

namespace App\Http\Controllers\ponpes;

use App\Http\Controllers\Controller;
use App\Pembayaran;
use App\Santri;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    // private $sa;
    private $modulURL;

    public function __construct()
    {
        $this->sa = Santri::all();
        $this->modulURL = route('pembayaran');
    }

    public function index()
    {
        $data = Pembayaran::latest()->get();
        return view('ponpes.pembayaran-spp.index', compact('data'));
    }
}
