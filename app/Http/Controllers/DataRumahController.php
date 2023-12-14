<?php

namespace App\Http\Controllers;

use App\Models\DataRumah;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class DataRumahController extends Controller
{
    use FileUpload;
    
    public function index()
    {
        $data = DataRumah::query();
        if(auth()->user()->role == 'ketua_rt'){
            $data->where('rt',auth()->user()->ketua_rt->rt);
            $data->where('rw',auth()->user()->ketua_rt->rw);
        }
        $data = $data->get();
        return view('data-rumah.index',compact(['data']));
    }

    public function create()
    {
        $data = null;
        $nomor_rumah = '001';
        if(auth()->user()->role == 'ketua_rt'){
            $check_no = DataRumah::where('rt',auth()->user()->ketua_rt->rt)
                        ->where('rw',auth()->user()->ketua_rt->rw)
                        ->orderBy('nomor_rumah','DESC')
                        ->first();
            
            if($check_no){
                $nomor_rumah = sprintf('%03d',((int) $check_no->nomor_rumah + 1));
            }
        }
        return view('data-rumah.form',compact(['data','nomor_rumah']));
    }

    public function store(Request $request)
    {
        if($request->has('file'))
        {
            $file = $this->file_upload($request->file,'uploads/data-rumah',time().'-data-rumah-'.$request->kepala_keluarga.'.'.$request->file->getClientOriginalExtension());
            $request->merge(['foto_rumah'=>$file]);
        }

        if(!$request->has('jamban'))
        {
            $request->merge([
                'jamban'=>NULL
            ]);
        }
        
        if(!$request->has('listrik'))
        {
            $request->merge([
                'listrik'=>NULL
            ]);
        }
        
        if(!$request->has('air_bersih'))
        {
            $request->merge([
                'air_bersih'=>NULL
            ]);
        }

        DataRumah::create($request->all());
        
        return redirect()->route('data-rumah.index')->with('success-message','Data Rumah baru berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = DataRumah::findOrFail($id);
        
        return view('data-rumah.show',compact(['data']));
    }

    public function edit($id)
    {
        $data = DataRumah::findOrFail($id);
        $nomor_rumah = $data->nomor_rumah;
        return view('data-rumah.form',compact(['data','nomor_rumah']));
    }

    public function update(Request $request, $id)
    {
        $data = DataRumah::findOrFail($id);

        if($request->has('file'))
        {
            $file = $this->file_upload($request->file,'uploads/data-rumah',time().'-data-rumah-'.$request->kepala_keluarga.'.'.$request->file->getClientOriginalExtension());
            $request->merge(['foto_rumah'=>$file]);
        }

        if(!$request->has('jamban'))
        {
            $request->merge([
                'jamban'=>NULL
            ]);
        }
        
        if(!$request->has('listrik'))
        {
            $request->merge([
                'listrik'=>NULL
            ]);
        }
        
        if(!$request->has('air_bersih'))
        {
            $request->merge([
                'air_bersih'=>NULL
            ]);
        }

        $data->update($request->all());
        return redirect()->route('data-rumah.index')->with('success-message','Data Rumah berhasil diubah');
    }

    public function destroy($id)
    {
        $data = DataRumah::findOrFail($id);

        $data->delete();
        return redirect()->route('data-rumah.index')->with('success-message','Data Rumah berhasil dihapus');
    }

    public function check(Request $request)
    {
        $type = $request->type;
        $value = $request->$type;
        
        $data = DataRumah::find($request->id);

        if($data){
            if(strtolower(trim($data->$type)) == strtolower(trim($value))){
                return response()->json(true);   
            }else{
                $data = DataRumah::whereRaw('LOWER('.$type.') = LOWER(?)',$value)->first();
                if($data){
                    return response()->json(false);
                }
                return response()->json(true);
            }
        }else{
            $data = DataRumah::whereRaw('LOWER('.$type.') = LOWER(?)',$value)->first();
            if($data){
                return response()->json(false);
            }
            return response()->json(true);
        }
    }
}
