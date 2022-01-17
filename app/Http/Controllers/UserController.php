<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserPhoto;
use App\Models\VerifyPhoto;
use App\Models\UserPlan;
use App\Models\Withdraw;
use App\Models\VideoChatHistory;
use App\Models\Contact;
use App\Models\Message;
use App\Models\CapturePhoto;
use App\Models\CaptureVideo;
use App\Models\RecordVideo;

use stdClass;
use File;

class UserController extends Controller
{
    /**
     * Show all the users.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users as u')->join('user_photos as up', 'up.user_id', '=', 'u.id')
            ->select('u.*', 'up.avatar_name')
            ->where([ ['u.role', '=', 'end-user'] ])
            ->get();
        return view('admin.user.index', [
            'page' => 'Users',
            'users' => $users,
        ]);
    }

    //udpate user status
    public function updateUserStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->checked == 'true' ? 'active' : 'inactive';

        if ($user->save()) {
            return json_encode(['success' => true]);
        }

        return json_encode(['success' => false]);
    }
    //udpate user text-chat status
    public function updateUserTextStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->text_chat = $request->checked == 'true' ? 'allow' : 'none';
        if ($user->save()) {
            return json_encode(['success' => true]);
        }

        return json_encode(['success' => false]);
    }
    //udpate user video-chat status
    public function updateUserVideoStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->video_chat = $request->checked == 'true' ? 'allow' : 'none';

        if ($user->save()) {
            return json_encode(['success' => true]);
        }

        return json_encode(['success' => false]);
    }
    //return the user detail edit page
    public function user_detail_edit($id)
    {
        $user = User::find($id);
        if ($user) {
            $photos = VerifyPhoto::where('user_id', $id)->first();
            return view('admin.user.edit', [
                'page' => 'User Information',
                'photos' => $photos,
                'user' => $user
                //'currencies' => $model->key == 'CURRENCY' ? Currency::get() : '',
            ]);    
        }
        else {
            return redirect('users');
        }
    }
    //udpate user verify status
    public function updateUserVerifyStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->verify = $request->checked == 'true' ? 'verified' : 'uploaded';

        if ($user->save()) {
            return json_encode(['success' => true]);
        }

        return json_encode(['success' => false]);
    }
    //send Message to Client
    public function sendMessageClient(Request $request)
    {
        $user = User::find($request->id);
        $user->verify = $request->checked == 'true' ? 'verified' : 'uploaded';

        if ($user->save()) {
            return json_encode(['success' => true]);
        }

        return json_encode(['success' => false]);
    }
    
    //send modify user's minute
    public function modifyMinute(Request $request)
    {
        $man['points'] = $request->user_points * 60;
        $woman['points'] = $request->user_points;
        $user = User::where('id', $request->user_id)->first();
        if($user->gender == 'man' && User::where('id', $request->user_id)->update($man))
        {
            return json_encode(['success' => true]);
        }
        elseif($user->gender == 'woman' && User::where('id', $request->user_id)->update($woman))
        {
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false]);
    }
    //send close account
    public function closeAccount(Request $request)
    {
        /*
        1. delete verify_photos table and real photoes of user_photoes in user_photoes folder if account is woman's and if it is.
        2. delete user_photos table and real photos of user_photos in user_photoes folder for man and woman.
        3. delete withdraws if account is woman's
        4. delete user_plan if account is man's
        5. delete video chat histories for users
        6. delete message and related all datas
        7. delete record video if account is woman's 
        8. delete contact and make a new message for informing this account is close
        9. delete users table
        */
        $user = User::find($request->id);
        if ($user) {
            $clear_by['clear_by'] = $user->email;
            $details = new stdClass();
            $details->flag_verify_photoes = false;          //db: verify_photos, model: VerifyPhoto, folder: user_photos, content: for three verify photos
            $details->flag_user_photoes = false;            //db: user_photos, model: UserPhoto, folder: user_photos, content: for user's avatar in profile page.
            $details->flag_withdraw = false;                //db: withdraw, model: Withdraw
            $details->flag_userplan = false;                //db: user_plans, model: UserPlan
            $details->flag_videochathistories = false;      //db: videochathistories
            $details->flag_message = false;                 //db: messages, model: Message, 
                                                            //db: captured_photo, model: CapturePhoto, folder: captured_photo
                                                            //db: captured_video, model: CaptureVideo, folder: captured_video
            $details->flag_record = false;                  //db: record_video, model: RecordVideo, folder: record_video
            $details->flag_contact = false;                 //db: contacts, model: Contact
            $details->flag_users = false;                   //db: users, model: User
            
            if ($user->gender == 'woman'){
                //1. delete verify_photos
                $verify_photos = VerifyPhoto::where('user_id', $user->id)->first();
                if($verify_photos) {
                    $is_photo = storage_path("app/public/images/user_photos/{$verify_photos['photo_name1']}");
                    if (File::exists($is_photo)) @unlink($is_photo);
                    $is_photo = storage_path("app/public/images/user_photos/{$verify_photos['photo_name2']}");
                    if (File::exists($is_photo)) @unlink($is_photo);
                    $is_photo = storage_path("app/public/images/user_photos/{$verify_photos['photo_name3']}");
                    if (File::exists($is_photo)) @unlink($is_photo);
                    if (VerifyPhoto::where('user_id', $user->id)->delete()){
                        $details->flag_verify_photoes = true;
                    }
                }
                //3. delete withdraw
                if (Withdraw::where('email', $user->email)->delete()){
                    $details->flag_withdraw = true;
                }
                //7. delete record video
                $record_video = RecordVideo::where('self_email', $user->email)->get();
                if ($record_video)
                {
                    foreach ($record_video as $value) {
                        if ($value->video != 'undefined') {
                            $is_re_video = storage_path("app/public/images/record_video/$value->video");
                            if (File::exists($is_re_video)) @unlink($is_re_video);
                            RecordVideo::where('id',  $value->id)->delete();
                        }
                    }
                }
                if (RecordVideo::where('self_email', $user->email)->delete()) {
                    $details->flag_record = true;
                }
            }
            else if($user->gender == 'man'){
                //4. delete user_plans
                if (UserPlan::where('user_id', $user->id)->delete()){
                    $details->flag_userplan = true;
                }
            }    
            
            //5. delete video chat histories
                $delete_vh = VideoChatHistory::where('self_email',  $user->email)
                                        ->orWhere('partner_email', $user->email)
                                        ->get();
                $data['clear_by'] = $user->email;
                foreach ($delete_vh as $value)  {
                    if ($value->clear_by == 'yes') {
                        VideoChatHistory::where('id', $value->id)->update($data);
                    }
                    else if($value->clear_by != 'yes' && $value->clear_by != $user->email){
                        VideoChatHistory::where('id', $value->id)->delete();
                    }
                    $details->flag_videochathistories = true;
                }
            //6. delete message and related all datas (contacts, messages, captured_photo, captured_video)
                //already if partner clear these message, then delete these message
                Message::where([ ['from_email', '=', $user->email], ['type', '=', 'text'], ['clear_by', '!=', $user->email], ['clear_by', '!=', 'yes']])
                             ->orWhere([ ['to_email', '=', $user->email], ['type', '=', 'text'], ['clear_by', '!=', $user->email], ['clear_by', '!=', 'yes']])
                          ->delete();
                Message::where([ ['from_email', '=', $user->email], ['type', '=', 'emoji'], ['clear_by', '!=', $user->email], ['clear_by', '!=', 'yes']])
                             ->orWhere([ ['to_email', '=', $user->email], ['type', '=', 'emoji'], ['clear_by', '!=', $user->email], ['clear_by', '!=', 'yes']])
                          ->delete();  
                Message::where([ ['from_email', '=', $user->email], ['type', '=', 'gift'], ['clear_by', '!=', $user->email], ['clear_by', '!=', 'yes']])
                             ->orWhere([ ['to_email', '=', $user->email], ['type', '=', 'gift'], ['clear_by', '!=', $user->email], ['clear_by', '!=', 'yes']])
                          ->delete();
                $photo = DB::table('messages as m')->join('captured_photo as cp', 'm.message_source', '=', 'cp.id')
                             ->where([ ['m.from_email', '=', $user->email], ['m.type', '=', 'photo'], ['m.clear_by', '!=', $user->email], ['m.clear_by', '!=', 'yes']])
                             ->orWhere([ ['m.to_email', '=', $user->email], ['m.type', '=', 'photo'], ['m.clear_by', '!=', $user->email], ['m.clear_by', '!=', 'yes']])
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
                             ->where([ ['m.from_email', '=', $user->email], ['m.type', '=', 'video'], ['m.clear_by', '!=', $user->email], ['m.clear_by', '!=', 'yes']])
                             ->orWhere([ ['m.to_email', '=', $user->email], ['m.type', '=', 'video'], ['m.clear_by', '!=', $user->email], ['m.clear_by', '!=', 'yes']])
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
                Message::where([ ['from_email', '=', $user->email], ['type', '=', 'text'], ['clear_by', '=', 'yes'],])
                             ->orWhere([ ['to_email', '=', $user->email], ['type', '=', 'text'], ['clear_by', '=', 'yes'],])
                          ->update($clear_by);
                Message::where([ ['from_email', '=', $user->email], ['type', '=', 'emoji'], ['clear_by', '=', 'yes'],])
                             ->orWhere([ ['to_email', '=', $user->email], ['type', '=', 'emoji'], ['clear_by', '=', 'yes'],])
                          ->update($clear_by);
                Message::where([ ['from_email', '=', $user->email], ['type', '=', 'gift'], ['clear_by', '=', 'yes'],])
                             ->orWhere([ ['to_email', '=', $user->email], ['type', '=', 'gift'], ['clear_by', '=', 'yes'],])
                          ->update($clear_by);          
                Message::where([ ['from_email', '=', $user->email], ['type', '=', 'photo'], ['clear_by', '=', 'yes'],])
                             ->orWhere([ ['to_email', '=', $user->email], ['type', '=', 'photo'], ['clear_by', '=', 'yes'],])
                          ->update($clear_by);      
                Message::where([ ['from_email', '=', $user->email], ['type', '=', 'video'], ['clear_by', '=', 'yes'],])
                             ->orWhere([ ['to_email', '=', $user->email], ['type', '=', 'video'], ['clear_by', '=', 'yes'],])
                          ->update($clear_by);      
                          
            //7. delete contact and make a new message for informing this account is close
                //already if partner clear your contact, then delete these contact and message
                Contact::where([ ['self_email', '=', $user->email], ['clear_by', '!=', $user->email], ['clear_by', '!=', 'yes'] ])
                        ->orWhere([ ['partner_email', '=', $user->email], ['clear_by', '!=', $user->email], ['clear_by', '!=', 'yes'] ])
                        ->delete();
                        
                //delete about disagree & new request.        
                Contact::where([ ['self_email', '=', $user->email], ['state', '!=', 'agree'] ])
                        ->orWhere([ ['partner_email', '=', $user->email], ['state', '!=', 'agree'] ])
                        ->delete();
                        
                //if partner didn't delete your contact 
                //inform this account is close to partner
                //and update this contact.
                $user_contact = Contact::where([['self_email', '=', $user->email], ['clear_by', '=', 'yes' ], ['state', '=', 'agree'] ])->get(); 
                foreach ($user_contact as $value)  {
                    $model = new Message();
                    $model->from_email = $user->email;
                    $model->to_email = $value->partner_email;
                    $model->message_source = $user->username."'s account is closed by some reason.";
                    $model->message_trans = '';
                    $model->type = 'text';
                    $model->read_state = 'no';                     
                    $model->save();
                    $details->flag_contact = true;
                }
                Contact::where([['self_email', '=', $user->email], ['clear_by', '=', 'yes' ], ['state', '=', 'agree'] ])
                        ->orWhere([['partner_email', '=', $user->email], ['clear_by', '=', 'yes' ], ['state', '=', 'agree'] ])
                        ->update($clear_by);
            
            
            //2. delete user_photos
                $user_photos = UserPhoto::where('user_id', $user->id)->first();
                if($user_photos) {
                    $is_photo = storage_path("app/public/images/user_photos/{$user_photos['avatar_name']}");
                    if (File::exists($is_photo) && $user_photos['avatar_name'] != 'stranger.jpg') @unlink($is_photo);
                    if (UserPhoto::where('user_id', $user->id)->delete()){
                        $details->flag_user_photoes = true;
                    }
                }

            
            //8. delete user
                if (User::where('id', $user->id)->delete()){
                    $details->flag_users = true;
                }
            return json_encode(['success' => true, 'data' => $details]);
        }
        else {
            return redirect('users');
        }
        return json_encode(['success' => false]);
    }
}
