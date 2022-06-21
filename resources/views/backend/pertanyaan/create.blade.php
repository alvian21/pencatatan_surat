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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Pertanyaan</h4>
                        <form class="mt-4" method="post" action="{{ route('pertanyaan.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @include('backend.include.alert')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pertanyaan">Pertanyaan</label>
                                        <textarea class="form-control" id="pertanyaan" required name="pertanyaan" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            @forelse ($jawaban as $item)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="jawaban">Jawaban ({{$item['nilai']}})</label>
                                            <textarea class="form-control" id="jawaban" name="jawaban[]" required rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse

                            <div class="row  mt-2">
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
        $(document).ready(function() {
            $('#table-siswa').DataTable()
        })
    </script>
@endpush
