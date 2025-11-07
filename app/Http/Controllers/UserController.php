<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users  = User::latest();  
        $search = $request->get('search');
       // $role   = $request->get('role');

        if ($search) {
            $users = $users->where(function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%')
                                  ;
                        });
        }
        
        $users= $users->paginate(10);
        return view('users.list',[
            'users' =>$users  ,
        ]);
    }
 
    /** 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate =Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email'=>'required|email|unique:users,email,',
            'password'=>'required|min:5|same:confrmPassword',
             'confrmPassword'=>'required',
             
          ]);
          
 
         if($validate->fails()){
            return redirect()->route('users.create')->withInput()->withErrors($validate);
         } 
         $user                        =new user();
         $user->name                  = strtolower(( trim($request->name) ));
         $user->email                 = $request->email;
         $user->password              = Hash::make($request->password); 
         $user->save();
  
         return redirect()->route('users.index')->with('success','User aded Successfuly');
 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id     = Crypt::decrypt($id);
       
        $user= User::findOrFail($id);
       
        return view('users.edit',[
            'user' =>$user, 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = Crypt::decrypt($id); 
        $user= User::findOrFail($id);//check user existence

         $validate =Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email'=>'required|email|unique:users,email,'.$id.',id',
             'password' => 'nullable|min:5|same:confrmPassword',
            'confrmPassword' => 'nullable|same:password', 
           
          ]);

         if($validate->fails()){
            $id= encrypt($id); 
            return redirect()->route('users.edit',$id)->withInput()->withErrors($validate);
         }
         
         $user->name                 = strtolower(( trim($request->name) ));
         $user->email                = $request->email;
        
         if ($request->filled('password') && $request->password !== '*****') {
            $user->password = bcrypt($request->password); // Always hash passwords!
       }
          $user->save();

          return redirect()->route('users.index')->with('success','User updated Successfuly');

    }
 
    /**
     * Remove the specified resource from storage.
     */ 
    public function destroy(string $id)
    {
        $id = Crypt::decrypt($id); 
        $user = User::find($id);
       
           $user->delete();  

          return redirect()->route('users.index')->with('success', 'Users successfully deleted.');
        
    }
}
