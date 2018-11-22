<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$data = User::orderBy('id','DESC')->get();
    	return view('users.index',compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('id', 'desc')->pluck('name','name')->all();
        return view('users.create',compact('roles'));
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
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        $lastPenggugat = User::role('Penggugat')->latest()->first();
        $nextNo = '';
        if (!$lastPenggugat) {
            $nextNo = 1;
        } else if ($lastPenggugat) {
            if (in_array($lastPenggugat->no_perkara, ['', null ] )){
                $nextNo = 1;
            } else { 
                $no_perkara = $lastPenggugat->no_perkara;

                $no_perkara = explode('/', $no_perkara);

                $nextNo = $no_perkara[0] + 1;
            }
        }

        $year = date('Y');

        $no_perkara = "$nextNo/g/$year/PTUN.PBR";

        $input['no_perkara'] = $no_perkara;

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
        ->with('success','User created successfully');
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
    	return view('users.show',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$user = User::find($id);
    	$roles = Role::pluck('name','name')->all();
    	$userRole = $user->roles->pluck('name','name')->all();
    	return view('users.edit',compact('user','roles','userRole'));
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
            'username' => 'required||unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    	$input = $request->all();
    	if(!empty($input['password'])){ 
    		$input['password'] = Hash::make($input['password']);
    	}else{
    		$input = array_except($input,array('password'));    
    	}
    	$user = User::find($id);
    	$user->update($input);
    	DB::table('model_has_roles')->where('model_id',$id)->delete();
    	$user->assignRole($request->input('roles'));
    	return redirect()->route('users.index')
    	->with('success','User updated successfully');
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


        $user->trans_perkara->each(function($i) {
            $i->trans_perkara_det->each(function($ii) {
                $ii->delete();
            });

            $i->delete();
        });
        $user->delete();
        return redirect()->route('users.index')
        ->with('success','User deleted successfully');
    }
}