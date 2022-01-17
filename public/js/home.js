/*jshint esversion: 6 */
/*jshint esversion: 8 */
     

let socket;                                 
let reg_socket = 'not_yet';
//for text chat
let textPartnerUsername;
let textPartnerEmail;
let textPartnerStatus;
//end for text chat
(function() {
    "use strict";
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

    let connection;                             
    let localStream;   
    let partnerEmail;
    let partnerName;                            
    let partnerCountry;                         
    let partnerIp;  
    let selfIp;
    let gender;
    
    
    let timeout;
    let intervalchatID;
    let facingMode = "user";
    let initiator = false;
    let isChatConnected = false;
    let isTextChatConnected = false;
    let searching = false;                      
    let typing = false;                         
    let initiated = false;
    let allowed = false;
    let banned = false;                         
    let settings = {}; 
    let configuration = {};                     
    let womanpointmouseover = false;            
    let check_data = {};
    let all_users = {};
    let media =  {
        tag: 'video',        type: 'video/webm',        ext: '.mp4',        gUM: {video: true, audio: false}
    }
    //for video history
    var video_history_interval;
    var video_history_state = false;
    var video_history_timer = 0, start_time, end_time;
    //for video and text toggle
    let in_where = 'video';
    //for url 
    let urlRegex =
        /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;

    //get the details
    (function() {
        console.log('home js ajax before')
        $.ajax({
                url: "/get-details",
            })
            .done(function(data) {
                
                data = JSON.parse(data); 
                if (data.success) {
                    settings = data.data;
                    var mm = Math.trunc(settings.leftpoints/60);
                    $('#timer').html(mm);
                    initializeSocket(settings.signalingURL);

                    configuration = {
                        iceServers: [{
                                urls: settings.stunUrl,
                            },
                            {
                                urls: settings.turnUrl,
                                username: settings.turnUsername,
                                credential: settings.turnPassword,
                            },
                        ],
                    };
                    $("#video").attr('disabled', true);
                    $("#text_btn").attr('disabled', true);
                } else {
                    showErrorAlert("Could not get the session details.");
                }
            })
            .catch(function() {
                showErrorAlert("Could not get the session details.");
            });
    })();
    //connect to the signaling server and add listeners
    function initializeSocket(signalingURL) {
        socket = io.connect(signalingURL);
        //listen for socket message event and handle it
        socket.on("message", function(data) {
            data = JSON.parse(data);
            switch (data.type) {
                case "match":
                    handleMatch(data);
                    break;
                case "partnerLeft":
                    requestNextPartner(
                        partnerName +
                        " has left the chat, searching for a new partner..."
                    );
                    break;
                case "partnerStop":
                    requestPartnerStop(partnerName + " has stop the chat, searching for a new partner...");
                    break;
                case "offer":
                    handleOffer(data);
                    break;
                case "answer":
                    handleAnswer(data);
                    break;
                case "candidate":
                    handleCandidate(data);
                    break;
                case "message":
                    customizeSocket(data);
                    break;
                case "onlineCount":
                    handleOnlineCount(data);
                    break;
                case "offlineCount":
                    handleOfflineCount(data);
                    break;
                case "textConnected":
                    textPartnerUsername = data.textPartnerUsername;
                    textPartnerEmail = data.textPartnerEmail;
                    textPartnerStatus = data.textPartnerStatus;
                    handleTextChatConnected(data.textPartnerUsername);
                    break;
                case "typing":
                    handleTyping(data);
                    break;
                case "selfData":
                    setSelfData(data);
                    break;
                //for direct calling part
                case "callOffer":
                    handleCallOffer(data);
                    break;
                case "callOfferCancel":
                    handleCallOfferCancel(data);
                    break;
                case "callAnswerCancel":
                    handleCallAnswerCancel(data);
                    break;
                case "callAnswerAccept":
                    handleCallAnswerAccept(data);
                    break;
                //when user unread message from the others
                case "notify_unread_message": 
                    console.log('here is socket initialization part notify unread message')
                    notifyUnreadMessage(data);
                    updateRecentMessage(data.partner_email, data.message_source, data.message_trans, data.message_type);
                    console.log('here is socket paintHeaderUnreadMessage function call part')
                    paintHeaderUnreadMessage();
                    break;
            }
        });
        //handle socket disconnect event and notify the user
        // socket.on("disconnect", function(reason) {  
        //     //$("#messageInput, #send, #next").attr("disabled", true);
        //     console.log('Looks like you are disconnected, please refresh the page and try again.')
        // });
    }
    function customizeSocket(data) {
        
        switch(data.message_type){
            case "usual":
                $(".typing-dots").closest('.remote-chat').remove();
                appendMessage( data.message_source, data.message_trans, false, false);
                break;
            case "text_usual":
                $(".typing-dots").closest('.remote-chat').remove();
                updateRecentMessage(data.partner_email, data.message_source, data.message_trans, 'text');
                appendtextMessage(data.message_source, data.message_trans, false, data.read);
                
                break;
            case "text_emoji":
                $(".typing-dots").closest('.remote-chat').remove();
                appendEmojiMessage(data.message, false, false);
                updateRecentMessage(data.partner_email, data.message_source, data.message_trans, 'emoji');
                
                break;
            case "text_gift":
                $(".typing-dots").closest('.remote-chat').remove();
                appendGiftMessage(data.message, false, data.read);
                updateRecentMessage(data.partner_email, data.message_source, data.message_trans, 'gift');
                
                break;
            case "text_photo":
                $(".typing-dots").closest('.remote-chat').remove();
                appendPhotoMessage(data.message, false);
                updateRecentMessage(data.partner_email, data.message_source, data.message_trans, 'photo');
                
                break;
            case "text_video":
                $(".typing-dots").closest('.remote-chat').remove();
                appendVideoMessage(data.message, false);
                updateRecentMessage(data.partner_email, data.message_source, data.message_trans, 'video');
                
                break;
            //when page is loading    
            case "no_request": 
                document.getElementById("add_friend").title = data.message; 
                break;  
            case "already_send_request": 
                document.getElementById("add_friend").title = data.message;
                break;
            case "already_receive_request": 
                document.getElementById("add_friend").title = data.message;
                $("#add_friend").attr('disabled', true);
                break;
            case "already_friend": 
                document.getElementById("add_friend").title = "You are already a friend of this user!"; 
                $("#add_friend").attr('disabled', true);
                break;    
                
            //when user click add button.
            case "add_request": 
                $("#request_self_username").html(data.self_username);console.log('add friend requqest');
                $("#request_self_email").val(data.self_email);
                $("#request_partner_email").val(data.partner_email);
                $("#contact_request_avatar").html(`<img src="storage/images/user_photos/`+ data.avatar +`" width="150" height="150" alt="contact request avatar">`);
                $("#contactRequestModal").modal('show');
                document.getElementById("add_friend").title = data.message; 
                break;
            //when click accept or decline button on pop-up modal.
            case "diplay_accepted_modal":
                showAccepted(data.message);
                document.getElementById("add_friend").title = "You are a friend of this user!";
                break;
            case "diplay_declined_modal":
                $("#add_friend").attr("disabled", false);
                document.getElementById("add_friend").title = "Add a friend";
                showDeclined(data.message);
                break;
        }
    }
    //stringify the data and send it to opponent
    
    //to prevent XSS vulnerability
    function htmlEscape(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    function linkify(text) {
        return text.replace(urlRegex, function(url) {
            return '<a href="' + url + '" target="_blank">' + url + "</a>";
        });
    }
    function handleOnlineCount(data) 
    {
        for (let i=0; i<data.all_users.length; i++) {
            var line_state_div = 'line_state' + data.all_users[i];
            
            if (document.getElementById(line_state_div) != null) {
                document.getElementById(line_state_div).innerHTML = '<span class="available-stats online"></span>';    
            }
            var line_state11_div = 'line_state_d' + data.all_users[i]; 
            if (document.getElementById(line_state11_div) != null) {
                document.getElementById(line_state11_div).innerHTML = '<span class="active"></span>';    
            } 
            var line_state22_div = 'line_state_l' + data.all_users[i]; 
            if (document.getElementById(line_state22_div) != null) {
                document.getElementById(line_state22_div).innerHTML = 'online';    
            } 
        }
        all_users = data.all_users;
        $("#onlineCount").text(data.all_users.length);
    }
    function handleOfflineCount(data) 
    {
        var line_state_div = 'line_state' + data.email;
        if (document.getElementById(line_state_div) != null) {
            document.getElementById(line_state_div).innerHTML = '';    
        }
        var line_state11_div = 'line_state_d' + data.email; 
        if (document.getElementById(line_state11_div) != null) {
            document.getElementById(line_state11_div).innerHTML = '<span class="offline"></span>';    
        } 
        var line_state22_div = 'line_state_l' + data.email; 
        if (document.getElementById(line_state22_div) != null) {
            document.getElementById(line_state22_div).innerHTML = 'offline';    
        } 
    }
//Initializing socket PART
    window.onload = function() {
        setInterval(() => {
            showPoints();
            if(socket.connected && reg_socket == 'not_yet'){
                checkConnection();
                reg_socket = 'registered';
            }
        }, 1000);    
    };    
    //check if the socket is connected or not
    function checkConnection() {
        //prevent unncessary ajax requests
        if (banned) {
            showBan();
            return;
        } else if (allowed) {
            continueToChat();
            return;
        }
        //check if the socket is connected or not
        if (!socket.connected) {
            showErrorAlert("Could not connect to the server, please try again later.");
            return;
        }
        //check if the user is banned or not and user's time is 0 
        $.ajax({
                url: "/check-user",
            })
            .done(function(data) { 
                data = JSON.parse(data);
                if (data.success) {
                    check_data = data.data;
                    if (check_data.gender == 'man' && check_data.time_left <= 0) {
                        showBuyMinute();
                        throw new Error("Banned.");
                    }
                    if (check_data.gender == 'woman' && check_data.verify == 'none') {
                        showPhotoVerify();
                        console.log('verify photo none')
                        throw new Error("Banned.");
                    }
                    else if (check_data.gender == 'woman' && check_data.verify == 'uploaded') {
                        showWaitVerify();
                        throw new Error("Banned.");
                        console.log('verify photo uploaded')
                    }
                    if (check_data.isbanned)
                    {
                        banned = true;
                        socket.disconnect();
                        showBan();
                        throw new Error("Banned.");
                    }
                    if (check_data.isbanned == false && (check_data.gender == 'woman' || (check_data.gender == 'man' && check_data.time_left > 0)))   {
                        allowed = true;
                        continueToChat();   
                    }
                }
            })
            .catch(function() {
                $("#video").attr("disabled", false);
            });
    }

    //show welcome modal or continue directly to chat
    function continueToChat() {
        if (settings.userLoggedIn) {
            gender = settings.userGender; 
            
        } else if(localStorage.getItem("gender")) {
            gender = localStorage.getItem("gender");
            
        }
        localStorage.setItem("gender", gender);
        
        $("#start").attr("disabled", true);
        
        send({
            type: "start",
            email: settings.email,
            username: settings.username,
            gender: gender,
            ip: settings.ip,
            genderFilter: gender.value == 'man' ? 'woman' : 'man',  
            countryFilter: '',
        });
        initiated = true;
        $("#video, #record_start").attr("disabled", false);
        $("#text_btn").attr('disabled', false);
        document.getElementById("video").title = 'Video chat';
    }
    
    //set self IP address and country flag
    function setSelfData(data) {
        selfIp = data.ip;

        $("#selfCountryflag")
            .attr(
                "src",
                data.country ?
                "//flagcdn.com/64x48/" +
                data.country.toLocaleLowerCase() +
                ".png" :
                "images/globe.png"
            )
            .removeAttr("hidden");
    }
//Video chat part
    $("#video").on('click', async function (e) {
        e.preventDefault();
        
        $(".chat-panel").removeClass("hide");
        $(".camera-about, #video").hide();
        
        $(".local-video-container .video-load-icon").hide();
        $(".video-actions").show();
        $(".remote-video-container .video-load-icon").css(
            "animation",
            "blink 1s linear infinite"
        );
        if (isMobile) {
            $(".rotate").show();
        }
        $("#stop, #next, #add_friend").removeClass("hide");
        //manage the UI when chatType is video
        try {
            //get usermedia
            localStream = await navigator.mediaDevices.getUserMedia({
                audio: false,
                video: true,
            });
        } catch (e) {
            showSystemError("Could not get the devices, please check the error and try again. " + e);
            $("#start").attr("disabled", false);
            $(".camera-about, #video").show();
            return;
        }
        localVideo_m.srcObject = localStream;
        $("#localVideo_m").show();
        send({
            type: "next",
            email: settings.email,
            username: settings.username,
        });
    });
    //set partner name, country and manage other information
    function handleChatConnected() {

        isChatConnected = true;             
        searching = false;              
        $("#remoteVideo").show();
        $(".remote-user-info").show();
        $(".report, .capture").show();
        
        appendMessage(                  //for video
            "You are now connected with " + partnerName + "!",
            '',
            false,
            true
        );
        $("#partnerCountryVideo").attr(    //for video
            "src",
            partnerCountry ?
            "//flagcdn.com/64x48/" +
            partnerCountry.toLocaleLowerCase() +
            ".png" :
            "./images/globe.png"
        );
        $("#partnerName").text(partnerName);    //for video
        $(".remote-user-info, .report, .capture").removeClass("hide");    //for video
        $("#messageInput, #send, #next").attr("disabled", false);   //for video
        $(".remote-video-container .video-load-icon").addClass("hide"); //for video
        
        //for video history
        video_history_state = false;
        var d = new Date();
        start_time  = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
        console.log('start_time: ' + start_time);
        
        video_history_interval = setInterval(() => {
            video_history_timer++;
        }, 1000); 
    }
    function handleTextChatConnected(textPartnerUsername) {
        $("#partnerCountryText").attr(    //for text
            "src",
            partnerCountry ?
            "//flagcdn.com/64x48/" +
            partnerCountry.toLocaleLowerCase() +
            ".png" :
            "./images/globe.png"
        );
        isTextChatConnected = true;
        console.log("You are now connected with " + textPartnerUsername + "!");
    }
    //create and send the offer to the opponent
    function handleMatch(data) {
        console.log('here is handleMatch')
        console.log(data);
        if (isChatConnected && isTextChatConnected) return;
        console.log('in hMatch, chatType is ' + data.chatType);
        if (data.chatType === "text") {
            textPartnerUsername = data.username;
            textPartnerEmail = data.email;
            textPartnerStatus = data.textPartnerStatus;
            console.log('in hMatch, username is ' + data.username);    
            console.log('in hMatch, email is ' + data.email);    
            console.log('in hMatch, textPartnerStatus is ' + data.textPartnerStatus);    
            console.log('in hMatch, leftPartner is ' + data.leftPartner);    
            if (textPartnerStatus == 'partner') {
                
                console.log(settings.username)
                console.log(settings.email)
                send({
                    type: "textConnected",
                    textPartnerUsername: settings.username,
                    textPartnerEmail : settings.email,
                    textPartnerStatus : data.textPartnerStatus,
                });
                handleTextChatConnected(textPartnerUsername);
            }
            return;
        }
        partnerEmail = data.email;
        partnerName = data.username;
        partnerCountry = data.partnerCountry;
        partnerIp = data.ip;
        checkContact(settings.email, partnerEmail);
        
        //create RTCPeerConnection if the chatType is video
        connection = new RTCPeerConnection(configuration);
        setupListeners();
        initiator = true;

        connection
            .createOffer()
            .then(function(offer) {
                return connection.setLocalDescription(offer);
            })
            .then(function() {
                send({
                    type: "offer",
                    sdp: connection.localDescription,
                    email: settings.email,
                    username: settings.username,
                    country: data.country,
                    ip: selfIp,
                });
            })
            .catch(function(e) {
                console.log("An error occurred: ", e);
            });
    }
    //handle offer event
    //create and send the answer to the opponent
    function handleOffer(data) {

        if (!isChatConnected) {
            
            connection = new RTCPeerConnection(configuration);
            setupListeners();
        }
        partnerEmail = data.email;
        partnerName = data.username;
        partnerCountry = data.country;
        partnerIp = data.ip;

        initiator = false;
        connection.setRemoteDescription(data.sdp);
        connection
            .createAnswer()
            .then(function(answer) {
                connection.setLocalDescription(answer);
                send({
                    type: "answer",
                    answer: answer,
                });
            })
            .catch(function(e) {
                console.log("An error occurred: ", e);
            });
    }
    //handle answer and set remote description
    function handleAnswer(data) {
        if (
            connection.signalingState !== "closed" ||
            connection.signalingState !== "stable"
        ) {
            connection.setRemoteDescription(data.answer);
        }
    }
    //handle candidate and add ice candidate
    function handleCandidate(data) {
        if (data.candidate && connection.signalingState !== "closed") {
            connection.addIceCandidate(new RTCIceCandidate(data.candidate));
        }
    }
    //add local track to the connection,
    //manage remote track,
    //ice candidate and state change event
    //when chatType is video
    function setupListeners() {
        setTimer();
        localStream
            .getTracks()
            .forEach((track) => connection.addTrack(track, localStream));

        connection.onicecandidate = (event) => {
            if (event.candidate) {
                send({
                    type: "candidate",
                    candidate: event.candidate,
                });
            }
        };
        
        connection.ontrack = (event) => {
            //if (remoteVideo.srcObject) return;
            remoteVideo.srcObject = event.streams[0];
            handleChatConnected();
            $(".remote-video-container .video-load-icon").addClass("hide");
        };

        connection.addEventListener("connectionstatechange", () => {
            if (connection.connectionState === "connected") {
                $(".remote-video-container .video-load-icon").addClass("hide");
            } else if (connection.connectionState === "disconnected") {
                $(".remote-video-container .video-load-icon").removeClass("hide");
            } else if (connection.connectionState === "failed" && initiator) {
                //perform iceRestart if the connection fails
                connection
                    .createOffer({
                        iceRestart: true,
                        offerToReceiveVideo: true,
                    })
                    .then(function(offer) {
                        return connection.setLocalDescription(offer);
                    })
                    .then(function() {
                        send({
                            type: "offer",
                            sdp: connection.localDescription,
                        });
                    })
                    .catch(function(e) {
                        console.log("An error occurred: ", e);
                    });
            }
        });
    }

    //reload the page on stop button click
    $("#stop").on("click", function() {
        //for local video
        $(".chat-panel").addClass("hide");
        $(".camera-about, #video").show();
        $(".local-video-container .video-load-icon").show();
        $(".video-actions").hide();
        
        $("#localVideo_m").hide();
        $("#stop, #next, #add_friend").addClass("hide");
        
        //for remote video
        isChatConnected = false;
        $("#remoteVideo").hide();
        $(".remote-user-info").hide();
        $(".report, .capture").hide();
        $("#messageInput, #send, #next").attr('disabled', true);
        $(".remote-video-container .video-load-icon").css(
         "animation",
         "none"
        );
        $(".remote-video-container .video-load-icon").removeClass("hide");
        $(".video-chat-body").html('');
        send({
             type: "video-stop",
             username: settings.username,
             email: settings.email,
        });
        //for counting points
        clearInterval(intervalchatID);
        //for video history
        if (video_history_state == false) {
            clearInterval(video_history_interval);
            var d = new Date();
            end_time  = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
            console.log(start_time);
            console.log(end_time);
            saveVideoHistory(settings.email, settings.username, partnerEmail, partnerName, video_history_timer, start_time, end_time, 'yes');
        }
        video_history_timer = 0;
        video_history_state = true;
    });

    //free the opponent
    $("#next").on("click", function() {
        console.log('next button click');
        //for counting points
        clearInterval(intervalchatID);
        //for video history
        if (video_history_state == false) {
            clearInterval(video_history_interval);
            var d = new Date();
            end_time  = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
            saveVideoHistory(settings.email, settings.username, partnerEmail, partnerName, video_history_timer, start_time, end_time, 'yes');
            video_history_timer = 0;
            video_history_state = true;
        }
        if (searching) return;
        requestNextPartner("Searching for a new partner...");
    });

    //request next partner
    //reinitialize the RTCPeerConnection object
    function requestNextPartner(message) {
        searching = true;
        isChatConnected = false;
        clearInterval(intervalchatID);
        $("#messageInput, #send, #next").attr("disabled", true);
        appendMessage(message,'', false, true);
        $(".remote-user-info, .report, .capture").addClass("hide");
        
        send({
            type: "next",
            username: settings.username,
            email: settings.email,
            gender: gender.value,
            genderFilter: gender.value == 'man' ? 'woman' : 'man',
            countryFilter: '',
        });

        $(".remote-video-container .video-load-icon").removeClass("hide");

        if (connection) {
            connection.close();
            connection.onicecandidate = null;
            connection.ontrack = null;
        }

        remoteVideo.srcObject = null;
        
        //for remote video
        $("#remoteVideo").hide();
        $(".remote-user-info").hide();
        $(".report, .capture").hide();
        //for counting points
        clearInterval(intervalchatID);
        //for video history
        if (video_history_state == false) {
            clearInterval(video_history_interval);
            var d = new Date();
            end_time  = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
            console.log(start_time);
            console.log(end_time);
            saveVideoHistory(settings.email, settings.username, partnerEmail, partnerName, video_history_timer, start_time, end_time, 'no');
            video_history_timer = 0;
            video_history_state = true;
        }
        
    }
    function requestPartnerStop(message) {
        isChatConnected = false;
        $("#remoteVideo").hide();
        $(".remote-user-info").hide();
        $(".report, .capture").hide();
        $("#messageInput, #send, #next").attr('disabled', true);
        $(".remote-video-container .video-load-icon").css(
         "animation",
         "none"
        );
        $(".remote-video-container .video-load-icon").removeClass("hide");
    }
    //handle add_friend button if video chat is going to start.
    function checkContact(self_email, partner_email){
        let form = new FormData();
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        $.ajax({
                url: "/check-contact",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);
                var contact = data.data;
                if (data.success) {
                    //first state: there is no request between them
                    if (contact == 'no_request')
                    {
                        document.getElementById("add_friend").title = "Add this user as friend";
                        send({
                            type: "message",
                            message_type: 'no_request',
                            message: "Add this user as friend",
                        });
                    }
                    //second state: there is a request between them
                    if (contact == settings.email){
                        document.getElementById("add_friend").title = "You already send a request!";
                        $("#add_friend").attr('disabled', true);
                        send({
                            type: "message",
                            message_type: 'already_send_request',
                            message: "You already have a request!",
                        });
                    }
                    else if (contact == partnerEmail){
                        document.getElementById("add_friend").title = "You already have a request!";
                        send({
                            type: "message",
                            message_type: 'already_receive_request',
                            message: "You already send a request!",
                        });
                    }
                    //third state: there is contact between them
                    if (contact == 'agree')
                    {   
                        document.getElementById("add_friend").title = "You are already a friend of this user!";     
                        $("#add_friend").attr('disabled', true);
                          
                        send({
                            type: "message",
                            message_type: 'already_friend',
                        });    
                    }
                } else {
                    console.log('there is a request disagreed')
                }
            })
            .catch(function() {
                showErrorAlert('database error');
            });
    }
    //handle add_friend button click event
    $("#add_friend").on("click", function() {
        console.log('add friend button click');
        let form = new FormData();
        form.append("self_email", settings.email);
        form.append("partner_email", partnerEmail);
        form.append("in_where", 'add_button');
        $.ajax({
                url: "/add-friend",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {  //console.log(data); return;
                data = JSON.parse(data); 
                console.log(data);
                if (data.success) {
                    var contact_state = data.contact_state;
                    //first state: has no request between them
                    if(contact_state == 'add_request'){
                        
                        send({
                            type: "message",
                            message_type: 'add_request',
                            message: "You have a request from this user",
                            self_username: data.self_username,
                            self_email: settings.email,
                            partner_email: partnerEmail,
                            avatar: data.self_avatar,
                        });
                        
                        showSuccess("You send a request to this user");
                        
                        $("#add_friend").attr("disabled", true);
                        document.getElementById("add_friend").title = "You send a request to this user";
                        
                    }
                    //second state: has a request between them
                    if(contact_state == 'reciever')
                    {
                        var contact = data.contacts;
                        console.log(contact);
                        $("#request_self_username").html(contact.self_username);
                        $("#request_self_email").val(contact.self_email);
                        $("#request_partner_email").val(contact.partner_email);
                        $("#contact_request_avatar").html(`<img src="storage/images/user_photos/`+ contact.avatar_name +`" width="150" height="150" alt="contact request avatar">`);
                        $("#contactRequestModal").modal('show');    
                    }
                } 
            })
            .catch(function() {
                showErrorAlert("An error occured with database");
            });
        
    });
        
    //ajax call to verify with some photo
    $(".accept_request_btn").on("click", function(e) {
        console.log('accept request button click');
        e.preventDefault();
        let form = new FormData();
        form.append("partner_email", $("#request_self_email").val());
        form.append("self_email", $("#request_partner_email").val());
        form.append("in_where", 'accept_request');
        $.ajax({
                url: "/add-friend",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);    
                $("#contactRequestModal").modal('hide');
                $("#add_friend").attr("disabled", true);    console.log('disabled 8');
                document.getElementById("add_friend").title = "You are a friend of this user!";
                send({
                    type: "message",
                    message_type: 'diplay_accepted_modal',
                    message: 'Your request has been accepted',
                });
            })
            .catch(function() {
                showError();
                $("#savephoto").attr("disabled", false);
            });
        
    });
    //ajax call to verify with some photo
    $(".decline_request_btn").on("click", function(e) {
        console.log('decline requests button click');
        e.preventDefault();
        let form = new FormData();
        form.append("partner_email", $("#request_self_email").val());
        form.append("self_email", $("#request_partner_email").val());
        form.append("in_where", 'decline_request');
        $.ajax({
                url: "/add-friend",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);  
                $("#contactRequestModal").modal('hide');
                document.getElementById("add_friend").title = "Add a friend";
                send({
                    type: "message",
                    message_type: 'diplay_declined_modal',
                    message: 'Your request has been declined',
                });
            })
            .catch(function() {
                showError();
            });
    }); 
    //listen for message form submit event and send message in video chat
    $(document).on("submit", "#chatForm", function(e) {
        e.preventDefault();
        //prevent XSS vulnerability
        let message = htmlEscape($("#messageInput").val().trim());
        if (message) {
            $("#messageInput").val("");
            
            let form = new FormData();
            form.append("message",message);
            form.append("partnerEmail",partnerEmail);
            $.ajax({
                    url: "/trans-message",
                    data: form,
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                })
                .done(function(data) {
                    data = JSON.parse(data);
                    console.log('here is trans part');
                    console.log(data);
                    
                    var source = data.transl['source'];
                    var trans = data.transl['trans'];
                    console.log(source);
                    console.log(trans);
                    appendMessage(source['translated_text'], trans['translated_text'], true, false);
                    send({
                        type: "message",
                        message_type: 'usual',
                        message_source: source['translated_text'],
                        message_trans:  trans['translated_text'],
                    });
                    saveMessage(settings.email, partnerEmail, source['translated_text'], trans['translated_text'], 'yes', 'text');
                    typing = false;
                    clearTimeout(timeout);    
                })
                .catch(function() {
                    showError();
                });
        }
        
    });
    //append message to the chat body
    function appendMessage( message_source, message_trans,self, system) {
        let systemClass = "";
        if (system) {
            $(".video-chat-body").html("");
            systemClass = '<span class="font-weight-bold">System</span>: ';
        }
        let className = self ? "local-chat" : "remote-chat", messageDiv = '';
        
        if (!system) {
            var d = new Date();
            
                messageDiv ="<div class='" + className + "'>" + 
                                "<div>" + 
                                    '<div class="server-msg" style="font-size: 15px;" >' + 
                                        systemClass + linkify(message_source) + 
                                    "</div>" + 
                                    '<div class="server-msg" style="clear: both; font-size: 12px;" >' + 
                                        systemClass + linkify(message_trans) + 
                                    "</div>" + 
                                    '<div class="server-msg" style="clear: both;" >' +  
                                        d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds() + 
                                    "</div>" + 
                                "</div>" + 
                            "</div>";    
        }
        else if(system) {
            messageDiv ="<div class='" + className + "'>" + 
                                "<div>" + 
                                    '<div class="server-msg">' + 
                                        systemClass + linkify(message_source) + 
                                    "</div>" + 
                                "</div>" + 
                            "</div>";    
        }

        $(".video-chat-body").append(messageDiv);
        $(".video-chat-body").animate({
                scrollTop: $(".video-chat-body").prop("scrollHeight"),
            },
            100
        );
    }
    //capture opponent's screenshot
    $(".report").on("click", function() {
        console.log('report button click');
        $(this).addClass("hide");
        canvas.width = remoteVideo.videoWidth / 2;
        canvas.height = remoteVideo.videoHeight / 2;
        canvas
            .getContext("2d")
            .drawImage(remoteVideo, 0, 0, canvas.width, canvas.height);

        fetch(canvas.toDataURL("image/jpeg"))
            .then((res) => res.blob())
            .then(sendImage);
    });

    //send the captured screenshot to the server
    function sendImage(blob) {
        let form = new FormData();
        form.append("ip", partnerIp);
        form.append("image", blob);

        $.ajax({
                url: "/report-user",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);

                if (data.success) {
                    Swal.fire({
                        icon: "info",
                        iconHtml: '<i class="fa fa-flag"></i>',
                        text: "The user has been reported!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    send({
                        type: "message",
                        message_type: 'usual',
                        message: "I just reported you!",
                    });
                } else {
                    showErrorAlert('this is an error 9');
                }
            })
            .catch(function() {
                showErrorAlert('this is an error 10');
            });
    }
    
