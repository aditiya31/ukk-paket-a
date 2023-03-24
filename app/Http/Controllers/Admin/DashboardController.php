<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Pengaduan;
use App\Models\Petugas;
use PDF;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $petugas = Petugas::count();
        $masyarakat = Masyarakat::count();

        $pending = Pengaduan::where('status', '0')->count();
        $proses = Pengaduan::where('status', 'proses')->count();
        $selesai = Pengaduan::where('status', 'selesai')->count();

        $pendingData = Pengaduan::where('status', '0')->orderBy('tgl_pengaduan', 'desc')->get();
        $prosesData = Pengaduan::where('status', 'proses')->orderBy('tgl_pengaduan', 'desc')->get();
        $selesaiData = Pengaduan::where('status', 'selesai')->orderBy('tgl_pengaduan', 'desc')->get();
    
        return view('Admin.Dashboard.index', ['petugas' => $petugas, 'masyarakat' => $masyarakat,'pending' => $pending, 'proses' => $proses, 'selesai' => $selesai, 'data_pending' => $pendingData, 'data_proses' => $prosesData, 'data_selesai' => $selesaiData]);
    }

    public function cetakLaporan()
    {
        $pendingData = Pengaduan::where('status', '0')->orderBy('tgl_pengaduan', 'desc')->get();
        $prosesData = Pengaduan::where('status', 'proses')->orderBy('tgl_pengaduan', 'desc')->get();
        $selesaiData = Pengaduan::where('status', 'selesai')->orderBy('tgl_pengaduan', 'desc')->get();

        $pdf = PDF::loadView('Admin.dashboard.cetak', ['data_pending' => $pendingData, 'data_proses' => $prosesData, 'data_selesai' => $selesaiData]);
        return $pdf->download('laporan-pengaduan.pdf');
    }
}