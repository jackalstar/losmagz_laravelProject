<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{

    /**
     * Show the profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     
    //return the index page
    public function index()
    {
        $packages = Package::get();
        return view('admin.package.index', [
            'page' => 'Packages',
            'packages' => $packages
        ]);    
    }
    //return the edit page
    public function edit($id)
    {
        $model = Package::find($id);

        return view('admin.package.edit', [
            'page' => 'Packages',
            'model' => $model,
            'currencies' => $model->key == 'CURRENCY' ? Currency::get() : '',
        ]);
    }
    //update package
    public function update(Request $request)
    {
        $model['package_name'] = $request->package_name;
        $model['price'] = $request->price;
        $model['currency'] = $request->currency;
        $model['minute'] = $request->minute;    

        if (Package::where('id', $request->id)->update($model)) {
            // Cache::forget('settings');
            // Cache::forget('symbol');
            return json_encode(['success' => true]);
        }
        return json_encode(['success' => false, 'error' => 'An error occurred, please try again.']);
    }
}