//localvideo control buttons
    //turn off the video
    $(".video-off").on("click", function() {
        
        $(this).hide();
        $(".video-on").show();
        localStream
            .getVideoTracks()
            .forEach((track) => (track.enabled = false));
    });
    
    //turn on the video
    $(".video-on").on("click", function() {
        
        $(this).hide();
        $(".video-off").show();
        localStream.getVideoTracks().forEach((track) => (track.enabled = true));
    });

    //mute the audio
    $(".audio-mute").on("click", function() {
        
        $(this).hide();
        $(".audio-unmute").show();
        localStream
            .getAudioTracks()
            .forEach((track) => (track.enabled = false));
    });

    //unmute the audio
    $(".audio-unmute").on("click", function() {
        
        localStream.getAudioTracks().forEach((track) => (track.enabled = true));
        $(this).hide();
        $(".audio-mute").show();
    });

    //rotate camera for mobile device
    $(".rotate").on("click", function() {
        
        //stop the video track and remove it from the stream
        localStream.getVideoTracks().forEach((track) => track.stop());
        localStream.removeTrack(localStream.getVideoTracks()[0]);

        facingMode = facingMode === "user" ? "environment" : "user";

        navigator.mediaDevices
            .getUserMedia({
                video: {
                    facingMode: {
                        exact: facingMode,
                    },
                },
            })
            .then(function(stream) {
                let videoTrack = stream.getVideoTracks()[0];

                if (connection) {
                    let sender = connection.getSenders().find(function(s) {
                        return s.track.kind === videoTrack.kind;
                    });

                    sender.replaceTrack(videoTrack);
                }

                //add track to the stream
                localStream.addTrack(videoTrack);

                //make sure the proper video icon is visible
                if ($(".video-on").is(":visible")) {
                    $(".video-on").hide();
                    $(".video-off").show();
                }
            })
            .catch(function(e) {
                console.log("An error occurred: ", e);
            });
    });
