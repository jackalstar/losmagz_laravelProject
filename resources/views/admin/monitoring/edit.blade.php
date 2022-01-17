@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)
@section('style')
    
    <style type="text/css">
        .verify-photo {
            width:100%;
            display: flex;
            flex-direction: row;
        }
        .verifyphoto {
            width:100%;
            border-radius: 10px;
        }
        .card {
            overflow-y: hidden;
        }
    </style>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <h2>
                <strong class="text-danger">{{ $user->username }}</strong>
                {{ $user->email }}
                @if ($user->logged == 'on')
                    <img class="" src="{{ asset('storage/images/source_img/logged.png') }}">
                @endif
            </h2>
        </div>
        <div class="row">
            <div class="col-sm">
                <p class="text-danger">Gender</p>
                <div class="row">
                    @if ($user->gender == 'man')
                        <span class="badge badge-success">Man</span>
                    @else
                        <span class="badge badge-primary">Woman</span>
                    @endif
                </div>
            </div>
            <div class="col-sm">
                <p class="text-danger">Plan Type</p>
                <div class="row">
                    @if ($user->plan_type == 'free')
                        <span class="badge badge-info">Free</span>
                    @else
                        <span class="badge badge-success">Paid</span>
                    @endif
                </div>
            </div>
            <div class="col-sm">
                <p class="text-danger">Plan Status</p>
                <div class="row">
                    @if ($user->plan_status == 'active')
                        <span class="badge badge-success">Active</span>
                    @elseif($user->plan_status == 'inactive')
                        <span class="badge badge-info">Inactive</span>
                    @else
                        <span class="badge badge-danger">Expired</span>
                    @endif
                </div>
            </div>
            <div class="col-sm">
                <p class="text-danger">Status</p>
                <div class="row">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input user-status"
                            data-id="{{ $user->id }}" id="customSwitch{{ $user['id'] }}"
                            {{ $user->status == 'active' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customSwitch{{ $user->id }}"></label>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <p class="text-danger">Text</p>
                <div class="row">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input user-text-chat"
                            data-id="{{ $user->id }}" id="textSwitch{{ $user->id }}"
                            {{ $user->text_chat == 'allow' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="textSwitch{{ $user->id }}"></label>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <p class="text-danger">Video</p>
                <div class="row">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input user-video-chat"
                            data-id="{{ $user->id }}" id="videoSwitch{{ $user->id }}"
                            {{ $user->video_chat == 'allow' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="videoSwitch{{ $user->id }}"></label>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <p class="text-danger">Created at</p>
                <div class="row">
                    <div>{{ $user->created_at }}</div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                @if ($user->gender == 'woman')
                    <div class="row"><strong>Verify Photo</strong></div>
                    <div class="row">
                        @if ($user->verify != 'none')
                        <div class="col-sm-4">
                            <div class="verify-photo">
                                <img class="verifyphoto" src="{{ asset('storage/images/user_photos/' . $photos->photo_name1 ) }}" alt="{{ $photos->photo_name1 }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="verify-photo">
                                <img class="verifyphoto" src="{{ asset('storage/images/user_photos/' . $photos->photo_name2 ) }}" alt="{{ $photos->photo_name2 }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="verify-photo">
                                <img class="verifyphoto" src="{{ asset('storage/images/user_photos/' . $photos->photo_name3 ) }}" alt="{{ $photos->photo_name3 }}">
                            </div>
                        </div>
                        @else
                        
                        <p>This user did not upload any photos yet.</p>
                        @endif
                    </div>
                @elseif($user->gender == 'man')
                    <div class="row mb-3"><strong>Minute left</strong></div>
                    <div class="row">
                        <div class="form-group">
                            <form id="editUserMinute">
                                <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                                <input type="number" min="0" id="user_points" name="user_points" value="{{ round($user->points/60) }}" class="form-control" required>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary mt-3" id="modify_minute_button">Modify</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
                
            <div class="col-md-2">
                @if ($user->gender == 'woman' && $user->verify != 'none')
                    <label>Approve for verify photo</label>
                    <div class="row custom-control custom-switch" style="position:relative; left:20px">
                        <input type="checkbox" class="custom-control-input user-verify-status"
                            data-id="{{ $user->id }}" id="verifySwitch{{ $user['id'] }}"
                            {{ $user->verify == 'verified' ? 'checked' : '' }}>
                        <label class="custom-control-label" for="verifySwitch{{ $user->id }}"></label>
                    </div>
                @endif
                
                <label>Message</label>
                <div class="row">
                    <textarea style="width: 100%; height:150px;"></textarea>
                </div>
                
                <button class="btn btn-primary" style="float:right; margin-top: 10px;" id="sendmessageclient" title="Send a message to user">Send</button>
            </div>
            <div class="col-md-4 mt-5">
                @if ($user->gender == 'woman' && $user->verify != 'none')
                    <div class="row">
                        <div class="form-group">
                            <form id="editUserMinute">
                                <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
                                <div class="d-flex justify-content-center ml-3">
                                    <label>Points: </label>
                                    <input type="number" min="0" id="user_points" name="user_points" value="{{ $user->points }}" class="form-control ml-3" required>
                                    <button class="btn btn-primary ml-3" id="modify_minute_button">Modify</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <div class="callout callout-info">
                        <h5>Description</h5>

                        <p>You can edit some features of this user in here. Please choose depending your idea.</p>
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-closeaccount" 
                    style="position: relative; float: left;" title="Delete this user" data-id="{{ $user->id }}">Close account</button>
                <a href="{{ route('users') }}">
                    <button type="button" class="btn btn-warning" style="position: relative; float: right;" title="Back to User page">Back</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
