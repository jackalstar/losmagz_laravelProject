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
use App\Models\CapturePhoto;
use App\Models\CaptureVideo;
use File;
use DB;
use DateTime;
class MonitoringController extends Controller
{
    public function index(Request $request)
    {
        $messages = Message::where('type', 'photo')
                           ->orWhere('type', 'video')->get();
        $data_arr = array();
                foreach ($messages as $val){
                    array_push($data_arr, array(
                        'id' => $val->id,
                        'from_id' => $this->getUserId($val->from_email),
                        'from_email' => $this->getUsername($val->from_email),
                        'to_id' => $this->getUserId($val->to_email),
                        'to_email' => $this->getUsername($val->to_email),
                        'type' => $val->type,
                        'm_content' => $this->getContent($val->type, $val->message_source),
                        'read_state' => $val->read_state,
                        'clear_by' => $val->clear_by == 'yes' ? 'no' : $this->getUsername($val->clear_by),
                        'created_at' => $val->created_at,
                    ));    
                }
        return view('admin.monitoring.index', [
                    'page' => 'Monitoring',
                    'data_arr' => $data_arr,
                ]);
    }
    public function getUsername($email){
        $user = User::where('email', $email)->first();
        if($user) {
            return $user->username;
        }
        else 
            {
                return 'none';
            }
    }
    public function getUserId($email){
        $user = User::where('email', $email)->first();
        if($user) {
            return $user->id;
        }
        else 
            {
                return 'none';
            }
    }
    public function getContent($type, $m_content) {
        
        if ($type == 'photo') {
            $captured_photo = CapturePhoto::where('id', $m_content)->first(); 
            return $captured_photo->image;
        }
        else if($type == 'video') {
            $captured_video = CaptureVideo::where('id', $m_content)->first(); 
            return $captured_video->video;
        }
        
    }
    public function photovideoMessageDelete(Request $request) {
        
        $message = Message::where('id', $request->id)->first();
        if ($message->type == 'video') {
            $video = CaptureVideo::where('id', $message->message_source)->first();
            $is_file = storage_path("app/public/images/captured_video/{$video['video']}");
            if (File::exists($is_file))
            {
                @unlink($is_file);
                CaptureVideo::where('id', $message->message_source)->delete();
                return json_encode(['success' => true]);    
            }   
        }
        else if ($message->type == 'photo') {
            $photo = CapturePhoto::where('id', $message->message_source)->first();
            $is_file = storage_path("app/public/images/captured_photo/{$photo['image']}");
            if (File::exists($is_file))
            {
                @unlink($is_file);
                CapturePhoto::where('id', $message->message_source)->delete();
                return json_encode(['success' => true]);    
            }  
        }
        return json_encode(['success' => false]);  
    }
    
}