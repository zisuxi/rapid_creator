<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Design_Images;
use App\Models\Niche;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

ini_set('memory_limit', '-1');
ini_set('max_execution_time', '0');

class PagesController extends Controller
{
    public function signin()
    {
        if (session()->has('user_added')) {
            return redirect('/dashboard');
        } else {
            return view('Authentication.signin');
        }
    }
    public function forget()
    {
        return view('Authentication.forget');
    }
    public function reset()
    {
        return view('Authentication.reset');
    }
    public function dashboard()
    {
        $user = User::where("id", session()->get("user_added"))->first();
        $compact = compact("user");
        return view('Pages.dashboard')->with($compact);
    }
    public function profile()
    {
        $user = User::where("id", session()->get("user_added"))->first();
        $compact = compact("user");
        return view('Pages.profile')->with($compact);
    }
    public function editProfile()
    {
        return view('Pages.profile_edit');
    }
    public function updateProfile(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $message = "";
        if ($request->hasFile("picture")) {
            $image = $request->file('picture');
            $extension = $image->getClientOriginalExtension();
            $imageName = rand(10000, 90000) . "." . $extension;
            $image->move('./images/', $imageName);
            $message = 200;
        }
        if ($message == 200) {
            $picture = "./images/" . $imageName;
        } else {
            $picture = $user->picture;
        }
        User::where('id', $id)->update([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "contact_no" => $request->contact_no,
            "country" => $request->country,
            "state" => $request->state,
            "city" => $request->city,
            "picture" => $picture,
            "zip_code" => $request->zip_code,
            "address" => $request->address,
        ]);
        $afterUpdate = User::where('id', $id)->first();
        $data = [
            'name' => ucfirst($afterUpdate->first_name) . " " . ucfirst($afterUpdate->last_name),
            'email' => $afterUpdate->email,
            'address' => $afterUpdate->address,
            'picture' => $afterUpdate->picture,
        ];

        return response()->json([
            "message" => 200,
            "data" => $data,
        ]);
    }
    public function emailUpdate(Request $request, $id)
    {
        $request->validate([
            "email" => "unique:users,email,$id",
        ]);
        User::where('id', $id)->update([
            "email" => $request->email,
        ]);
        $afterEmailUpdate = User::where('id', $id)->first();
        $data = [
            'email' => $afterEmailUpdate->email,
        ];
        return response()->json([
            "message" => 200,
            "data" => $data,
        ]);
    }
    public function passwordUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ],
            [
                'password.confirmed' => 'Your Password is not Matched with the Confirm Password',
                'password.required'=>'Password Field is required',
                'password_confirmation.required'=>'Comfirmation Password is required within the Password',
            ]
        );
        User::where('id', $id)->update([
            "plain_password" => $request->password,
            "password" => bcrypt($request->password),
        ]);
        return response()->json([
            "message" => 200,
        ]);
    }
}
