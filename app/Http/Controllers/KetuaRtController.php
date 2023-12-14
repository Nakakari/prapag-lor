<?php

namespace App\Http\Controllers;

use App\Models\KetuaRt;
use Illuminate\Http\Request;

class KetuaRtController extends Controller
{
    public function index()
    {
        $data = KetuaRt::get();
        return view('ketua-rt.index',compact(['data']));
    }

    public function create()
    {
        $data = null;
        return view('ketua-rt.form',compact(['data']));
    }

    public function store(Request $request)
    {
        $check = KetuaRt::where('rt',$request->rt)->where('rw',$request->rw)->first();

        if($check){
            return redirect()->back()->with('error-message','Ketua untuk RT 00'.$request->rt.' dan RW 00'.$request->rw.' Sudah ada');
        }

        KetuaRt::create($request->all());
        
        return redirect()->route('ketua-rt.index')->with('success-message','Ketua RT baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = KetuaRt::findOrFail($id);

        return view('ketua-rt.form',compact(['data']));
    }

    public function update(Request $request, $id)
    {
        $check = KetuaRt::where('rt',$request->rt)->where('rw',$request->rw)->where('id','!=',$id)->first();

        if($check){
            return redirect()->back()->with('error-message','Ketua untuk RT 00'.$request->rt.' dan RW 00'.$request->rw.' Sudah ada');
        }

        $data = KetuaRt::findOrFail($id);

        $data->update($request->all());
        return redirect()->route('ketua-rt.index')->with('success-message','Ketua RT berhasil diubah');
    }

    public function destroy($id)
    {
        $data = KetuaRt::findOrFail($id);

        $data->delete();
        return redirect()->route('ketua-rt.index')->with('success-message','Ketua RT berhasil dihapus');
    }

    public function check(Request $request)
    {
        $type = $request->type;
        $value = $request->$type;
        
        $data = KetuaRt::find($request->id);

        if($data){
            if(strtolower(trim($data->$type)) == strtolower(trim($value))){
                return response()->json(true);   
            }else{
                $data = KetuaRt::whereRaw('LOWER('.$type.') = LOWER(?)',$value)->first();
                if($data){
                    return response()->json(false);
                }
                return response()->json(true);
            }
        }else{
            $data = KetuaRt::whereRaw('LOWER('.$type.') = LOWER(?)',$value)->first();
            if($data){
                return response()->json(false);
            }
            return response()->json(true);
        }
    }
}
