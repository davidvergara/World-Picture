<?php namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller {
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


	if (Auth::guest()){
			return view('home');
		}
		else{
			$userId = Auth::user()->id;
			$thumbnails = \DB::table('fileentries')
					->where(function ($query) use ($userId) {
						$query->select('fileentries.id', 'fileentries.user_id', 'fileentries.filename'
								, 'fileentries.path', 'fileentries.lattitude', 'fileentries.longitude'
								, 'fileentries.created_at', 'fileentries.updated_at')
								->where('fileentries.user_id', '=', $userId);
					})->get();



			return view('layout.master2', compact('thumbnails'));


		}
	}

}