@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)
@section('style')
<link href="{{ asset('css/in_style.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <form id="newGiftForm">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Gift Name</label>
                        <input type="text" id="name"  class="form-control" required>
                        <label>Cost</label>
                        <input type="number" id="cost_minute" class="form-control" min=0 max=200 required>
                        <label>Receive</label>
                        <input type="number" id="receive_minute" class="form-control" min=0 max=200 required>
                        <label>Image</label>
                        <input type="file" id="image"  class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="callout callout-info">
                            <h5>Description</h5>
                            <p>Some text is here about creating Gifts.</p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="new_gift_start" class="btn btn-primary">Save</button>
            <a href="{{ route('gifts') }}"><button type="button" class="btn btn-default">Cancel</button></a>
        </form>
    </div>
</div>
@endsection