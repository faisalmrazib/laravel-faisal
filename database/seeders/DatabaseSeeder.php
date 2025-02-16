<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            [
                'id' => 1,
                'name'=>'Admin',
                'email'=>'admin@admin.com',
                'password'=> Hash::make('12345678'),
                'is_admin' => true
                ]
        ]);

        
    }
   
}
