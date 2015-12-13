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
        $filename = pathinfo($nombre, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $user = Auth::user()->id;
        //$user = User::findOrFail($id);
        $public_path = public_path();

        while (\Storage::exists($nombre))
        {
            $nombre=$filename.'1'.'.'.$extension;
            $filename=$filename.'1';
            echo $nombre;
        }

        \Storage::disk('local')->put($nombre,  \File::get($file));
        $entry = new Fileentry();

        // $entry->mime = $file->getClientMimeType();
        //$entry->original_filename = $file->getClientOriginalName();

        $entry->filename = $nombre;
        $entry->lattitude = $lat;
        $entry->longitude = $lng;
        //$entry->path = $file->getRealPath();
        $entry->path = $public_path;
        $entry->user_id = $user;

        $entry->save();

        Session::flash('flash_message', 'Well done! Your picture has been uploaded succesfully.');
        Session::flash('flash_type', 'alert-success');

        return redirect::to('/');
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

        $control = '';
        //$thumbnails = Fileentry::all();
       // echo $thumbnails;

        return view('layout.master2', compact('thumbnails'));
    }

    public function showmap1()
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
        $control = 'map';

        return response()->json($thumbnails);
    }

    public function showmap2()
    {
        $thumbnails = Fileentry::all();

        return response()->json($thumbnails);
    }

    public function showmap3()
    {

        $arg1 = $_GET['argument1'];

        $thumbnails = \DB::table('fileentries')
            ->where(function ($query) use ($arg1) {
                $query->select('fileentries.id', 'fileentries.user_id', 'fileentries.filename'
                    , 'fileentries.path', 'fileentries.lattitude', 'fileentries.longitude'
                    , 'fileentries.created_at', 'fileentries.updated_at')
                    ->where('fileentries.filename','LIKE', '%'.$arg1.'%');
            })->get();
        $control = 'map';

        return response()->json($thumbnails);
    }


    public function delete($picture)
    {


        \DB::table('fileentries')->where('filename', $picture)->delete();
        \Storage::delete($picture);
        //\Storage::disk('local')->delete('filename');

        Session::flash('flash_message', 'Well done! Your picture has been deleted succesfully.');
        Session::flash('flash_type', 'alert-success');

        //$thumbnails = Fileentry::all();
        return redirect::to('/');
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
