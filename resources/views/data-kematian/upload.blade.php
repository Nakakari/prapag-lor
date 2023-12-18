@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card border-bottom-primary">
                <div class="card-header">
                    <div class="float-left">
                        <h6 class="m-0 font-weight-bold text-primary">Upload File</h6>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('fail'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('fail') }}
                        </div>
                    @endif

                    <form action="{{ route('data-kematian.upload') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>File Excel (Download <a href="{{ asset('excel/contoh-buku-pemakaman.xlsx') }}">Contoh
                                    Format Buku Pemakaman</a>)</label>
                            <input type="file" name="upload_buku_pemakaman"
                                class="form-control @error('upload_buku_pemakaman') is-invalid @enderror" required="">
                            @error('upload_buku_pemakaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                            <a href="{{ route('data-kematian.index') }}" class="btn btn-sm btn-light">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('plugins.select2')
@push('styles')
    <style>
        .select2-container {
            width: 250px !important;
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.cari').select2();
        });
    </script>
@endpush
