@extends('layouts.app')
@section('title', 'Detail Data Rumah')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-bottom-primary">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
                </div>

                <div class="card-body table-responsive">
                    @php
                        $details = [['name' => 'Nomor Rumah', 'value' => $data->nomor_rumah], ['name' => 'Jenis Dinding', 'value' => $data->jenis_dinding], ['name' => 'Luas m2', 'value' => $data->luas], ['name' => 'Kepala Rumah Tangga', 'value' => $data->kepala_keluarga], ['name' => 'RT/RW', 'value' => sprintf('%03d', $data->rt) . '/' . sprintf('%03d', $data->rw)], ['name' => 'Ketua RT', 'value' => $data->ketua_rt], ['name' => 'Waktu Input', 'value' => $data->created_at]];
                    @endphp

                    <table class="table table-sm table-bordered" id="print-area">
                        <tbody>
                            @foreach ($details as $row)
                                <tr>
                                    <td width="40%">{{ $row['name'] }}</td>
                                    <td width="30%">{{ $row['value'] }}</td>
                                    @if ($loop->index == 0)
                                        <td rowspan="{{ count($details) }}" width="30%">
                                            @if ($data->foto_rumah)
                                                <img src="{{ asset($data->foto_rumah) }}" alt="" class="img-fluid">
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="fom-group">
                                <a href="{{ route('data-rumah-warga.index') }}" class="btn btn-sm btn-light">Kembali</a>
                                <a href="#" id="print-pdf" class="btn btn-sm btn-danger float-right">
                                    <i class="fa fa-file-pdf"></i> Print
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        label {
            font-weight: 1000;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('click', '#print-pdf', function(e) {
                e.preventDefault();
                var element = document.getElementById('print-area');
                var opt = {
                    margin: 1,
                    filename: 'sketsa-rumah.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'cm',
                        format: 'a4',
                        orientation: 'portrait'
                    }
                };

                // New Promise-based usage:
                html2pdf().set(opt).from(element).save();
            })
        });
    </script>
@endpush
