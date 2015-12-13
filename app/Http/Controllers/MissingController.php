<?php namespace App\Http\Controllers;

use Auth;

class MissingController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        //$conn = DB::connection('mysql');


            return view('missing.blade');

    }

}