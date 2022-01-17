@extends('layouts.app')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('style')
    <style>
        .edit_btn {
            cursor: pointer;
            height: 30px;
        }
        #username_input {
            border-radius: 5px;
            height: 40px;
            font-size: 20px;
            padding-left: 10px;
        }
        .show_edit_username {
            display: -webkit-box;
        }
        .hide_edit_username {
            display: none;
        }
        .attatch_btn {
            width: 200px;
            height: 200px;
            display: none;
        }
        .preview-photo {
            width: 100%;
            height: 100%;
        }
        .take-photo-show {
            display: block;
        }
        .take-photo-hide {
            display: none;
        }
        .round-10 {
            border-radius: 10px;
        }
    </style>
    <link href="{{ asset('css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endsection
@section('content')

<div id="permission"></div>
<canvas id="canvas" class="hide"></canvas>
    <div class="container">
        <div class="row" id="display_username">
            <h3 class="mr-3" id="username"></h3>    
            <a class="edit_btn" id="edit_btn"><i class="fa fa-edit"></i></a>    
        </div>
        <div class="row" id="edit_username">
            
            <div class="col-md-3">
                <input type="text" class="mr-3" id="username_input">
            </div>
            <div class="col-md-3">
                <a class="edit_btn" id="edit_submit"><i class="fa fa-edit"></i></a>            
            </div>
        
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-new thumbnail" style="width: 300px; height: 300px;" id="avatar_preview">
						<img class="verifyphoto" src="{{ asset('storage/images/user_photos/' . $userPhoto ) }}" alt="{{ $userPhoto }}" width="300" height="300">
					</div>
					<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 300px;">
					</div>
					<div>
						<span class="btn default btn-file">
							<span class="fileinput-new btn btn-primary">Select image </span>
							<span class="fileinput-exists btn btn-warning">	Change </span>
							<input type="file" name="..." id="myimage">
						</span>
						<a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove </a>
					</div>
				</div>
				<div class="margin-top-10">
					<a href="" class="btn btn-success upload-photo">
					    <i class="fa fa-upload"></i>Upload 
					</a>
				    <a class="take-profile-photo btn btn-success ml-3" title="Take a photo" id="take_photo_btn"  data-target="#take_avatar_modal" data-toggle="modal">
				         <i class="fa fa-camera"></i>&nbsp Capture
                    </a>
				</div>
            </div>
        </div>
        <div class="row">
            <label for="google_translate_element">Select language</label>
            <div id="google_translate_element"></div>
        </div>
        
<!-- take photo modal starts -->
<div class="modal fade" id="take_avatar_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">Take photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="takeAvatarForm">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="avatar_name">
                        <div class="local-video-container" id="local-video-container">
                            <div id="preview_video_avatar" class="preview-photo round-10 ">
                                <video id="localVideo" muted autoplay playsinline></video>
                            </div>
                            <div id="preview_photo_avatar" class="take-photo-hide preview-photo round-10 ">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-theme take-avatar ">Take a photo</button>
                    <div class="take-photo-hide " id="two_avatar_method" >
                        <button type="submit" id="avatar_send_start" class="btn btn-theme mr-3 ">Save</button>
                        <button type="button" id="avatar_take_another" class="btn btn-theme">Take another</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- take photo modal ends -->
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/socket.io.js') }}"></script>
    <script src="{{ asset('js/adapter.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="{{ asset('js/bootstrap-fileinput.js') }}"></script>
    
    <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endsection
