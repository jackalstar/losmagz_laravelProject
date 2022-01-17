@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('content')
<div class="card">
<div class="card-body">
    @if (getSetting('PAYMENT_MODE') == 'disabled')
        <span class="badge badge-warning p-2 mb-3">The payment mode is disabled, <a
                href="{{ $paymentModeLink }}">enable</a> now to make the features paid.</span>
    @endif
    <table id="features" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($features as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->description }}</td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input feature-status"
                                data-id="{{ $value->id }}" id="customSwitch{{ $value->id . 'status' }}"
                                {{ $value->status == 'active' ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="customSwitch{{ $value->id . 'status' }}"></label>
                        </div>
                    </td>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input feature-paid"
                                data-id="{{ $value->id }}" id="customSwitch{{ $value->id . 'paid' }}"
                                {{ $value->paid == 'yes' ? 'checked' : '' }}>
                            <label class="custom-control-label"
                                for="customSwitch{{ $value->id . 'paid' }}"></label>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Paid</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>
@endsection