//Text chat part
    //listen for message form submit event and send message in text chat
    $(document).on("submit", "#textchatForm", function(e) {
        e.preventDefault();
        //prevent XSS vulnerability
        let message = htmlEscape($("#textmessageInput").val().trim());
        console.log('message')
        console.log(message)
        if (message) {
            var self_email = $("#from_field").val();
            var partner_email = $("#to_field").val();
            $("#textmessageInput").val("");
            let form = new FormData();
            form.append("message",message);
            form.append("partnerEmail",partner_email);
            $.ajax({
                    url: "/trans-message",
                    data: form,
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                })
                .done(function(data) {
                    data = JSON.parse(data);
                    console.log('here is trans part in text chat');
                    console.log(data);
                    
                    var source = data.transl['source'];
                    var trans = data.transl['trans'];
                    console.log(source);
                    console.log(trans);
                    readMessageByTyping();
                    updateRecentMessage(partner_email, source['translated_text'], trans['translated_text'], 'text');
                    console.log(textPartnerStatus)
                    if (textPartnerStatus == 'partner' ){
                        appendtextMessage(source['translated_text'], trans['translated_text'], true, true);
                        console.log('home js partner is connected with me in text chat')
                        saveMessage(self_email, partner_email, source['translated_text'], trans['translated_text'], 'yes', 'text');    
                        send({
                            type: "message",
                            message_type: 'text_usual',
                            message_source: source['translated_text'],
                            message_trans:  trans['translated_text'],
                            partner_email: self_email,
                            read: true,
                        });
                    }
                    else if (textPartnerStatus == 'home') {
                        appendtextMessage(source['translated_text'], trans['translated_text'], true, false);
                        console.log('home js partner is home in text chat')
                        saveMessage(self_email, partner_email, source['translated_text'], trans['translated_text'], 'no', 'text');
                        send({
                            type: "unread_message",
                            PartnerEmail: partner_email,
                            partner_email: self_email,
                            message_source: source['translated_text'],
                            message_trans:  trans['translated_text'],
                            message_type: 'text',
                            read: false,
                        });
                    }
                    else if (textPartnerStatus == 'offline') {
                        appendtextMessage(source['translated_text'], trans['translated_text'], true, false);
                        console.log('home js partner is offline in text chat')
                        saveMessage(self_email, partner_email, source['translated_text'], trans['translated_text'], 'no', 'text');
                    }
                    typing = false;
                    clearTimeout(timeout);
                })
                .catch(function() {
                    showError();
                });
        }
    });
    
    //send emoji when user click emoji in emoji field
    $(".one-emoji").on("click", function(e) {
        e.preventDefault();
        var div = this.children;
        var message = div[0].value;
        var self_email = $("#from_field").val();
        var partner_email = $("#to_field").val();
        appendEmojiMessage(message, true, false);
        readMessageByTyping();
        updateRecentMessage(partner_email, message, '', 'emoji');
        if (textPartnerStatus == 'partner' ){
            saveMessage(self_email, partner_email, message, '', 'yes', 'emoji');    
            send({
                type: "message",
                message_type: 'text_emoji',
                message: message,
                partner_email: self_email,
            });
        }
        else if (textPartnerStatus == 'home') {
            saveMessage(self_email, partner_email, message, '', 'no', 'emoji');
            send({
                type: "unread_message",
                textPartnerEmail: partner_email,
                partner_email: self_email,
                message_source: message,
                message_trans: '',
                message_type: 'emoji',
            });
        }
        else if (textPartnerStatus == 'offline') {
            saveMessage(self_email, partner_email, message, '', 'no', 'emoji');
        }
        typing = false;
        clearTimeout(timeout);
    });
    //ajax call to send photo in text chat field
    $("#takePhotoForm").on("submit", function(e) {
        e.preventDefault();
        $("#photo_send_start").attr("disabled", true);
        var message = $("#photo_id").val();
        var self_email = $("#from_field").val();
        var partner_email = $("#to_field").val();
        let form = new FormData();
        form.append("photo_id", message);
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        $.ajax({
                url: "/send_photo",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);
                if (data.success) {
                    let message = data.captured_photo;
                    $(".take-photo").attr("disabled", false);
                    
                    readMessageByTyping();
                    updateRecentMessage(partner_email, message, '', 'photo');
                    appendPhotoMessage(message, true);         
                    if (textPartnerStatus == 'partner' ){
                        saveMessage(self_email, partner_email, message.id, '', 'yes', 'photo');    
                        send({
                            type: "message",
                            message_type: 'text_photo',
                            message: message,
                            partner_email: self_email,
                        });
                    }
                    else if (textPartnerStatus == 'home') {
                        saveMessage(self_email, partner_email, message.id, '', 'no', 'photo');
                        send({
                            type: "unread_message",
                            textPartnerEmail: partner_email,
                            partner_email: self_email,
                            message_source: message,
                            message_trans: '',
                            message_type: 'photo',
                        });
                    }
                    else if (textPartnerStatus == 'offline') {
                        saveMessage(self_email, partner_email, message.id, '', 'no', 'photo');
                    }
                    //for UI    
                    $("#preview_photo_part").html('');
                    $("#preview_photo_part").removeClass('take-photo-show').addClass('take-photo-hide');
                    $("#preview_video_part").removeClass('take-photo-hide').addClass('take-photo-show');
                    //for button
                    $("#two_method").removeClass('take-photo-show').addClass('take-photo-hide');
                    $(".take-photo").removeClass('take-photo-hide').addClass('take-photo-show');
                    
                    $("#photo_send_start").attr('disabled', false);
                } else {
                    showErrorAlert('this is an error 7');
                }
            })
            .catch(function() {
                showErrorAlert('this is an error 8');
            });
    });
    //ajax call to send photo in text chat field
    $("#uploadPhotoForm").on("submit", function(e) {
        e.preventDefault();
        $("#uploadphotostart").attr("disabled", true);
        var self_email = $("#from_field").val();
        var partner_email = $("#to_field").val();
        let form = new FormData();
        form.append("uploadimage", $("#uploadimage").prop("files")[0]);
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        $.ajax({
                url: "/upload_photo",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);  
                if (data.success) {
                    var message = data.photo;
                    
                    readMessageByTyping();
                    updateRecentMessage(partner_email, message.id, '', 'photo');
                    appendPhotoMessage(message, true);         
                    if (textPartnerStatus == 'partner' ){
                        saveMessage(self_email, partner_email, message.id, '', 'yes', 'photo');    
                        send({
                            type: "message",
                            message_type: 'text_photo',
                            message: message,
                            partner_email: self_email,
                        });
                    }
                    else if (textPartnerStatus == 'home') {
                        saveMessage(self_email, partner_email, message.id, '', 'no', 'photo');
                        send({
                            type: "unread_message",
                            textPartnerEmail: partner_email,
                            partner_email: self_email,
                            message_source: message,
                            message_trans: '',
                            message_type: 'photo',
                        });
                    }
                    else if (textPartnerStatus == 'offline') {
                        saveMessage(self_email, partner_email, message.id, '', 'no', 'photo');
                    }
                    
                    $("#photo_send_start").attr('disabled', false);
                    $("#upload_photo_modal").modal('hide');
                } else {
                    showErrorAlert('this is an error 7');
                }
            })
            .catch(function() {
                showErrorAlert('this is an error 8');
            });
    });
    
    $("#video_send_start").on('click', function(e) {
        //for button
        $("#two_video_method").removeClass('take-photo-show').addClass('take-photo-hide');
        $(".take-video-start").removeClass('take-photo-hide').addClass('take-photo-show');
        //for UI
        $("#preview_record1_part").removeClass('take-photo-hide').addClass('take-photo-show');
        $("#preview_record2_part").html('');
        $("#preview_record2_part").removeClass('take-photo-show').addClass('take-photo-hide');
        //for main action
        var self_email = $("#from_field").val();
        var partner_email = $("#to_field").val();
        const form = new FormData();
        form.append('_token',  $('meta[name="csrf-token"]').attr('content'));
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        form.append('video', blob);
        $.ajax({
            url: "/take-video-save",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);            
            if (data.success) {
                let message = data.video_data;
                
                readMessageByTyping();
                updateRecentMessage(partner_email, message, '', 'video');
                appendVideoMessage(message, true);         
                if (textPartnerStatus == 'partner' ){
                    saveMessage(self_email, partner_email, message.id, '', 'yes', 'video');    
                    send({
                        type: "message",
                        message_type: 'text_video',
                        message: message,
                        partner_email: self_email,
                    });
                }
                else if (textPartnerStatus == 'home') {
                    saveMessage(self_email, partner_email, message.id, '', 'no', 'video');
                    send({
                        type: "unread_message",
                        textPartnerEmail: partner_email,
                        partner_email: self_email,
                        message_source: message,
                        message_trans: '',
                        message_type: 'video',
                    });
                }
                else if (textPartnerStatus == 'offline') {
                    saveMessage(self_email, partner_email, message.id, '', 'no', 'video');
                }
            }
            
        })
        .catch(error => {});
    });
    //append message to the text chat body
    function appendtextMessage(message_source, message_trans, self, read) {
        let className = self ? "message-personal" : "";
        var d = new Date();
        let apm = d.getHours() < 12 ? 'AM' : 'PM';
        let hours = d.getHours() > 12 ? d.getHours() - 12 : d.getHours();
            if (d.getHours() == 0) hours = 12;
        let mins = d.getMinutes() > 9 ? d.getMinutes() : '0' + d.getMinutes();
        
        var send_check = `<div class="checkmark-sent-delivered">✓</div>`;
        var read_check = ``;
        if (read) {
            read_check = `<div class="checkmark-read">✓</div>`;
        }
        var message_content_div =   `<div class="message new ` + className + `" style="margin-bottom: 30px;">` +
                                        linkify(message_source) + `<br>` +
                                        message_trans + `<br>` +
                                        `<div class="timestamp">` + hours + ':' + mins + '  ' + apm + `</div>` +
                                        `<div class="send-check">`  +  send_check + `</div>` +
                                        `<div class="read-check">`  +  read_check + `</div>` +
                                    `</div>`;
        $("#messages-content").append(message_content_div);
        $("#messages-content").animate({
                scrollTop: $("#messages-content").prop("scrollHeight"),
            },
            100
        );
    }
    //append message to the text chat body
    function appendEmojiMessage(message, self) {
        
        let form = new FormData();
        form.append("message", message);
            $.ajax({
                url: "/get-emoji",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data); 
                var emoji = data.emoji
                if (data.success) {
                    var d = new Date();
                    var nowtime = d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
                    let className = self ? "local-chat" : "remote-chat",
                        messageDiv ="<div class='" + className + "'>" + "<div>" + '<div class="server-msg"><img class="contact_avatar" src="storage/images/gifts_emoji/' + emoji.image + '" width=50 height=50></div></div></div>';
                    $(".text-chat-body").append(messageDiv);
                    $(".text-chat-body").animate({
                            scrollTop: $(".text-chat-body").prop("scrollHeight"),
                        },
                        100
                    );
                } else {
                    console.log('there is not emoji that you are looking for');
                }
            })
            .catch(function() {
                showErrorAlert('this is an error with db 3');
            });
        
    }
    function appendPhotoMessage(message, self) {
        $("#photo_id").val('');
        let className = self ? "local-chat" : "remote-chat";
        let messageDiv = "<div class='" + className + "'>" + "<div>" + '<div class="server-msg"><a href="#view_photo_modal" data-toggle="modal" onclick="view_zoom(' + message.id + ')"><img class="send-photo" src="storage/images/captured_photo/' + message.image + '"></a></div></div></div>';
        $(".text-chat-body").append(messageDiv);
        $(".text-chat-body").animate({
                scrollTop: $(".text-chat-body").prop("scrollHeight"),
            },
            100
        );
    }
    function appendVideoMessage(message, self) {
        
        let className = self ? "local-chat" : "remote-chat";
        let messageDiv = "<div class='" + className + "'>" + "<div>" + '<div class="server-msg"><video controls src="storage/images/captured_video/' + message.video + '" style="width:260px;"></video></div></div></div>';
        $(".text-chat-body").append(messageDiv);
        $(".text-chat-body").animate({
                scrollTop: $(".text-chat-body").prop("scrollHeight"),
            },
            100
        );    
    }
    
    //handle keydown
    $("#messageInput").keydown((e) => {
        if (e.which != 13) {
            if (!typing) {
                //notify the opponent that the user is typing
                typing = true;
                send({
                    type: "typing",
                    typing: true,
                });
                timeout = setTimeout(typingTimeout, 1000);
            } else {
                clearTimeout(timeout);
                timeout = setTimeout(typingTimeout, 1000);
            }
        }
    });

    //notify the opponent that the user has stopped typing
    function typingTimeout() {
        typing = false;
        send({
            type: "typing",
            typing: false,
        });
    }

    //handle typing status
    function handleTyping(data) {
        if (data.typing) {
            appendMessage('<p class="typing-dots"></p>','', false, false);
        } else {
            $(".typing-dots").parent().parent().remove();
        }
    }
    
    function notifyUnreadMessage(data) {
        console.log('here is notify unread message function in contact');
        console.log(data)
        var unread_message_div = 'unread_message' + data.partner_email;
        console.log(unread_message_div)
        var unread_cnt = 1;
        var div1 = document.getElementById(unread_message_div);
        if (div1 != null) {
            let first = div1.firstChild;
            if (first) {
                let second = first.firstChild;
                unread_cnt= second.textContent;
                Number(unread_cnt);
                unread_cnt ++; 
            }
            document.getElementById(unread_message_div).innerHTML = `<div class="unread_message ml-1" style="background-color: red;height: 22px;width: 22px;border-radius: 10px;color: white;font-size: 15px;" ><p>` + unread_cnt + `</p></div>`            
        }
        return;
    }
    //ajax call to clear chat history
    $("#clearChatHistoryForm").on("submit", function(e) {
        e.preventDefault();
    
        let form = new FormData();
        form.append("self_email", $("#from_field").val());
        form.append("partner_email", $("#to_field").val());
        console.log($("#from_field").val());
        console.log($("#to_field").val());
        $.ajax({
                url: "/clear_chat_history",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {  
                data = JSON.parse(data); console.log(data);
                
                if (data.success) {
                    $("#clear_history_modal").modal('hide');   
                    $("#text-chat-body").html('<img class="" src="storage/images/source_img/chat_home.png" >');
                    readMessageByTyping();
                } else {
                    showError(data.error);
                }
            })
            .catch(function() {
                showError();
            });
    });

//Direct Call part
    $("#call_offer_start").on("click", function(e) {
        e.preventDefault();
        console.log('you clicked call button, and call this function in homejs')
        var partner_avatar_name = $("#parnter_avatar_name").val();
        console.log(partner_avatar_name);
        console.log('in_where: ' + in_where);
        $(".call_partner_avatar").css(
            "animation",
            "blink 2s linear infinite"
        );
        
        if (in_where == 'text') {
            send({
                type: "callOffer",
                email: settings.email,
                partner_email: textPartnerEmail,
                partner_avatar_name: partner_avatar_name,
            });    
        }
        else if (in_where == 'video') {
            console.log(settings.email)
            partnerEmail = $("#videoPartnerEmail").val();
            partner_avatar_name = $("#videoPartnerAvatar").val();
            console.log(partnerEmail)
            console.log(partner_avatar_name)
            send({
                type: "callOffer",
                email: settings.email,
                partner_email: partnerEmail,
                partner_avatar_name: partner_avatar_name,
            });    
        }
    });
    function handleCallOffer(data) {
        console.log('this is in handle call answer function')
        console.log(data);
        if (data.call_status == 'success') {
            $("#call_from_email").val(data.partner_email);
            let form = new FormData();
            form.append("call_from_email", $("#call_from_email").val());
            $.ajax({
                    url: "/get-partner-avartar",
                    data: form,
                    type: "post",
                    cache: false,
                    contentType: false,
                    processData: false,
                })
                .done(function(data) {  
                    data = JSON.parse(data); console.log(data);
                    if (data.success) {
                        var user_photo = data.user_photo;
                        $("#call_answer_partner_avatar").html('<img class="call_partner_avatar" src="storage/images/user_photos/' + user_photo.avatar_name + '" width=300 height=300>');   
                        $(".call_partner_avatar").css(
                            "animation",
                            "blink 2s linear infinite"
                        );
                    } 
                })
                .catch(function() { });
            $("#call_answer_modal").modal('show');
            console.log('here is direct calling in socket define of home_js');
        }
        else if (data.call_status == 'failed') {
            $(".call_partner_avatar").css(
                "animation",
                "none"
            );
            showDeclined('This user is offline, please try agian later');
        }
    }
    $("#call_offer_cancel").on("click", function(e) {
        e.preventDefault();
        
        send({
            type: "callOfferCancel",
            email: settings.email,
            partner_email: textPartnerEmail,
        });
        $(".call_partner_avatar").css(
            "animation",
            "none"
        );
        $("#call_offer_modal").modal('hide');
        
    });
    function handleCallOfferCancel() {
        $(".call_partner_avatar").css(
            "animation",
            "none"
        );
        $("#call_answer_modal").modal('hide');
        
    }
    $("#call_answer_cancel").on("click", function(e) {
        e.preventDefault();
        console.log($("#call_from_email").val());
        var call_from_email = $("#call_from_email").val();
        send({
            type: "callAnswerCancel",
            email: settings.email,
            partner_email: call_from_email,
        });
        $(".call_partner_avatar").css(
            "animation",
            "none"
        );
        $("#call_answer_modal").modal('hide');
        
    });
    function handleCallAnswerCancel() {
        console.log('home js handlecallanswercancel for disappear call offer modal show declined modal')
        $(".call_partner_avatar").css(
            "animation",
            "none"
        );
        $("#call_offer_modal").modal('hide');
        showDeclined('This user declined your request.');
    }
    $("#call_answer_accept").on("click", function(e) {
        e.preventDefault();
        console.log($("#call_from_email").val());
        var call_from_email = $("#call_from_email").val();
        send({
            type: "callAnswerAccept",
            email: settings.email,
            partner_email: call_from_email,
        });
        $(".call_partner_avatar").css(
            "animation",
            "none"
        );
        $("#call_answer_modal").modal('hide');
        openCallPage('camera');
        
        $(".chat-panel").removeClass("hide");
        $(".camera-about, #video").hide();
        
        $(".local-video-container .video-load-icon").hide();
        $(".video-actions").show();
        $(".remote-video-container .video-load-icon").css(
            "animation",
            "blink 1s linear infinite"
        );
        if (isMobile) {
            $(".rotate").show();
        }
        $("#localVideo_m").show();
        localVideo_m.srcObject = localStream;
        $("#stop, #next, #add_friend").removeClass("hide");
    });
    
    function handleCallAnswerAccept() {
        console.log('home js handlecallansweraccept for disappear call offer modal show declined modal')
        $(".call_partner_avatar").css(
            "animation",
            "none"
        );
        $("#call_offer_modal").modal('hide');
        showAccepted('This user accept your request.');
        openCallPage('camera');
        $(".chat-panel").removeClass("hide");
        $(".camera-about, #video").hide();
        
        $(".local-video-container .video-load-icon").hide();
        $(".video-actions").show();
        $(".remote-video-container .video-load-icon").css(
            "animation",
            "blink 1s linear infinite"
        );
        if (isMobile) {
            $(".rotate").show();
        }
        $("#localVideo_m").show();
        localVideo_m.srcObject = localStream;
        $("#stop, #next, #add_friend").removeClass("hide");
    }
    
//COUNTING POINT AND MINUTE
    //to increase or decrease the points of each gender when chatting.
    function setTimer()
    {
        intervalchatID = setInterval(function(){ 
            if(settings.userGender == 'man') {
                decreasePoints();
            } else {
                increasePoints();
            }
        }, 1000);
    }
    function decreasePoints()
    {

        let form = new FormData();
        form.append("mode", 'decrease');
        $.ajax({
                url: "/modify-points",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);

            })
            .catch(function() {
                console.log('an error occured 12')
            });
    }
    function increasePoints()
    {
        let form = new FormData();
        form.append("mode", 'increase');
        $.ajax({
                url: "/modify-points",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);
            })
            .catch(function() {
                console.log('an error occured 12')
            });
    }
    function showPoints() {
        $.ajax({
                url: "/get-points",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);
                if (data.success) 
                {
                    if(settings.userGender == 'man') {
                        var mm = Math.trunc(data.points/60);
                        $('#timer').html(mm);
                    } else {
                        if (womanpointmouseover == false){
                            $('#points').html(data.points);
                        } else {
                            $('#points').html('$' + ((data.points/100).toFixed(2)));
                        }
                    }    
                }
            })
            .catch(function() { });
    }
    $("#points").on('mouseover', function() {
        womanpointmouseover = true;
        $('#points').html('$' + ((settings.leftpoints/100).toFixed(2)));
    });
    $("#points").on('mouseout', function() {
        womanpointmouseover = false;
        $('#points').html(settings.leftpoints);
    });

