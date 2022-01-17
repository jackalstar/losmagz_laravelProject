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
                <th>From</th>
                <th>To</th>
                <th>Type</th>
                <th>Content</th>
                <th>Read</th>
                <th>Delete by</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_arr as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <a href="/user-detail/edit/{{ $value['from_id'] }}">
                            <button class="btn btn-primary btn-sm">
                                {{$value['from_email'] }}
                            </button>
                        </a>
                    </td>
                    <td>
                        <a href="/user-detail/edit/{{ $value['to_id'] }}">
                            <button class="btn btn-primary btn-sm">
                                {{$value['to_email'] }}
                            </button>
                        </a>
                    </td>
                    <td>
                        {{$value['type'] }}
                    </td>
                    <td>
                        @if ($value['type'] == 'photo')
                        <img class="" src="{{asset('storage/images/captured_photo/' . $value['m_content'] )}}"  alt="{{ $value['m_content'] }}" width="200" height="180" >
                        @else
                        <video controls src="{{asset('storage/images/captured_video/' .$value['m_content'])}}" alt="{{ $value['m_content'] }}" width="200" height="180"  ></video>
                        @endif
                    </td>
                    <td>
                        {{$value['read_state'] }}
                    </td>
                    <td>
                        {{$value['clear_by'] }}
                    </td>
                    <td>
                        {{$value['created_at'] }}
                    </td>
                    <td>
                        <button data-id="{{ $value['id'] }}" class="btn btn-danger btn-sm " title="Delete" onclick="removePhotoVideoMessage('{{ $value['id'] }}', this)"><i class="fa fa-ban"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>From</th>
                <th>To</th>
                <th>Type</th>
                <th>Content</th>
                <th>Read</th>
                <th>Delete by</th>
                <th>Created at</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>
@endsection
