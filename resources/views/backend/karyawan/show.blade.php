@extends('backend.main')
@section('title')
    Karyawan
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
                        <h4 class="card-title">Detail Karyawan</h4>
                        <form class="mt-4" method="post"
                            action="{{ route('karyawan.update', [$karyawan->employee_id]) }}" enctype="multipart/form-data">
                            @csrf
                            @include('backend.include.alert')
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" readonly id="nama"
                                            value="{{ $karyawan->name_e }}" name="nama">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tanggal_lahir"
                                            value="{{ $karyawan->birth_date }}" readonly name="tanggal_lahir">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir"
                                            value="{{ $karyawan->birth_place }}" readonly name="tempat_lahir">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" readonly id="alamat"
                                            value="{{ $karyawan->address }}" name="alamat">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomor_hp">Nomor Hp</label>
                                        <input type="text" class="form-control" readonly id="nomor_hp"
                                            value="{{ $karyawan->phone_number }}" name="nomor_hp">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                        <input type="text" class="form-control" readonly id="pendidikan_terakhir"
                                            value="{{ $karyawan->last_education }}" name="pendidikan_terakhir">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control" readonly id="jabatan"
                                            value="{{ $karyawan->role }}" name="jabatan">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" readonly id="status"
                                            value="{{ $karyawan->status }}" name="status">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sertifikat">Sertifikat</label>
                                    </div>
                                </div>
                            </div>
                            <div id="datasub">
                                @forelse ($karyawan->certificate as $key => $item)
                                    <div class="row">
                                        <input type="hidden" name="id_document[]" value="{{ $item->id_document }}">
                                        <input type="hidden" name="nilai" id="nilai" value="{{ $key + 1 }}">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="file">File</label>
                                                <br>
                                                <a href="{{ asset('storage/certificate/' . $item->name_c) }}"
                                                    target="blank">{{ $item->name_c }}</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="old_tipe">Tipe</label>
                                                <input type="text" class="form-control" readonly required id="old_tipe"
                                                    name="old_tipe[]" value="{{ $item->type }}">
                                            </div>
                                        </div>

                                    </div>

                                @empty
                                @endforelse
                            </div>

                            <div class="row  mt-2">
                                <div class="col-md-12 text-center">
                                    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Tutup</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
