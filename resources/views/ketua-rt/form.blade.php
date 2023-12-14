@extends('layouts.app')
@section('title', $data ? 'Ubah Data':'Tambah Data')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card border-bottom-primary">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                
                @if ($data)
                {!! Form::open()->route('ketua-rt.update',[$data->id])->fill($data)->id('form')->put()->multipart() !!}
                @else
                {!! Form::open()->route('ketua-rt.store')->id('form')->multipart() !!}
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        {!! Form::text('name', 'Nama')->required() !!}
                    </div>
                    <div class="col-lg-12">
                        {!! Form::text('nik', 'NIK')->required() !!}
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <select
                                name="rw"
                                class="form-control"
                                required="" id="rw">
                                <option value=""> -- Pilih RW -- </option>
                                @foreach(App\Models\DataRw::with('rts')->get() as $row)
                                <option value="{{$row->name}}" data-rt="{{$row->rts}}" {{$data ? ($data->rw == $row->name ? 'selected':''):''}}>00{{$row->name}}</option>
                                @endforeach
                            </select>                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <select
                                name="rt"
                                class="form-control"
                                disabled=""
                                id="rt"
                                >
                                <option value=""> -- Pilih RT -- </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        {!! Form::text('description', 'Keterangan') !!}
                    </div>

                    <div class="col-lg-12">
                        <div class="fom-group">
                            <button type="submit" class="btn btn-sm btn-primary"> Simpan </button>
                            <a href="{{ route('ketua-rt.index') }}" class="btn btn-sm btn-light">Kembali</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

                
            </div>
        </div>
    </div>
</div>
@endsection
@include('plugins.select2')
@include('plugins.jquery-validate')
@push('scripts')
<script>
$(document).ready(function(){
    
    $('#form').validate()

    /* RW */
    $('#rw').select2({
        allowClear: true,
        placeholder: '-- Pilih RW --'
    })

    function setRt(){
        $('#rt').empty();
        $('#rt').append(`<option value=""></option>`)
        let rts = $('#rw').find(':selected').data('rt')

        let default_rt = '';
        @if($data)
            default_rt = {{$data->rt}}
        @endif
        
        $.each(rts, function(index,val){
            $('#rt').append(`<option value="${val.name}" ${default_rt == val.name ? 'selected':''}>00${val.name}</option>`)
        })

        $('#rt').prop('disabled',false)

        $('#rt').select2({
            allowClear: true,
            placeholder: '-- Pilih RT --',
        })
    }

    $(document).on('change','#rw',function(e){
        e.preventDefault();
        setRt()
    })

    setRt()

})
</script>
@endpush