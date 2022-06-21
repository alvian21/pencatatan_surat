@extends('backend.main')
@section('title')
    Pertanyaan
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
                        <h4 class="text-dark"><i class="fas fa-list pr-2"></i> Daftar Pertanyaan</h4>
                        <a href="{{ route('pertanyaan.create') }}" class="btn btn-primary float-right">Tambah Pertanyaan</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-siswa" class="table table-striped border text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan</th>


                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pertanyaan as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                <a href="{{ route('pertanyaan.edit', [$item->id]) }}"
                                                    class="btn btn-warning"><i class="mdi mdi-pencil"></i></a>
                                                <a href="{{ route('pertanyaan.show', [$item->id]) }}"
                                                    class="btn btn-info"><i class="mdi mdi-eye"></i></a>

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


        })
    </script>
@endpush
