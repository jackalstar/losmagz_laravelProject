@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('content')
<div class="card p-3">
        <div class="row">
            <div class="col-md-6">
                <form id="heartLikeEdit">
                    <label>Cost like (between 1 and 100)</label>
                    <input type="number" id="heart_value" value="{{$heart_value}}" class="form-control" placeholder="Enter Value" max="100" min="0" required>
                    <label>Destroy Time (between 10 and 86400)</label>
                    <input type="number" id="destroy_value" value="{{$destroy_value}}" class="form-control" placeholder="Enter Value" max="86400" min="10" required>
                    
                    <button type="button" id="heart_save" class="btn btn-primary mt-2">Save</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="callout callout-info">
                        <h5>Description</h5>
                        <p>This is for cost like</p>
                        <p>And this is for destroy video automatically</p>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="card">
<div class="card-body">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Record Video</th>
                <th>Title</th>
                <th>Username</th>
                <th>Length</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_arr as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <video controls src="{{asset('storage/images/record_video/' .$value['video'])}}" width=150 height=120 ></video>
                    </td>
                    <td>
                        {{$value['title'] }}
                    </td>
                    <td>
                        <div>{{$value['username'] }}</div>
                        <img class="mt-1" src="{{ asset('storage/images/user_photos/'.$value['user_avatar']) }}" width="50" height="50" >
                    </td>
                    <td>
                        {{$value['vlength'] }}
                    </td>
                    <td>
                        {{$value['created_at'] }}
                    </td>
                    <td>
                        <button data-id="{{ $value['id'] }}" class="btn btn-danger btn-sm " title="Delete" onclick="removeRecordVideo('{{ $value['id'] }}', '{{ $value['self_email'] }}', this)"><i class="fa fa-ban"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Record Video</th>
                <th>Title</th>
                <th>Username</th>
                <th>Length</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>
@endsection
