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
use File;
use DB;
class ViewRequestController extends Controller
{
    public function viewRequests(Request $request)
    {
        $contacts = DB::table('contacts as c')->join('user_photos as up', 'up.email', '=', 'c.self_email')
                                            ->select('c.self_email', 'c.self_username', 'c.partner_email', 'c.partner_username', 'c.state', 'c.favourite', 'up.avatar_name')
                                            ->where('c.partner_email', Auth::user()->email)
                                            ->where('c.state', 'new')
                                            ->get();
        if(count($contacts))
        {
            return json_encode(['success' => true, 'contacts' => $contacts ]);    
        }
        return json_encode(['success' => false]);
        
    }
}
