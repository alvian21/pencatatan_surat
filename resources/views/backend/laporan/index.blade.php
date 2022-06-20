@extends('backend.main')
@section('title')
    Laporan
@endsection
@section('content')
    <div class="page-content container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laporan Surat</h4>
                        <form class="mt-4" method="post" target="_blank" action="{{ route('laporan.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @include('backend.include.alert')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="status">Laporan Status</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="Surat Masuk">Surat Masuk</option>
                                            <option value="Surat Keluar">Surat Keluar</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="periode_awal">Periode Awal</label>
                                        <input type="date" class="form-control" id="periode_awal"
                                            name="periode_awal">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="periode_akhir">Periode Akhir</label>
                                        <input type="date" class="form-control" id="periode_akhir"
                                            name="periode_akhir">
                                    </div>
                                </div>
                            </div>




                            <div class="row mt-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary">Cetak</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
