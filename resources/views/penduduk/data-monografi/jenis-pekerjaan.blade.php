@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow border-bottom-primary">
                <div class="card-header">
                    <div class="float-left">
                        <h6 class="d-inline text-primary">Data Monografi Penduduk Berdasarkan Jenis Pekerjaan
                        </h6>
                    </div>
                    <div class="float-right">
                        <a onclick="exportData('btnExcel')" class="btn btn-success print-excel text-white"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-excel" viewBox="0 0 16 16">
                                <path
                                    d="M5.18 4.616a.5.5 0 0 1 .704.064L8 7.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 8l2.233 2.68a.5.5 0 0 1-.768.64L8 8.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 8 5.116 5.32a.5.5 0 0 1 .064-.704" />
                                <path
                                    d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1" />
                            </svg> Excel
                        </a>
                        <a onclick="exportData('btnPdf')" class="btn btn-danger print-pdf text-white"><i
                                class="fas fa-file-pdf"></i>
                            PDF
                        </a>
                    </div>
                </div>

                <div class="card-body table-responsive">

                    <input type="hidden" id="filter-kondisi" value="{{ $request['kondisi'] }}" />
                    <input type="hidden" id="filter-rt" value="{{ $request['rt'] }}" />
                    <input type="hidden" id="filter-rw" value="{{ $request['rw'] }}" />

                    <table class="table table-bordered table-sm" style="width: 100%;">
                        <thead>
                            <tr>
                                <th rowspan="3">NO</th>
                                <th rowspan="3">PEKERJAAN</th>
                                @foreach ($data['data']['berdasarkan']['RW'] as $key => $row)
                                    <th colspan="{{ count($data['data']['berdasarkan']['RT']) * 3 }}">RW.
                                        00{{ ucwords($row) }}
                                    </th>
                                @endforeach
                                {{-- <th colspan="2">JUMLAH</th> --}}
                            </tr>
                            <tr>
                                @for ($i = 0; $i < count($data['data']['berdasarkan']['RW']); $i++)
                                    @foreach ($data['data']['berdasarkan']['RT'] as $key => $row)
                                        <th colspan="3">RT. 00{{ ucwords($row) }}
                                        </th>
                                    @endforeach
                                @endfor
                            </tr>
                            <tr>
                                @for ($i = 0; $i < count($data['data']['berdasarkan']['RW']); $i++)
                                    @for ($j = 0; $j < count($data['data']['berdasarkan']['RT']); $j++)
                                        <th>L</th>
                                        <th>P</th>
                                        <th>L+P</th>
                                    @endfor
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($data['data']['pekerjaan'] as $key => $pekerjaan)
                                <tr>
                                    <td class="text-center">{{ $nomor++ }}</td>
                                    <td>{{ $key }}</td>
                                    @foreach ($pekerjaan['rw'] as $rw)
                                        @foreach ($rw['rt'] as $rt)
                                            <td>{{ $rt['L'] }}</td>
                                            <td>{{ $rt['P'] }}</td>
                                            <td>{{ $rt['L'] + $rt['P'] }}</td>
                                        @endforeach
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        table>thead>tr>th {
            vertical-align: middle !important;
            text-align: center;
            font-size: 10px;
        }

        table>tbody>tr>td {
            font-size: 10px;
        }

        table>tfoot>tr>td {
            font-size: 10px;
            font-weight: bold;
        }

        .feather-16 {
            width: 16px;
            height: 16px;
        }

        .feather-24 {
            width: 24px;
            height: 24px;
        }

        .feather-32 {
            width: 32px;
            height: 32px;
        }
    </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        function exportData(btnType) {
            window.open('/penduduk/export-monografi?' +
                'kondisi=' + $("#filter-kondisi").val() +
                '&rt=' + $("#filter-rt").val() +
                '&rw=' + $("#filter-rw").val() +
                '&btnType=' + btnType
            );
        }
    </script>
@endpush
