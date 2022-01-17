<?php

namespace App\Http\Controllers;

use App\Models\BannedUser;
use App\Models\Country;
use App\Models\Language;
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
use App\Models\RecordVideo;
use App\Models\VideoChatHistory;
use File;
use DB;
use DateTime;
use GoogleTranslate;
class HomeController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::get();
        $languages = Language::get();
        if( Auth::user()){
            
            $photos = VerifyPhoto::where('user_id', Auth::user()->id)->first();    
            $avatar = UserPhoto::where('email', Auth::user()->email)->first();
            $gifts = Gift::get();
            $emoji = Emoji::get();
            $logged['logged'] = 'on';
            User::where('id', Auth::user()->id)->update($logged);
            								
            return view('home', [
                'page' => 'Home',
                'countries' => $countries,
                'languages' => $languages,
                'photos' => $photos,
                'avatar' => $avatar,
                'gifts' => $gifts,
                'emoji' => $emoji,
            ]);
        }
        else{
            return view('welcome', [
                'page' => 'Welcome',
                //'countries' => $countries,
                //'languages' => $languages,
            ]);    
        }
    }
    public function getReadState($self_email, $partner_email) {
        $cnt = 0;
        $cnt = Message::where([ ['from_email', '=', $self_email], ['to_email', '=', $partner_email], ['read_state', '=', 'no']])->count();
        return $cnt;
    }
    public function getRecentMessage($self_email, $partner_email, $state) 
    {
        $lastest_message = Message::where([['from_email', '=', $self_email], ['to_email', '=', $partner_email], ['clear_by', '!=', Auth::user()->email] ])
                ->orWhere([['from_email', '=', $partner_email], ['to_email', '=', $self_email], ['clear_by', '!=', Auth::user()->email] ])
                ->latest()->first();
        if ($lastest_message) {
            if ($state) {
                if ($lastest_message->type == 'text' || $lastest_message->type == 'system')
                {
                    return substr($lastest_message->message_source, 0, 15);    
                }
                else {
                    return $lastest_message->type;    
                }
            }
            else { 
                $theDate    = new DateTime($lastest_message->created_at);
                $stringDate = $theDate->format('H:i A');
                return $stringDate;    
            }    
        }
        return false;
    }
    public function logoutControl(Request $request) 
    {
        $data['logged'] = 'off';
        if(User::where('email', $request->user_email)->update($data))
        {
            return json_encode(['success' => true]);    
        }
        return json_encode(['success' => false]);
    }

    //add image to the array
    private function addImage($images, $image)
    {
        $imagesArray = json_decode($images);
        array_push($imagesArray, $image);
        return json_encode($imagesArray);
    }

    //check if the user is banned or not
    public function checkUser(Request $request)
    {
        if (Auth::check())
        {
            $details = new stdClass();
            $details->isbanned = BannedUser::where('ip', $request->ip())->count();
            $details->time_left = Auth::user()->points;
            $details->gender = Auth::user()->gender;    
            $details->verify = Auth::user()->verify;
            return json_encode(['success' => true, 'data' => $details]);
        }
        return json_encode(['success' => false]);
        
    }

    //get the application details and send it to the user
    public function getDetails(Request $request)
    {
        $details = new stdClass();
        $details->username = Auth::check() ? Auth::user()->username : getSetting('DEFAULT_USERNAME');
        $details->email = Auth::check() ? Auth::user()->email : '';
        $details->userGender = Auth::user() ? Auth::user()->gender : '';
        $details->stunUrl = getSetting('STUN_URL');
        $details->turnUrl = getSetting('TURN_URL');
        $details->turnUsername = getSetting('TURN_USERNAME');
        $details->turnPassword = getSetting('TURN_PASSWORD');
        $details->signalingURL = getSetting('SIGNALING_URL');
        $details->ip = $request->ip();
        $details->textChatPaid = getFeature('TEXT_CHAT', 'paid') == 'yes';
        $details->videoChatPaid = getFeature('VIDEO_CHAT', 'paid') == 'yes';
        $details->genderFilterPaid = getFeature('GENDER_FILTER', 'paid') == 'yes';
        $details->countryFilterPaid = getFeature('COUNTRY_FILTER', 'paid') == 'yes';
        $details->userType = auth()->user() ? auth()->user()->plan_type : 'free';
        $details->paidPlanName = getSetting('PRICING_PLAN_NAME_PAID');
        $details->primaryColor = getSetting('THEME_COLOR');
        $details->userLoggedIn = auth()->check();
        $details->withdraw_state = auth()->check() ? Auth::user()->withdraw_state : '';
        $details->leftpoints = Auth::check() ? Auth::user()->points : 0;
        if(Auth::check())
        {
            $withdraw = Withdraw::where('email', Auth::user()->email)->latest()->first();
            if($withdraw){
                if($withdraw->paymethod == 'paypal'){
                    $details->paymethod = $withdraw->paymethod;
                    $details->paypal_email = $withdraw->paypal_email;
                }
                else if($withdraw->paymethod == 'visa'){
                    $details->paymethod = $withdraw->paymethod;
                    $details->account_name = $withdraw->account_name;    
                    $details->bsb_number = $withdraw->bsb_number;
                    $details->account_number = $withdraw->account_number;
                }    
            }
        }
        return json_encode(['success' => true, 'data' => $details]);
    }
    //get women's photoes if it is.
    public function get_women_photoes(Request $request)
    {
        $details = new stdClass();
        if(Auth::check())
        {
            $photoes = VerifyPhoto::where('user_id', Auth::user()->id)->first();
            if($photoes){
                $details->photo_name1 = $photoes->photo_name1;
                $details->photo_name2 = $photoes->photo_name2;
                $details->photo_name3 = $photoes->photo_name3;
                return json_encode(['success' => true, 'data' => $details]);
            }
        }
        return json_encode(['success' => false]);
    }
    
    public function verifyPhoto(Request $request)
    {
        $is_registered = VerifyPhoto::where('user_id', Auth::user()->id)->first();
        if($is_registered) {
            if ($request->firstimage != 'undefined'){
                $is_photo = storage_path("app/public/images/user_photos/{$is_registered['photo_name1']}");
                if (File::exists($is_photo)) @unlink($is_photo);
                
                $file1 = $request->firstimage;
                if ($file1 && $file1->isValid()) {
                    $request->validate([
                        'firstimage' => 'required|mimes:jpeg,png|max:10240',
                    ]);
        
                    $image = $request->file('firstimage');
                    $model['photo_name1'] = Str::random(40).'.'.$image->guessClientExtension();
                    $file1->storeAs('public/images/user_photos', $model['photo_name1']);
                } 
            }
            
            if ($request->secondimage != 'undefined'){
                $is_photo = storage_path("app/public/images/user_photos/{$is_registered['photo_name2']}");
                if (File::exists($is_photo)) @unlink($is_photo);
                
                $file2 = $request->secondimage;
                if ($file2 && $file2->isValid()) {
                    $request->validate([
                        'secondimage' => 'required|mimes:jpeg,png|max:10240',
                    ]);
        
                    $image = $request->file('secondimage');
                    $model['photo_name2'] = Str::random(40).'.'.$image->guessClientExtension();
                    $file2->storeAs('public/images/user_photos', $model['photo_name2']);
                } 
            }
            
            if ($request->thirdimage != 'undefined'){
                $is_photo = storage_path("app/public/images/user_photos/{$is_registered['photo_name3']}");
                if (File::exists($is_photo)) @unlink($is_photo);
                
                $file3 = $request->thirdimage;
                if ($file3 && $file3->isValid()) {
                    $request->validate([
                        'thirdimage' => 'required|mimes:jpeg,png|max:10240',
                    ]);
        
                    $image = $request->file('thirdimage');
                    $model['photo_name3'] = Str::random(40).'.'.$image->guessClientExtension();
                    $file3->storeAs('public/images/user_photos', $model['photo_name3']);
                }
            }
            
            VerifyPhoto::where('user_id', Auth::user()->id)->update($model);
            return json_encode(['success' => true, 'verify' => 'update']);
        }
        else {
            $model = new VerifyPhoto;
            $model['user_id'] = Auth::user()->id;
            if ($request->firstimage != 'undefined'){
                $file1 = $request->firstimage;
                if ($file1 && $file1->isValid()) {
                    $request->validate([
                        'firstimage' => 'required|mimes:jpeg,png|max:10240',
                    ]);
        
                    $image = $request->file('firstimage');
                    $model['photo_name1'] = Str::random(40).'.'.$image->guessClientExtension();
                    $file1->storeAs('public/images/user_photos', $model['photo_name1']);
                    
                }
            }
            if ( $request->secondimage != 'undefined') {
                $file2 = $request->secondimage;
                if ($file2 && $file2->isValid()) {
                    $request->validate([
                        'secondimage' => 'required|mimes:jpeg,png|max:10240',
                    ]);
        
                    $image = $request->file('secondimage');
                    $model['photo_name2'] = Str::random(40).'.'.$image->guessClientExtension();
                    $file2->storeAs('public/images/user_photos', $model['photo_name2']);
                    
                } 
            }
            if ( $request->thirdimage != 'undefined') {
                $file3 = $request->thirdimage;
                if ($file3 && $file3->isValid()) {
                    $request->validate([
                        'thirdimage' => 'required|mimes:jpeg,png|max:10240',
                    ]);
        
                    $image = $request->file('thirdimage');
                    $model['photo_name3'] = Str::random(40).'.'.$image->guessClientExtension();
                    $file3->storeAs('public/images/user_photos', $model['photo_name3']);
                    //$flag++;
                }
            }
            if ($model->save()) {
                Cache::forget('settings');
                Cache::forget('symbol');
                $vdata['verify'] = 'uploaded';
                User::where('id', Auth::user()->id)->update($vdata);
                return json_encode(['success' => true, 'verify' => 'none']);
            }
            
        }
        return json_encode(['success' => false, 'error' => 'An error occurred, please try again.']);
    }
    public function modifyPoints(Request $request)
    {
        $user = User::find(Auth::user()->id);
        
        if ($request->mode == 'increase'){
            $model['points'] = $user->points + 1;
        }
        else if ($request->mode == 'decrease'){
            $model['points'] = $user->points - 1;
        }
        if(User::where('id', Auth::user()->id)->update($model))
        {
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false]);
    }
    
    public function getPoints(Request $request)
    {
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);    
            return json_encode(['success' => true, 'points' => $user->points]);
        }
        return json_encode(['success' => false]);
    }

    public function saveMessage(Request $request)
    {
        $model = new Message();
        $model->from_email = $request->self_email;
        $model->to_email = $request->partner_email;
        $model->message_source = $request->message_source;
        $model->message_trans = $request->message_trans;
        $model->type = $request->type;
        $model->read_state = $request->read_state;
        if ($model->save()) {
            
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false]);
    }
    //save the reported user ip and image
    public function reportUser(Request $request)
    {
        $file = $request->image;
        $ip = $request->ip;

        if ($file && $file->isValid()) {
            $reportedUser = ReportedUser::where('ip', $ip)->first();
            $fileName = Str::random(4) . '_' . Carbon::now()->timestamp . '.jpg';

            if ($reportedUser) {
                $reportedUser->images = $this->addImage($reportedUser->images, $fileName);
                $reportedUser->save();
            } else {
                $newArray = [];
                array_push($newArray, $fileName);

                $model = new ReportedUser();
                $model->ip = $ip;
                $model->images = json_encode($newArray);
                $model->save();
            }

            $file->storeAs('public/images/reported-users', $fileName);

            return json_encode(['success' => true]);
        }

        return json_encode(['success' => false]);
    }
    public function addFriend(Request $request)
    {   
        $send_request = Contact::where('self_email', $request->self_email)->where('partner_email', $request->partner_email)->first();
        $recieve_requested = Contact::where('self_email', $request->partner_email)->where('partner_email', $request->self_email)->first();
        //register a new request
        $model = new Contact();
        $model->self_email = $request->self_email;
        $model->partner_email = $request->partner_email;
            $self = User::where('email', $request->self_email)->first();
        $model->self_username = $self->username;
            $partner = User::where('email', $request->partner_email)->first();
        $model->partner_username = $partner->username;
        //register a new system message
        $message = new Message();
        $message->from_email = $request->self_email;
        $message->to_email = $request->partner_email; 
        $message->type = 'system';
        
        //first state: has no request between them
        if (!$send_request && !$recieve_requested )
        {
            $message->message_source = ($self->username)." send a request";
            //send a user avatar to the partner
            $self_avatar = UserPhoto::where('user_id', $self->id)->first();
            
            if($model->save() && $message->save())
            {
                return json_encode(['success' => true, 'contact_state' => 'add_request', 'self_avatar' => $self_avatar->avatar_name, 'self_username' => $self->username]);
            }
            return json_encode(['success' => false, 'error' => 'System error occured!']);
        }
        //second state: has a request between them
        //if this user is sender
        if ($send_request && !$recieve_requested)
        {   
            if ($request->in_where == 'add_button' || $request->in_where == 'video_stories' || $request->in_where == 'video_history')
            {
                if ($send_request->state == 'disagree')
                {
                    $data['state'] = 'new';
                    Contact::where('self_email', $request->self_email)->where('partner_email', $request->partner_email)->update($data);
                    
                    $message->message_source = ($self->username)." send a request";
                    //send a user avatar to the partner
                    $self_avatar = UserPhoto::where('user_id', $self->id)->first();
                    
                    if($message->save())
                    {
                        return json_encode(['success' => true, 'contact_state' => 'add_request', 'self_avatar' => $self_avatar->avatar_name, 'self_username' => $self->username]);
                    }
                    return json_encode(['success' => false, 'error' => 'System error occured!']);
                }
                return json_encode(['success' => false]);
            }
        }
        //if this user is reciever
        if (!$send_request && $recieve_requested)
        {
            if ($request->in_where == 'add_button' || $request->in_where == 'video_stories' || $request->in_where == 'video_history')
            {
                if ($recieve_requested->state == 'disagree')
                {
                    $data['state'] = 'new';
                    $data['self_email'] = $request->self_email;
                    $data['partner_email'] = $request->partner_email;
                    $data['self_username'] = $self->username;
                    $data['partner_username'] = $partner->username;
                    
                    Contact::where('self_email', $request->partner_email)->where('partner_email', $request->self_email)->update($data);
                    
                    
                    $message->message_source = ($self->username)." send a request";
                    //send a user avatar to the partner
                    $self_avatar = UserPhoto::where('user_id', $self->id)->first();
                    
                    if($message->save())
                    {
                        return json_encode(['success' => true, 'contact_state' => 'add_request', 'self_avatar' => $self_avatar->avatar_name, 'self_username' => $self->username]);
                    }
                    return json_encode(['success' => false, 'error' => 'System error occured!']);
                }
                if ($recieve_requested->state != 'disagree') {
                    $contacts = DB::table('contacts as c')->join('user_photos as up', 'up.email', '=', 'c.self_email')
                                            ->select('c.self_email', 'c.self_username', 'c.partner_email', 'c.partner_username', 'c.state', 'c.favourite', 'up.avatar_name')
                                            ->where('c.partner_email', $request->self_email)->where('c.self_email', $request->partner_email)->where('c.state', 'new')
                                            ->first();
                    if ($contacts){
                        return json_encode(['success' => true, 'contact_state' => 'reciever', 'contacts' => $contacts]);        
                    }    
                }
                return json_encode(['success' => false]);            
            }
            if ($request->in_where == 'accept_request')
            {   
                $message->message_source = ($self->username)." accepted this request";
                $message->read_state = 'yes';
                $model->state = 'agree';
                if($model->save() && $message->save())
                {
                    $data['state'] = 'agree';
                    $data1['read_state'] = 'yes';
                    Contact::where('self_email', $request->partner_email)->where('partner_email', $request->self_email)->update($data);
                    Message::where('from_email', $request->partner_email)->where('to_email', $request->self_email)->update($data1);
                    //for rendering contact system message if this user click accept button
                    $messages = Message::where([ ['from_email', '=', $request->self_email], ['to_email', '=', $request->partner_email]])
                                        ->orWhere([ ['from_email', '=', $request->partner_email], ['to_email', '=', $request->self_email]])
                                        ->get();
                    return json_encode(['success' => true, 'partner_username' => $partner->username, 'self_email' => $request->self_email, 'partner_email' => $request->partner_email, 'messages' => $messages]);
                }    
                return json_encode(['success' => false]);
            }
            if ($request->in_where == 'decline_request')
            {   
                $message->message_source = ($self->username)." declined this request";
                $message->read_state = 'yes';
                if($message->save())
                {
                    $data['state'] = 'disagree';
                    $data1['read_state'] = 'yes';
                    Contact::where('self_email', $request->partner_email)->where('partner_email', $request->self_email)->update($data);
                    Message::where('from_email', $request->partner_email)->where('to_email', $request->self_email)->update($data1);
                    return json_encode(['success' => true]);
                }    
                return json_encode(['success' => false]);
            } 
            return json_encode(['success' => false]);
        }
        return json_encode(['success' => false]);
    }
    public function checkContact(Request $request)
    {
        $contacts = Contact::where([  ['self_email', '=', $request->self_email], ['partner_email', '=', $request->partner_email]  ])         
                        ->orWhere([  ['partner_email', '=', $request->self_email], ['self_email', '=', $request->partner_email]  ])
                        ->first();
        //first state
        if (!$contacts)
        {
            return json_encode(['success' => true, 'data' => 'no_request']);  
        }
        //second state
        if ($contacts && $contacts->state == 'new')
        {
            return json_encode(['success' => true, 'data' => $contacts->self_email]);    
        }
        //third state
        if ($contacts && $contacts->state == 'agree')
        {
            return json_encode(['success' => true, 'data' => 'agree']);    
        }
        return json_encode(['success' => false]);
    }
    public function getPartnerAvartar(Request $request)
    {
        $user_photo = UserPhoto::where('email', $request->call_from_email)->first();
        if ($user_photo) {
            return json_encode(['success' => true, 'user_photo' => $user_photo]);    
        }
        return json_encode(['success' => false]);
    }
    public function videoHistorySave(Request $request)
    {
        
        if ($request->save_key == 'yes') {
            
            $video_chat_history = new VideoChatHistory();
            $video_chat_history->self_email = $request->selfEmail;
            $video_chat_history->self_username = $request->selfName;
            $video_chat_history->partner_email = $request->partnerEmail;
            $video_chat_history->partner_username = $request->partnerName;
            $video_chat_history->start_time = $request->start_time;
            $video_chat_history->end_time = $request->end_time;
            $video_chat_history->vlength = $request->vlength;
            
            if ($video_chat_history->save()) {
                $partner_avatar = UserPhoto::where('email', $request->partnerEmail)->first()->avatar_name;
                return json_encode(['success' => true, 'video_chat_history' => $video_chat_history, 'partner_avatar' => $partner_avatar]);
            }    
        }
        else if($request->save_key == 'no') {
            $partner_avatar = UserPhoto::where('email', $request->partnerEmail)->first()->avatar_name;
            $video_chat_history1 = VideoChatHistory::where([ ['self_email', '=',  $request->partnerEmail ], ['partner_email', '=', $request->selfEmail]])->latest()->first();
            return json_encode(['success' => true, 'video_chat_history' => $video_chat_history1, 'partner_avatar' => $partner_avatar]);
        }
        return json_encode(['success' => false]);
    }
    public function getVideoHistory(Request $request)
    {
        $cnt = 7;
        $video_chat_histories = VideoChatHistory::where([['self_email', '=', Auth::user()->email], ['clear_by', '!=', Auth::user()->email] ])
                                                ->orWhere([['partner_email', '=', Auth::user()->email], ['clear_by', '!=', Auth::user()->email] ])->latest()->take($cnt)->get();
        $data_arr = array();
        foreach ($video_chat_histories as $val){
            if ($val->self_email == Auth::user()->email) {
                array_push($data_arr, array(
                    'id' => $val->id,
                    'self_email' => $val->self_email,
                    'self_username' => $val->self_username,
                    'partner_email' => $val->partner_email,
                    'partner_username' => $val->partner_username,
                    'partner_avatar' => UserPhoto::where('email', $val->partner_email)->first()->avatar_name,
                    'start_time' => $val->start_time,
                    'end_time' => $val->end_time,
                    'vlength' => $val->vlength,
                    'created_at' => $val->created_at,
                    'contact_state' => $this->getContactState($val->self_email, $val->partner_email),
                ));    
            }
            else {
                array_push($data_arr, array(
                    'id' => $val->id,
                    'self_email' => $val->partner_email,
                    'self_username' => $val->partner_username,
                    'partner_email' => $val->self_email,
                    'partner_username' => $val->self_username,
                    'partner_avatar' => UserPhoto::where('email', $val->self_email)->first()->avatar_name,
                    'start_time' => $val->start_time,
                    'end_time' => $val->end_time,
                    'vlength' => $val->vlength,
                    'created_at' => $val->created_at,
                    'contact_state' => $this->getContactState($val->partner_email, $val->self_email),
                ));
            }
        }
        if ($data_arr) {
            return json_encode(['success' => true, 'video_chat_histories' => $data_arr]);
        }
        return json_encode(['success' => false]);
    }
    public function getContactState($self_email, $partner_email)
    {
        $contacts = Contact::where([  ['self_email', '=', $self_email], ['partner_email', '=', $partner_email] , ['state', '!=', 'disagree'] ])         
                        ->orWhere([  ['partner_email', '=', $self_email], ['self_email', '=', $partner_email] , ['state', '!=', 'disagree']  ])
                        ->get();
        return count($contacts);
    }
    public function videoHistoryDelete(Request $request) {
        $delete_vh = VideoChatHistory::where('id', $request->delete_id)->first();
        if ($delete_vh->clear_by == 'yes')  {
            $data['clear_by'] = Auth::user()->email;
            VideoChatHistory::where('id', $request->delete_id)->update($data);
            return json_encode(['success' => true]);    
        }
        else if ( $delete_vh->clear_by == Auth::user()->email) {
            return json_encode(['success' => false]);
        }
        else {
            VideoChatHistory::where('id', $request->delete_id)->delete();
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false]);
    }
    public function videoHistoryDeleteAll(Request $request) {
        $delete_vh = VideoChatHistory::where('self_email',  Auth::user()->email)
                                ->orWhere('partner_email', Auth::user()->email)
                                ->get();
        $data['clear_by'] = Auth::user()->email;
        foreach ($delete_vh as $value)  {
            if ($value->clear_by == 'yes') {
                VideoChatHistory::where('id', $value->id)->update($data);
            }
            else if($value->clear_by != 'yes' && $value->clear_by != Auth::user()->email){
                VideoChatHistory::where('id', $value->id)->delete();
            }
        }
        return json_encode(['success' => true]);
    }
    public function DBoperation(Request $request)  {
        $servername = "localhost";
        $username = "admin_fluky";
        $password = "$Ajx93oEB!jjCAttkwhdro&DZ&fhX$";
        $dbname = "admin_fluky";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
        // sql to create table
        $sql = "CREATE TABLE MyGuests (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        if ($conn->query($sql) === TRUE) {
          echo "Table MyGuests created successfully";
        } else {
          echo "Error creating table: " . $conn->error;
        }
        
        $conn->close();
    }
    public function transMessage(Request $request) {
        // return json_encode(['success' => true, 'partnerEmail' => $request->partnerEmail]);
        $self_lang = Auth::user()->lang;
        $partner_lang = User::where('email', $request->partnerEmail)->first()->lang;
        $transl['source'] =  GoogleTranslate::translate($request->message, $self_lang);
        $transl['trans'] =  GoogleTranslate::translate($request->message, $partner_lang);
        return json_encode(['success' => true, 'transl' => $transl]);
    }
    public function setLanguage(Request $request) {
        $data['lang'] = $request->lang_code;
        if (User::where('id', Auth::user()->id)->update($data)) 
        {
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false]);
    }
        //$whatlanguage = GoogleTranslate::detectLanguage(['最近聊天记录', '最近聊天记录']);
        //$whattrans =  GoogleTranslate::translate(['Hello world', 'Laravel is the best framework']);
        //dd($whattrans); 
        
        // $data_arr = array_reverse($data_arr);
        // if (count($data_arr) > $cnt) {
        //     array_splice($data_arr, 0, count($data_arr) - $cnt);
        // }       
        
}
