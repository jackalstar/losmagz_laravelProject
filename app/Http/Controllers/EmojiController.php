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
use App\Models\Emoji;
use File;
use DB;
use DateTime;
class EmojiController extends Controller
{
    public function index(Request $request)
    {
        $emoji = Emoji::get();
        return view('admin.emoji.index', [
            'page' => 'Emoji',
            'emoji' => $emoji,
        ]);
        
    }
    public function newEmoji(Request $request) 
    {
        return view('admin.emoji.create', [
            'page' => 'Emoji',
        ]);
    }
    //return the edit page
    public function edit($id)
    {
        $model = Emoji::find($id);

        return view('admin.emoji.edit', [
            'page' => 'Emoji',
            'model' => $model,
        ]);
    }
    public function create(Request $request) 
    {
        $model = new Emoji;
        $model['name'] = $request->name;
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
    public function update(Request $request) {
        $is_has = Emoji::where('id', $request->id)->first();
        if ($is_has) {
            if ( $request->image != 'undefined') {
            
                $is_photo = storage_path("app/public/images/gifts_emoji/{$is_has['image']}");
                if (File::exists($is_photo)) @unlink($is_photo);
                
                $file = $request->image;
                if ($file && $file->isValid()) {
                    $request->validate([
                        'image' => 'required|mimes:jpeg,png|max:10240',
                    ]);
        
                    $image = $request->file('image');
                    $model['image'] = Str::random(40).'.'.$image->guessClientExtension();
                    $file->storeAs('public/images/gifts_emoji', $model['image']);
                    
                    $model['name'] = $request->name;
                }
            }    
        }
            
        if (Emoji::where('id', $request->id)->update($model)) {
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false]);
    }
    
    //return the edit page
    public function delete($id)
    {
        $model = Emoji::find($id)->delete();
        
        return redirect('/emoji');
        
    }
    
    
}
