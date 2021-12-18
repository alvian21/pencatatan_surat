@extends('backend.main')
@section('title')
Siswa
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
                    <h4 class="card-title">Edit Ijazah Siswa</h4>
                    <form class="mt-4" method="post" action="{{route('siswa.update',[$siswa->id_sd])}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        @include('backend.include.alert')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" value="{{$siswa->name}}" id="nama" name="nama">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" value="{{$siswa->birth_date_s}}" id="tanggal_lahir" name="tanggal_lahir">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" value="{{$siswa->birth_place_s}}" name="tempat_lahir">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_orangtua">Nama Orangtua</label>
                                    <input type="text" class="form-control" id="nama_orangtua" value="{{$siswa->parents_name}}" name="nama_orangtua">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nisn">NISN</label>
                                    <input type="text" class="form-control" id="nisn" value="{{$siswa->nisn}}" name="nisn">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nis">NIS</label>
                                    <input type="text" class="form-control" id="nis" value="{{$siswa->nis}}" name="nis">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="npsn">NPSN</label>
                                    <input type="text" class="form-control" id="npsn" value="{{$siswa->npsn}}" name="npsn">

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
                            @forelse ($siswa->document as $key => $item)
                            <div class="row">
                                <input type="hidden" name="id_document[]" value="{{$item->id}}">
                                <input type="hidden" name="nilai" id="nilai" value="{{$key+1}}">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <br>
                                        <a href="{{asset('storage/certificate/'.$item->name)}}" target="blank">{{$item->name}}</a>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="old_tipe">Tipe</label>
                                        <input type="text" class="form-control" required id="old_tipe" name="old_tipe[]" value="{{$item->type}}">
                                    </div>
                                </div>
                                <div class="col-md-2" style="margin-top:30px" >
                                    <button type="button" class="btn btn-danger btnHapus btn-block"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>

                        @empty

                        @endforelse
                    </div>
                        <button type="button" class="btn btn-outline-primary btn-block btntambah">Tambah
                            Sertifikat</button>
                        <div class="row mt-2">
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
