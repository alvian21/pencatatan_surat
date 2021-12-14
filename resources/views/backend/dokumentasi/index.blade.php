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
            <div class="material-card card">
                <div class="card-header container-fluid d-flex justify-content-between">
                    <h4 class="text-dark"><i class="fas fa-list pr-2"></i> Daftar Dokumentasi</h4>
                    <a href="{{route('dokumentasi.create')}}" class="btn btn-primary float-right">Tambah Dokumentasi</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-siswa" class="table table-striped border text-center">
                            <thead>
                                <tr>
                                    <th>Nama Kegiatan</th>
                                    <th>Tgl. Kegiatan</th>
                                    <th>Tempat Kegiatan</th>
                                    <th>Jumlah Peserta</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dokumentasi as $item)
                                <tr>
                                    <td>{{$item->name_of_activity}}</td>
                                    <td>{{$item->activity_date}}</td>
                                    <td>{{$item->activity_place}}</td>
                                    <td>{{$item->number_of_participant}}</td>
                                    <td>
                                        <a href="{{route('dokumentasi.edit',[$item->id_documentation])}}"
                                            class="btn btn-warning"><i class="mdi mdi-pencil"></i></a>
                                        <a href="{{route('dokumentasi.show',[$item->id_documentation])}}"
                                            class="btn btn-info"><i class="mdi mdi-eye"></i></a>
                                        <button type="button" class="btn btn-danger hapus"
                                            data-id="{{$item->id_documentation}}"> <i
                                                class="mdi mdi-delete"></i></button>
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
                            url:"{{url('dokumentasi')}}/"+id,
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
