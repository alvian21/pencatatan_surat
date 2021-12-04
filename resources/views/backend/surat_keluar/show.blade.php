@extends('backend.main')
@section('title')
Surat Keluar
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
                    <h4 class="card-title">Detail Surat Keluar</h4>
                    <form class="mt-4"
                        action="#">
                        @csrf
                        @method('put')
                        @include('backend.include.alert')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nomor_surat">Nomor Surat</label>
                                    <input type="text" readonly class="form-control" required id="nomor_surat"
                                        name="nomor_surat" value="{{$surat->reference_number_o}}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kepada">Kepada</label>
                                    <input type="text" class="form-control" readonly required id="kepada" value="{{$surat->to}}" name="kepada">
                                </div>
                            </div>


                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_surat">Tanggal Surat</label>
                                    <input type="date" class="form-control" readonly value="{{$surat->letter_date_o}}" required id="tanggal_surat"
                                        name="tanggal_surat">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tembusan">Tembusan</label>
                                    <input type="text" class="form-control" readonly required id="tembusan" value="{{$surat->copy}}" name="tembusan">
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
                                    <a href="{{asset('storage/surat_keluar/'.$surat->attachment)}}" target="blank">{{$surat->attachment}}</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="paraf">Paraf</label>
                                    <br>
                                    <a href="{{asset('storage/surat_keluar/paraf/'.$surat->paraf)}}" target="blank">{{$surat->paraf}}</a>
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
                                    <textarea class="form-control" id="perihal" readonly required name="perihal"
                                        rows="3">{{$surat->description_o}}</textarea>

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
                                <a href="{{route('surat_keluar.index')}}" class="btn btn-secondary">Tutup</a>
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


        $('#kode_surat').on('change', function () {
            var kode = $(this).val()

            if (kode != '') {
                $.ajax({
                    url: "{{route('surat_keluar.generate')}}",
                    method: "GET",
                    data: {
                        kode_surat: kode
                    },
                    success: function (response) {
                        if (response.status) {

                            $('#nomor_surat').val(response.nomor)
                        }
                    }
                })
            }
        })
    })

</script>
@endpush
