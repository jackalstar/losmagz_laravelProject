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
                <a class="btn btn-primary mb-1" href="/new_gift">New Gift</a>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Cost</th>
                    <th>Receive</th>
                    <th>Image</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gifts as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->cost_minute }}</td>
                    <td>{{ $value->receive_minute }}</td>
                    <td>
                        <img class="verifyphoto" src="{{ asset('storage/images/gifts_emoji/' . $value->image ) }}" alt="{{ $value->image }}" width="50" height="50">
                    </td>
                    <td>
                        <a href="/gifts/edit/{{ $value->id }}">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                        </a>
                        <a href="/gifts/delete/{{ $value->id }}">
                            <button class="btn btn-warning btn-sm">
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
                    <th>Cost</th>
                    <th>Receive</th>
                    <th>Image</th>
                    <th>Edit</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
