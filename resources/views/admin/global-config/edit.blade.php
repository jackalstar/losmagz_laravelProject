@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('content')
<div class="card">
    <div class="card-body">
        <form id="globalConfigEdit">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>{{ $model->key }}</label>
                        <input type="hidden" id="id" value="{{ $model->id }}">
                        <input type="hidden" id="key" value="{{ $model->key }}">
                        @if ($model->key == 'THEME_COLOR')
                            <input type="color" id="value" value="{{ $model->value }}" class="form-control" required>
                        @elseif($model->key == 'LOGO' || $model->key == 'FAVICON')
                            <input type="file" id="value" value="{{ $model->value }}" class="form-control"
                                accept=".png" required>
                        @elseif($model->key == 'AUTH_MODE' || $model->key == 'PAYMENT_MODE')
                            <select id="value" class="form-control">
                                <option value="enabled" @if ($model->value == 'enabled') selected @endif>Enabled</option>
                                <option value="disabled" @if ($model->value == 'disabled') selected @endif>Disabled</option>
                            </select>
                        @elseif($model->key == 'DEFAULT_THEME')
                            <select id="value" class="form-control">
                                <option value="light" @if ($model->value == 'light') selected @endif>Light</option>
                                <option value="dark" @if ($model->value == 'dark') selected @endif>Dark</option>
                            </select>
                        @elseif($model->key == 'CURRENCY')
                            <select id="value" class="form-control">
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->code }}" @if ($model->value == $currency->code) selected @endif>
                                        {{ $currency->name . ' - ' . $currency->code . ' - ' . $currency->symbol }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <input type="text" id="value" value="{{ $model->value }}" class="form-control"
                                placeholder="Enter Value" maxlength="255" required>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="callout callout-info">
                            <h5>Description</h5>
    
                            <p>{{ $model->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
    
            @if ($model->key == 'LOGO' || $model->key == 'FAVICON')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Preview</label>
                            <div class="preview">
                                <img src="{{ asset('storage/images/' . $model->key . '.png') }}"
                                    alt="{{ $model->key }}">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    
            <button type="submit" id="save" class="btn btn-primary">Save</button>
            <a href="{{ route('global-config') }}"><button type="button" class="btn btn-default">Cancel</button></a>
        </form>
    </div>
</div>
@endsection