//Taking photo
    // take a photo in text-chat and profile page.
    $("#take_photo_btn, .take-profile-photo").on("click", async function(e) {
        e.preventDefault();
        console.log ('take photo & take_profile photo btn click');
            try {
                localStream = await navigator.mediaDevices.getUserMedia({
                    audio: false,
                    video: true,
                });
            } catch (e) {
                showSystemError("Could not get the devices, please check the error and try again. " + e );
                return;
            }
            localVideo.srcObject = localStream;
    });
    $(".take-avatar").on("click", function() {
        $(".take-avatar").attr("disabled", true);
        canvas.width = localVideo.videoWidth;
        canvas.height = localVideo.videoHeight;
        canvas
            .getContext("2d")
            .drawImage(localVideo, 0, 0, canvas.width, canvas.height);
        fetch(canvas.toDataURL("image/jpeg"))
            .then((res) => res.blob())
            .then(sendProfilePhoto);
    });
    //send the captured screenshot to the server
    function sendProfilePhoto(blob) {
        let form = new FormData();
        form.append("image", blob);
        $.ajax({
                url: "/take_profile_photo",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);
                if (data.success) {
                    var user_avatar = data.user_avatar;
                    showSuccess("Your photo is upload successfully");
                    $(".take-avatar").attr("disabled", false);
                    $("#avatar_name").val(user_avatar.avatar_name);
                    
                    
                    $("#preview_photo_avatar").html('<img class="preview-photo" src="storage/images/user_photos/' + user_avatar.avatar_name + '">');
                    $("#preview_photo_avatar").removeClass('take-photo-hide').addClass('take-photo-show');
                    $("#preview_video_avatar").removeClass('take-photo-show').addClass('take-photo-hide');
                    
                    $(".take-avatar").removeClass('take-photo-show').addClass('take-photo-hide');
                    $("#two_avatar_method").removeClass('take-photo-hide').addClass('take-photo-show');
                    
                } else {
                    showErrorAlert('this is an error 5');
                }
            })
            .catch(function() {
                showErrorAlert('this is an error 6');
            });
    }
    $("#avatar_send_start").on('click', function(e){
        e.preventDefault();
        let preview = $("#avatar_name").val();
        $('#avatar_preview').html('<img class="verifyphoto" src="storage/images/user_photos/' + preview + '" alt="" width="300" height="300">');
        $("#take_avatar_modal").modal('hide');
        
        $("#avatar_name").val('');
        
        $("#preview_photo_avatar").removeClass('take-photo-show').addClass('take-photo-hide');
        $("#preview_video_avatar").removeClass('take-photo-hide').addClass('take-photo-show');
        
        $(".take-avatar").removeClass('take-photo-hide').addClass('take-photo-show');
        $("#two_avatar_method").removeClass('take-photo-show').addClass('take-photo-hide');
    });
    $("#avatar_take_another").on('click', function(e){
        e.preventDefault();
        $("#avatar_name").val('');
        
        $("#preview_photo_avatar").removeClass('take-photo-show').addClass('take-photo-hide');
        $("#preview_video_avatar").removeClass('take-photo-hide').addClass('take-photo-show');
        
        $(".take-avatar").removeClass('take-photo-hide').addClass('take-photo-show');
        $("#two_avatar_method").removeClass('take-photo-show').addClass('take-photo-hide');
    });
    //take a photo in text-chat 
    $(".take-photo").on("click", function() {
        console.log('take photo button click');
        $(".take-photo").attr("disabled", true);
        canvas.width = localVideo.videoWidth;
        canvas.height = localVideo.videoHeight;
        canvas
            .getContext("2d")
            .drawImage(localVideo, 0, 0, canvas.width, canvas.height);
        fetch(canvas.toDataURL("image/jpeg"))
            .then((res) => res.blob())
            .then(sendPhoto);
    });
    //send the captured screenshot to the server
    function sendPhoto(blob) {
        var self_email = $("#from_field").val();
        var partner_email = $("#to_field").val();
        let form = new FormData();
        form.append("image", blob);
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        $.ajax({
                url: "/take_photo",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);            
        
                if (data.success) {
                    var preview = data.preview;
                    
                    $("#preview_video_part").removeClass('take-photo-show').addClass('take-photo-hide');
                    $("#preview_photo_part").html('<img class="preview-photo" src="storage/images/captured_photo/' + preview.image + '">');
                    $("#preview_photo_part").removeClass('take-photo-hide').addClass('take-photo-show');
                    
                    $(".take-photo").removeClass('take-photo-show').addClass('take-photo-hide');
                    $("#two_method").removeClass('take-photo-hide').addClass('take-photo-show');
                    
                    $("#photo_id").val(preview.id);
                } else {
                    showErrorAlert('this is an error 7');
                }
            })
            .catch(function() {
                showErrorAlert('this is an error 8');
            });
    }
    let chunks, recorder, stream, counter=1,ul = document.getElementById('preview_record2_part'), blob;

