@extends('layouts.dashboard')

@section('page', $page)
@section('title', getSetting('APPLICATION_NAME') . ' | ' . $page)

@section('style')
<link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/home_extra.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-fileinput.css') }}" rel="stylesheet">
<style>
    :root {
    --white-bg: #fff;
    --card-bg: #fff;
    --font-color: #1d253b;
    --bg-color: #f5f6fa;
    --box-shadow-color: #838384;
    --borderbox-color: #efefef;
    --btn-font: #ffffff;
    --border-color: #c5c5c5;
}

[data-theme="dark"] {
    --white-bg: #27293d;
    --card-bg: #e2e4e9;
    --font-color: #fff;
    --bg-color: #1e1e2d;
    --border-color: #3d3d46;
    --box-shadow-color: #292943;
    --btn-font: #ffffff;
    --borderbox-color: #33354e;
}
    .dropbtn1 {
        cursor: pointer;
    }
    .dropdown1 {
      position: relative;
      display: inline-block;
    }
    .dropdown-content1 {
      display: none;
      position: absolute;
      top: 35px;
      left: -7px;
      background-color: var(--bg-color);
      min-width: 450px;
      overflow: auto;
      box-shadow: 5px 10px 18px #888888;
      z-index: 4;
    }
    .dropdown-content1 a {
      color: {{ getSetting('THEME_COLOR') }};
      text-decoration: none;
      display: block;
    }
    .dropbtn2 {
        cursor: pointer;
    }
    .dropdown2 {
      position: relative;
      display: inline-block;
    }
    .dropdown-content2 {
      display: none;
      position: absolute;
      top: 35px;
      right: 10px;
      background-color: var(--bg-color);
      min-width: 300px;
      overflow: auto;
      box-shadow: 5px 10px 18px #888888;
      z-index: 4;
    }
    
    .dropdown-content2 a {
      color: {{ getSetting('THEME_COLOR') }};
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    .dropbtn3 {
        cursor: pointer;
    }
    .dropdown3 {
      position: relative;
      display: inline-block;
    }
    .dropdown-content3 {
      display: none;
      position: absolute;
      top: 35px;
      right: 0px;
      background-color: var(--bg-color);
      min-width: 600px;
      padding: 5px;
      border-radius: 20px;
      overflow: auto;
      box-shadow: 5px 10px 18px #888888;
      z-index: 4;
    }
    
    .dropdown-content3 a {
      color: {{ getSetting('THEME_COLOR') }};
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    
    .dropbtn4 {
        cursor: pointer;
    }
    .dropdown4 {
      position: relative;
      display: inline-block;
    }
    .dropdown-content4 {
        display: none;
        position: absolute;
        top: -255px;
        right: 150px;
        background-color: var(--bg-color);
        width: 538px;
        height: 244px;
        padding: 0px 10px;
        border-radius: 10px;
        overflow: auto;
        box-shadow: 5px 10px 18px #888888;
        z-index: 4;
    }
    
    .dropdown-content4 a {
      color: {{ getSetting('THEME_COLOR') }};
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }
    .show {display: block;}
    .carousel-indicators {
        bottom: 35px;
    }
    .carousel-indicators li {
        border: 1px solid #323daf;
        width: 40px;
        height: 40px;
        text-indent: 0px;
        opacity: 1;
        background-color: transparent;
        border: none;
    }
    .carousel-indicators .active{
        display:flex;
    }
    .story_title {
        position: absolute;
        top: 5px;
        left: 5px;
    }
    .story_title p {
        color: white;
        margin: 2px;
    }
    .story_title p:first-child {
        font-size: 16px;
        font-weight: bold;
    }
    .story_img {
        border-radius: 5px;
    }
    .story-btn {
        position: absolute;
        bottom: 50px;
        left: 50%;
    }
    .callout {
        background-color: var(--white-bg);
    }
</style>
@endsection

@section('content')

<div id="camera" class="pagecontent">
    <section class="dashboard">
    <div id="permission"></div>
    <canvas id="canvas" class="hide"></canvas>
    <div class="container-fluid main video-dask">
        <div class="row">
            @if (getFeature('VIDEO_CHAT', 'status') == 'active')
                <div class="col-12 col-md-4 col-lg-3 video-section pr-0">
                    <div class="remote-video-container">
                        <div class="remote-user-info hide">
                            <img id="partnerCountryVideo" src="" alt="Country Flag" width="25" />
                            <span id="partnerName"></span>
                            <p style="margin-bottom: 0px;" id="capture_timer"></p>
                        </div>
                        <button class="action-video report hide" data-toggle="tooltip" data-placement="top" title="Report">
                            <i class="fa fa-flag"></i>
                        </button>    
                        <video id="remoteVideo" autoplay playsinline></video>
                        <i class="fa fa-video video-load-icon"></i>
                    </div>
                    <div class="local-video-container">
                        <video id="localVideo_m" muted autoplay playsinline></video>
                        <i class="fa fa-video video-load-icon"></i>
                        <div class="video-actions">
                            <button class="action-video video-off" data-toggle="tooltip" data-placement="top"
                                title="Camera Off"><i class="fa fa-video"></i></button>
                            <button class="action-video hide video-on" data-toggle="tooltip" data-placement="top"
                                title="Camera On"><i class="fa fa-video-slash"></i></button>
                            <button class="action-video audio-mute" data-toggle="tooltip" data-placement="top"
                                title="Mute Audio"><i class="fa fa-microphone"></i></button>
                            <button class="action-video hide audio-unmute" data-toggle="tooltip" data-placement="top"
                                title="Unmute Audio"><i class="fa fa-microphone-slash"></i></button>
                            <button class="action-video rotate" data-toggle="tooltip" data-placement="top"
                                title="Rotate Camera"><i class="fa fa-camera"></i></button>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12 {{ getFeature('VIDEO_CHAT', 'status') == 'active' ? 'col-md-8 col-lg-9' : 'col-md-12 col-lg-12 text-chat-panel' }} chat-main">
                <div class="row d-flex align-items-center">
                    <!-- call button options :: start -->
                    <div class="col-12 text-center chat-section">
                        <div class="btn-actions">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-4 col-lg-5 pr-0 text-left">
                                    <span class="mb-0 mt-0">
                                        <img id="partnerCountryText" class="d-none mr-1" src="images/globe.png"
                                            alt="Country Flag" width="25" />
                                    </span>
                                    @guest
                                    @else
                                        <!--
                                        @if (getFeature('TEXT_CHAT', 'status') == 'active' && Auth::user()->text_chat == 'allow')
                                            <button id="text" class="btn btn-theme" title="Text chat">
                                                <i class="fa fa-comments"></i>
                                                <span class="d-none d-lg-inline-block">Text</span>
                                            </button>
                                        @endif
                                        -->
                                        @if (getFeature('VIDEO_CHAT', 'status') == 'active' && Auth::user()->video_chat == 'allow')
                                            @if (Auth::user()->gender == 'woman' && Auth::user()->verify != 'verified')
                                                <button id="video" class="btn btn-theme" title="Video chat" disabled>
                                                    <i class="fa fa-video"></i>
                                                    <span class="d-none d-lg-inline-block">Start</span>
                                                </button>
                                            @else
                                                <button id="video" class="btn btn-theme" title="Video chat">
                                                    <i class="fa fa-video"></i>
                                                    <span class="d-none d-lg-inline-block">Start</span>
                                                </button>
                                            @endif
                                        @endif
                                        
                                    @endguest
                                    
                                    <button id="stop" class="btn btn-theme hide" title="Stop this chat">
                                        <i class="fa fa-stop"></i>
                                        <span class="d-none d-lg-inline-block">Stop</span>
                                    </button>
                                    <button id="next" class="btn btn-theme hide search-next" title="Search for a new friend">
                                        <i class="fa fa-random"></i>
                                        <span class="d-none d-lg-inline-block">Next</span>
                                    </button>
                                    <button id="add_friend" class="btn btn-theme hide add-friend" title="Add this user as friend">
                                        <i class="fa fa-plus"></i>
                                        <span class="d-none d-lg-inline-block">Add</span>
                                    </button>
                                </div>
                                
                                <div class="col-4 col-md-8 col-lg-7 pl-0 text-right filter-options">
                                    <!--@if (getFeature('GENDER_FILTER', 'status') == 'active')
                                        <label class="mb-0"><i class="fa fa-users"></i></label>
                                        <select id="genderFilter">
                                            <option value="">Gender: All</option>
                                            <option value="man">Man</option>
                                            <option value="woman">Woman</option>
                                        </select>
                                    @else
                                        <select id="genderFilter" hidden></select>
                                    @endif-->
                                    @if (getFeature('COUNTRY_FILTER', 'status') == 'active')
                                        <label class="ml-2 mb-0"><i class="fa fa-flag"></i></label>
                                        <select id="countryFilter">
                                            <option value="">Country: All</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->code }}">
                                                    {{ $country->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select id="countryFilter" hidden></select>
                                    @endif 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- call button options :: end -->
    
                    <!-- chat area :: start -->
                    <div class="col-12 chat-area">
                        <!-- about us  :: start -->
                        <div class="about camera-about">
                            @guest
                            @else
                            @if ( Auth::user()->gender == 'woman' && (Auth::user()->verify == 'verified') || Auth::user()->gender == 'man')
                            <h4 class="recently-chat-history">Recent Chat History<button class="btn btn-danger ml-3 " onclick="videohalldelete()"><i class="fa fa-ban mr-1"></i>Delete All</button></h4> 
                            
                            <ul class="video-history" id="video_history">
                            </ul>
                            @endif
                            <div id="verify_plan_btn" class="mt-5">
                                @if ( Auth::user()->gender == 'woman' && (Auth::user()->verify == 'none'))
                                    <p>Please <strong class="text-danger">verify</strong> with three photo to use this app</p>
                                    <button class="btn btn-primary" data-target="#verify_modal" data-toggle="modal" onclick="getWomenPhotoes ()">Verify</button>
                                @elseif ( Auth::user()->gender == 'woman' && (Auth::user()->verify == 'uploaded'))
                                    <p>Your three photo is already uploaded. If you want to update, please click this <strong class="text-danger">update</strong> button.</p>
                                    <button class="btn btn-primary" data-target="#verify_modal" data-toggle="modal" onclick="getWomenPhotoes ()">Update</button>
                                @endif
                            </div>
                            @endguest
                        </div>
                        <!-- about us  :: end -->
                        <!-- chat panel :: starts -->
                        <div class="chat-panel hide">
                            <div class="chat-box">
                                <div class="chat-body video-chat-body"></div>
                                <div class="chat-footer">
                                    <form id="chatForm">
                                        <div class="input-group">
                                            <input type="text" id="messageInput" class="form-control note-input"
                                                placeholder="Type a message..." autocomplete="off" maxlength="100"
                                                disabled />
                                            <div class="input-group-append">
                                                <button id="send" class="btn btn-outline-secondary" type="submit"
                                                    title="Send" disabled>
                                                    <i class="far fa-paper-plane"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- chat panel :: end -->
                    </div>
                    <!-- chat area :: end -->
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
<div id="text" class="pagecontent" style="display:none">
    <section class="dashboard">
    <div class="container-fluid main video-dask">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="row">
                    <!-- call button options :: start -->
                    <div class="col-12 text-center chat-section">
                        <div class="btn-actions">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-4 col-lg-5 pr-0 text-left">
                                    @guest
                                    @else
                                    <div class="dropdown1">
                                      <a onclick="myFunction1()" class="dropbtn1">All friends</a>
                                      <div id="myDropdown1" class="dropdown-content1 ">
                                        <a href="#" onclick="paintContacts('all');">All friends</a>
                                        <a href="#" onclick="paintContacts('online');">Friends online</a>
                                        <a href="#" onclick="paintContacts('favourite');">Favourites</a>
                                        <a href="#" onclick="paintContacts('unread');">Unread</a>
                                        <a href="#" onclick="paintContacts('block');">Blocked friends</a>
                                      </div>
                                    </div>
                                    @endguest
                                </div>
                                
                                <div class="col-4 col-md-8 col-lg-7 pl-0 text-right filter-options">
                                    @guest
                                    @else
                                        <a class="btn " title="Text chat" >
                                            <i class="fa fa-search"></i>
                                        </a>
                                        <a class="btn " title="Text chat" >
                                            <i class="fa fa-check-circle"></i>
                                        </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- call button options :: end -->
                    <!-- contact area :: start -->
                    <div class="col-12 chat-area">
                        <!-- about us  :: start -->
                        <div class="about">
                            <ul class="contact_users" id="contact_users">
                                
                            </ul>
                        </div>
                        <!-- about us  :: end -->
                    </div>
                    <!-- contact area :: end -->
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-9 chat-main">
                <div class="row d-flex align-items-center">
                    <!-- call button options :: start -->
                    <div class="col-12 text-center chat-section">
                        <div class="btn-actions">
                            <div class="row">
                                <div class="col-8 col-md-4 col-lg-5 pr-0 text-left">
                                    @guest
                                    @else
                                    <div class="row col-md-6" id="chat-field-actor">
                                        <h6>Welcome {{Auth::user()->username}}</h6>
                                    </div>
                                        
                                    @endguest
                                </div>
                                
                                <div class="col-4 col-md-8 col-lg-7 pl-0 text-right filter-options" id="filter-options1">
                                    @guest
                                    @else
                                        <a class="btn " title="Call" data-target="#call_offer_modal" data-toggle="modal">
                                            <i class="fa fa-phone"></i>
                                        </a> 
                                        @if (Auth::user()->gender == 'man')
                                        <div class="dropdown3">
                                            <p><a onclick="myFunction3()"   title="Gift" ><img class="dropbtn3" src="storage/images/source_img/gift.png" width=25 height=25 ></a></p>
                                            <div id="myDropdown3" class="dropdown-content3 ">
                                                <div class="row gift-field" >
                                                @foreach ($gifts as $key => $value )
                                                <div class="col-sm-3 gift one-gift">
                                                    <input type="hidden" value="{{$value['id']}}" >
                                                    <img class="gifts-images" src="{{asset('storage/images/gifts_emoji/' . $value['image']) }}" width=100 height=100>
                                                    <h4 class="mt-3">{{$value['name']}}</h4>
                                                    <p>Cost:</p> <p> {{$value['cost_minute']}} minutes</p>
                                                </div>
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>    
                                        @endif
                                        <a class="btn " title="Bookmark" >
                                            <i class="fa fa-bookmark"></i>
                                        </a>    
                                        <div class="dropdown2">
                                            <p><a onclick="myFunction2()" class="dropbtn2">...</a></p>
                                            <div id="myDropdown2" class="dropdown-content2 ">
                                                <a style="color: var(--primary-color); cursor: pointer; " onclick="toggleFav();" id="togglefavbtn"></a>
                                                <a href="#report_modal" data-toggle="modal">Report</a>
                                                <a href="#clear_history_modal" data-toggle="modal">Clear chat</a>
                                                <a style="color: var(--primary-color); cursor: pointer; " onclick="toggleBlock();" id="toggleblockbtn"></a>
                                                <a href="#delete_partner_modal" data-toggle="modal">Delete contact</a>
                                            </div>
                                        </div>    
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- call button options :: end -->
    
                    <!-- chat area :: start -->
                    <div class="col-12 chat-area">
                        <!-- chat panel :: starts -->
                        <div class="text-chat-panel">
                            <div class="chat-box">
                                <input type="hidden" id="field_read_scroll">
                                <input type="hidden" id="field_read_state">
                                <input type="hidden" id="from_field">
                                <input type="hidden" id="to_field">
                                <div class="chat-body text-chat-body" id="text-chat-body" onscroll="readMessageByScrolling();">
                                    <img class="" src="storage/images/source_img/chat_home.png" >
                                </div>
                                @guest
                                @else
                                <div class="chat-footer" id="chat-footer">
                                    <h4 id="block_label" class="">You are blocked from this user</h4>
                                    <form id="textchatForm" class="row">
                                        <div class="input-group">
                                            <a class="btn btn-theme" title="Take a video" id="take_video_btn"  data-target="#take_video_modal" data-toggle="modal">
                                                <i class="fa fa-video"></i>
                                            </a>
                                            <a class="btn btn-theme" title="Take a photo" id="take_photo_btn"  data-target="#take_photo_modal" data-toggle="modal">
                                                <i class="fa fa-camera"></i>
                                            </a>
                                            <a class="btn btn-theme" title="Upload photo"  data-target="#upload_photo_modal" data-toggle="modal">
                                                <i class="fa fa-upload"></i>
                                            </a>
                                            <a class="btn btn-theme" title="Translator" data-target="#translate_modal" data-toggle="modal">
                                                <i class="fa fa-language"></i>
                                            </a>
                                            <input type="text" id="textmessageInput" class="form-control note-input" placeholder="Type a message..." autocomplete="off" style="padding-left: 10px;" />
                                            <div class="input-group-append">
                                                <button id="textsend" class="btn btn-outline-secondary" type="submit" title="Send" >
                                                    <i class="far fa-paper-plane"></i>
                                                </button>
                                            </div>
                                            <div class="dropdown4">
                                                <a onclick="myFunction4()" class="btn dropbtn4"  title="Emoji chat" ><img src="storage/images/source_img/emoji_btn.png" width=30 height=30></a>
                                                <div id="myDropdown4" class="dropdown-content4 ">
                                                    <div class="row" >
                                                    @foreach ($emoji as $key => $value )
                                                    <div class="emoji one-emoji" title="{{$value['name']}}">
                                                        <input type="hidden" value="{{$value['id']}}" >
                                                        <img class="contact_avatar" src="{{asset('storage/images/gifts_emoji/' . $value['image']) }}" width=50 height=50>
                                                    </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endguest
                            </div>
                        </div>
                        <!-- chat panel :: end -->
                    </div>
                    <!-- chat area :: end -->
                </div>
            </div>
        </div>
    </div>
    </section>
</div>    
@guest
@else
@if (Auth::user()->gender == 'woman')
<div id="record_video" class="pagecontent" style="display:none">
    <section class="dashboard">
    <div id="permission"></div>
    <canvas id="canvas" class="hide"></canvas>
    <div class="container-fluid main video-dask">
        <div class="row">
            @if (getFeature('VIDEO_CHAT', 'status') == 'active')
                <div class="col-12 col-md-4 col-lg-3 video-section pr-0">
                    <div class="record-video-container">
                        <div class="record-loader loader--style1" style="display: none;">
                    		<div class="row record-loader-row">
                    			<i class="fa fa-spinner"></i>
                    		</div>
                    	</div>
                    	<div class="preview-record-video" id="preview-record-video" style="display: none;"></div>
                        <div class="remote-user-info">
                            <p style="margin-bottom: 0px;" id="re_record_timer"></p>
                        </div>
                        <video id="localVideo_r" muted autoplay playsinline></video>
                        <i class="fa fa-video record-video-load-icon"></i>
                        <div class="record-video-actions">
                            <button class="action-video video-off" data-toggle="tooltip" data-placement="top"
                                title="Camera Off"><i class="fa fa-video"></i></button>
                            <button class="action-video hide video-on" data-toggle="tooltip" data-placement="top"
                                title="Camera On"><i class="fa fa-video-slash"></i></button>
                            <button class="action-video audio-mute" data-toggle="tooltip" data-placement="top"
                                title="Mute Audio"><i class="fa fa-microphone"></i></button>
                            <button class="action-video hide audio-unmute" data-toggle="tooltip" data-placement="top"
                                title="Unmute Audio"><i class="fa fa-microphone-slash"></i></button>
                            <button class="action-video record-rotate" data-toggle="tooltip" data-placement="top"
                                title="Rotate Camera"><i class="fa fa-camera"></i></button>
                        </div>
                    </div>
                    <div>
                        <label>Title </label>
                        <input type="text" id="record_title" value="" class="form-control"  placeholder="Enter Value" maxlength="255" required>
                    </div>
                </div>
            @endif
            <div class="col-12 {{ getFeature('VIDEO_CHAT', 'status') == 'active' ? 'col-md-8 col-lg-9' : 'col-md-12 col-lg-12 text-chat-panel' }} chat-main">
                <div class="row d-flex align-items-center">
                    <!-- record button options :: start -->
                    <div class="col-12 text-center chat-section">
                        <div class="btn-actions">
                            <div class="row align-items-center">
                                <div class="col-8 col-md-4 col-lg-5 pr-0 text-left">
                                    @guest
                                    @else
                                    <button id="record_start" class="btn btn-theme" title="Record video" disabled>
                                        <i class="fa fa-video"></i>
                                        <span class="d-none d-lg-inline-block">Start</span>
                                    </button>
                                    <button id="record_stop" class="btn btn-theme hide" title="Stop this record">
                                        <i class="fa fa-stop"></i>
                                        <span class="d-none d-lg-inline-block">Stop</span>
                                    </button>
                                    <button id="record_save" class="btn btn-theme hide" title="Save record video">
                                        <i class="fa fa-save"></i>
                                        <span class="d-none d-lg-inline-block">Save</span>
                                    </button>
                                    <button id="record_cancel" class="btn btn-theme hide" title="Cancel">
                                        <i class="fa fa-close"></i>
                                        <span class="d-none d-lg-inline-block">Cancel</span>
                                    </button>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- record button options :: end -->
                    <!-- record video area :: start -->
                    <div class="col-12 chat-area">
                        <div class="about record-about">
                            <h4 class="record_story_title mt-5"></h4> 
                            <ul class="record-video-ul" id="record-video-ul"></ul>
                        </div>
                    </div>
                    <!-- record video area :: end -->
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
@elseif(Auth::user()->gender == 'man')
<div id="view_stories" class="pagecontent" style="display:none">
    <section class="dashboard">
        <div class="row d-flex align-items-center">
            <!-- video stories area :: start -->
            <div class="col-12 chat-area">
                <h4 class="recently-chat-history">Interesting Stories</h4> 
                <div class="col-md-12">
                    <div class="video-stories-ul" >
                        <div id="demo" class="carousel slide carousel-fade" data-ride="carousel" ></div>
                    </div> 
                </div>
            </div>
            <!-- video stories area :: end -->
        </div>
    </section>
</div>
@endif
@endguest

    <!-- verify modal starts -->
    <div class="modal fade" id="verify_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">Verify Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="verifyPhotoform">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label> First question:</label>
                            <label> First question First question First question</label>
                            <input type="file" id="firstphoto" value="$firstphoto->value" class="form-control" >
                        </div> 
                        <div class="col-sm-4">
                            <label>Preview</label>
                            <div class="preview" id="photo1">
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Second question:</label>
                            <label> Second question Second question Second question </label>
                            <input type="file" id="secondphoto" value="$secondphoto->value" class="form-control" >
                        </div>
                        <div class="col-sm-4">
                            <label>Preview</label>
                            <div class="preview" id="photo2">
                            </div>
                        </div>
                    </div>
                     
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Third question:</label>
                            <label> Third question Third question Third question </label>
                            <input type="file" id="thirdphoto" value="$thirdphoto->value" class="form-control" >
                        </div>
                        <div class="col-sm-4">
                            <label>Preview</label>
                            <div class="preview" id="photo3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="savephoto" class="btn btn-primary">Save Photo</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <!-- verify modal ends -->
    <!-- withdraw modal starts -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Withdraws</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <h4 class="text-center">
                        You have <strong style="color: pink" id="woman_points"></strong> points.
                    </h4>
                    <div id="alertplace"></div>
                    <div class="form-group">
                        <div class="tab">
                            <button id="visa_btn" class="tablinks active" onclick="openPayment(event, 'visa')">
                                <img src="{{ asset('storage/images/source_img/visaicon.png') }}" width="110" height="40" alt="visa">
                            </button>
                            
                            <button id="paypal_btn" class="tablinks" onclick="openPayment(event, 'paypal')">
                                <img src="{{ asset('storage/images/source_img/paypalicon.png') }}" width="45" height="40" alt="paypal">aypal
                            </button>
                        </div>
                        <div id="visa" class="tabcontent" style="display:block">
                            <form id="visaForm">
                                <label class="col-md-4 col-form-label">Account Name</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="account_name" required >
                                </div>
        
                                <label class="col-md-4 col-form-label">BSB Number</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control card-number" id="bsb_number" min="0" size="20"  required>
                                </div>
                                
                                <label class="col-md-4 col-form-label">Account Number</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control card-number" id="account_number" min="0" size="20"  required>
                                </div>
                                <div class="row m-3 d-flex justify-content-end">
                                    <button type="submit" id="visawithdraw" class="btn btn-theme"> Withdraw </button>
                                </div>
                            </form>
                        </div>
                        
                        <div id="paypal" class="tabcontent">
                            <form id="paypalForm">
                                <label class="col-md-4 col-form-label">Paypal email</label>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" id="paypal_email" required>
                                </div>
                                <div class="row m-3 d-flex justify-content-end">
                                    <button type="submit" id="paypalwithdraw" class="btn btn-theme"> Withdraw </button>    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- withdraw modal ends -->
    <!-- withdraw success modal starts -->
    <div class="modal fade" id="withdrawSuccessModal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Welcome</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body terms_modal">
                    <h6 class="m-3" style="color: {{ getSetting('THEME_COLOR') }}">Thank you, admin will review and send the money in 3 bussiness days</h6>        
                </div>
                <div class="modal-footer">
                    <button type="submit" id="ok-btn" class="btn btn-theme">Ok</button>
                </div>
                
            </div>
        </div>
    </div>
    <!-- withdraw success modal ends -->
    <!-- contact request modal starts -->
    <div class="modal fade" id="contactRequestModal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Friend Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center" id="contact_request_avatar">
                        
                    </div>
                    <div class="row d-flex justify-content-center">
                        <h5 id="request_self_username"></h5>
                        <input type="hidden" id="request_self_email">
                        <input type="hidden" id="request_partner_email">
                    </div>
                    <div class="row d-flex justify-content-center mt-3">
                        <button type="button" class="btn btn-warning decline_request_btn">Decline</button>   
                        <button type="button" class="btn btn-primary ml-3 accept_request_btn">Accept</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact request modal ends -->
    <!-- translate modal starts -->
    <div class="modal fade" id="translate_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="top: -250px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Translate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="translateForm">
                    <div class="modal-body">
                        <select id="languageFilter" class="form-control">
                            <option value="">Select Language</option>
                            @foreach ($languages as $language)
                                <option value="{{ $language->lang_code }}">
                                    {{ $language->lang_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="trans_modal_cancel" class="btn btn-theme">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- translate modal ends -->
    <!-- upload photo modal starts -->
    <div class="modal fade" id="upload_photo_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Upload photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadPhotoForm">
                    <div class="modal-body">
                        <div class="form-group d-flex flex-column align-items-center">
                            <h3>Upload photo</h3>
                            <p>File should not be bigger than 5MB</p>
                            <div class="fileinput fileinput-new" data-provides="fileinput" style="width: 60%;">
            					<div class="fileinput-new thumbnail" style="width: 100%; height: 100%;">
            						<img class="verifyphoto" src="storage/images/user_photos/stranger.jpg" alt="" >
            					</div>
            					<div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%; height: 100%;">
            					</div>
            					<div>
            						<span class="btn default btn-file">
            							<span class="fileinput-new btn btn-primary">Select image </span>
            							<span class="fileinput-exists btn btn-warning">	Change </span>
            							<input type="file" name="..." id="uploadimage">
            						</span>
            						<a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove </a>
            					</div>
            				</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="uploadphotostart" class="btn btn-theme">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- upload photo modal ends -->
    <!-- take photo modal starts -->
    <div class="modal fade" id="take_photo_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Take photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="takePhotoForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" id="photo_id">
                            <div class="local-video-container" id="local-video-container">
                                <div id="preview_video_part" class="preview-photo round-10 ">
                                    <video id="localVideo" muted autoplay playsinline></video>
                                </div>
                                <div id="preview_photo_part" class="preview-photo round-10 ">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-theme take-photo ">Take a photo</button>
                        <div class="take-photo-hide " id="two_method" >
                            <button type="submit" id="photo_send_start" class="btn btn-theme mr-3 ">Send</button>
                            <button type="button" id="photo_take_another" class="btn btn-theme">Take another</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- take photo modal ends -->
    <!-- view photo modal starts -->
    <div class="modal fade" id="view_photo_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 678px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">View photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="view_photo"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="photo_view_close" class="btn btn-theme mr-3">close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- view photo modal ends -->
    
    <!-- take video modal starts -->
    <div class="modal fade" id="take_video_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Video Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="takeVideoForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5 id="record_timer">Minimum video length is 5 seconds</h5>
                            <div class="local-video-container">
                                <div id="preview_record1_part" class="preview-photo round-10 ">
                                    <video id="localVideo1" muted autoplay playsinline></video>
                                    <div class="video-actions" id="take-video-actions">
                                        <button class="action-video video-off" data-toggle="tooltip" data-placement="top"  title="Camera Off"><i class="fa fa-video"></i></button>
                                        <button class="action-video hide video-on" data-toggle="tooltip" data-placement="top"  title="Camera On"><i class="fa fa-video-slash"></i></button>
                                        <button class="action-video audio-mute" data-toggle="tooltip" data-placement="top" title="Mute Audio"><i class="fa fa-microphone"></i></button>
                                        <button class="action-video hide audio-unmute" data-toggle="tooltip" data-placement="top" title="Unmute Audio"><i class="fa fa-microphone-slash"></i></button>
                                        <button class="action-video rotate" data-toggle="tooltip" data-placement="top" title="Rotate Camera"><i class="fa fa-camera"></i></button>
                                    </div>
                                </div>
                                <div id="preview_record2_part" class="preview-photo round-10 ">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-theme take-video-start ">Start Recording</button>
                        <button type="button" class="btn btn-theme take-video-stop take-photo-hide ">Stop Recording</button>
                        <div class="take-photo-hide " id="two_video_method" >
                            <button type="button" id="video_send_start" class="btn btn-theme mr-3 ">Send</button>
                            <button type="button" id="video_take_another" class="btn btn-theme">Take another</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- take video modal ends -->
    <!-- clear history modal starts -->
    <div class="modal fade" id="clear_history_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Confirm clearing your chat history!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="clearChatHistoryForm">
                    <div class="modal-body">
                        <img class="contact_avatar" src="storage/images/source_img/chat_history_clear.png" >    
                        <p>Confirm clearing your chat history!</p>
                        <div class="form-group">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="clear_start" class="btn btn-theme">Confirm</button>
                        <button type="button" id="clear_cancel" class="btn btn-theme">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- clear history modal ends -->
    <!-- delete partner modal starts -->
    <div class="modal fade" id="delete_partner_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Confirm chat partner deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deletePartnerForm">
                    <div class="modal-body">
                        <div style="margin:auto;" id="delete_contact_avatar">
                            
                        </div>
                        <div class="form-group">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="contact_delete_start" class="btn btn-theme">Confirm</button>
                        <button type="button" id="contact_delete_cancel" class="btn btn-theme">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete partner modal ends -->
    <!-- report modal starts -->
    <div class="modal fade" id="report_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Report a violation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="reportForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="report_avatar"></div>
                            <label>
                                <input type="radio" name="report_radio" value="Spam" checked>  <span>Spam</span>
                            </label><br>
                            <label>
                                <input type="radio" name="report_radio" value="CSS">  <span>Nudity or pornography</span>
                            </label><br>
                            <label>
                                <input type="radio" name="report_radio" value="HTML">  <span>Child endangerment (exploitation)</span>
                            </label><br>
                            <label>
                                <input type="radio" name="report_radio" value="CSS">  <span>Harassment or threats</span>
                            </label><br>
                            <label>
                                <input type="radio" name="report_radio" value="JavaScript">  <span>Deception / Deception for gifts</span>                        
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="report_start" class="btn btn-theme">Confirm</button>
                        <button type="button" id="report_cancel" class="btn btn-theme">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- report modal ends -->
    <!-- direct call modal starts -->
    <div class="modal fade" id="call_offer_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <input type="hidden" id="parnter_avatar_name">
                    <input type="text" id="videoPartnerEmail">
                    <input type="text" id="videoPartnerAvatar">
                    <div class="d-flex justify-content-center" id="call_offer_partner_avatar"></div>
                    <div class="d-flex justify-content-center" id="call_offer_partner_name"></div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" id="call_offer_start" class="btn btn-theme">Call</button>
                    <button type="button" id="call_offer_cancel" class="btn btn-theme">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- direct call  modal ends -->
    <!-- direct call modal starts -->
    <div class="modal fade" id="call_answer_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>I have a request for calling </p>
                    <input type="text" id="call_from_email">
                    <div class="d-flex justify-content-center" id="call_answer_partner_avatar"></div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" id="call_answer_accept" class="btn btn-theme">Accept</button>
                    <button type="button" id="call_answer_cancel" class="btn btn-theme">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- direct call  modal ends -->
@endsection

@section('script')
<script src="{{ asset('js/socket.io.js') }}"></script>
<script src="{{ asset('js/adapter.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
<script src="{{ asset('js/home_extra.js') }}"></script>
<script src="{{ asset('js/bootstrap-fileinput.js') }}"></script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
jQuery(document).ready(function() {    
    document.getElementById('filter-options1').style.display = 'none';
    document.getElementById('chat-footer').style.display = 'none';
    paintVideoHistory();
});
</script>
<script type="text/javascript">
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction1() {
      document.getElementById("myDropdown1").classList.toggle("show");
    }
    function myFunction2() {
      document.getElementById("myDropdown2").classList.toggle("show");
    }
    function myFunction3() {
      document.getElementById("myDropdown3").classList.toggle("show");
    }
    function myFunction4() {
      document.getElementById("myDropdown4").classList.toggle("show");
    }
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        
        if (document.getElementsByClassName('message-dropdown')[0].contains(event.target) || document.getElementsByClassName('announcement-dropdown')[0].contains(event.target)){
            
        } else{
            // outside
            var li_div1 = document.querySelector('.announcement-dropdown').parentNode.children;
            if(li_div1[1].style.display == 'block') li_div1[1].style.display = 'none';
            
            var li_div2 = document.querySelector('.message-dropdown').parentNode.children;
            if(li_div2[1].style.display == 'block') li_div2[1].style.display = 'none';
        }
        
        var res = event.target.matches('.dropbtn1, .dropbtn2');
        
        if (!res){
        
            var openDropdown1 = document.getElementById("myDropdown1");
            if (openDropdown1.classList.contains('show')){
                openDropdown1.classList.remove('show');
            }
            var openDropdown2 = document.getElementById("myDropdown2");
            if (openDropdown2.classList.contains('show')){
                openDropdown2.classList.remove('show');
            }
        }
    }
    
</script>
@endsection
