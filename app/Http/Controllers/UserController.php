<?php

namespace App\Http\Controllers;

use App\Events\SendEmailUserEvent;
use App\Http\Requests\CreatedUserRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
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
use CreateUsersTable;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

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

    public function view(UserRequest $request)
    {
        $data_user = $this->UserRepo->listData($request);

        $list_user = ListUserTransformers::collection($data_user['data'])
                    ->additional([
                        'jumlah' => $data_user['jumlah']
                    ]);
        return $list_user;
 
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
    public function store(CreatedUserRequest $request)
    {

        DB::beginTransaction();
        try {
            $foto = $request->foto? $this->insert_image($request->foto):null;
            $user = $this->UserRepo->create($request,$foto);
            $creater = $request->user()->name;

            Log::info($creater.": created data ".$user->name." is Successfully");
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
     * register new data user
     *
     * @param  mixed $request
     * @return void
     */
    public function register(Request $request)
    {

        DB::beginTransaction();
        try {
            $foto = $request->foto? $this->insert_image($request->foto):null;
            $user = $this->UserRepo->create($request,$foto);

            Log::info("Register data ".$user->name." is Successfully");
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeManyUser(CreatedUserRequest $request)
    {

        $newUser = [];
        $faker = Faker::create('id_ID');
        for ($i = 0; $i <= 100; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            $name = $firstName . " " . $lastName;
            $email = strtolower($firstName . $lastName) . '@gmail.com';
            $address = $faker->randomElement([
                'Jl. Kenangan, Gang Hujan',
                'Jl. Sudirman, Gang Kenangan',
                'Jl. Gajah Mada, Gang I',
                'Jl. Mawar Merah, Gang II',
                'Jl. Kebo Iwa , Gang II'
            ]);
            $newUser [] = [
                'name' => $name,
                'email' =>  $email,
                'foto' =>  null,
                'password' => '12345678',
                'password_confirmation' => '12345678',
                'alamat' => $address
            ];
        }
        $json = json_encode($newUser);
        return $json;
        dd(json_encode($newUser),json_decode($json));
        dd(json_decode($newUser));
        DB::beginTransaction();
        try {
            $foto = $request->foto? $this->insert_image($request->foto):null;
            $user = $this->UserRepo->create($request,$foto);
            $createrMany = $request->user()->name;

            Log::info($createrMany.": created data ".$user->name." is Successfully");
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
    public function update(UpdateUserRequest $request, $id)
    {
        
        DB::beginTransaction();
        try {
            $foto = $request->foto? $this->update_image($request->foto,$request->foto_lama):$request->foto_lama;
            $update_user = $this->UserRepo->update_data($id,$request,$foto);
            $Updater = $request->user()->name;

            Log::info($Updater.": update data ".$request->name." is Successfully");
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
    public function destroy(DeleteRequest $request,$id)
    {
        $deleter = $request->user()->name;
        $user = $this->UserRepo->delete($id);

        Log::info($deleter.": deleted data ".$user->name." is Successfully");
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
