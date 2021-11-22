@extends('backend.main')
@section('title')
Surat Masuk
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
                    <h4 class="card-title">Tambah Surat Masuk</h4>
                    <form class="mt-4" enctype="multipart/form-data" method="post" action="{{route('surat_masuk.store')}}">
                        @csrf
                        @include('backend.include.alert')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dari">Dari</label>
                                    <input type="text" class="form-control" required id="dari" name="dari">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_surat">Nomor Surat</label>
                                    <input type="text" class="form-control" required id="nomor_surat" name="nomor_surat">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_masuk">Tanggal Masuk</label>
                                    <input type="date" class="form-control" required readonly value="{{date('Y-m-d')}}"
                                        id="tanggal_masuk" name="tanggal_masuk">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_surat">Tanggal Surat</label>
                                    <input type="date" class="form-control" required id="tanggal_surat" name="tanggal_surat">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kode_surat">Kode Surat</label>
                                    <select class="form-control select2" id="kode_surat" name="kode_surat">
                                        <option>Pilih Kode Surat</option>
                                        @forelse ($kodesurat as $item)
                                        <option value="{{$item['kode']}}">KODE {{$item['kode']}} |
                                            {{$item['keterangan']}}</option>
                                        @empty

                                        @endforelse

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="perihal">Perihal</label>
                                    <textarea class="form-control" id="perihal" required name="perihal" rows="3"></textarea>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dokumen_surat">Dokumen Surat</label>
                                    <input type="file" class="form-control-file" required id="dokumen_surat"
                                        name="dokumen_surat">
                                </div>
                            </div>
                        </div>


                        <div class="row">
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
        $('#kode_surat').select2({
            theme: "bootstrap"
        })
     })
</script>
@endpush
