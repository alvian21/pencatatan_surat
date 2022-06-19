@extends('backend.main')
@section('title')
    Karyawan
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
                        <h4 class="text-dark"><i class="fas fa-list pr-2"></i> Daftar Karyawan</h4>
                        <a href="{{ route('karyawan.create') }}" class="btn btn-primary float-right">Tambah Karyawan</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-siswa" class="table table-striped border text-center">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tempat & Tgl. Lahir</th>

                                        <th>Alamat</th>
                                        <th>Nomor Hp</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th>Jabatan</th>
                                        <th>Jumlah Dokumen</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($karyawan as $item)
                                        <tr>
                                            <td>{{ $item->name_e }}</td>
                                            <td>{{ $item->birth_place }},
                                                {{ date('j F Y', strtotime($item->birth_date)) }}
                                            </td>
                                            <td>{{ $item->address }}</td>
                                            <td>{{ $item->phone_number }}</td>
                                            <td>{{ $item->last_education }}</td>
                                            <td>{{ $item->role }}</td>
                                            @if ($item->status == 'Tenaga Pendidik')
                                                <td>{{ count($item->certificate) }}/4</td>
                                            @else
                                                <td>{{ count($item->certificate) }}/3</td>
                                            @endif
                                            <td>{{$item->status}}</td>
                                            <td>
                                                <a href="{{ route('karyawan.edit', [$item->employee_id]) }}"
                                                    class="btn btn-warning"><i class="mdi mdi-pencil"></i></a>
                                                <a href="{{ route('karyawan.show', [$item->employee_id]) }}"
                                                    class="btn btn-info"><i class="mdi mdi-eye"></i></a>
                                                <button type="button" class="btn btn-danger hapus"
                                                    data-id="{{ $item->employee_id }}"> <i
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
        $(document).ready(function() {
            $('#table-siswa').DataTable()

            function ajax() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }

            $('.hapus').on('click', function() {
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
                                url: "{{ url('karyawan') }}/" + id,
                                method: "DELETE",
                                success: function(response) {
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
