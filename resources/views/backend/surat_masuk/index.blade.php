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
                    <a href="{{route('surat_masuk.create')}}" class="btn btn-primary float-right">Tambah Surat Masuk</a>
                </div>
                <div class="card-body">
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
                                    <td>{{$item->status}}</td>
                                    <td>
                                        <a href="{{route('surat_masuk.edit',[$item->id_incoming])}}"
                                            class="btn btn-warning"><i class="mdi mdi-pencil"></i></a>
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
                            url:"{{url('surat_masuk')}}/"+id,
                            method:"DELETE",
                            success:function(response){
                                if(response.status){
                                    location.reload(true)
                                }
                            }
                        })
                    }
                });
         })
     })
</script>
@endpush
