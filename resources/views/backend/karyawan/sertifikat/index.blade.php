@extends('backend.main')
@section('title')
Sertifikat Karyawan
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
                    <h4 class="text-dark"><i class="fas fa-list pr-2"></i> Daftar Sertifikat Karyawan</h4>
                    {{-- <a href="{{route('karyawan.create')}}" class="btn btn-primary float-right">Tambah Karyawan</a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-siswa" class="table table-striped border text-center">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tempat & Tgl. Lahir</th>
                                    <th>Pendidikan Terakhir</th>
                                    <th>Jumlah Sertifikat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($karyawan as $item)
                                <tr>
                                    <td>{{$item->name_e}}</td>
                                    <td>{{$item->birth_place}}, {{date("j F Y", strtotime($item->birth_date))}}</td>
                                    <td>{{$item->last_education}}</td>
                                    <td>{{count($item->certificate)}}</td>

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


     })
</script>
@endpush
