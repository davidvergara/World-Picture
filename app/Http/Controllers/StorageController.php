<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Fileentry;
use Illuminate\Support\Facades\Redirect;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \View::make('new');
    }


    public function save(Request $request)
    {

        $input = Request::all();

        $file = $input['file'];
        $lat = $input['lat'];
        $lng = $input['lng'];
        $nombre = $file->getClientOriginalName();
        //$extension = $file->getClientOriginalExtension();
        $user = Auth::user()->id;
        //$user = User::findOrFail($id);
        $public_path = public_path();

        if (\Storage::exists($nombre))
        {
            Session::flash('flash_message', 'Alert! The name of the picture is already in use.');
            Session::flash('flash_type', 'alert-danger');

            return redirect::to('/showpictures');
        }


        \Storage::disk('local')->put($nombre,  \File::get($file));
        $entry = new Fileentry();
        // $entry->mime = $file->getClientMimeType();
        //$entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getClientOriginalName();
        //$entry->path = $file->getRealPath();
        $entry->path = $public_path;
        $entry->lattitude = $lat;
        $entry->longitude = $lng;
        $entry->user_id = $user;

        $entry->save();

        Session::flash('flash_message', 'Well done! Your picture has been uploaded succesfully.');
        Session::flash('flash_type', 'alert-success');

        return redirect::to('/showpictures');
    }

    /**
     * Show the form for creating a new resourcez
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //$pictures = Fileentry::all();
        $userId = Auth::user()->id;
        $thumbnails = \DB::table('fileentries')
            ->where(function ($query) use ($userId) {
                $query->select('fileentries.id', 'fileentries.user_id', 'fileentries.filename'
                    , 'fileentries.path', 'fileentries.lattitude', 'fileentries.longitude'
                    , 'fileentries.created_at', 'fileentries.updated_at')
                    ->where('fileentries.user_id', '=', $userId);
            })->get();




        //$thumbnails = Fileentry::all();
        return view('layout.master2', compact('thumbnails'));
    }

    public function delete($picture)
    {


        \DB::table('fileentries')->where('filename', $picture)->delete();
        \Storage::delete($picture);
        //\Storage::disk('local')->delete('filename');

        //$thumbnails = Fileentry::all();
        return redirect::to('/showpictures');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
