@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)
@section('style')
<link href="{{ asset('css/in_style.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <form id="newEmojiForm">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Emoji Name</label>
                        <input type="text" id="name"  class="form-control" required>
                        <label>Image</label>
                        <input type="file" id="image"  class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="callout callout-info">
                            <h5>Description</h5>
                            <p>Some text is here about creating Emoji.</p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="new_emoji_start" class="btn btn-primary">Save</button>
            <a href="{{ route('emoji') }}"><button type="button" class="btn btn-default">Cancel</button></a>
        </form>
    </div>
</div>
@endsection