<?php

namespace App\Http\Controllers;

use App\Models\property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index(){
        $data=Auth::user();
        $propertyData=property::with('propertyAssets','propertyFeature')->get();
        // return $propertyData;
        return view('index',compact('data','propertyData'));
    }
    public function loadAboutPage(){
        return view('about');
    }
    public function loadPropertyPage(){
        return view('property');
    }
    public function loadBlogPage(){
        return view('blog');
    }
    public function loadContactPage(){
        return view('contact');
    }


    //

    public function userLogin(){
        return view('user.user_login');
    }
    public function checkLogin(Request $request){
        
        $request->validate([
            'logemail' => 'required|email',
            'logpassword' => 'required'
        ]);

        $user = User::where('email', $request->logemail)->first();
        // return $user;
        if ($user && Hash::check($request->logpassword, $user->password) && $user->role=='user') {

            Auth::login($user);  
            $request->session()->put('loggedUserData',[
                'id'=>$user->id,
                'name'=>$user->name,
                'email'=>$user->email
            ]);
            $flag = [
                'message' => 'Login Success',
                'alert-type' => 'success'
            ];
            return redirect()->route('user.profile')->with($flag);
        } else {
            $flag = [
                'message' => 'Invalid E-mail or Password',
                'alert-type' => 'error'
            ];
            return back()->with($flag);
        }
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        // Auth::logout();
        // Session::flush();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register(Request $request){
        $request->validate([
            'username'=>'required',
            'email'=>'email|required|unique:users',
            'password'=>'required'
        ]);

        $user=new User();
        $user->name=$request->username;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        $flag=array(
            'message'=>"Login Success",
            'alert-type'=>'success'
        );
        return redirect()->route('user.profile')->with($flag);
    }

    public function profile(){
        return view('user.user_profile');
    }
    public function loadLifestyle(){
        return view('pages.lifestyle');
    }
}
