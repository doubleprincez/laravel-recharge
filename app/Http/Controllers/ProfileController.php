<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('user.profile_show');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request)
    {
        if($request->has('83jffd03u')){
            $id = $request['83jffd03u'];
            $user = User::find(decrypt($id));
            if ($user = Auth::user()) {
                return view('user.profile', compact('user'));
            } else {
                return view('/welcome');
            }
        }else{
            return redirect()->back()->with('error','Try again');
        }

    }


    public function update(Request $request)

    {

        $name = filter_var(trim($request['name']),FILTER_SANITIZE_STRING);
        $email = filter_var(trim($request['email']),FILTER_SANITIZE_EMAIL);
//        $phone = filter_var(trim($request['phone']));
        $password = filter_var(trim($request['password']));
        $gender = filter_var(trim($request['gender']));

        $fileNameToStore = '';
        //Handle File upload
        //Request should check data from form to have image file
        if ($request->hasFile('image')) {
            // Get Filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload image
            $path = $request->file('image')->storeAs('public/img', $fileNameToStore);

        }

        $update_user = User::where('id', '=', auth()->id())->firstOrFail();
        if (!empty($name)) {
            $update_user->name = $name;
        }
        if (!empty($email)) {
            $update_user->email = $email;
        }
//        if (!empty($phone)) {
//            $update_user->mobile = (string)$phone;
//        }
        if (!empty($password)) {
            $update_user->password = $password;
        }
        if (!empty($gender)) {
            $update_user->gender = $gender;
        }

//        Add this to image profile update from account
        if ($request->hasFile('image')) {
            $update_user->avatar = 'storage/img/' . $fileNameToStore;
        }
        $update_user->save();

        return redirect('profile')->with([session('success')=>'Upload Successful']);
    }
}
