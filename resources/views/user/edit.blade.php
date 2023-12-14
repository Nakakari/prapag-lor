@extends('layouts.app')
@section('title','Ubah User')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-bottom-primary">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                <form action="{{route('user.update',$data->id)}}" method="POST" id="form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" required value="{{$data->name}}" autofocus>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="custom-select">
                                    @foreach (App\Models\User::ListRole() as $key=>$row)
                                    <option value="{{$key}}" {{$data->role == $key ? 'selected':''}}>{{$row}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" required value="{{$data->username}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required value="{{$data->email}}">
                            </div>
                        </div>
                        <div class="col-lg-12">              
                            <div class="form-group">
                                <label class="d-block">
                                    Password
                                    <div class="custom-control custom-checkbox float-right">
                                        <input type="checkbox" class="custom-control-input" id="is_password">
                                        <label class="custom-control-label" for="is_password">Ganti password?</label>
                                    </div>
                                </label>
                                <input type="text" name="password" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <a href="{{route('user.index')}}" class="btn btn-light"><i class="fa fa-fw fa-arrow-left"></i>Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@include('plugins.jquery-validate')
@push('scripts')
<script>
    $(document).ready(function(){
        $('#form').validate({
            rules: {
                username: {
                    required: true,
                    remote: {
                        url: '{{route("user.check")}}',
                        method: 'GET',
                        data:{
                            type: function(){
                                return 'username'
                            },id: function(){
                                return '{{$data->id}}'
                            }
                        } 
                    }
                },
                email: {
                    required: true,
                    remote: {
                        url: '{{route("user.check")}}',
                        method: 'GET',
                        data:{
                            type: function(){
                                return 'email'
                            },id: function(){
                                return '{{$data->id}}'
                            }
                        } 
                    }
                }
            },
            messages: {
                username: {
                    remote: 'Username telah digunakan'
                },
                email: {
                    remote: 'Email telah digunakan'
                }
            }
        })

        function is_password()
        {
            if($('#is_password').is(':checked'))
            {
                $('input[name="password"]').prop('disabled',false);
            }else{
                $('input[name="password"]').prop('disabled',true);
             
            }
        }

        is_password();

        $(document).on('click','#is_password',function(e){
            is_password();
        })
    })
</script> 
@endpush