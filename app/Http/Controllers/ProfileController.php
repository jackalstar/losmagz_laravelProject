<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use File;

use App\Models\UserPlan;
use App\Models\UserPhoto;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
     
    public function index()
    {
        $userPhoto = UserPhoto::where('user_id', Auth::id())->first();
        $avatar = UserPhoto::where('email', Auth::user()->email)->first();
        return view('profile.profile', [
            'page' => 'Profile',
            'userPhoto' => $userPhoto->avatar_name,
            'avatar' => $avatar,
        ]);
    } 
    public function manTransaction()
    {
        $userPlan = UserPlan::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('profile.transaction', [
            'page' => 'Transaction',
            'userPlan' => $userPlan,
        ]);
    }
    public function womenWithdraw()
    {
        $userWithdraw = Withdraw::where('email', Auth::user()->email)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile.withdraw', [
            'page' => 'Withdraw',
            'userWithdraw' => $userWithdraw
        ]);
    }
    public function getProfileInfo(Request $request)
    {
        $profile_info = User::where('id', Auth::id())->first();
        if ($profile_info)
        {
            return json_encode(['success' => true, 'data' => $profile_info]);
        }
        return json_encode(['success' => false]);
    }
    
    public function updateUsername(Request $request)
    {
        $userinfo['username'] = $request->username;
        if (User::where('id', Auth::id())->update($userinfo))
        {
            return json_encode(['success' => true, 'data' => $request->username]);    
        }
        return json_encode(['success' => false]);
    }
    public function uploadAvatar(Request $request)
    {
        $userphoto = UserPhoto::where('user_id', Auth::user()->id)->first();
        
        if ($request->myimage != 'undefined'){
            if ($userphoto['avatar_name'] != "stranger.jpg")
            {
                $is_photo = storage_path("app/public/images/user_photos/{$userphoto['avatar_name']}");
                if (File::exists($is_photo)) @unlink($is_photo);    
            }
            
            
            $file = $request->myimage;
            if ($file && $file->isValid()) {
                $request->validate([
                    'myimage' => 'required|mimes:jpeg,png|max:10240',
                ]);
    
                $image = $request->file('myimage');
                $data['avatar_name'] = Str::random(40).'.'.$image->guessClientExtension();
                $file->storeAs('public/images/user_photos', $data['avatar_name']);
                if (UserPhoto::where('user_id', Auth::id())->update($data)) {
                    return json_encode(['success' => true]);
                }    
            }
        }
        return json_encode(['success' => false]);
    }
    public function takeProfilePhoto(Request $request){
        $userphoto = UserPhoto::where('user_id', Auth::user()->id)->first();
        if ($request->myimage != 'undefined'){
            
            $is_photo = storage_path("app/public/images/user_photos/{$userphoto['avatar_name']}");
            if (File::exists($is_photo)) @unlink($is_photo);
            
            $file = $request->image;
            if ($file && $file->isValid()) {
                $data['avatar_name'] = Str::random(10) . '_' . Carbon::now()->timestamp . '.jpg';
                $file->storeAs('public/images/user_photos', $data['avatar_name']);
                if (UserPhoto::where('user_id', Auth::id())->update($data)) {
                    $user_avatar = UserPhoto::where('user_id', Auth::user()->id)->first();
                    return json_encode(['success' => true, 'user_avatar' => $user_avatar]);
                }
            }
        }
        return json_encode(['success' => false]);
    }
}
