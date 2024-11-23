<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\ServiceInterfaces\AdminInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller {
    protected $admin;

    public function __construct(AdminInterface $admin) {
        $this->admin = $admin;
    }

    public function adminLogin() {
        return view('admin.admin_login');
    }

    public function adminDashboard() {
        $adminData=Auth::user();
        // return $adminData;
        return view('admin.admin_dashboard', compact('adminData'));
    }
    
   

public function checkLogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    $user = User::where('email', $request->email)->first();
    if ($user && Hash::check($request->password, $user->password)) {
        
        Auth::login($user);  
        $flag = [
            'message' => 'Login Success',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.dashboard')->with($flag);
    } else {
        $flag = [
            'message' => 'Invalid E-mail or Password',
            'alert-type' => 'error'
        ];
        return back()->with($flag);
    }
}

public function adminProfile(){
    $adminData=Auth::user();
    return view('admin.admin_profile',compact('adminData'));
}


public function adminUpdate(Request $request){
    $admin=Auth::user();
    $admin->name=$request->name;
    $admin->email=$request->email;
    $admin->phone=$request->phone;
    $admin->address=$request->address;
    if($request->hasFile('photo')){
        if($admin->photo !==null){
            unlink(public_path('uploads/admin_images/'. $admin->photo));
        }
        $file=$request->file('photo');
        $filename=time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/admin_images/'), $filename);
        $admin->photo=$filename;
    }
    $flag=array();
        if($admin->save()){
            $flag=array(
                'message'=>"Profile Update Successfully",
                'alert-type'=>'success'
            );
            return redirect()->back()->with($flag);
        }else{
            $flag=array(
                'message'=>"Failed to Update Profile",
                'alert-type'=>'error'
            );
            return redirect()->back()->with($flag);
        }
    // 
}


public function loadAllAdmin(){
    $data['adminData']=Auth::user();
    $data['allAdmin']=User::where('role','admin')->get();
    return view('admin.all_admin', $data);
}

public function addAdmin(){
    $adminData=Auth::user();
    return view('admin.pages.add_admin', compact('adminData'));
}

public function storeAdmin(Request $request)
{
    
    $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users|email',
        'password' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'status'=>'required'
    ]);
   
    $admin=new User();
    $admin->name=$request->name;
    $admin->email=$request->email;
    $admin->password=Hash::make($request->password);
    $admin->phone=$request->phone;
    $admin->address=$request->address;
    $admin->role='admin';
    if($request->hasFile('photo')){
        $imageFile=$request->file('photo');
        $image= time() . "." . $imageFile->getClientOriginalExtension();
        $imageFile->move(public_path('uploads/admin_images/'), $image);
        $admin->photo=$image;
    }
    if($request->hasFile('cv')){
        $cvFile=$request->file('cv');
        $cv= time() . "." . $cvFile->getClientOriginalExtension();
        $cvFile->move(public_path('uploads/admin_images/'), $cv);
        $admin->cv=$cv;
    }

    if($admin->save()){
        return redirect()->back()->with([
            'message'=>"Admin Added Successfully",
            'alert-type'=>'success'
        ]);
    }else{
        return redirect()->back()->with([
            'message'=>"Failed to Add Admin",
            'alert-type'=>'error'
        ]); 
    }
}

public function show($id)
{
    $admin = User::findOrFail($id); 
    return response()->json($admin);
}

public function update($id){
    $data=User::find($id);
    $adminData=Auth::user();
    return view('admin.pages.update_admin', compact('data','adminData'));
}

public function storeUpdate(Request $request,$id){
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'email' => 'required|email|unique:users,email,' . $request->id,
        'phone' => 'required',
        'address' => 'required',
    ]);
       
    $admin=User::find($request->id);   
    $admin->name=$request->name;
    $admin->email=$request->email;
    $admin->phone=$request->phone;
    $admin->address=$request->address;
    $admin->status=$request->status;
    if($request->hasFile('photo')){
        $imageFile=$request->file('photo');
        $image= time() . "." . $imageFile->getClientOriginalExtension();
        if($admin->photo !==null){
            unlink(public_path('uploads/admin_images/'. $admin->photo));
        }
        $imageFile->move(public_path('uploads/admin_images/'), $image);
        $admin->photo=$image;
    }
    if($request->hasFile('cv')){
        $cvFile=$request->file('cv');
        $cv= time() . "." . $cvFile->getClientOriginalExtension();
        if($admin->cv !==null){
            unlink(public_path('uploads/admin_pdf/'. $admin->cv));
        }
        $cvFile->move(public_path('uploads/admin_pdf/'), $cv);
        $admin->cv=$cv;
    }

    if($admin->save()){
        return redirect()->route('admin.allAdmin')->with([
            'message'=>"Admin Added Successfully",
            'alert-type'=>'success'
        ]);
    }else{
        return redirect()->back()->with([
            'message'=>"Failed to Add Admin",
            'alert-type'=>'error'
        ]); 
    }
}


public function alUsers(){
    // dd(route('admin.viewusers'));
    // return "View User Page";
    $data['adminData'] = Auth::user();
    $data['allUsers'] = User::where('role', 'user')->get();
    return view('admin.view_users', $data);

}


public function adminLogout(Request $request): RedirectResponse
{
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/admin/login');
}

    
}
