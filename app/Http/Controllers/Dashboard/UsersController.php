<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Hash;
use Auth;
use App\Image;

class UsersController extends Controller {

    /**
    * render and paginate the users page.
    *
    * @return string
    */
    public function index() {
         $users = Admin::latest()->where('id', '<>', auth()->id())->get(); //use pagination here
        return view('dashboard.users.index', compact('users'));
    }

    public function create(){
        $roles = Role::get();
        return view('dashboard.users.create',compact('roles'));
    }
    
    public function edit($id){
        $user= Admin::find($id);
        $roles = Role::get();
        if($user)
        return view('dashboard.users.edit',compact('user','roles'));
        else
        return redirect()->route('admin.users.index')->with(['error' => 'this user not exist']);
    }



    public function store(AdminRequest $request) {
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);   // the best place on model
        $user->role_id = $request->role_id;

        // save the new user data
        if($user->save())
             return redirect()->route('admin.users.index')->with(['success' => 'تم التحديث بنجاح']);
        else
            return redirect()->route('admin.users.index')->with(['success' => 'حدث خطا ما']);

    }
    
    public function update(AdminRequest $request,$id) {
        $user= Admin::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        if (!$request->password =="oldpassword"){
            $user->password =$user->password;   // the best place on model
            
        }else{
            $user->password= bcrypt($request->password);
            $request->password_confirmation= bcrypt($request->password);

        }






  


        // save the new user data
        if($user->save())
             return redirect()->route('admin.users.index')->with(['success' => 'تم التحديث بنجاح']);
        else
            return redirect()->route('admin.users.index')->with(['success' => 'حدث خطا ما']);

    }
}
