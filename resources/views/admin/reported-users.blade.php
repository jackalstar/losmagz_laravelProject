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
                <th>IP</th>
                <th>Images</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->ip }}</td>
                    <td>
                        @foreach (json_decode($value->images) as $image)
                            <img src="{{ asset('storage/images/reported-users/' . $image) }}"
                                class="reported-image" width="50px" title="View" alt="user" />
                        @endforeach
                    </td>
                    <td>
                        <button data-id="{{ $value->id }}" class="btn btn-primary btn-sm ignore"
                            title="Ignore"><i class="fa fa-minus"></i></button>
                        <button data-id="{{ $value->id }}" class="btn btn-danger btn-sm ban" title="Ban"><i
                                class="fa fa-ban"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>IP</th>
                <th>Images</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>

<div class="modal fade" id="reportedImageModal" tabindex="-1" role="dialog" aria-labelledby="reportedImageModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <img id="reportedImage">
    </div>
</div>
</div>
@endsection
