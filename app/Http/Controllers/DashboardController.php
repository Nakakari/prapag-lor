<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = DB::select("SELECT DISTINCT(k.rw), 
        (SELECT 
        COUNT(id) 
        FROM data_rumahs
        WHERE TRIM(LEADING '0' FROM rw) = k.rw) AS jumlah_rumah,
        
        (SELECT 
        COUNT(id) 
        FROM data_rumahs
        WHERE TRIM(LEADING '0' FROM rw) = k.rw AND jenis_kelamin ='L') AS jumlah_l,
        
        (SELECT 
        COUNT(id) 
        FROM data_rumahs
        WHERE TRIM(LEADING '0' FROM rw) = k.rw AND jenis_kelamin ='P') AS jumlah_p,
        
        (SELECT 
        COUNT(id) 
        FROM data_rumahs
        WHERE TRIM(LEADING '0' FROM rw) = k.rw AND jamban = 1) AS jumlah_jamban,
        
        (SELECT 
        COUNT(id) 
        FROM data_rumahs
        WHERE TRIM(LEADING '0' FROM rw) = k.rw AND air_bersih = 1) AS jumlah_air_bersih,
        
        (SELECT 
        COUNT(id) 
        FROM data_rumahs
        WHERE TRIM(LEADING '0' FROM rw) = k.rw AND air_bersih LIKE '%sumur_gali%') AS jumlah_sumur_gali,
        
        (SELECT 
        COUNT(id) 
        FROM data_rumahs
        WHERE TRIM(LEADING '0' FROM rw) = k.rw AND air_bersih LIKE '%sumur_bor%') AS jumlah_sumur_bor,
        
        (SELECT 
        COUNT(id) 
        FROM data_rumahs
        WHERE TRIM(LEADING '0' FROM rw) = k.rw AND air_bersih LIKE '%pam%') AS jumlah_pam,
        
        (SELECT 
        COUNT(id) 
        FROM data_rumahs
        WHERE TRIM(LEADING '0' FROM rw) = k.rw AND listrik = 1) AS jumlah_listrik
        
        FROM ketua_rts k");

        return view('dashboard.index',compact('data'));
    }
}
