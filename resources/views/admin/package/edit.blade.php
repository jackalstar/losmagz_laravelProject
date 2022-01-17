@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('content')
<div class="card">
    <div class="card-body">
        <form id="packageEdit">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <h1>{{ $model->package_name }}</h1>
                        <input type="hidden" id="id" value="{{ $model->id }}">
                            <label>Package Name</label>
                            <input type="text" id="package_name" value="{{ $model->package_name }}" class="form-control" required>
                            <label>Price</label>
                            <input type="text" id="price" value="{{ $model->price }}" class="form-control" required>
                            <label>Currency</label>
                            <input type="text" id="currency" value="{{ $model->currency }}" class="form-control" required>
                            <label>Minute assigned</label>
                            <input type="text" id="minute" value="{{ $model->minute }}" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="callout callout-info">
                            <h5>Description</h5>
                            <p>Some text is here about editing Package.</p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="packagesave" class="btn btn-primary">Save</button>
            <a href="{{ route('packages') }}"><button type="button" class="btn btn-default">Cancel</button></a>
        </form>
    </div>
</div>
@endsection
