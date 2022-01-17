<?php

namespace App\Http\Controllers;

use App\Models\BannedUser;
use App\Models\Country;
use App\Models\ReportedUser;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use stdClass;
use Illuminate\Support\Facades\Cache;
use App\Models\GlobalConfig;
use App\Models\VerifyPhoto;
use App\Models\UserPhoto;
use App\Models\User;
use App\Models\Withdraw;
use App\Models\Package;
use App\Models\Contact;
use App\Models\Message;
use App\Models\Gift;
use File;
use DB;
use DateTime;
class GiftController extends Controller
{
    public function index(Request $request)
    {
        $gifts = Gift::get();
        return view('admin.gift.index', [
            'page' => 'Gifts',
            'gifts' => $gifts,
        ]);
        
    }
    public function newGift(Request $request) 
    {
        return view('admin.gift.create', [
            'page' => 'Gifts',
        ]);
    }
    public function create(Request $request) 
    {
        $model = new Gift;
        $model['name'] = $request->name;
        $model['cost_minute'] = $request->cost_minute;
        $model['receive_minute'] = $request->receive_minute;
        if ( $request->image != 'undefined') {
            $file = $request->image;
            if ($file && $file->isValid()) {
                $request->validate([
                    'image' => 'required|mimes:jpeg,png|max:10240',
                ]);
    
                $image = $request->file('image');
                $model['image'] = Str::random(40).'.'.$image->guessClientExtension();
                $file->storeAs('public/images/gifts_emoji', $model['image']);
            }
        }
        if ($model->save()) {
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false]);
    }
    //return the edit page
    public function edit($id)
    {
        $model = Gift::find($id);

        return view('admin.gift.edit', [
            'page' => 'Gifts',
            'model' => $model,
        ]);
    }
    
    public function update(Request $request) {
        $is_has = Gift::where('id', $request->id)->first();
        if ($is_has) {
            if ( $request->image != 'undefined') {
                //delete origin file
                $is_photo = storage_path("app/public/images/gifts_emoji/{$is_has['image']}");
                if (File::exists($is_photo)) @unlink($is_photo);
                //create new file
                $file = $request->image;
                if ($file && $file->isValid()) {
                    $request->validate([
                        'image' => 'required|mimes:jpeg,png|max:10240',
                    ]);
        
                    $image = $request->file('image');
                    $model['image'] = Str::random(40).'.'.$image->guessClientExtension();
                    $file->storeAs('public/images/gifts_emoji', $model['image']);
                }
            }    
            $model['name'] = $request->name;
            $model['cost_minute'] = $request->cost_minute;
            $model['receive_minute'] = $request->receive_minute;
        }
            
        if (Gift::where('id', $request->id)->update($model)) {
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false]);
    }
    //return the edit page
    public function delete($id)
    {
        $model = Gift::find($id)->delete();
        
        return redirect('/gifts');
        
    }
}
