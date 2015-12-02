<?php

/**
 * Created by PhpStorm.
 * User: wences
 * Date: 25/11/2015
 * Time: 1:26
 */

use \Illuminate\DataBase\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('users')->insert(array(
            'name' => 'Wences',
            'email' => 'wencesms92@gmail.com',
            'password' => \Hash::make('secret')
        ));
    }

}