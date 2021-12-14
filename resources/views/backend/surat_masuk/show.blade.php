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
                    <h4 class="card-title">Detail Surat Masuk</h4>
                    <form class="mt-4" enctype="multipart/form-data" method="post" action="{{route('surat_masuk.update',[$surat->id_incoming])}}">
                        @csrf
                        @method('put')
                        @include('backend.include.alert')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dari">Dari</label>
                                    <input type="text" readonly class="form-control" value="{{$surat->from}}" required id="dari" name="dari">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_surat">Nomor Surat</label>
                                    <input type="text" readonly class="form-control"  value="{{$surat->reference_number_i}}" required id="nomor_surat" name="nomor_surat">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kepada">Kepada</label>
                                    <input type="text" class="form-control" readonly  value="{{$surat->to}}" required id="kepada" name="kepada">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="posisi">Posisi Surat</label>
                                    <input type="text" class="form-control" readonly value="{{$surat->position}}" required id="posisi" name="posisi">

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_masuk">Tanggal Masuk</label>
                                    <input type="date" class="form-control" required  value="{{$surat->date_of_receipt}}" readonly
                                        id="tanggal_masuk" name="tanggal_masuk">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_surat">Tanggal Surat</label>
                                    <input type="date" class="form-control" readonly required id="tanggal_surat" value="{{$surat->letter_date_i}}" name="tanggal_surat">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="kode_surat">Kode Surat</label>
                                    <input type="text" class="form-control" readonly  value="{{$surat->description_letter_code}}" required id="kode_surat" name="kode_surat">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dokumen_surat">Dokumen Surat</label>
                                    <br>
                                    <a href="{{asset('storage/surat_masuk/'.$surat->scan)}}" target="blank">{{$surat->scan}}</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paraf">Paraf</label>
                                    <br>
                                    <a href="{{asset('storage/surat_masuk/paraf/'.$surat->paraf)}}" target="blank">{{$surat->paraf}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" readonly  value="{{$surat->status}}" required id="status" name="status">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="perihal">Perihal</label>
                                    <textarea class="form-control" readonly id="perihal" required name="perihal" rows="3">{{$surat->description_i}}</textarea>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keterangan_disposisi">Keterangan Disposisi</label>
                                    <textarea class="form-control" readonly id="keterangan_disposisi" required name="keterangan_disposisi" rows="3">{{$surat->status_description}}</textarea>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{route('surat_masuk.index')}}" class="btn btn-secondary">Tutup</a>
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
