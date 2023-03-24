@extends('layouts.user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('title', 'Pengaduan Masyarakat')

@section('content')
    {{-- Section Header --}}
    <section class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
            <div class="container">
                <div class="container-fluid">
                    <a class="navbar-brand ml-3" href="#">
                        <h4 class="semi-bold text-white mt-1">PEKAT</h4>
                        <p class="italic mt-0 text-white">Pengaduan Masyarakat</p>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        @if (Auth::guard('masyarakat')->check())
                            <ul class="navbar-nav text-center ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link ml-3 text-white" href="{{ route('pekat.laporan') }}">Laporan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link ml-3 text-white"
                                        href="{{ route('pekat.logout') }}">{{ Auth::guard('masyarakat')->user()->nama }}</a>
                                </li>
                            </ul>
                        @else
                            <ul class="navbar-nav text-center ml-auto">
                                <li class="nav-item">
                                    <button class="btn text-white" type="button" class="btn btn-primary"
                                        data-toggle="modal" data-target="#loginModal">Masuk</button>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pekat.formRegister') }}" class="btn btn-outline-purple">Daftar</a>
                                </li>
                            </ul>
                        @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="text-center">
        <h2 class="medium text-white mt-3">Layanan Pengaduan Masyarakat Warga Kampung Sawah</h2>
        <p class="italic text-white mb-5">Sampaikan laporan Anda langsung kepada pihak yang berwenang</p>
    </div>

    <!-- <div class="wave wave1"></div>
    <div class="wave wave2"></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div> -->
</section>
{{-- Section Card Pengaduan --}}
<div class="row justify-content-center">
    <div class="col-lg-6 col-10 col">
        <div class="content shadow">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif

            @if (Session::has('pengaduan'))
                <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
            @endif

            <div class="card mb-3 text-center">Tulis Laporan Disini</div>
            <form action="{{ route('pekat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" value="{{ old('judul_laporan') }}" name="judul_laporan"
                        placeholder="Masukkan Judul Laporan" class="form-control">
                </div>
                <div class="form-group">
                    <textarea name="isi_laporan" placeholder="Masukkan Isi Laporan" class="form-control" rows="4">{{ old('isi_laporan') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="text" value="{{ old('tgl_kejadian') }}" name="tgl_kejadian"
                        placeholder="Pilih Tanggal Kejadian" class="form-control" onfocusin="(this.type='date')"
                        onfocusout="(this.type='text')">
                </div>
                <div class="form-group">
                    <textarea name="lokasi_kejadian" id="latlang" rows="3" class="form-control mb-3" placeholder="Lokasi Kejadian">{{ old('lokasi_kejadian') }}</textarea>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <select name="kategori_kejadian" class="custom-select" id="inputGroupSelect01" required>
                            <option value="" selected>Pilih Kategori Kejadian</option>
                            <option value="agama">Agama</option>
                            <option value="hukum">Hukum</option>
                            <option value="lingkungan">Lingkungan</option>
                            <option value="sosial">Sosial</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-custom mt-2">Kirim</button>
            </form>
        </div>
    </div>
</div>
{{-- Section Hitung Pengaduan --}}
<div class="pengaduan mt-5">
    <div class="bg-purple">
        <div class="text-center">
            <h5 class="medium text-white mt-3">JUMLAH LAPORAN SEKARANG</h5>
            <h2 class="medium text-white">{{ $pengaduan }}</h2>
        </div>
    </div>
</div>
{{-- Buat Footer --}}
{{-- <div class="mt-5">
    <hr>
    <div class="text-center">
    </div>
</div> --}}
{{-- Modal --}}
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="mt-3 text-center">Masuk terlebih dahulu</h3>
                <p class="text-center">Silahkan masuk menggunakan akun yang sudah didaftarkan.</p>
                <form action="{{ route('pekat.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Username atau Email</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-purple text-white mt-3" style="width: 100%">MASUK</button>
                </form>
                @if (Session::has('pesan'))
                    <div class="alert alert-danger mt-2">
                        {{ Session::get('pesan') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@if (Session::has('pesan'))
    <script>
        $('#loginModal').modal('show');
    </script>
@endif
@endsection
