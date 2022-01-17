@extends('layouts.admin')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('style')
    <link href="{{ asset('css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <form id="emojiEdit">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <h1>{{ $model->name }}</h1>
                        <input type="hidden" id="id" value="{{ $model->id }}">
                        <label>Emoji Name</label>
                        <input type="text" id="name" value="{{ $model->name }}" class="form-control" required>
                        
                        <div class="fileinput fileinput-new" data-provides="fileinput">
        					<div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
        						<img class="verifyphoto" src="{{ asset('storage/images/gifts_emoji/' . $model->image ) }}" alt="{{ $model->image }}" width="200" height="200">
        					</div>
        					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;">
        					</div>
        					<div>
        						<span class="btn default btn-file">
        							<span class="fileinput-new btn btn-primary">Select image </span>
        							<span class="fileinput-exists btn btn-warning">	Change </span>
        							<input type="file" name="..." id="image" required>
        						</span>
        						<a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove </a>
        					</div>
        				</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="callout callout-info">
                            <h5>Description</h5>
                            <p>Some text is here about editing Emoji.</p>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="emojisave" class="btn btn-primary">Save</button>
            <a href="{{ route('emoji') }}"><button type="button" class="btn btn-default">Cancel</button></a>
        </form>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('js/bootstrap-fileinput.js') }}"></script>
@endsection
