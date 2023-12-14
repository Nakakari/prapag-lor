<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name'=>'admin','email'=>'admin@app.com','role'=>'admin']
        ];

        foreach($users as $row){
            User::create([
                'name'=>$row['name'],
                'username'=>$row['name'],
                'role'=>$row['role'],
                'email'=>$row['email'],
                'password'=>bcrypt('admin'),
            ]);
        }
    }
}
