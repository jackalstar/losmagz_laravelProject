@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('content')
<div class="card">
<div class="card-body">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Plan Type</th>
                <th>Plan Status</th>
                <th>Status</th>
                <th>Text</th>
                <th>Video</th>
                <th>Photo Verify</th>
                <th>Minute or Points</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <img src="{{ asset('storage/images/user_photos/' . $value->avatar_name ) }}" alt="{{ $value->avatar_name }}" width="50" height="50">
                        <a href="/user-detail/edit/{{ $value->id }}">
                            <button class="btn btn-primary btn-sm">
                                {{ $value->username }}
                            </button>
                        </a>
                        @if ($value->logged == 'on')
                            <img class="" src="{{ asset('storage/images/source_img/logged.png') }}">
                        @endif
                        
                    </td>
                    <td>{{ $value->email }}</td>
                    <td>
                        @if ($value->gender == 'man')
                            <span class="badge badge-success">Man</span>
                        @else
                            <span class="badge badge-primary">Woman</span>
                        @endif
                    </td>
                    <td>
                        @if ($value->gender == 'man')
                            @if ($value->plan_type == 'free')
                                <span class="badge badge-info">Free</span>
                            @else
                                <span class="badge badge-success">Paid</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if ($value->plan_status == 'active')
                            <span class="badge badge-success">Active</span>
                        @elseif($value->plan_status == 'inactive')
                            <span class="badge badge-info">Inactive</span>
                        @else
                            <span class="badge badge-danger">Expired</span>
                        @endif
                    </td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input user-status" 
                                data-id="{{ $value->id }}" id="customSwitch{{ $value->id }}"
                                {{ $value->status == 'active' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customSwitch{{ $value->id }}"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input user-text-chat"
                                data-id="{{ $value->id }}" id="textSwitch{{ $value->id }}"
                                {{ $value->text_chat == 'allow' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="textSwitch{{ $value->id }}"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input user-video-chat"
                                data-id="{{ $value->id }}" id="videoSwitch{{ $value->id }}"
                                {{ $value->video_chat == 'allow' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="videoSwitch{{ $value->id }}"></label>
                        </div>
                    </td>
                    <td>
                        @if ($value->gender == 'woman')
                            @if ($value->verify == 'none')
                                <span class="badge badge-info">none</span>
                            @elseif ($value->verify == 'uploaded')
                                <span class="badge badge-primary">uploaded</span>
                            @elseif ($value->verify == 'verified')
                                <span class="badge badge-success">verified</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if ($value->gender == 'man')
                            {{round($value->points/60)}} mins
                        @elseif ($value->gender == 'woman')
                            {{$value->points}} pts
                        @endif
                    </td>
                    <td>{{ $value->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Plan Type</th>
                <th>Plan Status</th>
                <th>Status</th>
                <th>Text</th>
                <th>Video</th>
                <th>Photo Verify</th>
                <th>Minute or Points</th>
                <th>Created Date</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>
@endsection
