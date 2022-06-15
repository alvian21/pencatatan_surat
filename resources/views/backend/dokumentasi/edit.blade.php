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
                        <form class="mt-4" method="post"
                            action="{{ route('dokumentasi.update', [$dokumentasi->id_documentation]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @include('backend.include.alert')
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_kegiatan">Nama Kegiatan</label>
                                        <input type="text" value="{{ $dokumentasi->name_of_activity }}"
                                            class="form-control" id="nama_kegiatan" name="nama_kegiatan">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_kegiatan">Tempat Kegiatan</label>
                                        <input type="text" value="{{ $dokumentasi->activity_place }}"
                                            class="form-control" id="tempat_kegiatan" name="tempat_kegiatan">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_kegiatan">Tanggal Kegiatan</label>
                                        <input type="date" value="{{ $dokumentasi->activity_date }}"
                                            class="form-control" id="tanggal_kegiatan" name="tanggal_kegiatan">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah_peserta">Jumlah Peserta</label>
                                        <input type="text" value="{{ $dokumentasi->number_of_participant }}"
                                            class="form-control" id="jumlah_peserta" name="jumlah_peserta">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $dokumentasi->description_d }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="Dokumentasi">File Dokumentasi</label>
                                    </div>
                                </div>
                            </div>
                            @forelse ($dokumentasi->detail as $key => $item)
                                <div class="row">
                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                    <input type="hidden" name="nilai" id="nilai" value="{{ $key + 1 }}">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="file">File</label>
                                            <br>
                                            <a href="{{ asset('storage/image/' . $item->image) }}"
                                                target="blank">{{ $item->image }}</a>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-top:30px">
                                        <button type="button" class="btn btn-danger btnHapus btn-block"><i
                                                class="fas fa-trash"></i></button>
                                    </div>

                                </div>

                            @empty
                            @endforelse
                            <div id="datasub">

                            </div>
                            <button type="button" class="btn btn-outline-primary btn-block btntambah mt-3">Tambah
                                Dokumentasi</button>

                            <div class="row mt-3">
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
        $(document).ready(function() {
            $('#table-siswa').DataTable()

            $('.btntambah').on('click', function() {
                // var nilai = $('#nilai').val()
                var nilai = 0
                var hide = $('#datasub').find('input[type=hidden]')
                var maxIndex;
                maxIndex = hide.length - 1;
                nilai = maxIndex + 2
                var tambah = parseInt(nilai);
                var datahtml = `<div class="row">
                                <input type="hidden" name="nilai" id="nilai" value="${tambah}">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="file">File</label>
                                        <input type="file" class="form-control" required id="file"
                                            name="gambar[]">
                                    </div>
                                </div>

                                <div class="col-md-2" style="margin-top:30px" >
                                    <button type="button" class="btn btn-danger btnHapus btn-block"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>`
                $('#datasub').append(datahtml)
            })

            $(document).on('click', '.btnHapus', function() {
                $(this).closest('.row').remove();
            })
        })
    </script>
@endpush