//Record Video part
    let rv_preview = document.getElementById('preview-record-video');
    $("#record_start").on('click', async function (e) {
        e.preventDefault();
        //for UI
            //*for button
        $("#record_start").addClass("hide");
        $("#record_stop").removeClass("hide");
        $("#record_stop").attr('disabled', true);        
            //*for record window
        $(".record-loader").show();
        //for real action
        		//manage the UI when chatType is video
        try {
            //get usermedia
            localStream = await navigator.mediaDevices.getUserMedia({
                audio: false,
                video: true,
            });
        } catch (e) {
            showSystemError("Could not get the devices, please check the error and try again. " + e);
            $("#start").attr("disabled", false);
            $(".camera-about, #video").show();
            return;
        }
        navigator.mediaDevices.getUserMedia({video: true,audio: false})
                        .then( _stream => {
                            stream = _stream;
                            recorder = new MediaRecorder(stream);
                            recorder.ondataavailable = e => {
                                chunks.push(e.data);
                                if(recorder.state == 'inactive')  
                                    makeRecordLink();
                            };
                            console.log('recording media successfully');
                        })
                console.log('recorder out ' + recorder);        
        var rv_init = 'no';           
        video_interval = setInterval(() => {
            video_timer++;
            if (recorder != undefined && rv_init == 'no')  {
                //for record window
                $(".record-loader").hide();
                $(".record-video-container .record-video-load-icon").hide();
                $(".record-video-actions").show();
                if (isMobile) {
                    $(".record-rotate").show();
                }
                console.log('recorder in ' + recorder);
                $("#localVideo_r").show();
                localVideo_r.srcObject = localStream;        
                        
                //for main action
                chunks=[];
                recorder.start();
                rv_init = 'yes';
                video_timer = 0;
            }
            if (video_timer == 5){
                $("#record_stop").attr('disabled', false);        
            }    
            var mm = Math.trunc(video_timer/60);
            var ss = video_timer - mm * 60;
            if (mm < 10)    mm = '0' + mm;
            if (ss < 10)    ss = '0' + ss;
            $("#re_record_timer").html(mm + ':' + ss);   
        }, 1000); 
    });
    $("#record_stop").on("click", function() {
        console.log('record stop button click');
        //for UI
            //*for record window
        //$(".record-video-container .record-video-load-icon").hide();
        $(".record-video-actions").hide();
        $("#localVideo_r").hide();
        $("#preview-record-video").show();
            //*for button
        $("#record_stop").addClass("hide");
        $("#record_save").removeClass("hide");
        $("#record_cancel").removeClass("hide");
        //for real action
        clearInterval(video_interval);
        $("#re_record_timer").html('');  
        //for main action
        recorder.stop();
    });
    $("#record_save").on("click", function() {
        console.log('record save button click');
        //for main action
        const form = new FormData();
        form.append('video', blob);
        form.append('vlength', video_timer);
        form.append('title', $('#record_title').val());
        if ($('#record_title').val() == '') { confirm('please enter title');return;}
        
        $.ajax({
            url: "/record-video-save",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);        console.log(data);    
            if (data.success) {
                showSuccess('Record Success');
                //for UI
                $("#preview-record-video").hide();
                
                document.getElementById('preview-record-video').firstChild.remove();
                $(".record-video-container .record-video-load-icon").show();
                $('#record_title').val('');
                //for button
                $("#record_start").removeClass("hide");
                $("#record_save").addClass("hide");
                $("#record_cancel").addClass("hide");
                //for timer
                video_timer = 0;
                //for appending record video div
                var record_video = data.video_data;
                //for synchronize
                var storydelete = data.storydelete;
                var dd = new Date(record_video['created_at']);
                var    ddd = dd.getTime();
                var nn  = new Date();
                var    nnn = nn.getTime();
                var t = parseInt(storydelete) + Math.round((nnn - ddd)/1000);
                setTimeSynchronize(parseInt(t));
                    
                let record_videoDiv = `<div class="col-lg p-3 mr-3 video-captured">` + 
                                        `<div class="row">` + 
                                            `<div class="col-md-6">` +
                                                `<video controls src="storage/images/record_video/` + record_video['video'] + `"></video>` + 
                                            `</div>` +
                                            `<div class="col-md-6 d-flex flex-column align-items-center video-details">` + 
                                                `<p>Like : ` + record_video['recommend'] + `</p>` + 
                                                `<p id="time_left_record">Time left : </p>` + 
                                                `<div>` + 
                                                    `<a class="btn btn-warning ml-3" title="Delete" onclick="recordVideoDelete('` + record_video['id'] + `', '` + record_video['email'] + `', this)"><i class="fa fa-ban"></i>&nbsp Delete</a>` + 
                                                `</div>` +
                                                '<div class="callout callout-info mt-5">' +
                                                    '<h5>Description</h5>' +
                                                    '<p>This video does not exist after 24 hours.</p>' +
                                                    '<p>You can re-make and delete this video, but you have only one video for your portfolio.</p>' +
                                                '</div>' +
                                            `</div>` + 
                                        `</div>` + 
                                    `</div>`;
                $("#record-video-ul").html(record_videoDiv);    
                $(".record_story_title").html(record_video['title']);
                //for left timer
                OnRecordVideoTimer();    
            }
        })
        .catch(error => {});
    });
    $("#record_cancel").on("click", function() {
        console.log('record cancel button click');
        //for UI
        $("#preview-record-video").hide();
        document.getElementById('preview-record-video').firstChild.remove();
        $(".record-video-container .record-video-load-icon").show();
        //for button
        $("#record_start").removeClass("hide");
        $("#record_save").addClass("hide");
        $("#record_cancel").addClass("hide");
        //for real action
        
    });

    // take a video part
    $("#take_video_btn").on("click", async function(e) {
        e.preventDefault();
        try {
            //get usermedia
            localStream = await navigator.mediaDevices.getUserMedia({video: true,audio: false});
        } catch (e) {
            showSystemError( "Could not get the devices, please check the error and try again. " + e );
            return;
        }
        localVideo1.srcObject = localStream;
        navigator.mediaDevices.getUserMedia({video: true,audio: false})
                        .then( _stream => {
                            stream = _stream;
                            recorder = new MediaRecorder(stream);
                            recorder.ondataavailable = e => {
                                chunks.push(e.data);
                                if(recorder.state == 'inactive')  
                                    makeLink();
                            };
                            console.log('got media successfully');
                        })
    });
    var video_timer = 0;
    var video_interval;
    $(".take-video-start").on('click', function(e) {
        //for button
        $(".take-video-start").removeClass('take-photo-show').addClass('take-photo-hide');
        $(".take-video-stop").removeClass('take-photo-hide').addClass('take-photo-show');
        $(".take-video-stop").attr('disabled', true);
        //for action
        video_interval = setInterval(() => {
            video_timer++;
            if (video_timer == 5)    $(".take-video-stop").attr('disabled', false);        
            var mm = Math.trunc(video_timer/60);
            var ss = video_timer - mm * 60;
            if (mm < 10)    mm = '0' + mm;
            if (ss < 10)    ss = '0' + ss;
            $("#record_timer").html('Recording...  ' + mm + ':' + ss);   
        }, 1000); 
        //for main action
        chunks=[];
        recorder.start();
    });
    $(".take-video-stop").on('click', function(e) {
        //for button
        $(".take-video-stop").removeClass('take-photo-show').addClass('take-photo-hide');
        $("#two_video_method").removeClass('take-photo-hide').addClass('take-photo-show');
        //for UI
        $("#preview_record1_part").removeClass('take-photo-show').addClass('take-photo-hide');
        $("#preview_record2_part").removeClass('take-photo-hide').addClass('take-photo-show');
        //for action
        video_timer = 0;
        clearInterval(video_interval);
        $("#record_timer").html('Minimum video length is 5 seconds'); 
        //for main action
        recorder.stop();
    });
    $("#video_take_another").on('click', function(e) {
       //for button
       $("#two_video_method").removeClass('take-photo-show').addClass('take-photo-hide');
       $(".take-video-start").removeClass('take-photo-hide').addClass('take-photo-show');
       //for UI
       $("#preview_record1_part").removeClass('take-photo-hide').addClass('take-photo-show');
       $("#preview_record2_part").html('');
        $("#preview_record2_part").removeClass('take-photo-show').addClass('take-photo-hide');
    });
    function makeLink(){
            blob = new Blob(chunks, {type: 'video/webm' })
            let url = URL.createObjectURL(blob)
            , mt = document.createElement('video')
            , hf = document.createElement('a');
            mt.controls = true;
            mt.src = url;
            hf.href = url;
            hf.download = `${counter++}${'.mp4'}`;
            hf.innerHTML = `donwload ${hf.download}`;
            ul.appendChild(mt);
            ul.appendChild(hf);
    }
    
    function makeRecordLink(){
        console.log('I am in makeRecordLink function')
            blob = new Blob(chunks, {type: 'video/webm' })
            let url = URL.createObjectURL(blob)
            , mt = document.createElement('video')
            mt.controls = true;
            mt.src = url;
            rv_preview.appendChild(mt);
    }
    //will be called when user click accept button on view request dropdown menu
    
