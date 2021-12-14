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
            <div class="material-card card">
                <div class="card-header container-fluid d-flex justify-content-between">
                    <h4 class="text-dark"><i class="fas fa-list pr-2"></i> Daftar Surat Masuk</h4>
                    @if (auth()->user()->role == 'admin')
                    <a href="{{route('surat_masuk.create')}}" class="btn btn-primary float-right">Tambah Surat Masuk</a>
                    @endif
                </div>
                <div class="card-body">
                    @if (auth()->user()->role == 'admin')
                    <div class="table-responsive">
                        <table id="table-siswa" class="table table-striped border text-center">
                            <thead>
                                <tr>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Surat</th>
                                    <th>Dari</th>
                                    <th>Kode Surat</th>
                                    <th>Dokumen</th>
                                    <th>Posisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($surat as $item)
                                <tr>
                                    <td>{{$item->reference_number_i}}</td>
                                    <td>{{date("j F Y", strtotime($item->date_of_receipt))}}</td>
                                    <td>{{date("j F Y", strtotime($item->letter_date_i))}}</td>
                                    <td>{{$item->from}}</td>
                                    <td>{{$item->description_letter_code}}</td>
                                    <td><a href="{{route('surat_masuk.download',[$item->id_incoming])}}"
                                            class="btn btn-info"><i class="fas fa-download"></i></a></td>
                                    <td>{{$item->position}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                        <a href="{{route('surat_masuk.edit',[$item->id_incoming])}}"
                                            class="btn btn-warning"><i class="mdi mdi-pencil"></i></a>
                                        <a target="blank" href="{{route('surat_masuk.cetak_pdf',[$item->id_incoming])}}"
                                            class="btn btn-success" data-id="{{$item->id_incoming}}">
                                            <i class="fas fa-print"></i></a>
                                        <a href="{{route('surat_masuk.show',[$item->id_incoming])}}"
                                            class="btn btn-info"><i class="mdi mdi-eye"></i></a>
                                        <button type="button" class="btn btn-danger hapus"
                                            data-id="{{$item->id_incoming}}"> <i class="mdi mdi-delete"></i></button>
                                    </td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table id="table-siswa" class="table table-striped border text-center">
                            <thead>
                                <tr>
                                    <th>Nomor Surat</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Surat</th>
                                    <th>Dari</th>
                                    <th>Kode Surat</th>
                                    <th>Dokumen</th>
                                    <th>Posisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($surat as $item)
                                <tr>
                                    <td>{{$item->reference_number_i}}</td>
                                    <td>{{date("j F Y", strtotime($item->date_of_receipt))}}</td>
                                    <td>{{date("j F Y", strtotime($item->letter_date_i))}}</td>
                                    <td>{{$item->from}}</td>
                                    <td>{{$item->description_letter_code}}</td>
                                    <td><a href="{{route('surat_masuk.download',[$item->id_incoming])}}"
                                            class="btn btn-info"><i class="fas fa-download"></i></a></td>
                                    <td>{{$item->position}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btnedit" data-id="{{$item->id_incoming}}"><i
                                                class="mdi mdi-pencil"></i></a>
                                        <a target="blank" href="{{route('surat_masuk.cetak_pdf',[$item->id_incoming])}}"
                                            class="btn btn-success" data-id="{{$item->id_incoming}}">
                                            <i class="fas fa-print"></i></a>
                                        <a href="#" class="btn btn-success" data-id="{{$item->id_incoming}}"><i
                                                class="fas fa-print"></i></a>
                                        <a href="{{route('surat_masuk.show',[$item->id_incoming])}}"
                                            class="btn btn-info"><i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Modal Update --}}
                    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog"
                        aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update Surat Masuk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" id="formSurat">
                                        <div id="data-alert">
                                        </div>
                                        <input type="hidden" name="id" name="id" class="id_incoming">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="DISETUJUI">DISETUJUI</option>
                                                <option value="TIDAK DISETUJUI">TIDAK DISETUJUI</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="paraf">Paraf</label>
                                            <input type="file" class="form-control-file" id="paraf" name="paraf">
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan"
                                                rows="3"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary btnsimpan">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')

@if (auth()->user()->role == 'admin')
<script>
    $(document).ready(function () {
        $('#table-siswa').DataTable()

        function ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        $('.hapus').on('click', function () {
            var id = $(this).data('id')
            console.log(id);
            swal({
                    title: "Apa kamu yakin?",
                    text: "Ketika dihapus, data tidak bisa dikembalikan lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        ajax()
                        $.ajax({
                            url: "{{url('surat_masuk')}}/" + id,
                            method: "DELETE",
                            success: function (response) {
                                if (response.status) {
                                    location.reload(true)
                                }
                            }
                        })
                    }
                });
        })
    })

</script>
@else
<script>
    $(document).ready(function () {
        $('#table-siswa').DataTable()

        function ajax() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }


        $(document).on('click', '.btnedit', function () {
            var id = $(this).data('id')
            $('.id_incoming').val(id)
            console.log(id);
            $.ajax({
                url: "{{route('surat_masuk.data_surat')}}",
                method: "GET",
                data: {
                    id: id
                },
                success: function (response) {
                    if (response.status) {
                        var data = response.data;
                        // $('#status').val(data.status).change()
                        $('#keterangan').val(data.status_description)
                    }
                }
            })

            $('#updateModal').modal('show')

        })

        $(document).on('click', '.btnsimpan', function () {
            var formUpload = new FormData();
            var data = $('#formSurat').serializeArray();
            if ($('#paraf')[0].files[0]) {
                formUpload.append("paraf", $('#paraf')[0].files[0]);
            }

            $.each(data, function (key, el) {
                formUpload.append(el.name, el.value);
            });

            ajax()
            $.ajax({
                url: "{{route('surat_masuk.update_surat')}}",
                method: "POST",
                data: formUpload,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.status) {
                        setTimeout(function () {
                            $('#updateModal').modal('hide');
                            window.location.reload(true)
                        }, 1500)
                    }
                    $('#data-alert').html(response.data)
                }
            })

        })


    })

</script>
@endif

@endpush
