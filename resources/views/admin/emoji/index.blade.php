@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)
@section('style')
<link href="{{ asset('css/in_style.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        @if (getSetting('PAYMENT_MODE') == 'disabled')
            <span class="badge badge-warning p-2 mb-3">The payment mode is disabled, <a
                    href="{{ $paymentModeLink }}">enable</a> now to accept payments.</span>
        @endif
        <table class="table table-bordered table-striped table-hover">
            
            <thead>
                <a class="btn btn-primary mb-1" href="/new_emoji">New Emoji</a>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emoji as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>
                        <img class="verifyphoto" src="{{ asset('storage/images/gifts_emoji/' . $value->image ) }}" alt="{{ $value->image }}" width="50" height="50">
                    </td>
                    <td>
                        <a href="/emoji/edit/{{ $value->id }}">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                        </a>
                        <a href="/emoji/delete/{{ $value->id }}">
                            <button class="btn btn-warning btn-sm" title="Delete">
                                <i class="fa fa-ban"></i>
                            </button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Edit</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
