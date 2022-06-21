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
                        <h4 class="card-title">Detail Pertanyaan</h4>
                        <form class="mt-4">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pertanyaan">Pertanyaan</label>
                                        <textarea class="form-control" id="pertanyaan" readonly required name="pertanyaan" rows="3">{{$pertanyaan->name}}</textarea>
                                    </div>
                                </div>
                            </div>

                            @forelse ($pertanyaan->detail_jawaban as $item)
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="jawaban">Jawaban ({{$item->status}})</label>
                                            <textarea class="form-control" readonly id="jawaban" name="jawaban[]" required rows="3">{{$item->name}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse

                            <div class="row  mt-2">
                                <div class="col-md-12 text-center">
                                    <a href="{{route('pertanyaan.index')}}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
