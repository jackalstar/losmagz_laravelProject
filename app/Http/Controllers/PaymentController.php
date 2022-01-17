<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Stripe;
use App\Models\UserPlan;
use App\Models\User;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth'], ['except' => ['index']]);
        $this->middleware('checkPaymentMode');
        $this->middleware('checkGender');
    }

    /**
     * Show the pricing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $freeFeatures = Feature::where('paid', 'no')->where('status', 'active')->pluck('description');
        $paidFeatures = Feature::where('paid', 'yes')->where('status', 'active')->pluck('description');
        $packages = Package::get();
        return view('payment.pricing', [
            'page' => 'Pricing',
            'freeFeatures' => $freeFeatures,
            'paidFeatures' => $paidFeatures,
            'packages' => $packages
        ]);
    }

    /**
     * payment view
     */
    public function payment(Request $request)
    {
        /*if (Auth::user()->plan_status == "active") {
            return redirect(route('profile'));
        }*/
        
        $price = $request->price;
        $type = strtolower($request->type);
        return view('payment.pay', [
            'page' => 'Payment',
            'price' => $price,
            'type' => $type
        ]);
    }

    /**
     * handle payment and add plan details
     */
    public function handlePayment(Request $request)
    {
        $price = $request->price;

        try {
            Stripe\Stripe::setApiKey(getSetting('STRIPE_SECRET'));

            $transaction = Stripe\Charge::create([
                "amount" => 100 * $price,
                "currency" => getSetting('CURRENCY'),
                "source" => $request->stripeToken,
                "description" => "Plan purchased"
            ]);
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return back();
        }

        $model = new UserPlan();
        $model->user_id = Auth::id();
        $model->amount = $price;
        $model->type = $request->type;
        $model->currency = getSetting('CURRENCY');
        $model->gateway = 'stripe';
        $model->transaction_id = $transaction->id;
        $model->plan_start_date = Carbon::now()->toDateString();
        $model->plan_end_date = $request->type == 'monthly' ? Carbon::now()->addYear()->toDateString() : Carbon::now()->addMonth()->toDateString();
        // $model->created_at = Carbon::now()->addHour(11);
        // $model->updated_at = Carbon::now()->addHour(11);
        $model->save();
        $minute_origin = User::find(Auth::id())->points;
        $add_minute = Package::where('package_name', ucfirst($request->type))->first()->minute;    
        $total_minute = $minute_origin + $add_minute * 60;
        User::where('id', Auth::id())->update(['plan_type' => $request->type, 'plan_status' => 'active', 'points' => $total_minute, 'text_chat' => 'allow', 'video_chat' => 'allow']);
        Session::flash('success', 'Payment has been successfully processed, thank you!');

        return redirect(route('man_transaction'));
    }
}
