<?php

use Illuminate\Database\Seeder;
use\App\Models\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::truncate();

        $arrUsers = ['thanh@eocenterprise.com','tranduyhoa94@gmail.com'];

        foreach ($arrUsers as $key => $value) {

        	$user = User::create([
        		'email'=>$value,
        		'first_name'=> 'SFR',
        		'last_name'=> 'Software',
        		'password'=>bcrypt('123456')
        	]);

        	$user->access_token = $user->generateAccessToken();
        	$user->save();

        }
    }
}
