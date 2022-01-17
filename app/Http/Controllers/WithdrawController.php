<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WithdrawController extends Controller
{
    //index page for admin
    public function index() {
        $withdraws = Withdraw::get();
        return view('admin.withdraw.index', [
            'page' => 'Withdraw',
            'withdraws' => $withdraws
        ]);
    }
    //request visa withdraw
    public function visaWithdraw(Request $request)
    {   
        $withdraw = Withdraw::where('email', Auth::user()->email)->latest()->first();
        if($withdraw && $withdraw->approve == 'none')
        {
            $model['account_name'] = $request->account_name;
            $model['bsb_number'] = $request->bsb_number;
            $model['account_number'] = $request->account_number; 
            
            $data = Withdraw::where('email', Auth::user()->email)->get();
            $length = count($data)-1;
            if (Withdraw::where('email', Auth::user()->email)->where('created_at', $data[$length]['created_at'])->update($model))
            {
                return json_encode(['success' => true]);
            }
        }
        else {
            $model = new Withdraw;
            $model->username = Auth::user()->username;
            $model->email = Auth::user()->email;
            $model->withdrawpoints = Auth::user()->points;
            $model->paymethod = $request->paymethod;
            
            $model->account_name = $request->account_name;
            $model->bsb_number = $request->bsb_number;
            $model->account_number = $request->account_number;
            
            if ( $model->save() ){
                User::where('email', Auth::user()->email)->update(['withdraw_state' => 'withdraw']);
                return json_encode(['success' => true]);
            }
        }
        return json_encode(['success' => false]);
    }
    
    //request paypal withdraw
    public function paypalWithdraw(Request $request)
    {   
        $withdraw = Withdraw::where('email', Auth::user()->email)->latest()->first();
        if($withdraw && $withdraw->approve == 'none')
        {
            $model['paypal_email'] = $request->paypal_email;
            $data = Withdraw::where('email', Auth::user()->email)->get();
            $length = count($data)-1;
            if (Withdraw::where('email', Auth::user()->email)->where('created_at', $data[$length]['created_at'])->update($model))
            {
                return json_encode(['success' => true]);
            }
        }
        else {
            $model = new Withdraw;
            $model->username = Auth::user()->username;
            $model->email = Auth::user()->email;
            $model->withdrawpoints = Auth::user()->points;
            $model->paymethod = $request->paymethod;
            
            $model->paypal_email = $request->paypal_email;
            
            if ( $model->save() ){
                User::where('email', Auth::user()->email)->update(['withdraw_state' => 'withdraw']);
                return json_encode(['success' => true]);
            }
        }
        return json_encode(['success' => false]);
    }
    //return the user detail edit page
    public function withdraw_approve(Request $request)
    {
        //update withdraw approve and withrawpoints
        $model['approve'] = 'approved';
        $model['withdrawpoints'] = $request->withdrawing_points;
        Withdraw::where('id', $request->id)->update($model);
        
        //update user points and withdraw_state
        $model1['withdraw_state'] = 'none';
        $withdraw = Withdraw::where('id', $request->id)->first();
        $user = User::where('email', $withdraw->email)->first();
        $old_points = $user->points;
        $model1['points'] = $old_points - $request->withdrawing_points;
        User::where('email', $withdraw->email)->update($model1);
        
        return json_encode(['success' => true, 'id' => $request->id, 'approve_time' => $withdraw->updated_at, 'withdrawed_points' => $request->withdrawing_points]);    
    }
    public function withdraw_disapprove(Request $request)
    {
        $model['approve'] = 'disapproved';
        $model['withdrawpoints'] = 0;
        Withdraw::where('id', $request->id)->update($model);
        
        $withdraw = Withdraw::where('id', $request->id)->first();
        $model1['withdraw_state'] = 'none';
        User::where('email', $withdraw->email)->update($model1);
        return json_encode(['success' => true, 'id' => $request->id, 'approve_time' => $withdraw->updated_at]);
    }
}
