@extends('layouts.app')
@section('title','Tambah User')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-bottom-primary">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                <form action="{{route('user.store')}}" method="POST" id="form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" required autofocus>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="custom-select">
                                    @foreach (App\Models\User::ListRole() as $key=>$row)
                                    <option value="{{$key}}">{{$row}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">              
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" required>
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
    })
</script> 
@endpush