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
            <div class="material-card card">
                <div class="card-header container-fluid d-flex justify-content-between">
                    <h4 class="text-dark"><i class="fas fa-list pr-2"></i> Daftar Ijazah Siswa</h4>
                    <a href="{{route('siswa.create')}}" class="btn btn-primary float-right">Tambah Ijazah Siswa</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-siswa" class="table table-striped border text-center">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tempat & Tgl. Lahir</th>
                                    <th>Nama OrangTua</th>
                                    <th>NISN</th>
                                    <th>NIS</th>
                                    <th>NPSN</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswa as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->birth_place_s}}, {{date("j F Y", strtotime($item->birth_date_s))}}</td>
                                    <td>{{$item->parents_name}}</td>
                                    <td>{{$item->nisn}}</td>
                                    <td>{{$item->nis}}</td>
                                    <td>{{$item->npsn}}</td>
                                    <td>

                                        <a href="{{route('siswa.edit',[$item->id_sd])}}" class="btn btn-warning"><i
                                                class="mdi mdi-pencil"></i></a>

                                        <a href="{{route('siswa.show',[$item->id_sd])}}"
                                            class="btn btn-info"><i class="mdi mdi-eye"></i></a>
                                            
                                        <button type="button" class="btn btn-danger hapus" data-id="{{$item->id_sd}}">
                                            <i class="mdi mdi-delete"></i></button>
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
                            url: "{{url('siswa')}}/" + id,
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
@endpush
