<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPost;
use App\User;
use App\Company;
class Users extends Controller
{
    public function __construct() {
        $this->middleware('Second');
    }
    public function showPath(Request $request) {
        $uri = $request->path();
        echo '<br>URI: '.$uri;
        
        $url = $request->url();
        echo '<br>';
        
        echo 'URL: '.$url;
        $method = $request->method();
        echo '<br>';
        
        echo 'Method: '.$method;
    }
    /**
     * Store the incoming blog post.
     *
     * @param  StoreBlogPost  $request
     * @return Response
     */  
    public function getUsers(){
        $data = User::all();
        return view('allUsers',['data' => $data]);
    }    

    public function form(){
        return view('addUser');
    }

    public function addUser(StoreBlogPost $req){
        $user = new User;
        $user->username = $req->username;
        $user->email = $req->email;
        $user->password = $req->password;
        $user->c_name = $req->c_name;
        if($user->save()){
            $req->session()->flash('msg', 'User successfully Added.');
        }
        else{
            $req->session()->flash('msg', 'There is some error in inserting data.');
        }
        return redirect('users/add-user');
        
    }

    public function deleteUser($id, Request $req){
        $user = new User;
        $req_user = $user->where('id', $id)->first();
        if(!$req_user){
            $req->session()->flash('msg', 'User not found.');
        }
        if($user->where('id', $id)->delete()){
            $req->session()->flash('msg', 'User has been deleted successfully.');
        }
        return redirect('users');
        
    }

    public function editUser($id, Request $req){
        $user = new User;
        $req_user = $user->where('id', $id)->first();
        if(!$req_user){
            $req->session()->flash('errorMsg', 'User not found.');
            return redirect('users');
        }
        return view('editUser')->with(compact('req_user'));
        
    }

    public function updateUser($id, StoreBlogPost $req){
        $user = User::find($id);
        $user->username = $req->username;
        $user->email = $req->email;
        $user->password = $req->password;
        $user->c_name = $req->c_name;
        if($user->save()){
            $req->session()->flash('msg', 'User updated successfully.');
        }
        else{
            $req->session()->flash('msg', 'There is some error in updating user.');
        }
        return redirect('users');
    }

    public function get_one_to_one_data(){
        $user = new Company;
        return Company::find(1)->myUser()->where('c_name', 'Geek')->get();
    }
    public function get_users_roles_data(){
        return User::find(1)->get_roles;
    }        
}
