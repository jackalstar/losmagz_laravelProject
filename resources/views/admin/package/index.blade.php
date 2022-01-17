@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('content')
<div class="card">
<div class="card-body">
    @if (getSetting('PAYMENT_MODE') == 'disabled')
        <span class="badge badge-warning p-2 mb-3">The payment mode is disabled, <a
                href="{{ $paymentModeLink }}">enable</a> now to accept payments.</span>
    @endif
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Currency</th>
                <th>Minute</th>

                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packages as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->package_name }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{ $value->currency }}</td>
                    <td>{{ $value->minute }}</td>
                    <td>
                        <a href="/packages/edit/{{ $value->id }}">
                            <button class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i>
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
                <th>Price</th>
                <th>Currency</th>
                <th>Minute</th>

                <th>Edit</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>
@endsection
