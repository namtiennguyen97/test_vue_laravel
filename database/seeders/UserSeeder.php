<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $res = User::create([
            'name' => 'lucnn',
            'email' => 'lucnn@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        dd($res);
//        $user = new User([
//            'id' => 'q',
//            'name' => 'lucnn4',
//            'email' => 'lucnn4@gmail.com',
//            'password' => Hash::make('123456'),
//        ]);
//        if(!$user->save()){
//            dd('create user lỗi', $user);
//        }else{
//            dd($user->created_at);
//        }
    }
}
