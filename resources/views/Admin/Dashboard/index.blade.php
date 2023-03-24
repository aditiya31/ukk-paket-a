@extends('layouts.admin')

@section('title', 'Halaman Dashboard')

@section('css')
    <style>
        .bg-gradient-primary {
            background: #15548F; 
            color: white;
        }
    </style>
@endsection
    
@section('header', 'Dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center">Petugas</div>
                <div class="card-body">    
                    <div class="text-center">
                        {{ $petugas }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header text-center">Masyarakat</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $masyarakat }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-center">Belum di Respon</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $pending }}
                    </div>
                </div>
                <button type="button" class="btn bg-gradient-primary" id="btn-pending">
                    Lihat Data
                </button>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-center">Sudah di Respon</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $proses }}
                    </div>
                </div>
                <button type="button" class="btn bg-gradient-primary" id="btn-proses">
                    Lihat Data
                </button>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header text-center">Laporan Selesai</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $selesai }}
                    </div>
                </div>
                <button type="button" class="btn bg-gradient-primary" id="btn-selesai">
                    Lihat Data
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-sm-12 d-none mb-3" id="pending">
            <div class="card">
                <div class="card-header">
                    <h4>Data Belum diproses</h4>
                </div>
                <div class="card-body">
                <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Isi Laporan</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($data_pending as $k => $v)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $v->tgl_pengaduan->format('d-M-Y') }}</td>
                        <td>{{ $v->isi_laporan }}</td>
                        <td><a href="{{ route('pengaduan.show', $v->id_pengaduan) }}" style="text-decoration: underline">Lihat</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
                </div>
            </div>
        </div>
        
        <div class="col-sm-12 d-none mb-3" id="proses">
            <div class="card">
                <div class="card-header">
                    <h4>Data Proses</h4>
                </div>
                <div class="card-body">
                <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Isi Laporan</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($data_proses as $k => $v)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $v->tgl_pengaduan->format('d-M-Y') }}</td>
                        <td>{{ $v->isi_laporan }}</td>
                        <td><a href="{{ route('pengaduan.show', $v->id_pengaduan) }}" style="text-decoration: underline">Lihat</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 d-none mb-3" id="selesai">
        <div class="card">
                <div class="card-header">
                    <h4>Data Selesai</h4>
                </div>
                <div class="card-body">
                <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Isi Laporan</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($data_selesai as $k => $v)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $v->tgl_pengaduan->format('d-M-Y') }}</td>
                        <td>{{ $v->isi_laporan }}</td>
                        <td><a href="{{ route('pengaduan.show', $v->id_pengaduan) }}" style="text-decoration: underline">Lihat</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#btn-selesai').click(function () {
            var selesai = $('#selesai');
            if (selesai.hasClass('d-none')) {
                selesai.removeClass('d-none');
                $(this).text('Sembunyikan')   
            }else{
                selesai.addClass('d-none');
                $(this).text('Lihat Data')   
            }
        })
        $('#btn-proses').click(function () {
            var proses = $('#proses');
            if (proses.hasClass('d-none')) {
                proses.removeClass('d-none');
                $(this).text('Sembunyikan')   
            }else{
                proses.addClass('d-none');
                $(this).text('Lihat Data')   
            }
        })
        $('#btn-pending').click(function () {
            var pending = $('#pending');
            if (pending.hasClass('d-none')) {
                pending.removeClass('d-none');
                $(this).text('Sembunyikan')   
            }else{
                pending.addClass('d-none');
                $(this).text('Lihat Data')   
            }
        })
    </script>
@endsection