//Show alert
    //set chat design height when the document loads
    heigthSet();

    //remove loader when the window loads
    $(window).on("load", function() {
        setTimeout(removeLoader);
    });
    $(window).on("load", function() {
        setTimeout(removeLoader);
    });
    //remove the loader
    function removeLoader() {
        $(".loader").fadeOut(500);
    }
    

    //update the chat area height on window resize
    $(window).on("resize", function() {
        heigthSet();
    });

    //calculate and set chat area height
    // function heigthSet() {
    //     let width = $(window).width();
    //     let height = $(window).height();
    //     let chatheight = height - 151;
    //     let videoHeight = height / 2 - 52.5;

    //     if (width < 767) {
    //         $(".chat-main").css("top", videoHeight + 11 + "px");

    //         if ($(".chat-main").hasClass("text-chat-panel")) {
    //             let chatTextResponsive = height - 150;
    //             $(".chat-area").css("height", chatTextResponsive + "px");
    //         } else {
    //             let chatResponsive = height / 2 - 100.5;
    //             $(".chat-area").css("height", chatResponsive + "px");
    //         }
    //     } else {
    //         $(".chat-main").css("top", "0");
    //         $(".chat-area").css("height", chatheight + "px");
    //     }
    //     $(".remote-video-container").css("height", videoHeight + "px");
    //     $(".local-video-container").css("height", videoHeight + "px");
    //     $(".record-video-container").css("height", videoHeight + "px");

    //     if (width < 368) {
    //         $("#video, #stop, #next, #add_friend, #record_start, #record_stop, #record_save, #record_cancel").addClass('btn-sm');
    //     } else {
    //         $("#video, #stop, #next, #add_friend, #record_start, #record_stop, #record_save, #record_cancel").removeClass('btn-sm');
    //     }
    // }
    
    //calculate and set chat area height
    function heigthSet() {
        let width = $(window).width();
        let height = $(window).height();
        let chatheight = height - 151;
        let videoHeight = height / 2 - 52.5;

        if (width < 767) {
            $(".chat-main").css("top", videoHeight + 11 + "px");

            if ($(".chat-main").hasClass("text-chat-panel")) {
                let chatTextResponsive = height - 150;
                $(".chat-area").css("height", chatTextResponsive + "px");
            } else {
                let chatResponsive = height / 2 - 100.5;
                $(".chat-area").css("height", chatResponsive + "px");
            }
        } else {
            $(".chat-main").css("top", "0");
            $(".chat-area").css("height", chatheight + "px");
        }
        $(".remote-video-container").css("height", videoHeight + "px");
        $(".local-video-container").css("height", videoHeight + "px");
        $(".record-video-container").css("height", videoHeight + "px");

        if (width < 368) {
            $("#video, #stop, #next, #add_friend, #record_start, #record_stop, #record_save, #record_cancel").addClass('btn-sm');
        } else {
            $("#video, #stop, #next, #add_friend, #record_start, #record_stop, #record_save, #record_cancel").removeClass('btn-sm');
        }
    }
    //show alert with text only
    function showErrorAlert(message) {
        Swal.fire({
            icon: "error",
            text: message || "An error occurred, please try again.",
            showConfirmButton: false,
            timer: 1500,
        });
    }

    //show alert with title and text
    function showBan() {
        Swal.fire({
            icon: "error",
            iconHtml: '<i class="fa fa-user-slash"></i>',
            title: "Oops...",
            text: "You are banned!",
            confirmButtonColor: settings.primaryColor,
        });
    }
    //show alert with title and text
    function showBuyMinute() {
        Swal.fire({
            icon: "error",
            iconHtml: '<i class="fa fa-user-slash"></i>',
            title: "Buy minute...",
            text: "Your time left is 0!",
            confirmButtonColor: settings.primaryColor,
        });
    }
    //show alert with title and text
    function showPhotoVerify() {
        Swal.fire({
            icon: "error",
            iconHtml: '<i class="fa fa-user-slash"></i>',
            title: "Verify photo...",
            text: "You have to verify with three photo!",
            confirmButtonColor: settings.primaryColor,
        });
    }
    //show alert with title and text
    function showWaitVerify() {
        Swal.fire({
            icon: "error",
            iconHtml: '<i class="fa fa-user-slash"></i>',
            title: "Wait please...",
            text: "You have to wait while admin verify your photo!",
            confirmButtonColor: settings.primaryColor,
        });
    }
    //show alert with title and text
    function showBuyMinuteForGift() {
        Swal.fire({
            icon: "error",
            iconHtml: '<i class="fa fa-user-slash"></i>',
            title: "Buy minute...",
            text: "Your time left is not enough to buy this gift!",
            confirmButtonColor: settings.primaryColor,
        });
    }
    //show alert with title and text
    function showSystemError(message) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: message,
            confirmButtonColor: settings.primaryColor,
        });
    }

    //the selected feature is premium
    function showPremium() {
        Swal.fire({
            icon: "info",
            iconHtml: '<i class="far fa-gem"></i>',
            title: settings.paidPlanName + " Feature",
            text: "Upgrade now to use this feature!",
            showCancelButton: true,
            confirmButtonColor: settings.primaryColor,
            confirmButtonText: "Upgrade",
        }).then((result) => {
            if (result.isConfirmed) {
                window.open("/pricing");
            }
        });
    }
    function showAccepted(message) {
        Swal.fire({
           icon: 'info' ,
           title: "Your request has been accepted",
           text: message,
           confirmButtonColor: settings.primaryColor,
           confirmButtonText: "Confirm",
        });
    }
    function showDeclined(message) {
        Swal.fire({
           icon: 'info' ,
           title: "Your request has been declined",
           text: message,
           confirmButtonColor: settings.primaryColor,
           confirmButtonText: "Confirm",
        });
    }
    //set country filter and notify the server
    $("#countryFilter").on("change", function() {
        if (settings.countryFilterPaid && settings.userType == "free") {
            $("#countryFilter").val("");
            showPremium();
            return;
        }

        if (!initiated) return;

        send({
            type: "updateCountryFilter",
            countryFilter: countryFilter.value,
        });
        requestNextPartner(
            "Searching for a " +
            genderFilter.value +
            " partner in " +
            countryFilter.options[countryFilter.selectedIndex].text +
            "..."
        );
    });
    $("#languageFilter").on("change", function() {
        
        console.log(languageFilter.options[languageFilter.selectedIndex].text)
        console.log(languageFilter.value)
        let form = new FormData();
        form.append("lang_code", languageFilter.value);
        $.ajax({
                url: "/set-language",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {  
                data = JSON.parse(data);     
                if (data.success) {
                    console.log('success');
                    showSuccess('Your language is ' + languageFilter.options[languageFilter.selectedIndex].text)
                } else {
                    console.log('error');
                }
            })
            .catch(function() {
                console.log('error');
            });
    });
    $("#trans_modal_cancel").on('click', function(e) {
        e.preventDefault();
        $("#translate_modal").modal('hide');
    })
    //set country filter and notify the server
    $("#camera_btn").on("click", function() {
        in_where = 'video';
    });
    $("#text_btn").on("click", function() {
        in_where = 'text';
    });
    
    
})();


    
    function showMessage(self_email, partner_email, partner_username){
        //show message and update contact into chat state.
        let form = new FormData();
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        $.ajax({
                url: "/get-messages",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {  
                data = JSON.parse(data);    
                console.log(data);
                if (data.success) {
                    
                    //for delete partner modal in right drop-down menu
                    $("#delete_contact_avatar").html(`<img class="current_avatar" src="storage/images/user_photos/` + data.partner_avatar + ` " width=120 height=120><h5 class="contact_user_text">` + partner_username +`</h5>`)
                    //for report modal in right drop-down menu
                    $("#report_avatar").html('<img class="current_avatar" src="storage/images/user_photos/' + data.partner_avatar + '" width=120 height=120><h5 class="contact_user_text">' + partner_username + '</h5>')
                    //for direct call partner avatar
                    $("#call_offer_partner_avatar").html('<img class="call_partner_avatar" src="storage/images/user_photos/' + data.partner_avatar + '" width=300 height=300>');
                    $("#call_offer_partner_name").html('<h5> Now you are calling to ' + partner_username + '</h5>')
                    $("#parnter_avatar_name").val(data.partner_avatar);
                    //for block label
                    //$("#textmessageInput").val('');
                    //$("#textmessageInput").attr('disabled', false);
                    //$('#textsend').attr('disabled', false);
                    //$("#block_label").removeClass('take-photo-show').addClass('take-photo-hide');
                    // if (data.block != 'no') {
                    //     console.log('I am blocked');
                    //     $("#block_label").removeClass('take-photo-hide').addClass('take-photo-show');
                    //     $("#textmessageInput").val('');
                    //     $("#textmessageInput").attr('disabled', true);
                    //     $('#textsend').attr('disabled', true);
                    // }
                    
                    //for chat field main part
                    var messages = data.messages;
                    var gifts = data.gifts;
                    var gender = data.gender;
                        
                        //for favourite button and right dropdown menu
                        var favour = '', favour1 = '', block_div = '';
                        if (data.favourite == 'allow') {
                            favour =  '<a class="fav-btn" onclick="toggleFav();" id="heart_img"><img class="" src="storage/images/source_img/red_heart.png" width=35 height=30></a>';
                            favour1 = 'Remove from favourites';
                        }
                        else if (data.favourite == 'none') {
                            favour =  '<a class="fav-btn" onclick="toggleFav();" id="heart_img"><img class="" src="storage/images/source_img/empty_heart.png" width=35 height=30></a>';
                            favour1 = 'Add to favourites';
                        }
                        if (data.block == 'no') {
                            block_div = 'Block Contact';
                        }
                        else if (data.block == 'yes') {
                            block_div = 'Unblock Contact';
                        }
            //rendering start
                    var gifts_div = '';
                    var messageDiv = '';
                    var user_title_div = '', chat_control_div = '', message_content_div = '', message_box_div = '', user_info = '';
                    //for gift button if user is man.
                    if (gender == 'man') {
                        gifts_div = '<li>' +
                                        '<a class="main-link gift_link " data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' + 
                                            '<img class="" src="storage/images/source_img/gift.png" width=25 height=25 >' + 
                                        '</a>' +
                                        '<div class="dropdown-menu gift_dropdown">' +
                                            '<div class="dropdown-content">' +
                                                '<ul class="gift-field">';
                        for (var j = 0; j < gifts.length; j ++ ) {
                            gifts_div += '<li class="col-sm-3 gift one-gift">' + 
                                            '<a onclick="sendGift(' + gifts[j]['id'] + ', this);" >' + 
                                                '<input type="hidden" value="' + gifts[j]['id'] + '" >' +
                                                '<img class="gifts-images" src="storage/images/gifts_emoji/' + gifts[j]['image'] + '" width=100 height=100>' +
                                                '<h4 class="mt-3">' + gifts[j]['name'] + '</h4>' +
                                                '<p>Cost:</p> <p> ' + gifts[j]['cost_minute'] + ' minutes</p>' +
                                            '</a>' +
                                        '</li>';
                        }
                        gifts_div +=        '</ul>' +
                                        '</div>' +
                                    '</div>' +
                                '</li>';
                    }
                    chat_control_div = '<ul>' +
                                            '<li>' +
                                                '<a title="Call" data-target="#call_offer_modal" data-toggle="modal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone icon-dark"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></a>' +
                                            '</li>' +
                                            gifts_div +
                                            // '<li>' +
                                            //     '<a ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video icon-dark"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg></a>' +
                                            // '</li>' +
                                            // '<li>' +
                                            //     '<a ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info icon-dark"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></a>' +
                                            // '</li>' +
                                            '<li>' +
                                                '<a class="main-link control_contact_link " data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings icon-dark"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>' +
                                                '</a>' +
                                                '<div class="dropdown-menu control_contact_dropdown">' +
                                                    '<div class="dropdown-content">' +
                                                        '<ul>' +
                                                            '<li><a onclick="toggleFav();" id="togglefavbtn">' + favour1 + '</a></li>' +
                                                            '<li><a href="#report_modal" data-toggle="modal" >Report</a></li>' +
                                                            '<li><a href="#clear_history_modal" data-toggle="modal" >Clear chat</a></li>' +
                                                            '<li><a  onclick="toggleBlock();" id="toggleblockbtn" >' + block_div + '</a></li>' +
                                                            '<li><a href="#delete_partner_modal" data-toggle="modal" >Delete contact</a></li>' +
                                                        '</ul>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</li>' +
                                        '</ul>';
                    user_title_div ='<div class="user-title">' +
                                        '<div class="back-btn d-block d-sm-none">' +
                                            '<i data-feather="arrow-left"></i>' +
                                        '</div>' +
                                        '<div class="media list-media">' +
                                            '<div class="story-img">' +
                                                '<div class="user-img">' +
                                                    '<img src="storage/images/user_photos/' + data.partner_avatar + '" class="img-fluid blur-up lazyload bg-img" alt="user" style="border-radius: 100%;">' +
                                                '</div>' +
                                            '</div>' +
                                            '<div class="media-body">' +
                                                '<h5>' + partner_username + '</h5>' +
                                                '<h6 id="line_state_l' + partner_email + '">offline</h6>' +
                                            '</div>' +
                                            '<div class="media-body ml-3">' +
                                                favour +
                                            '</div>' +
                                        '</div>' +
                                            chat_control_div + 
                                    '</div>';  
                    message_box_div =   `<div class="message-box">` +
                                            `<a class="btn btn-info" title="Take a video" id="take_video_btn"  data-target="#take_video_modal" data-toggle="modal"><i class="fa fa-video"></i></a>` +
                                            `<a class="btn btn-info" title="Take a photo" id="take_photo_btn"  data-target="#take_photo_modal" data-toggle="modal"><i class="fa fa-camera"></i></a>` +
                                            `<a class="btn btn-info" title="Upload photo"  data-target="#upload_photo_modal" data-toggle="modal"><i class="fa fa-upload"></i></a>` +
                                            `<a class="btn btn-info" title="Translator" data-target="#translate_modal" data-toggle="modal"><i class="fa fa-language"></i></a>` +
                                            `<form id="textchatForm" style="width: calc(100% - 189px);">` +
                                                `<input type="text" id="textmessageInput" class="form-control note-input" placeholder="Type a message..." autocomplete="off" style="padding-left: 10px;" />` +
                                                `<div class="add-extent" >` +
                                                    `<i class="fas fa-plus animated-btn" id="add-extent"></i>` +
                                                    `<div class="options">` +
                                                        `<ul>` +
                                                            `<li><img src="assets/svg/image.svg" alt=""></li>` +
                                                            `<li><img src="assets/svg/paperclip.svg" alt=""></li>` +
                                                            `<li><img src="assets/svg/camera.svg" alt=""></li>` +
                                                            `<li><img src="storage/images/source_img/emoji_btn.png" alt=""></li>` +
                                                        `</ul>` +
                                                    `</div>` +
                                                `</div>` +
                                                `<button title="Send" type="submit" class="message-submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg></button>` +
                                            `</form>` +
                                        `</div>`;
                    user_info = `<div class="user-info">` +
                                    `<div class="back-btn d-lg-none d-block">` +
                                        `<i data-feather="x" class="icon-theme"></i>` +
                                    `</div>` +
                                    `<div class="user-image">` +
                                        `<img src="storage/images/user_photos/` + data.partner_avatar + `" class="img-fluid blur-up lazyload bg-img" alt="" style="border-radius: 20px; width: 180px;">` +
                                    `</div>` +
                                    `<div class="user-name">` +
                                        `<h5>` + partner_username + `</h5>` +
                                        `<h6>london, united kingdom</h6>` +
                                        `<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam adipisci aspernatur.</p>` +
                                        `<div class="social-btn">` +
                                            `<ul>` +
                                                `<li class="facebook">` +
                                                    `<a >` +
                                                        `<svg>` +
                                                            `<use xlink:href="../assets/svg/icons.svg#facebook"></use>` +
                                                        `</svg>` +
                                                    `</a>` +
                                                `</li>` +
                                                `<li class="twitter">` +
                                                    `<a >` +
                                                        `<svg>` +
                                                            `<use xlink:href="../assets/svg/icons.svg#twitter"></use>` +
                                                        `</svg>` +
                                                    `</a>` +
                                                `</li>` +
                                                `<li class="whatsapp">` +
                                                    `<a >` +
                                                        `<svg>` +
                                                            `<use xlink:href="../assets/svg/icons.svg#whatsapp"></use>` +
                                                        `</svg>` +
                                                    `</a>` +
                                                `</li>` +
                                            `</ul>` +
                                        `</div>` +
                                    `</div>` +
                                    `<div class="user-gallery">` +
                                        `<h5>media <a >see all</a></h5>` +
                                        `<div class="gallery-section">` +
                                            `<div class="portfolio-section ratio_square">` +
                                                `<div class="container-fluid p-0">` +
                                                    `<div class="row">` +
                                                        `<div class="col-4">` +
                                                            `<div class="overlay">` +
                                                                `<div class="portfolio-image">` +
                                                                    `<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#imageModel">` +
                                                                        `<img src="../assets/images/post/2.jpg" alt="" class="img-fluid blur-up lazyload bg-img">` +
                                                                    `</a>` +
                                                                `</div>` +
                                                            `</div>` +
                                                        `</div>` +
                                                        `<div class="col-4">` +
                                                            `<div class="overlay">` +
                                                                `<div class="portfolio-image">` +
                                                                    `<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#imageModel">` +
                                                                        `<img src="../assets/images/post/4.jpg" alt="" class="img-fluid blur-up lazyload bg-img">` +
                                                                    `</a>` +
                                                                `</div>` +
                                                            `</div>` +
                                                        `</div>` +
                                                        `<div class="col-4">` +
                                                            `<div class="overlay">` +
                                                                `<div class="portfolio-image">` +
                                                                    `<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#imageModel">` +
                                                                        `<img src="../assets/images/post/11.jpg" alt="" class="img-fluid blur-up lazyload bg-img">` +
                                                                    `</a>` +
                                                                `</div>` +
                                                            `</div>` +
                                                        `</div>` +
                                                    `</div>` +
                                                `</div>` +
                                            `</div>` +
                                        `</div>` +
                                    `</div>` +
                                `</div>`;
                    $("#myTabContent").html('');
                                var leng2 = messages.length - 1;
                        if (messages[leng2]['message_source'].indexOf("send a request") != -1 && messages[leng2]['from_email'] == partner_email){
                            console.log(message_content_div)
                            message_content_div += `<div class="request_part">` +
                                                        `<div>` +
                                                            `<img class="request_image" src="storage/images/user_photos/` + data.partner_avatar + `">` +
                                                            `<h3 class="mt-3">` + partner_username + `</h3>` +
                                                            `<p class="request_p">Wants to add you as a friend</p>` +
                                                        `</div>` +
                                                        `<div>` +
                                                            `<button class="btn btn-primary accept_request_btn" onclick="request_accept_modal('`+ self_email +`' , '`+ partner_email +`');">Accept</button>` +
                                                            `<button class="btn btn-warning ml-3 decline_request_btn" onclick="request_decline_modal('`+ self_email +`' , '`+ partner_email +`');">Decline</button>` +
                                                            //`<button class="btn btn-primary accept_request_btn" onclick="toggleBlock();">Block</button>` +
                                                        `</div>` +
                                                    `</div>`;
                            user_title_div = '<div class="user-title">' +
                                        '<div class="back-btn d-block d-sm-none">' +
                                            '<i data-feather="arrow-left"></i>' +
                                        '</div>' +
                                        '<div class="media list-media">' +
                                            '<div class="story-img">' +
                                                '<div class="user-img">' +
                                                    '<img src="storage/images/user_photos/' + data.partner_avatar + '" class="img-fluid blur-up lazyload bg-img" alt="user" style="border-radius: 100%;">' +
                                                '</div>' +
                                            '</div>' +
                                            '<div class="media-body">' +
                                                '<h5>' + partner_username + '</h5>' +
                                                '<h6 id="line_state_l' + partner_email + '">offline</h6>' +
                                            '</div>' +
                                            '<div class="media-body ml-3">' +
                                                
                                            '</div>' +
                                        '</div>' +
                                    '</div>';  
                            message_box_div = '';
                        }
                        else if (data.block != 'no') {
                            console.log('I am blocked')
                            message_content_div += `<div class="request_part">` +
                                                        `<div>` +
                                                            `<img class="request_image" src="storage/images/user_photos/` + data.partner_avatar + `">` +
                                                            `<h3 class="mt-3">` + partner_username + `</h3>` +
                                                        `</div>` +
                                                        `<div>` +
                                                            `<button class="btn btn-primary accept_request_btn" onclick="toggleBlock();">Unblock</button>` +
                                                        `</div>` +
                                                    `</div>`;
                            user_title_div = '<div class="user-title">' +
                                        '<div class="back-btn d-block d-sm-none">' +
                                            '<i data-feather="arrow-left"></i>' +
                                        '</div>' +
                                        '<div class="media list-media">' +
                                            '<div class="story-img">' +
                                                '<div class="user-img">' +
                                                    '<img src="storage/images/user_photos/' + data.partner_avatar + '" class="img-fluid blur-up lazyload bg-img" alt="user" style="border-radius: 100%;">' +
                                                '</div>' +
                                            '</div>' +
                                            '<div class="media-body">' +
                                                '<h5>' + partner_username + '</h5>' +
                                                '<h6 id="line_state_l' + partner_email + '">offline</h6>' +
                                            '</div>' +
                                            '<div class="media-body ml-3">' +
                                                
                                            '</div>' +
                                        '</div>' +
                                    '</div>';  
                            message_box_div = '';
                        }
                        else {
                            // var unread_line = 'no';
                            for ( var i = 0; i < messages.length; i++){
                                console.log('here is message append funciton part')
                                // let systemClass = "";
                                
                                    // for unread message
                                    // if ((messages[i]['from_email'] == partner_email) && (messages[i]['to_email'] == self_email) && (messages[i]['read_state'] == 'no') && (unread_line == 'no')) {
                                    //     messageDiv = `<div class="remote-chat" id="unread_line_div" style="width:100%; height: 2px; background-color: #D93AC4;"><p>Unread Message</p></div>`;
                                    //     unread_line = 'yes';
                                    // }
                                    
                                    let className = (messages[i]['from_email'] == self_email) ? "message-personal" : "";
                                    // let sourceClass = (messages[i]['from_email'] == self_email) ? "local-source" : "remote-source";
                                    // let transClass = (messages[i]['from_email'] == self_email) ? "local-trans" : "remote-trans";
                                    // let timerClass = (messages[i]['from_email'] == self_email) ? "local-timer" : "remote-timer";
                                    
                                    const d = new Date((messages[i]['created_at']));
                                    let apm = d.getHours() < 12 ? 'AM' : 'PM';
                                    let hours = d.getHours() > 12 ? d.getHours() - 12 : d.getHours();
                                        if (d.getHours() == 0) hours = 12;
                                    let mins = d.getMinutes() > 9 ? d.getMinutes() : '0' + d.getMinutes();
                                    
                                    var send_check = `<div class="checkmark-sent-delivered">✓</div>`;
                                    var read_check = (messages[i]['read_state'] == 'yes') ? `<div class="checkmark-read">✓</div>` : ``;
                                    if (messages[i]['type'] == 'text') {
                                        
                                        message_content_div +=  `<div class="message new ` + className + `" style="margin-bottom: 30px;">` +
                                                                    linkify(messages[i]['message_source']) + `<br>` +
                                                                    messages[i]['message_trans'] + `<br>` +
                                                                    `<div class="timestamp">` + hours + ':' + mins + '  ' + apm + `</div>` +
                                                                    `<div class="send-check">`  +  send_check + `</div>` +
                                                                    `<div class="read-check">`  +  read_check + `</div>` +
                                                                `</div>`;
                                    }
                                    else if (messages[i]['type'] == 'system') {  
                                        message_content_div +=  `<div class="message new ` + className + `"  style="margin-bottom: 30px;">` +
                                                                    `<strong>System: </strong>` + messages[i]['message_source'] +
                                                                    `<div class="timestamp">` + hours + ':' + mins + '  ' + apm + `</div>` +
                                                                    `<div class="send-check">`  +  send_check + `</div>` +
                                                                    `<div class="read-check">`  +  read_check + `</div>` +
                                                                `</div>`;
                                    }
                                    else if(messages[i]['type'] == 'emoji') {
                                        message_content_div +=  `<div class="message new ` + className + `"  style="margin-bottom: 30px;">` +
                                                                    `<img class="contact_avatar" src="storage/images/gifts_emoji/` + messages[i]['message_source'] + `" width=50 height=50>` +
                                                                    `<div class="timestamp">` + hours + ':' + mins + '  ' + apm + `</div>` +
                                                                    `<div class="send-check">`  +  send_check + `</div>` +
                                                                    `<div class="read-check">`  +  read_check + `</div>` +
                                                                `</div>`;
                                    }
                                    else if(messages[i]['type'] == 'gift') {
                                        message_content_div +=  `<div class="message new ` + className + `"  style="margin-bottom: 30px;">` +
                                                                    `<div class="send-gift">` +
                                                                        `<img class="contact_avatar" src="storage/images/gifts_emoji/` + messages[i]['message_source'] + `" width=100 height=100>` +
                                                                        `<h4 class="mt-3"> ` + messages[i]['name'] + `</h4>` +
                                                                        `<p>Cost:</p> <p>` + messages[i]['cost_minute'] + `  minutes</p>` +
                                                                    `</div>` +
                                                                    `<div class="timestamp">` + hours + ':' + mins + '  ' + apm + `</div>` +
                                                                    `<div class="send-check">`  +  send_check + `</div>` +
                                                                    `<div class="read-check">`  +  read_check + `</div>` +
                                                                `</div>`;
                                    }
                                    else if(messages[i]['type'] == 'photo') {
                                        message_content_div +=  `<div class="message new ` + className + `"  style="margin-bottom: 30px;">` +
                                                                    `<a href="#view_photo_modal" data-toggle="modal" onclick="view_zoom(' + messages[i]['name'] + ')">` +
                                                                        `<img class="send-photo" src="storage/images/captured_photo/` + messages[i]['message_source'] + `">` +
                                                                    `</a>` +
                                                                    `<div class="timestamp">` + hours + ':' + mins + '  ' + apm + `</div>` +
                                                                    `<div class="send-check">`  +  send_check + `</div>` +
                                                                    `<div class="read-check">`  +  read_check + `</div>` +
                                                                `</div>`;
                                    }
                                    else if(messages[i]['type'] == 'video') {
                                        message_content_div +=  `<div class="message new ` + className + `"  style="margin-bottom: 30px;">` +
                                                                    `<video controls src="storage/images/captured_video/` + messages[i]['message_source'] + `"  style="width:260px;"></video>` +
                                                                    `<div class="timestamp">` + hours + ':' + mins + '  ' + apm + `</div>` +
                                                                    `<div class="send-check">`  +  send_check + `</div>` +
                                                                    `<div class="read-check">`  +  read_check + `</div>` +
                                                                `</div>`;
                                    }
                            }//end for  
                        }
                        messageDiv = `<div class="tab-pane fade show active" id="user2" role="tabpanel" aria-labelledby="user2">` +
                            `<div class="tab-box">` +
                                `<div class="user-chat">` +
                                    user_title_div +
                                    `<div class="chat-history">` +              
                                        `<div class="avenue-messenger">` +
                                            `<div class="chat">` +      
                                                `<input type="hidden" id="from_field" value="` + self_email + `">` +
                                                `<input type="hidden" id="to_field" value="` + partner_email + `">` +
                                                `<input type="hidden" id="field_read_state" value="no">` +
                                                `<input type="hidden" id="field_read_scroll" value="0">` +
                                                
                                                `<div class="messages-content" id="messages-content" onscroll="readMessageByScrolling();">` +
                                                    message_content_div +
                                                `</div>` +
                                                message_box_div +
                                            `</div>` +
                                        `</div>` +
                                    `</div>` +
                                `</div>` +
                                user_info +
                            `</div>` +
                        `</div>`;
                        $("#myTabContent").append(messageDiv).fadeIn(500);
                        messageDiv = '';
                    
                    var element = document.getElementById("messages-content");
                    element.scrollTop = element.scrollHeight - element.clientHeight;
                    
                    //for chat field name
                    send({
                        type: "directconnect",
                        email: self_email,
                        partner_email: partner_email,
                    });
                    
                } else {
                     ("This friend already added.");
                }
            })
            .catch(function() {     
                alert('error');
            });
    }
    function readMessageByTyping() 
    {
        console.log('here is readMessageByTyping')
        if ($("#field_read_state").val() == 'no') {
            let form = new FormData();
            form.append("self_email", $("#from_field").val());
            form.append("partner_email", $("#to_field").val());
            $.ajax({
                url: "/read-message",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data); 

                if (data.success) {
                    console.log('message read successfully');
                    var div_total = document.getElementById('messages-content');
                    var mes_contents = div_total.children;
                    for (var i = 0; i < mes_contents.length - 1; i++) {
                        var one_mes = mes_contents[i].lastChild;
                        if (one_mes.innerHTML == '') {
                            one_mes.innerHTML = '<div class="checkmark-read">✓</div>';    
                        }    
                    }
                    var unread_message_div = 'unread_message' + $("#to_field").val();
                    //for remove number in contacts
                    var div1 = document.getElementById(unread_message_div);
                    if (div1.firstChild) {
                        div1.firstChild.remove();
                    }
                    $("#field_read_state").val('yes');
                    paintHeaderUnreadMessage();
                } else {
                    console.log('there is not new message to read');
                    $("#field_read_state").val('yes');
                }
            })
            .catch(function() {
                showError('this is an error with db 3');
            });
        }
    }

    function sendGift(id, myObj) {
        
        console.log('you click one-gift class button')
        console.log(id)
        console.log(myObj)
        
        var div = myObj.children;
        var message = div[0].value;
        console.log(message);
        var self_email = $("#from_field").val();
        var partner_email = $("#to_field").val();
        readMessageByTyping();
        let form = new FormData();
        form.append("self_email", self_email);
        form.append("message", message);
        $.ajax({
                url: "/check-man-minute",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data); 
                if (data.success) {
                    
                    updateRecentMessage(partner_email, message, '', 'gift');
                    if (textPartnerStatus == 'partner' ){
                        appendGiftMessage(message, true, true);
                        saveMessage(self_email, partner_email, message, '', 'yes', 'gift');    
                        send({
                            type: "message",
                            message_type: 'text_gift',
                            message: message,
                            type: "message",
                            partner_email: self_email,
                            read: true,
                        });
                    }
                    else if (textPartnerStatus == 'home') {
                        saveMessage(self_email, partner_email, message, '', 'no', 'gift');
                        appendGiftMessage(message, true, false);
                        send({
                            type: "unread_message",
                            PartnerEmail: partner_email,
                            partner_email: self_email,
                            message_source: message,
                            message_trans: '',
                            message_type: 'gift',
                            read: false,
                        });
                    }
                    else if (textPartnerStatus == 'offline') {
                        appendGiftMessage(message, true, false);
                        saveMessage(self_email, partner_email, message, '', 'no', 'gift');
                    }        
                } else {
                    console.log('he has not enough money to buy this gift');
                    showBuyMinuteForGift();
                } 
            })
            .catch(function() {
                showErrorAlert('this is an error check minute');
            });
    }
    function appendGiftMessage(message, self, read) {
        console.log(message)
        console.log(self)
        console.log(read)
        let form = new FormData();
        var self_email = $("#from_field").val();
        var partner_email = $("#to_field").val();
        form.append("message", message);
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        $.ajax({
            url: "/get-gift",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);  
            console.log(data); 
            var gift = data.gift;
            if (data.success) {
                let className = self ? "message-personal" : "";
                var d = new Date();
                let apm = d.getHours() < 12 ? 'AM' : 'PM';
                let hours = d.getHours() > 12 ? d.getHours() - 12 : d.getHours();
                    if (d.getHours() == 0) hours = 12;
                let mins = d.getMinutes() > 9 ? d.getMinutes() : '0' + d.getMinutes();
                
                var send_check = `<div class="checkmark-sent-delivered">✓</div>`;
                var read_check = ``;
                if (read)   read_check = `<div class="checkmark-read">✓</div>`;
                var message_content_div =   `<div class="message new ` + className + `" style="margin-bottom: 30px;">` +
                                                `<div class="send-gift">` +
                                                    `<img class="contact_avatar" src="storage/images/gifts_emoji/` + gift['image'] + `" width=100 height=100>` +
                                                    `<h4 class="mt-3"> ` + gift['name'] + `</h4>` +
                                                    `<p>Cost:</p> <p>` + gift['cost_minute'] + `  minutes</p>` +
                                                `</div>` +
                                                `<div class="timestamp">` + hours + ':' + mins + '  ' + apm + `</div>` +
                                                `<div class="send-check">`  +  send_check + `</div>` +
                                                `<div class="read-check">`  +  read_check + `</div>` +
                                            `</div>`;
                $("#messages-content").append(message_content_div);
                $("#messages-content").animate({
                        scrollTop: $("#messages-content").prop("scrollHeight"),
                    },
                    100
                );
            } else {
                console.log('there is not emoji that you are looking for');
            }
        })
        .catch(function() {  });
    }
    function send(data) {
        socket.emit("message", JSON.stringify(data));
    }
    
    $(document).on("click", ".chat-box .chat-footer .animated-btn", function() {
        $(this).parents(".add-extent").toggleClass("show")
         console.log('add-extent add-extent add-extent')
    });
    $('.add-extent').on('click', function(e) {
       console.log('add-extent add-extent add-extent');
    });