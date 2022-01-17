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

class TextController extends Controller
{
    /**
     * show the home page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
        return view('messanger', [
                'page' => 'Messanger',
            ]);
    }
    public function getMessage(Request $request){
        
        $messages = Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['clear_by', '!=', $request->self_email]])
                        ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['clear_by', '!=', $request->self_email]])
                        ->get();
        $partner_avatar = DB::table('user_photos as up')->join('users as u', 'up.user_id', '=', 'u.id')
                                            ->select('up.avatar_name')
                                            ->where('u.email', '=', $request->partner_email)
                                            ->first();
        $contact = Contact::where([['self_email', $request->self_email], ['partner_email', $request->partner_email] ])->first();       
        
        $partner_contact = Contact::where([['self_email', $request->partner_email], ['partner_email', $request->self_email] ])->first(); 
        if ($partner_contact) {
            
        }
        if ($contact == null) {
            $contact = Contact::where([['self_email', $request->partner_email], ['partner_email', $request->self_email] ])->first();  
        }
        $data_arr = array();
        
        foreach ($messages as $val){
            if ($val->type == 'emoji') {
                $message_source = Emoji::where('id', $val->message_source)->first()->image;
                $name = Emoji::where('id', $val->message_source)->first()->name;
                $cost_minute = '';
            }
            else if ($val->type == 'gift') {
                $message_source = Gift::where('id', $val->message_source)->first()->image;
                $name = Gift::where('id', $val->message_source)->first()->name;
                $cost_minute = Gift::where('id', $val->message_source)->first()->cost_minute;
            }
            else if ($val->type == 'photo') {
                $message_source = CapturePhoto::where('id', $val->message_source)->first()->image;
                $name = CapturePhoto::where('id', $val->message_source)->first()->id;
                $cost_minute = '';
            }
            else if ($val->type == 'video') {
                $message_source = CaptureVideo::where('id', $val->message_source)->first()->video;
                $name = CaptureVideo::where('id', $val->message_source)->first()->id;
                $cost_minute = '';
            }
            else {
                $message_source = $val->message_source;
                $message_trans = $val->message_trans;
                $name = '';
                $cost_minute = '';
            }
            array_push($data_arr, array(
                'from_email' => $val->from_email,
                'to_email' => $val->to_email,
                'message_source' => $message_source,
                'message_trans' => $message_trans,
                'name' => $name,
                'cost_minute' => $cost_minute,
                'type' => $val->type,
                'read_state' => $val->read_state,
                'clear_by' => $val->clear_by,
                'created_at' => $val->created_at,
                'updated_at' => $val->updated_at,
            )); 
        }
        $gifts = Gift::get();
        $gender = Auth::user()->gender;
        if ($partner_avatar)
        {
            return json_encode(['success' => true,  'messages' => $data_arr, 'partner_avatar' => $partner_avatar->avatar_name, 'favourite' => $contact['favourite'], 'block' => $contact['block'], 'gifts' => $gifts, 'gender' => $gender ]);    
        }
        return json_encode(['success' => false]);
    }
    
    public function readMessage(Request $request) {
        $data['read_state'] = 'yes';
        if (Message::where([['from_email', '=', $request->partner_email ], ['to_email', '=', $request->self_email], ['read_state', '=', 'no'] ])->update($data))
            return json_encode(['success' => true]);
        return json_encode(['success' => false]);
    }
    public function clearChatHistory(Request $request)
    {
        $clear_by['clear_by'] = $request->self_email;
        //already if partner clear these message, then delete these message
        Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['type', '=', 'text'], ['clear_by', '=', $request->partner_email]])
                     ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['type', '=', 'text'], ['clear_by', '=', $request->partner_email]])
                  ->delete();
        Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['type', '=', 'emoji'], ['clear_by', '=', $request->partner_email]])
                     ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['type', '=', 'emoji'], ['clear_by', '=', $request->partner_email]])
                  ->delete();  
        Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['type', '=', 'gift'], ['clear_by', '=', $request->partner_email]])
                     ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['type', '=', 'gift'], ['clear_by', '=', $request->partner_email]])
                  ->delete();
        // $send_req = DB::table('contacts as c')->join('user_photos as up', 'c.partner_email', '=', 'up.email')
        //                                     ->select('c.*', 'up.avatar_name')
        //                                     ->where([  ['c.self_email', '=', Auth::user()->email]  ])
        //                                     ->get();
        $photo = DB::table('messages as m')->join('captured_photo as cp', 'm.message_source', '=', 'cp.id')
                     ->where([ ['m.from_email', '=', $request->self_email], ['m.to_email', '=', $request->partner_email], ['m.type', '=', 'photo'], ['m.clear_by', '=', $request->partner_email]])
                     ->orWhere([ ['m.from_email', '=', $request->partner_email], ['m.to_email', '=', $request->self_email], ['m.type', '=', 'photo'], ['m.clear_by', '=', $request->partner_email]])
                     ->select('cp.image', 'm.id', 'm.message_source')
                     ->get();    
        if ($photo)
        {
            foreach ($photo as $value) {
                if ($value->image != 'undefined') {
                    $is_photo = storage_path("app/public/images/captured_photo/$value->image");
                    if (File::exists($is_photo)) @unlink($is_photo);
                    CapturePhoto::where('id',  $value->message_source)->delete();
                    Message::where('id', $value->id)->delete();
                }
            }
        }
        $video = DB::table('messages as m')->join('captured_video as cv', 'm.message_source', '=', 'cv.id')
                     ->where([ ['m.from_email', '=', $request->self_email], ['m.to_email', '=', $request->partner_email], ['m.type', '=', 'video'], ['m.clear_by', '=', $request->partner_email]])
                     ->orWhere([ ['m.from_email', '=', $request->partner_email], ['m.to_email', '=', $request->self_email], ['m.type', '=', 'video'], ['m.clear_by', '=', $request->partner_email]])
                     ->select('cv.video', 'm.id', 'm.message_source')
                     ->get();    
        if ($video)
        {
            foreach ($video as $value) {
                if ($value->video != 'undefined') {
                    $is_video = storage_path("app/public/images/captured_video/$value->video");
                    if (File::exists($is_video)) @unlink($is_video);
                    CaptureVideo::where('id',  $value->message_source)->delete();
                    Message::where('id', $value->id)->delete();
                }
            }
        }             
        //if partner didn't delete these message
        Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['type', '=', 'text'], ['clear_by', '=', 'yes'],])
                     ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['type', '=', 'text'], ['clear_by', '=', 'yes'],])
                  ->update($clear_by);
        Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['type', '=', 'emoji'], ['clear_by', '=', 'yes'],])
                     ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['type', '=', 'emoji'], ['clear_by', '=', 'yes'],])
                  ->update($clear_by);
        Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['type', '=', 'gift'], ['clear_by', '=', 'yes'],])
                     ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['type', '=', 'gift'], ['clear_by', '=', 'yes'],])
                  ->update($clear_by);          
        Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['type', '=', 'photo'], ['clear_by', '=', 'yes'],])
                     ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['type', '=', 'photo'], ['clear_by', '=', 'yes'],])
                  ->update($clear_by);      
        Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['type', '=', 'video'], ['clear_by', '=', 'yes'],])
                     ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['type', '=', 'video'], ['clear_by', '=', 'yes'],])
                  ->update($clear_by);      
        return json_encode(['success' => true]);
    }
    public function deletePartner(Request $request){
        
        $clear_by['clear_by'] = $request->self_email;
        //already if partner clear your contact, then delete these contact and message
        Contact::where([['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email], ['clear_by', '=', $request->partner_email] ])
                ->orWhere([['self_email', '=', $request->partner_email], ['partner_email', '=', $request->self_email], ['clear_by', '=', $request->partner_email] ])
                ->delete();
            //specially if partner is already declined your request, in this case there is no message. only declined contact.
            $disagreed_contact = Contact::where([['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email], ['state', '=', 'disagree']])->first();
            if ($disagreed_contact) {
                Contact::where([['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email], ['state', '=', 'disagree']])->delete();
                Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email] ])
                        ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email] ])
                        ->delete();    
                return json_encode(['success' => true]);
            }
        Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['clear_by', '=', $request->partner_email]])
                     ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['clear_by', '=', $request->partner_email]])
                  ->delete();
        $photo = DB::table('messages as m')->join('captured_photo as cp', 'm.message_source', '=', 'cp.id')
                     ->where([ ['m.from_email', '=', $request->self_email], ['m.to_email', '=', $request->partner_email], ['m.type', '=', 'photo'], ['m.clear_by', '=', $request->partner_email]])
                     ->orWhere([ ['m.from_email', '=', $request->partner_email], ['m.to_email', '=', $request->self_email], ['m.type', '=', 'photo'], ['m.clear_by', '=', $request->partner_email]])
                     ->select('cp.image', 'm.id', 'm.message_source')
                     ->get();    
        if ($photo)
        {
            foreach ($photo as $value) {
                if ($value->image != 'undefined') {
                    $is_photo = storage_path("app/public/images/captured_photo/$value->image");
                    if (File::exists($is_photo)) @unlink($is_photo);
                    CapturePhoto::where('id',  $value->message_source)->delete();
                    Message::where('id', $value->id)->delete();
                }
            }
        }
        $video = DB::table('messages as m')->join('captured_video as cv', 'm.message_source', '=', 'cv.id')
                     ->where([ ['m.from_email', '=', $request->self_email], ['m.to_email', '=', $request->partner_email], ['m.type', '=', 'video'], ['m.clear_by', '=', $request->partner_email]])
                     ->orWhere([ ['m.from_email', '=', $request->partner_email], ['m.to_email', '=', $request->self_email], ['m.type', '=', 'video'], ['m.clear_by', '=', $request->partner_email]])
                     ->select('cv.video', 'm.id', 'm.message_source')
                     ->get();    
        if ($video)
        {
            foreach ($video as $value) {
                if ($value->video != 'undefined') {
                    $is_video = storage_path("app/public/images/captured_video/$value->video");
                    if (File::exists($is_video)) @unlink($is_video);
                    CaptureVideo::where('id',  $value->message_source)->delete();
                    Message::where('id', $value->id)->delete();
                }
            }
        }   
        //if partner didn't delete your contact
        Contact::where([['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email], ['clear_by', '=', 'yes' ] ])
                ->orWhere([['self_email', '=', $request->partner_email], ['partner_email', '=', $request->self_email], ['clear_by', '=', 'yes' ] ])
                ->update($clear_by);
        Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email], ['clear_by', '=', 'yes'],])
                     ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email], ['clear_by', '=', 'yes'],])
                  ->update($clear_by);
        return json_encode(['success' => true]);
    }
    public function reportPartner(Request $request)
    {
        //return json_encode($request->self_email);
        //$file = $request->image;
        $ip = $request->ip();

        //if ($file && $file->isValid()) {
            $reportedUser = ReportedUser::where('ip', $ip)->first();
            //$fileName = Str::random(4) . '_' . Carbon::now()->timestamp . '.jpg';

            if ($reportedUser) {
                //$reportedUser->images = $this->addImage($reportedUser->images, $fileName);
                //$reportedUser->save();
                return json_encode(['success' => true]);
            } else {
                //$newArray = [];
                //array_push($newArray, $fileName);

                $model = new ReportedUser();
                $model->ip = $ip;
                $model->images = 'this is text report';
                //$model->images = json_encode($newArray);
                $model->save();
            }

            //$file->storeAs('public/images/reported-users', $fileName);

            return json_encode(['success' => true]);
        //}
    }
    public function getEmoji(Request $request)
    {
        $emoji = Emoji::find($request->message);
        if ($emoji) 
        {
            return json_encode(['success' => true, 'emoji' => $emoji]);    
        }
        return json_encode(['success' => false]);    
    }
    public function getGift(Request $request)
    {
        
        $gift = Gift::find($request->message);
        if ($gift && User::where('email', $request->self_email)->first()->gender == 'man') 
        {
            $mans_points = User::where('email', $request->self_email)->first()->points;
            $mans_points1 = $mans_points - $gift->cost_minute * 60;
            
            $model1['points'] = $mans_points1;
            User::where('email', $request->self_email)->update($model1);
            
            $woman_points = User::where('email', $request->partner_email)->first()->points;
            $woman_points1 = $woman_points + $gift->receive_minute * 60;
            $model2['points'] = $woman_points1;
            User::where('email', $request->partner_email)->update($model2);
            
            return json_encode(['success' => true, 'gift' => $gift]);    
        }
        else if($gift && User::where('email', $request->self_email)->first()->gender == 'woman')
        {
            return json_encode(['success' => true, 'gift' => $gift]);    
        }
        return json_encode(['success' => false]);    
    }
    
    public function takePhoto(Request $request){
        $model = new CapturePhoto();
        $file = $request->image;
        if ($file && $file->isValid()) {
            $fileName = Str::random(4) . '_' . Carbon::now()->timestamp . '.jpg';
            $model->image = $fileName;
            $file->storeAs('public/images/captured_photo', $fileName);
        }
        if ($model->save())
        {
            $preview = CapturePhoto::where('image', $fileName)->first();
            return json_encode(['success' => true, 'preview' => $preview]);    
        }
        return json_encode(['success' => false]);
    }
    
    public function sendPhoto(Request $request){
        
        $captured_photo = CapturePhoto::find($request->photo_id);
        if ($captured_photo) {
            return json_encode(['success' => true, 'captured_photo' => $captured_photo]);  
        }
        return json_encode(['success' => false]);
    }
    public function checkManMinute(Request $request){
        $gift = Gift::find($request->message);
        if ($gift->cost_minute * 60 <= (User::where('email', $request->self_email)->first()->points)) {
            return json_encode(['success' => true]);  
        }
        return json_encode(['success' => false]);
    }
    public function viewPhoto(Request $request) {
        $photo = CapturePhoto::find($request->id);
        if ($photo) {
            return json_encode(['success' => true, 'photo' => $photo]);
        }
        return json_encode(['success' => false]);
    }
    public function takePhotoAnother(Request $request) {
        
        $photo = CapturePhoto::find($request->photo_id);
        
        if ($photo)
        {
            if ($photo->image != 'undefined') {
                $is_photo = storage_path("app/public/images/captured_photo/$photo->image");
                if (File::exists($is_photo)) @unlink($is_photo);
                CapturePhoto::where('id',  $photo->id)->delete();
                return json_encode(['success' => true]);
            }
        }  
        return json_encode(['success' => false]);
    }
    
    public function uploadPhoto(Request $request) 
    {
        $capture = new CapturePhoto();
        $file = $request->uploadimage;
        if ($file && $file->isValid()) {
            $request->validate([
                'uploadimage' => 'required|mimes:jpeg,png|max:10240',
            ]);

            $image = $request->file('uploadimage');
            $capture['image'] = Str::random(40).'.'.$image->guessClientExtension();
            $file->storeAs('public/images/captured_photo', $capture['image']);
            if ($capture->save()) {
                $photo = CapturePhoto::where('image', $capture['image'])->first();
                return json_encode(['success' => true, 'photo' => $photo]);       
            }    
        }
        return json_encode(['success' => false]);
    }
    public function takeVideoSave(Request $request)
    {
        $captured_video = new CaptureVideo();
        
        $file = $request->video;
        if ($file && $file->isValid())
        {
            $video = $request->file('video');
            $captured_video['video'] = Str::random(40).'.'.$video->guessClientExtension();
            $file->storeAs('public/images/captured_video', $captured_video['video']);
            if ($captured_video->save())
            {
                $video_data = CaptureVideo::where('video', $captured_video['video'])->first();
                return json_encode(['success' => true, 'video_data' => $video_data]);    
            }
        }
        return json_encode(['success' => false]);
    }
    public function getContacts(Request $request) 
    {
        $filtered_contacsts = $this->filterContacts($request->filter_key);
        return json_encode(['success' => true, 'data_arr' => $filtered_contacsts]);        
    }
    
    public function unreadOrRecentContacts(Request $request) 
    {
        $filtered_contacsts = $this->filterContacts($request->filter_key);
        if (count($filtered_contacsts) == 0) 
        {
            $filtered_contacsts = $this->filterContacts('all');
        }
        return json_encode(['success' => true, 'data_arr' => $filtered_contacsts]);        
    }
    
    public function filterContacts($filter_key) 
    { 
        if ($filter_key == 'all' || $filter_key == 'online' || $filter_key == 'unread') {
            
            $send_req = DB::table('contacts as c')->join('user_photos as up', 'up.email', '=', 'c.partner_email')
                                                ->select('c.*', 'up.avatar_name')
                                                ->where([  ['c.self_email', '=', Auth::user()->email], ['c.block', '=', 'no'], ['c.clear_by', '!=', Auth::user()->email ] ])
                                                ->get();
            
            $receive_req = DB::table('contacts as c')->join('user_photos as up', 'up.email', '=', 'c.self_email')
                                                ->select('c.*', 'up.avatar_name')
                                                ->where([  ['c.partner_email', '=', Auth::user()->email], ['c.block', '=', 'no'], ['c.clear_by', '!=', Auth::user()->email ], ['c.state', '=', 'new']  ])
                                                ->get();    
        }
        else if ($filter_key == 'favourite') {
            
            $send_req = DB::table('contacts as c')->join('user_photos as up', 'up.email', '=', 'c.partner_email')
                                                ->select('c.*', 'up.avatar_name')
                                                ->where([  ['c.self_email', '=', Auth::user()->email], ['c.block', '=', 'no'], ['c.clear_by', '!=', Auth::user()->email ], ['c.favourite', '=', 'allow'] ])
                                                ->get();
            
            $receive_req = DB::table('contacts as c')->join('user_photos as up', 'up.email', '=', 'c.self_email')
                                                ->select('c.*', 'up.avatar_name')
                                                ->where([  ['c.partner_email', '=', Auth::user()->email], ['c.block', '=', 'no'], ['c.clear_by', '!=', Auth::user()->email ], ['c.favourite', '=', 'allow'], ['c.state', '=', 'new']  ])
                                                ->get();
            
        }
        else if($filter_key == 'block') {
            
            $send_req = DB::table('contacts as c')->join('user_photos as up', 'up.email', '=', 'c.partner_email')
                                                ->select('c.*', 'up.avatar_name')
                                                ->where([  ['c.self_email', '=', Auth::user()->email], ['c.clear_by', '!=', Auth::user()->email ], ['c.block', '=', 'yes'] ])
                                                ->get();
            
            $receive_req = DB::table('contacts as c')->join('user_photos as up', 'up.email', '=', 'c.self_email')
                                                ->select('c.*', 'up.avatar_name')
                                                ->where([  ['c.partner_email', '=', Auth::user()->email], ['c.clear_by', '!=', Auth::user()->email ], ['c.block', '=', 'yes'], ['c.state', '=', 'new']  ])
                                                ->get();
        }
        $data_arr = array();
        
        foreach ($send_req as $val){
            if ($filter_key == 'all' || $filter_key == 'favourite' || $filter_key == 'block') {
                
                array_push($data_arr, array(
                    'self_username' => $val->self_username,
                    'self_email' => $val->self_email,
                    'partner_email' => $val->partner_email,
                    'partner_username' => $val->partner_username,
                    'state' => $val->state,
                    'favourite' => $val->favourite,
                    'avatar_name' => $val->avatar_name,
                    'read_state' => $this->getReadState($val->partner_email, $val->self_email),
                    'recent_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'source'),
                    'recent_message_translated' => $this->getRecentMessage($val->self_email, $val->partner_email, 'trans'),
                    'datetime_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'time'),
                ));    
            }
            else if ($filter_key == 'online') {
                
                array_push($data_arr, array(
                    'self_username' => $val->self_username,
                    'self_email' => $val->self_email,
                    'partner_email' => $val->partner_email,
                    'partner_username' => $val->partner_username,
                    'state' => $val->state,
                    'favourite' => $val->favourite,
                    'avatar_name' => $val->avatar_name,
                    'read_state' => $this->getReadState($val->partner_email, $val->self_email),
                    'recent_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'source'),
                    'recent_message_translated' => $this->getRecentMessage($val->self_email, $val->partner_email, 'trans'),
                    'datetime_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'time'),
                ));    
                
            }
            else if  ($filter_key == 'unread' && ($this->getReadState($val->partner_email, $val->self_email) > 0 )) {
                
                array_push($data_arr, array(
                    'self_username' => $val->self_username,
                    'self_email' => $val->self_email,
                    'partner_email' => $val->partner_email,
                    'partner_username' => $val->partner_username,
                    'state' => $val->state,
                    'favourite' => $val->favourite,
                    'avatar_name' => $val->avatar_name,
                    'read_state' => intval($this->getReadState($val->partner_email, $val->self_email)),
                    'recent_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'source'),
                    'recent_message_translated' => $this->getRecentMessage($val->self_email, $val->partner_email, 'trans'),
                    'datetime_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'time'),
                ));  
                
            }
        }
        
        foreach ($receive_req as $val) {
            if ($filter_key == 'all' || $filter_key == 'favourite' || $filter_key == 'block') {
                array_push($data_arr, array(
                    'self_username' => $val->partner_username,
                    'self_email' => $val->partner_email,
                    'partner_email' => $val->self_email,
                    'partner_username' => $val->self_username,
                    'state' => $val->state,
                    'favourite' => $val->favourite,
                    'avatar_name' => $val->avatar_name,
                    'read_state' => $this->getReadState($val->self_email, $val->partner_email),
                    'recent_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'source'),
                    'recent_message_translated' => $this->getRecentMessage($val->self_email, $val->partner_email, 'trans'),
                    'datetime_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'time'),
                ));
            }
            else if ($filter_key == 'online') {
                array_push($data_arr, array(
                    'self_username' => $val->partner_username,
                    'self_email' => $val->partner_email,
                    'partner_email' => $val->self_email,
                    'partner_username' => $val->self_username,
                    'state' => $val->state,
                    'favourite' => $val->favourite,
                    'avatar_name' => $val->avatar_name,
                    'read_state' => $this->getReadState($val->self_email, $val->partner_email),
                    'recent_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'source'),
                    'recent_message_translated' => $this->getRecentMessage($val->self_email, $val->partner_email, 'trans'),
                    'datetime_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'time'),
                ));
            }
            else if  ($filter_key == 'unread' && ($this->getReadState($val->self_email, $val->partner_email) > 0 )) {
                array_push($data_arr, array(
                    'self_username' => $val->partner_username,
                    'self_email' => $val->partner_email,
                    'partner_email' => $val->self_email,
                    'partner_username' => $val->self_username,
                    'state' => $val->state,
                    'favourite' => $val->favourite,
                    'avatar_name' => $val->avatar_name,
                    'read_state' => $this->getReadState($val->self_email, $val->partner_email),
                    'recent_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'source'),
                    'recent_message_translated' => $this->getRecentMessage($val->self_email, $val->partner_email, 'trans'),
                    'datetime_message' => $this->getRecentMessage($val->self_email, $val->partner_email, 'time'),
                ));
            }
        }
        return $data_arr;
    }
    public function addFavourite(Request $request)
    {
        $contact = Contact::where([['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email]])->first();
        if ($contact) {
            if ($contact->favourite == 'allow') {
                $data['favourite'] = 'none';
                Contact::where([['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email]])->update($data);    
                return json_encode(['success' => true]);
            }
            else {
                $data['favourite'] = 'allow';
                Contact::where([['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email]])->update($data);    
                return json_encode(['success' => false]);
            }    
        }
        else if (!$contact){            //for receive(new)
            $contact = Contact::where([['partner_email', '=', $request->self_email], ['self_email', '=', $request->partner_email]])->first();
            if ($contact->favourite == 'allow') {
                $data['favourite'] = 'none';
                Contact::where([['partner_email', '=', $request->self_email], ['self_email', '=', $request->partner_email]])->update($data);    
                return json_encode(['success' => true]);
            }
            else {
                $data['favourite'] = 'allow';
                Contact::where([['partner_email', '=', $request->self_email], ['self_email', '=', $request->partner_email]])->update($data);    
                return json_encode(['success' => false]);
            }
        }
            
    } 
    public function setBlock(Request $request)
    {
        $contact = Contact::where([['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email]])->first();
        if ($contact->block == 'yes') {
            $data['block'] = 'no';
            Contact::where([['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email]])->update($data);    
            return json_encode(['success' => true]);
        }
        else {
            $data['block'] = 'yes';
            Contact::where([['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email]])->update($data); 
            return json_encode(['success' => false]);
        }
    }  
    public function getReadState($self_email, $partner_email) {
        $cnt = 0;
        $cnt = Message::where([ ['from_email', '=', $self_email], ['to_email', '=', $partner_email], ['read_state', '=', 'no']])->count();
        return $cnt;
    }
    public function getRecentMessage($self_email, $partner_email, $state) 
    {
        $lastest_message = Message::where([['from_email', '=', $self_email], ['to_email', '=', $partner_email] ])
                ->orWhere([['from_email', '=', $partner_email], ['to_email', '=', $self_email] ])
                ->latest()->first();
        if ($lastest_message) {
            if ($state == 'source') {
                if ($lastest_message->type == 'text') {
                    return $lastest_message->message_source;
                }
                else {
                    return $lastest_message->type;
                }
            }
            else if ($state == 'trans') {
                if ($lastest_message->type == 'text') {
                    return $lastest_message->message_trans;
                }
                else {
                    return '';
                }
            }
            else {
                $theDate    = new DateTime($lastest_message->created_at);
                $stringDate = $theDate->format('g:i A');
                return $stringDate;    
            }    
        }
        return false;
    }
}