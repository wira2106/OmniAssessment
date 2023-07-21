<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatedUserRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Penilaian;
use App\Models\User;
use App\Models\Wawancara;
use App\Repositories\Eloquent\EloquentUserRepository;
use App\Repositories\Interfaces\UserRepository;
use App\Traits\ImageSave;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Transformers\ListUserTransformers;
use App\Transformers\UserTransformers;

class UserController extends Controller
{
    use ImageSave;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(Request $request)
    {
        $this->user = new User;
        $this->UserRepo = app(UserRepository::class);
    }
    
    public function index()
    {
        return view('users.index');
    }

    public function profile(ProfileRequest $request)
    {
        $user = $this->user->all();
        return view('dashboard.dashboard', compact('user'));

    }

    public function data_profile(ProfileRequest $request)
    {
        $user = $request->user();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function view(Request $request)
    {
        $data_user = $this->UserRepo->listData($request);

        $list_user = ListUserTransformers::collection($data_user['data'])
                    ->additional([
                        'jumlah' => $data_user['jumlah']
                    ]);
        return $list_user;
 
        // return response()->json($send);
    }


    public function create(Request $request)
    {
        
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'alamat' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'foto' => 'mimes:jpeg,bmp,png|max:1024',
        ]);
        DB::beginTransaction();
        try {
            $foto = $request->foto? $this->insert_image($request->foto):null;
            $user = $this->UserRepo->create($request,$foto);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }

        return response()->json([
            'errors' => false,
            'message' => "Berhasil",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
       
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $user = $this->UserRepo->find($id);
        $data = (new UserTransformers($user));

        return $data;

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
        $this->validate($request, [
            'name' => 'required',
            'alamat' => 'required',
            'email' => 'required|email',
            'jenis_kelamin' => 'required',
            'foto' => 'mimes:jpeg,bmp,png|max:1024',
        ]);
       
        
        DB::beginTransaction();
        try {
            $foto = $request->foto? $this->update_image($request->foto,$request->foto_lama):$request->foto_lama;
            $update_user = $this->UserRepo->update_data($id,$request,$foto);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }

        return response()->json([
            'errors' => false,
            'message' => "Berhasil",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->UserRepo->delete($id);
        return response()->json([
            'errors' => false,
            'message' => "Berhasil",
        ]);
    }

    public function list_user()
    {
        $data_user = $this->UserRepo->all();

        $list_user = ListUserTransformers::collection($data_user);
        
        if ($data_user) {
            return response()->json([
                'status' => true,
                'message' => "Success",
                'data' => $list_user,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "fail",
                'data' => null,
            ]);
        }
        
       
 
        // return response()->json($send);
    }

}
