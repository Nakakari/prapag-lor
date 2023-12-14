<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data = User::get();
        return view('user.index',compact(['data']));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'password'=>bcrypt($request->password)
        ]);
        User::create($request->all());
        
        return redirect()->route('user.index')->with('success-message','User baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('user.edit',compact(['data']));
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        if($request->has('password')){
            $request->merge([
                'password'=>bcrypt($request->password)
            ]);
        }
        $data->update($request->all());
        return redirect()->route('user.index')->with('success-message','User berhasil diubah');
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);

        $data->delete();
        return redirect()->route('user.index')->with('success-message','User berhasil dihapus');
    }

    public function check(Request $request)
    {
        $type = $request->type;
        $value = $request->$type;
        
        $data = User::find($request->id);

        if($data){
            if(strtolower(trim($data->$type)) == strtolower(trim($value))){
                return response()->json(true);   
            }else{
                $data = User::whereRaw('LOWER('.$type.') = LOWER(?)',$value)->first();
                if($data){
                    return response()->json(false);
                }
                return response()->json(true);
            }
        }else{
            $data = User::whereRaw('LOWER('.$type.') = LOWER(?)',$value)->first();
            if($data){
                return response()->json(false);
            }
            return response()->json(true);
        }
    }

    public function profile()
    {
        $data = Auth::user();
        return view('user.profile',compact('data'));
    }
}
