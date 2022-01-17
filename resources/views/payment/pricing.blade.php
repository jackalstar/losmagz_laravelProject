@extends('layouts.app')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('content')
<div class="container-fluid text-center">
<h1 class="mb-3">Choose your package</h1>
<div class="container plan-selection">
    
    <div class="card-deck text-center">
        @foreach ($packages as $package)
        <div class="card">
            
            <div class="card-header">
                {{$package->package_name}}
            </div>
            <div class="card-body">
                @if (auth()->user() && auth()->user()->plan_type == strtolower($package->package_name))
                    <div class="ribbon-wrapper ribbon-lg">
                        <div class="ribbon bg-primary">
                            Recently buy
                        </div>
                    </div>
                @endif
                <h3 id="basicPrice">{{ getCurrencySymbol(). $package->price }}
                    /<small> {{$package->minute}}minutes</small>
                </h3>
            </div>
            <div class="card-footer">
                <form action="payment">
                    <input type="hidden" id="type" name="type" value="{{$package->package_name}}">
                    <input type="hidden" id="type" name="price" value="{{$package->price}}">
                    <button type="submit" class="btn btn-theme">Buy Now</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection
