@extends('backend.main')
@section('title')
Dokumentasi
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
                    <h4 class="card-title">Edit Dokumentasi</h4>
                    <form class="mt-4" method="post" action="{{route('dokumentasi.update',[$dokumentasi->id_documentation])}}" enctype="multipart/form-data">
                        @csrf
                        @include('backend.include.alert')
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_kegiatan">Nama Kegiatan</label>
                                    <input type="text" value="{{$dokumentasi->name_of_activity}}" class="form-control" id="nama_kegiatan" name="nama_kegiatan">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_kegiatan">Tempat Kegiatan</label>
                                    <input type="text" value="{{$dokumentasi->activity_place}}" class="form-control" id="tempat_kegiatan" name="tempat_kegiatan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                    <input type="date" value="{{$dokumentasi->activity_date}}" class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_peserta">Jumlah Peserta</label>
                                    <input type="text" value="{{$dokumentasi->number_of_participant}}" class="form-control" id="jumlah_peserta" name="jumlah_peserta">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file"  class="form-control-file" id="gambar" name="gambar">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi"  name="deskripsi" rows="3">{{$dokumentasi->description_d}}</textarea>
                                  </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
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
     })
</script>
@endpush
