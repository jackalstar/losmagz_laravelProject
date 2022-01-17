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
use App\Models\GiveLike;
use App\Models\Emoji;
use App\Models\CapturePhoto;
use App\Models\RecordVideo;

use File;
use DB;
use DateTime;

class RecordController extends Controller
{
    public function recordVideoSave(Request $request){
        
        $storydelete = GlobalConfig::where('key', 'STORYDELETE')->first()->value;
        $is_record_video = RecordVideo::where('self_email', Auth::user()->email)->first();
        if ($is_record_video)
        {
            $file = $request->video;
            if ($file && $file->isValid())
            {
                $video = $request->file('video');
                $data['video'] = Str::random(40).'.'.$video->guessClientExtension();
                $data['title'] = $request->title;
                $data['vlength'] = $request->vlength;
                $data['timer'] = 86400;
                $data['recommend'] = 0;
                $is_file = storage_path("app/public/images/record_video/{$is_record_video['video']}");
                if (File::exists($is_file)) @unlink($is_file);
                $file->storeAs('public/images/record_video', $data['video']);    
                if (RecordVideo::where('self_email', Auth::user()->email)->update($data))
                {
                    GiveLike::where('woman_email', Auth::user()->email)->delete();
                    $video_data = RecordVideo::where('self_email', Auth::user()->email)->first();
                    return json_encode(['success' => true, 'video_data' => $video_data, 'storydelete' => $storydelete]);    
                }
            }
        }
        else {
            $record_video = new RecordVideo();
            $file = $request->video;
            if ($file && $file->isValid())
            {
                $video = $request->file('video');
                $record_video['video'] = Str::random(40).'.'.$video->guessClientExtension();
                $record_video['title'] = $request->title;
                $record_video['vlength'] = $request->vlength;
                $record_video['self_email'] = Auth::user()->email;
                $record_video['self_username'] = Auth::user()->username;
                $file->storeAs('public/images/record_video', $record_video['video']);
                if ($record_video->save())
                {
                    $video_data = RecordVideo::where('self_email', Auth::user()->email)->first();
                    return json_encode(['success' => true, 'video_data' => $video_data, 'storydelete' => $storydelete]);    
                }
            }    
        }
        return json_encode(['success' => false]);
    }
    public function getRecordVideo(Request $request){
        $storydelete = GlobalConfig::where('key', 'STORYDELETE')->first()->value;
        
        $record_video = RecordVideo::where('self_email', Auth::user()->email)->first();
        if ($record_video)
        {
            return json_encode(['success' => true, 'record_video' => $record_video, 'storydelete' => $storydelete]);    
        }
        return json_encode(['success' => false]);
    }
    public function recordVideoDelete(Request $request){
        
        $record = RecordVideo::where('self_email', Auth::user()->email)->first();
        
        $is_file = storage_path("app/public/images/record_video/{$record['video']}");
        if (File::exists($is_file))
        {
            @unlink($is_file);
            RecordVideo::where('self_email', Auth::user()->email)->delete(); 
            GiveLike::where('woman_email', Auth::user()->email)->delete();
            return json_encode(['success' => true]);    
        }
        return json_encode(['success' => false]);    
        
    }
    public function getVideoStories(Request $request) {
        
        $record_video = RecordVideo::get();
        if ($record_video) {
            $data_arr = array();
            foreach ($record_video as $val){
                array_push($data_arr, array(
                    'id' => $val->id,
                    'title' => $val->title,
                    'video' => $val->video,
                    'username' => $val->self_username,
                    'self_email' => $val->self_email,
                    'user_avatar' => UserPhoto::where('email', $val->self_email)->first()->avatar_name,
                    'vlength' => $val->vlength,
                    'allow_state' => $val->allow_state,
                    'created_at' => $val->created_at,
                    'is_givelike' => GiveLike::where([ ['man_email', '=', Auth::user()->email], ['woman_email', '=', $val->self_email] ])->first(),
                    'is_add_friend' => $this->checkAddFriend(Auth::user()->email, $val->self_email),
                ));
            }    
            return json_encode(['success' => true, 'record_video' => $data_arr, 'self_email' => Auth::user()->email]);    
        }
        return json_encode(['success' => false]);    
    }
    public function checkAddFriend($self_email, $partner_email) {
        $contact = Contact::where([['self_email', '=', $self_email], ['partner_email', '=', $partner_email], ['state', '!=', 'disagree']])
                ->orWhere([['self_email', '=', $partner_email], ['partner_email', '=', $self_email], ['state', '!=', 'disagree']])
                ->get();
        return count($contact);
    }
    public function giveLike (Request $request){
        $cost_like = GlobalConfig::where('key', 'COSTLIKE')->first()->value;
        $origin_point1 = User::where('email', Auth::user()->email)->first()->points;
        $origin_point2 = User::where('email', $request->email)->first()->points;
        if ($cost_like <= $origin_point1 ) {
            $reduce_point = $origin_point1 - $cost_like;
            $increase_point = $origin_point2 + $cost_like;
            User::where('email', Auth::user()->email)->update(['points' => $reduce_point]);
            User::where('email', $request->email)->update(['points' => $increase_point]);
            
            if (!GiveLike::where([ ['man_email', '=', Auth::user()->email], ['woman_email', '=', $request->email] ])->first())
            {
                $model = new GiveLike();
                $model['man_email'] = Auth::user()->email;
                $model['woman_email'] = $request->email;
                if ($model->save()){
                    $origin_recommend = RecordVideo::where('self_email', $request->email)->first()->recommend;
                    $origin_recommend = $origin_recommend + 1;
                    RecordVideo::where('self_email', $request->email)->update(['recommend' => $origin_recommend]);
                    return json_encode(['success' => true]);     
                }
                    
            }
        }
        return json_encode(['success' => false]);
    }
    public function setTimeSynchronize(Request $request) {
        
        
        if ($record_video = RecordVideo::where('self_email', Auth::user()->email)->update(['timer' => $request->timer]))
        {
            return json_encode(['success' => true, 'record_video' => $record_video]);    
        }
        return json_encode(['success' => false]);
    }
    //from this is for admin panel
    public function index(Request $request){
        $recordvideo = RecordVideo::get();
        $heart_value = GlobalConfig::where('key', 'COSTLIKE')->first()->value;
        $destroy_value = GlobalConfig::where('key', 'STORYDELETE')->first()->value;
        $data_arr = array();
        foreach ($recordvideo as $val){
            array_push($data_arr, array(
                'id' => $val->id,
                'title' => $val->title,
                'video' => $val->video,
                'username' => $val->self_username,
                'self_email' => $val->self_email,
                'user_avatar' => UserPhoto::where('email', $val->self_email)->first()->avatar_name,
                'vlength' => $val->vlength,
                'allow_state' => $val->allow_state,
                'created_at' => $val->created_at,
            ));
        }
        
        return view('admin.record-video.index', [
                    'page' => 'Record Video',
                    'data_arr' => $data_arr,
                    'heart_value' => $heart_value,
                    'destroy_value' => $destroy_value,
                ]);
    }
    
    public function recordVideoSetUpdate(Request $request) {
        $data['value'] = $request->heart_value;
        $data1['value'] = $request->destroy_value;
        if (GlobalConfig::where('key', 'COSTLIKE')->update($data) && GlobalConfig::where('key', 'STORYDELETE')->update($data1)) {
            return json_encode(['success' => true ]);    
        }
        return json_encode(['success' => false ]);
    }
    public function recordOneDelete(Request $request){
        
        $record = RecordVideo::where('id', $request->id)->first();
        
        $is_file = storage_path("app/public/images/record_video/{$record['video']}");
        if (File::exists($is_file))
        {
            @unlink($is_file);
            RecordVideo::where('id', $request->id)->delete(); 
            GiveLike::where('woman_email', $request->email)->delete();
            return json_encode(['success' => true]);    
        }
        return json_encode(['success' => false]);    
        
    }   
}