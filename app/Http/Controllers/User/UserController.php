<?php

namespace App\Http\Controllers\User;


use Auth;
use App\User;
use App\Service;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Freshwork\ChileanBundle\Rut;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;
use Illuminate\Support\Facades\DB;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('permission:users.index')->only('index');
        $this->middleware('permission:users.store')->only('store');
        $this->middleware('permission:users.update')->only('update');
        $this->middleware('permission:users.destroy')->only('destroy');*/
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
            $users = User::orderBy('id', 'DESC')->with('roles')->paginate(10);

            return [
                'pagination' => [
                    'total'         => $users->total(),
                    'current_page'  => $users->currentPage(),
                    'per_page'      => $users->perPage(),
                    'last_page'     => $users->lastPage(),
                    'from'          => $users->firstItem(),
                    'to'            => $users->lastItem(),
                ],
                'users' => $users
            ];
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = request('id');
        $this->validate($request, [
            'name' => 'required|min:6|max:190',
            'email' => 'required|email|unique:users,email|min:6|max:150',
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'El campo nombre debe tener al menos 6 caracteres',
            'name.max' => 'El campo nombre debe tener a lo más 190 caracteres',
            'email.required' => 'El campo correo electrónico es obligatorio',
            'email.unique' => 'El correo electrónico ya existe',
            'email.min' => 'El campo de correo electrónico debe tener al menos 6 caracteres',
            'email.max' => 'El campo de correo electrónico debe tener a lo más 150 caracteres',
        ]);

        $data = $request->all();

        //$data['rut'] = Rut::parse($data['rut'])->format();
        //$data['password'] = bcrypt(Rut::parse($data['rut'])->format(Rut::FORMAT_ESCAPED));
        $data['password'] = bcrypt( $data['password'] );
        $data['url'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20); 

        $user = User::create($data);

        DB::table('quotationclients')->where('id', $id)->update(
            [
                'generado_client' => 1, 
            ]
        );

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return $user;
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
            'name' => 'required|min:6|max:190',
            'email' => ['required', 'email', 'min:6', 'max:150',
                        \Illuminate\Validation\Rule::unique('users')->ignore(User::find($id))],
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'El campo nombre debe tener al menos 6 caracteres',
            'name.max' => 'El campo nombre debe tener a lo más 190 caracteres',
            'email.required' => 'El campo correo electrónico es obligatorio',
            'email.min' => 'El campo de correo electrónico debe tener al menos 6 caracteres',
            'email.max' => 'El campo de correo electrónico debe tener a lo más 150 caracteres',
        ]);

        $data = $request->all();

        //$data['rut'] = Rut::parse($data['rut'])->format();
        //$data['password'] = bcrypt(Rut::parse($data['rut'])->format(Rut::FORMAT_ESCAPED));
        $data['password'] = bcrypt( $data['password'] );
        $data['url'] = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20);

        User::find($id)->update($data);

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return;
    }

    public function all()
    {
        $user = User::orderBy('id', 'DESC')->get();

        return $user;
    }

    public function getId()
    {
        $id = \Auth::user()->id;

        return $id;
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function clients()
    {
        $user_id = \Auth::user()->id;

        $clients = DB::table('users')
            ->join('mechanic_client', 'users.id', '=', 'mechanic_client.user_id')
            ->where('mechanic_client.mechanic_id', '=', $user_id)
            ->select('users.id', 'users.name', 'users.email', 'users.password', 'users.url')
            ->get();

        return $clients;
    }

    public function storeclient(Request $request)
    {
        //$id = request('id');
        $user = $this->store($request);

        $user->roles()->sync(array(0 => '3'));

        DB::table('mechanic_client')->insertOrIgnore(
            [
                'user_id' => $user->id, 
                'mechanic_id' => \Auth::user()->id,
                //'quotation_id' => request('id')
            ]
        );

        DB::table('quotationclients')->where('id', $id)->update(
            [
                'generado_client' => 1, 
            ]
        );
    }
    
    public function updateRole(Request $request, User $user)
    {
        //$user->update($request);
        //actualizar roles
        
        $user->roles()->sync($request->all());
    }
}
