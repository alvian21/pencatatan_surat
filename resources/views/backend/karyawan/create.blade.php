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
                    <h4 class="card-title">Tambah Karyawan</h4>
                    <form class="mt-4" method="post" action="{{route('karyawan.store')}}" enctype="multipart/form-data">
                        @csrf
                        @include('backend.include.alert')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" required id="nama" name="nama">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" required id="tanggal_lahir" name="tanggal_lahir">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" required id="tempat_lahir" name="tempat_lahir">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" required id="alamat" name="alamat">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_hp">Nomor Hp</label>
                                    <input type="text" class="form-control" required id="nomor_hp" name="nomor_hp">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                    <input type="text" class="form-control" required id="pendidikan_terakhir" name="pendidikan_terakhir">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <input type="text" class="form-control" required id="jabatan" name="jabatan">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                      <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                                      <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                                    </select>
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
                            <div class="row">
                                <input type="hidden" name="nilai" id="nilai" value="1">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <input type="file" class="form-control" required id="file"
                                            name="file[]">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="tipe">Tipe</label>
                                        <input type="text" class="form-control" required id="tipe"
                                            name="tipe[]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-block btntambah">Tambah
                            Sertifikat</button>
                        <div class="row  mt-2">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#table-siswa').DataTable()

        $('.btntambah').on('click', function () {
            // var nilai = $('#nilai').val()
                var nilai = 0
                var hide = $('#datasub').find('input[type=hidden]')
                var maxIndex;
                maxIndex = hide.length - 1;
                nilai = maxIndex+2
                var tambah = parseInt(nilai);
                var datahtml = `<div class="row">
                                <input type="hidden" name="nilai" id="nilai" value="${tambah}">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <input type="file" class="form-control" required id="file"
                                            name="file[]">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="tipe">Tipe</label>
                                        <input type="text" class="form-control" required id="tipe"
                                            name="tipe[]">
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-top:30px" >
                                    <button type="button" class="btn btn-danger btnHapus btn-block"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>`
                $('#datasub').append(datahtml)
            })

            $(document).on('click', '.btnHapus',function () {
                $(this).closest('.row').remove();
             })
     })
</script>
@endpush
