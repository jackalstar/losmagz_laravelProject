let record_page_interval;
//ajax call to verify with some photo
$("#verifyPhotoform").on("submit", function(e) {
    e.preventDefault();
    
    $("#savephoto").attr("disabled", true);

    let form = new FormData();
    form.append("firstimage", $("#firstphoto").prop("files")[0]);
    form.append("secondimage", $("#secondphoto").prop("files")[0]);
    form.append("thirdimage", $("#thirdphoto").prop("files")[0]);
    
    if($("#firstphoto").prop("files")[0] == undefined && $("#secondphoto").prop("files")[0] == undefined && $("#thirdphoto").prop("files")[0] == undefined) {
        showError('Please choose photos!');
        return;
    }
    $.ajax({
            url: "/verify-photo",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data); console.log(data);
            $("#savephoto").attr("disabled", false);
            $("#verify_modal").modal('hide');

            if (data.success) {
                showSuccess("Data updated successfully");
                if (data.verify == 'none')
                {   console.log('I am append part about verify')
                    $('#verify_plan_btn').html(`<p>Your three photo is already uploaded. If you want to update, please click this <strong class="text-danger">update</strong> button.</p><button class="btn btn-primary" data-target="#verify_modal" data-toggle="modal" onclick="getWomenPhotoes ()">Update</button>`);
                }
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
            $("#savephoto").attr("disabled", false);
        });
    
});
//ajax call to visa withdraw 
$("#visaForm").on("submit", function(e) {
    e.preventDefault();
    
    $("#visawithdraw").attr("disabled", true);

    let form = new FormData();
    form.append("paymethod", 'visa');
    
    form.append("account_name", $("#account_name").val());
    form.append("bsb_number", $("#bsb_number").val());
    form.append("account_number", $("#account_number").val());
    $.ajax({
            url: "/visa_withdraw",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);     
            $("#visawithdraw").attr("disabled", false);
            $("#withdrawModal").modal('hide');

            if (data.success) {
                $("#withdrawSuccessModal").modal('show');
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
            $("#visawithdraw").attr("disabled", false);
        });
    
});
//ajax call to paypal withdraw 
$("#paypalForm").on("submit", function(e) {
    e.preventDefault();
    
    $("#paypalwithdraw").attr("disabled", true);

    let form = new FormData();
    form.append("paymethod", 'paypal');
    form.append("paypal_email", $("#paypal_email").val());
    
    $.ajax({
            url: "/paypal_withdraw",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);
            $("#paypalwithdraw").attr("disabled", false);
            $("#withdrawModal").modal('hide');

            if (data.success) {
                $("#withdrawSuccessModal").modal('show');
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
            $("#paypalwithdraw").attr("disabled", false);
        });
    
});


$("#clear_cancel").on("click", function(e) {
   $("#clear_history_modal").modal('hide');
});
//ajax call to clear chat history
$("#reportForm").on("submit", function(e) {
    e.preventDefault();

    let form = new FormData();
    form.append("self_email", $("#from_field").val());
    form.append("partner_email", $("#to_field").val());
    $.ajax({
            url: "/report_partner",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);

            if (data.success) {
                $("#report_modal").modal('hide');
                showSuccess('report success');
                console.log('report partner success')
            } else {
                $("#report_modal").modal('hide');
            }
        })
        .catch(function() {
            $("#report_modal").modal('hide');
        });
    
});
$("#report_cancel").on("click", function(e) {
   $("#report_modal").modal('hide');
});

//ajax call to clear chat history
$("#deletePartnerForm").on("submit", function(e) {
    e.preventDefault();

    let form = new FormData();
    form.append("self_email", $("#from_field").val());
    form.append("partner_email", $("#to_field").val());
    $.ajax({
            url: "/delete_partner",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);
            
            if (data.success) {
                $("#delete_partner_modal").modal('hide');
                showSuccess('delete partner success');
                $("#myTabContent").html('<img class="" src="storage/images/source_img/chat_home.png" >');
                var one_contact_div = 'one_contact' + $("#to_field").val();
                document.getElementById(one_contact_div).parentNode.remove();
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
            
        });
    
});
$("#contact_delete_cancel").on("click", function(e) {
   $("#delete_partner_modal").modal('hide');
});

$("#cancel_withdraw").on("click", function(e) {
    $("#withdrawModal").modal('hide');
});
$("#ok-btn").on("click", function(e) {
    $("#withdrawSuccessModal").modal('hide');
});
//the part of women's verify photoes modal
function getWomenPhotoes () {
        $.ajax({
            url: "/get-women-photoes",
        })
        .done(function(data) {
            data = JSON.parse(data); 
            if (data.success) {
                photoes = data.data;        //console.log(photoes.photo_name1);
                $("#photo1").html(`<img class="verifyphoto" src="storage/images/user_photos/` + photoes.photo_name1 + `" alt=" ` + photoes.photo_name1 + ` ">`);
                $("#photo2").html(`<img class="verifyphoto" src="storage/images/user_photos/` + photoes.photo_name2 + `" alt=" ` + photoes.photo_name2 + ` ">`);
                $("#photo3").html(`<img class="verifyphoto" src="storage/images/user_photos/` + photoes.photo_name3 + `" alt=" ` + photoes.photo_name3 + ` ">`);
                $("#verify_plan_btn").html(`<p>Your three photo is already uploaded. If you want to update, please click this <strong class="text-danger">update</strong> button.</p>
                                        <button class="btn btn-primary" data-target="#verify_modal" data-toggle="modal" onclick="getWomenPhotoes()">Update</button>`);
            }
        })
        .catch(function() {
            showError("Could not get the session details.");
        });
}
//the part of women's withdraw modal
function getWomenPoints () {
    
    $.ajax({
            url: "/get-details",
        })
        .done(function(data) {
            data = JSON.parse(data);
            if (data.success) {
                settings = data.data;
                $('#woman_points').html(settings.leftpoints);
                
                var alert_sentence = `<p>Your transfer may take several days to complete.</p>`;
                if (settings.leftpoints < 5000)
                {
                    alert_sentence = `<p>You'll receive:</p><p style="padding: 10px 25px; border: 1px solid red; border-radius: 5px;">You need <strong>5000</strong> points for withdraw money.</p>`;
                    $("#paypalwithdraw").attr("disabled", true);
                    $("#visawithdraw").attr("disabled", true);
                    
                    withdraw_input_disable();
                }
                if (settings.withdraw_state == 'withdraw')
                {
                    alert_sentence = `<p>You'll receive:</p><p style="padding: 10px 25px; border: 1px solid red; border-radius: 5px; color: red;">You are in a state of withdrawing now. You can modify your request data again before admin approve</p>`;    
                    //two tabs btn and content for visa and paypal
                    var visacontent = document.getElementById("visa");
                    var paypalcontent = document.getElementById("paypal");
                    var visabtn  = document.getElementById("visa_btn");
                    var paypalbtn  = document.getElementById("paypal_btn");
                    
                    if (settings.paymethod == 'paypal')
                    {   
                        visacontent.style.display = "none";
                        paypalcontent.style.display ="block";
                        visabtn.classList.remove("active");
                        paypalbtn.classList.add("active");
                        
                        $("#paypal_email").val(settings.paypal_email);
                        
                        withdraw_visa_input_disable();
                        
                        $("#visawithdraw").attr("disabled", true);
                        
                    } else if (settings.paymethod == 'visa')
                    { 
                        visacontent.style.display = "block";
                        paypalcontent.style.display ="none";
                        paypalbtn.classList.remove("active");
                        visabtn.classList.add("active");
                        
                        $("#account_name").val(settings.account_name);
                        $("#bsb_number").val(settings.bsb_number);
                        $("#account_number").val(settings.account_number);
                        
                        withdraw_paypal_input_disable();
                        
                        $("#paypalwithdraw").attr("disabled", true);
                        
                    }
                }
                $('#alertplace').html(alert_sentence);
            } else {
                showError("Could not get the session details.");
            }
        })
        .catch(function() {
            showError("Could not get the session details.");
        });
}
function withdraw_visa_input_disable() {
    document.getElementById("account_name").readOnly = true;
    document.getElementById("bsb_number").readOnly = true;
    document.getElementById("account_number").readOnly = true;
}
function withdraw_paypal_input_disable() {
    document.getElementById("paypal_email").readOnly = true;
}
function withdraw_input_disable() {
    document.getElementById("paypal_email").readOnly = true;
    document.getElementById("account_name").readOnly = true;
    document.getElementById("bsb_number").readOnly = true;
    document.getElementById("account_number").readOnly = true;
}
// the part for withdraw modal's tab
function openPayment(evt, paymethodName) {
    console.log('openPayment function works');
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(paymethodName).style.display = "block";
      evt.currentTarget.className += " active";
}
// the part for withdraw modal's tab
// the part for page tab
function openPage(evt, pagerouteName) {

    var i, pagecontent, pagelinks;
    pagecontent = document.getElementsByClassName("pagecontent");
    for (i = 0; i < pagecontent.length; i++) {
    pagecontent[i].style.display = "none";
    }
    pagelinks = document.getElementsByClassName("pagelinks");
    for (i = 0; i < pagelinks.length; i++) {
    pagelinks[i].className = pagelinks[i].className.replace(" active", "");
    }
    document.getElementById(pagerouteName).style.display = "block";
    evt.currentTarget.className += " active";
    
    switch(pagerouteName) {
        
        case 'camera':
            OffRecordVideoTimer();
            break;
        case 'text':
            OffRecordVideoTimer();
            paintContacts('all');
            break;
        case 'record_video':
            OnRecordVideoTimer();    
            paintRecordVideo();
            break;
        case 'view_stories':
            paintVideoStories();
            break;
    }
}
function OnRecordVideoTimer() {
    
    if (record_page_interval == undefined) {
        record_page_interval = setInterval(() => {
    
            $.ajax({
                url: "/get-record-video",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data); 
                if (data.success) 
                {
                    var record_video = data.record_video;
     
                    let record_videoDiv = '';    
                    
                    var dd = new Date(record_video['created_at']);
                    var    ddd = dd.getTime();
                    var nn  = new Date();
                    var    nnn = nn.getTime();
                    var d = record_video['timer'];
                    d = d - Math.round((nnn - ddd)/1000);
                    if(d <= 0) {
                        recordVideoDelete();
                        OffRecordVideoTimer();
                    }
                    let mm2 = d % 3600;
                    
                    let ss2 = mm2 % 60;
                        mm2 = (mm2 - ss2) / 60;
                    let hh2 = (d - mm2 * 60 - ss2) / 3600;
                    
                    if (ss2 < 10) ss2 = '0' + ss2;
                    if (mm2 < 10) mm2 = '0' + mm2;
                    if (hh2 < 10) hh2 = '0' + hh2;
                    var timer_counter = 'Time left : ' + hh2 + ':' + mm2 + ':' + ss2;
                    $("#time_left_record").html(timer_counter);    
                }
                else {
                    
                }
            })
            .catch(function() { });    
        }, 1000);     
    }
    
}
function OffRecordVideoTimer() {
    
    if (record_page_interval != undefined) {
        clearInterval(record_page_interval);
        record_page_interval = undefined
        
    }
    
    
}
function setTimeSynchronize(t) {
    console.log('syn t = ' + t)
    const form = new FormData();
    form.append('timer', t);
    $.ajax({
            url: "/set-time-synchronize",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data); 
            if (data.success) 
            {
                console.log('syn success')
            }
            else {
                console.log('syn failed')
            }
        })
        .catch(function() { });    
}
function openCallPage(pagerouteName) {
    var i, pagecontent;
    pagecontent = document.getElementsByClassName("pagecontent");
    for (i = 0; i < pagecontent.length; i++) {
        pagecontent[i].style.display = "none";
    }
    document.getElementById(pagerouteName).style.display = "block";
}


    
    let urlRegex =
        /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;
        
    
    //detect and replace text with url
    function linkify(text) {
        return text.replace(urlRegex, function(url) {
            return '<a href="' + url + '" target="_blank">' + url + "</a>";
        });
    }
//Text chat part
    function readMessageByScrolling() {
        var scroll = $("#field_read_scroll").val();
        scroll ++;
        $("#field_read_scroll").val(scroll);
        if ($("#field_read_state").val() == 'no' && $("#field_read_scroll").val() > 30 ) {
            
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
                    for (var i = 0; i < mes_contents.length; i++) {
                        var one_mes = mes_contents[i].lastChild;
                        if (one_mes.innerHTML == '') {
                            one_mes.innerHTML = '<div class="checkmark-read">✓</div>';    
                        }    
                    }
                    
                    var unread_message_div = 'unread_message' + $("#to_field").val();
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
                showError('this is an error 3');
            });
        }
    }
    
 
    function updateRecentMessage(partner_email, message_source, message_trans, type) {
        console.log('this is update Recent Message function');
        var recent_message_div = 'recent_message' + partner_email;
        var recent_message_trans = 'recent_message_translated' + partner_email;
        var datetime_message_div = 'datetime_message' + partner_email;
        
        var d = new Date();
        
        let apm = d.getHours() < 12 ? 'AM' : 'PM';
        let hours = d.getHours() > 12 ? d.getHours() - 12 : d.getHours();
            if (d.getHours() == 0) hours = 12;
        let mins = d.getMinutes() > 9 ? d.getMinutes() : '0' + d.getMinutes();
            
        var nowtime = hours + ':' + mins + ' ' + apm;
        
        if (type == 'text' || type == 'system') {
            if (document.getElementById(recent_message_div) != null) {
                document.getElementById(recent_message_div).innerHTML = message_source.slice(0,15);
                document.getElementById(recent_message_trans).innerHTML = message_trans.slice(0,15);    
            }
            
        }
        else {
            if (document.getElementById(recent_message_div) != null) {
                document.getElementById(recent_message_div).innerHTML = type;
                document.getElementById(recent_message_trans).innerHTML = '';
            }
        }
        if (document.getElementById(datetime_message_div) != null) {
            document.getElementById(datetime_message_div).innerHTML = nowtime;    
        }
    }

    //save message when chatting 
    function saveMessage(from_email, to_email, message_source, message_trans, read_state, type) {
        
        let form = new FormData();
        form.append("self_email", from_email);
        form.append("partner_email", to_email);
        form.append("message_source", message_source);
        form.append("message_trans", message_trans);
        form.append("read_state", read_state);
        form.append("type", type);
        $.ajax({
                url: "/save-message",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data); console.log(data); 

                if (data.success) {
                    console.log('message saved successfully');
                } else {
                    showError('this is an error 2');
                }
            })
            .catch(function() {
                showError('this is an error 3');
            });
    }
    function request_accept_modal(self_email, partner_email)
    {   
        let form = new FormData();
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
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
                if (data.success) {
                    showSuccess("You have a new contact!");
                    var messages = data.messages;
                    $(".text-chat-body").html('');
                    var messageDiv = '';
                    for ( var i = 0; i < messages.length; i++){
                        let systemClass = '<span class="font-weight-bold">System</span>: ';
                        const d = new Date((messages[i]['created_at']));
                        let className = (messages[i]['from_email'] == self_email) ? "local-chat" : "remote-chat";
                        messageDiv +="<div class='" + className + "'>" + "<div>" + '<div class="server-msg">' + systemClass +  linkify(messages[i]['message_source']) + "</div>"
                            + '<div class="server-msg" style="clear: both;" >' +  d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds() + "</div>" + "</div>" + "</div>";    
                        $(".text-chat-body").append(messageDiv).fadeIn(1000);
                        messageDiv = '';
                    }   
                }
            })
            .catch(function() {
                showError();
            });
    }
    function request_decline_modal(self_email, partner_email)
    {   
        let form = new FormData();
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
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
                showError("This request is declined!");
                $("#text-chat-body").html('<img class="" src="storage/images/source_img/chat_home.png" >');
                var decline_contact_div = 'data_arr' + partner_email;
                document.getElementById(decline_contact_div).remove();
            })
            .catch(function() {
                showError();
            });
    }
//ADD FAVOURITE
    function toggleFav() {
        let self_email = $("#from_field").val();
        let partner_email = $("#to_field").val();
        let form = new FormData();
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        $.ajax({
                url: "/add-favourite",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);  
                if (data.success) 
                {
                    $("#heart_img").html(`<img class="" src="storage/images/source_img/empty_heart.png" width=35 height=30>`);
                    $("#togglefavbtn").html('Add from favourites');
                    var fav_btn = 'fav_btn' + partner_email;
                    document.getElementById(fav_btn).innerHTML = ``;
                }
                else {
                    $("#heart_img").html(`<img class="" src="storage/images/source_img/red_heart.png" width=35 height=30>`);
                    $("#togglefavbtn").html('Remove to favourites');
                    var fav_btn = 'fav_btn' + partner_email;
                    document.getElementById(fav_btn).innerHTML = `<img class="" src="storage/images/source_img/red_heart.png" width=35 height=30>`;
                }
            })
            .catch(function() {
                showError();
            });
    }
    function toggleBlock() {
        console.log('toggle Block function called.')
        let self_email = $("#from_field").val();
        let partner_email = $("#to_field").val();
        console.log(self_email)
        console.log(partner_email)
        let form = new FormData();
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        $.ajax({
                url: "/set-block",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data); 
                console.log(data); 
                if (data.success) 
                {
                    $("#toggleblockbtn").html('Block Contact');
                    var contact_div = 'one_contact' + partner_email;
                    document.getElementById(contact_div).remove();
                    showSuccess("Unblocked successfully");
                    $("#myTabContent").html('<img class="" src="storage/images/source_img/chat_home.png" >');
                    $("#field_read_scroll").val(0);
                    $("#field_read_state").val('no');
                    $("#to_field").val('');
                    $("#from_field").val('');
                    
                }
                else {
                    $("#toggleblockbtn").html('Unblock Contact');
                    var contact_div = 'one_contact' + partner_email;
                    document.getElementById(contact_div).remove();
                    showSuccess("Blocked successfully");
                    $("#myTabContent").html('<img class="" src="storage/images/source_img/chat_home.png" >');
                    $("#field_read_scroll").val(0);
                    $("#field_read_state").val('no');
                    $("#to_field").val('');
                    $("#from_field").val('');
                }
            })
            .catch(function() {
                showError();
            });
    }
    $("#photo_take_another").on('click', function(e) {
        e.preventDefault();
        
        $("#preview_photo_part").html('');
        $("#preview_photo_part").removeClass('take-photo-show').addClass('take-photo-hide');
        $("#preview_video_part").removeClass('take-photo-hide').addClass('take-photo-show');
        
        $("#two_method").removeClass('take-photo-show').addClass('take-photo-hide');
        $(".take-photo").removeClass('take-photo-hide').addClass('take-photo-show');
        
        $(".take-photo").attr("disabled", false);
        
        let form = new FormData();
        form.append("photo_id", $("#photo_id").val());
        $.ajax({
                url: "/take-photo-another",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);            
                if (data.success) {
                    
                } else {
                    showError('this is an error 7');
                }
            })
            .catch(function() {
                showError('this is an error 8');
            });
    });
    function view_zoom(id) {
       console.log('photo id : ' + id);
       let form = new FormData();
        form.append("id", id);
        $.ajax({
                url: "/view-photo",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);       
                let photo = data.photo;
                
                if (data.success) {
                    $(".view_photo").html('<img class="round-10" src="storage/images/captured_photo/' + photo.image + '">');
                } else {
                    showError('this is an error 7');
                }
            })
            .catch(function() {
                showError('this is an error 8');
            });
    }
    $("#photo_view_close").on('click', function (e) {
       e.preventDefault();
       $("#view_photo_modal").modal("hide");
       
    });
    function paintVideoHistory() {
        $.ajax({
            url: "/get-video-history",
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);            
            if (data.success) {
                var video_chat_histories = data.video_chat_histories;

                var el_div = '', add_button_title = '';
                for (let i = 0; i < video_chat_histories.length; i++)
                {
                    //for add button
                    if(video_chat_histories[i]['contact_state'] == 0) {
                        
                        add_button = `<button class="btn btn-success ml-3 ` + video_chat_histories[i]['partner_email'] + `" onclick="history_add_friend('` + video_chat_histories[i]['self_email'] + `', '` + video_chat_histories[i]['partner_email'] + `', this)" title='Add this user as friend'><i class="fa fa-plus mr-1"></i>Add</button>`;
                    }
                    else {
                        add_button = `<button class="btn btn-success ml-3" title='You already send a request to this user!' disabled><i class="fa fa-plus mr-1"></i>Add</button>`;
                    }
                    
                    let ss1 = video_chat_histories[i]['vlength'] % 60;
                    let mm1 = (video_chat_histories[i]['vlength'] - ss1) / 60;
                    if (ss1 < 10) ss1 = '0' + ss1;
                    if (mm1 < 10) mm1 = '0' + mm1;
                    var video_length = mm1 + ':' + ss1;
                    el_div += `<li class="row video-history-li">` +
                                    `<div  class="col-md-8 row d-flex align-items-center">` +
                                        `<h5 class="col-sm"><strong class="text-danger">` + video_chat_histories[i]['partner_username'] + `</strong></h5>` +
                                        `<div class="col-sm">` +
                                            `<img class="contact_avatar" src="storage/images/user_photos/` + video_chat_histories[i]['partner_avatar'] + `" width=50 height=50>` +
                                        `</div>` +
                                        `<p class="col-sm">` + video_chat_histories[i]['start_time'] + `</p>` +
                                        `<p class="col-sm">` + video_chat_histories[i]['end_time'] + `</p>` +
                                        `<p class="col-sm">` + video_length + `</p>` +
                                    `</div>` +
                                    `<div class="col-md-4 d-flex align-items-center">` +
                                        `<button class="btn btn-primary ml-3" onclick="videodcall('` + video_chat_histories[i]['partner_email'] + `', '` + video_chat_histories[i]['partner_avatar'] + `');" data-target="#call_offer_modal" data-toggle="modal"><i class="fa fa-phone mr-1"></i>Call</button>` +
                                        add_button + 
                                        `<button class="btn btn-warning ml-3  "  onclick="videohdelete(` + video_chat_histories[i]['id'] + `, this)"><i class="fa fa-ban mr-1"></i>Delete</button>` +
                                    `</div>` +
                                `</li>`;
                }
                $("#video_history").append(el_div);
            }
        })
        .catch(error => {});        
    }
    function saveVideoHistory(self_email, self_username, partner_email, partner_username, video_history_timer, start_time, end_time, save_key) {
        let form = new FormData();
        form.append('selfEmail', self_email);
        form.append('selfName', self_username);
        form.append('partnerEmail', partner_email);
        form.append('partnerName', partner_username);
        form.append('vlength', video_history_timer);
        form.append('start_time', start_time);
        form.append('end_time', end_time);
        form.append('save_key', save_key);
        $.ajax({
            url: "/video-history-save",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);
            if(data.success)
            {
                console.log(data);
                let video_chat_history = data.video_chat_history;
                let partner_avatar = data.partner_avatar;
                var el_div = '';
                let ss1 = video_chat_history.vlength % 60;
                let mm1 = (video_chat_history.vlength - ss1) / 60;
                console.log('save history function')
                if (ss1 < 10) ss1 = '0' + ss1;
                if (mm1 < 10) mm1 = '0' + mm1;
                var video_length = mm1 + ':' + ss1;
                el_div += `<li class="row video-history-li">` +
                                `<div  class="col-md-8 row d-flex align-items-center">` +
                                    `<h5 class="col-sm"><strong class="text-danger">` + partner_username + `</strong></h5>` +
                                    `<div class="col-sm">` +
                                        `<img class="contact_avatar" src="storage/images/user_photos/` + partner_avatar + `" width=50 height=50>` +
                                    `</div>` +
                                    `<p class="col-sm">` + video_chat_history.start_time + `</p>` +
                                    `<p class="col-sm">` + video_chat_history.end_time + `</p>` +
                                    `<p class="col-sm">` + video_length + `</p>` +
                                `</div>` +
                                `<div class="col-md-4 d-flex align-items-center">` +
                                    `<button class="btn btn-primary ml-3"  onclick="videodcall('` + partner_email + `', '` + partner_avatar + `');" data-target="#call_offer_modal" data-toggle="modal" ><i class="fa fa-phone mr-1"></i>Call</button>` +
                                    `<button class="btn btn-success ml-3" onclick="history_add_friend('` + self_email + `', '` + partner_email + `', this)"><i class="fa fa-plus mr-1"></i>Add</button>` +
                                    `<button class="btn btn-warning ml-3 " onclick="videohdelete(` + video_chat_history.id + `, this)"><i class="fa fa-ban mr-1"></i>Delete</button>` +
                                `</div>` +
                            `</li>`;
                $("#video_history").prepend(el_div);
                var div1 = document.getElementById('video_history');
                if(div1.children.length > 7) {
                    div1.lastChild.remove();    
                }
            }
        })
            .catch(error => {});
    }       
    
    function videodcall(partner_email, partner_avatar) {
        $("#videoPartnerEmail").val(partner_email);
        $("#videoPartnerAvatar").val(partner_avatar);
        $("#call_offer_partner_avatar").html('<img class="call_partner_avatar" src="storage/images/user_photos/' + partner_avatar + '" width=300 height=300>');
    }
    function videohdelete(delete_id, myObj) {
        console.log('delete id: ' + delete_id);
        
        let form = new FormData();
        form.append('delete_id', delete_id);
        $.ajax({
            url: "/video-history-delete",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);
            console.log(data);
            if(data.success)
            {
                showSuccess('A video history deleted successfully')
                myObj.parentNode.parentNode.remove();  
                //console.log(myObj.parentElement.parentElement.remove());  
            }
        })
        .catch(error => {});
    }
    function videohalldelete() {
        $.ajax({
            url: "/video-history-delete-all",
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);
            console.log(data);
            if(data.success)
            {
                showSuccess('All video history deleted successfully');
                $("#video_history").html('');
            }
        })
        .catch(error => {});
    }
    function recordVideoDelete()  {
        
        $.ajax({
            url: "/record-video-delete",
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);
            console.log(data);
            if(data.success)
            {
                showSuccess('A record video deleted successfully!');
                $('.video-captured').html('');
                $(".record_story_title").html("Now, You have no Record Video! Please capture video for your portfolio.");
                clearInterval(record_page_interval);
            }
        })
        .catch(error => {});
    }
    function paintRecordVideo() {
        
        $.ajax({
                url: "/get-record-video",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data); 


                if (data.success) 
                {
                    var record_video = data.record_video;
                        
                    let record_videoDiv = `<div class="col-lg p-3 mr-3 video-captured">` + 
                                            `<div class="row">` + 
                                                `<div class="col-md-6">` +
                                                    `<video controls src="storage/images/record_video/` + record_video['video'] + `"></video>` + 
                                                `</div>` +
                                                `<div class="col-md-6 d-flex flex-column align-items-center video-details">` + 
                                                    `<p>Like : ` + record_video['recommend'] + `</p>` + 
                                                    `<p id="time_left_record">Time left : </p>` + 
                                                    `<div>` + 
                                                        `<a class="btn btn-warning ml-3" title="Delete" onclick="recordVideoDelete()"><i class="fa fa-ban"></i>&nbsp Delete</a>` + 
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
                }
                else {
                    $(".record_story_title").html("Now, You have no Record Video! Please capture video for your portfolio.");    
                }
            })
            .catch(function() { });
    }
    function paintVideoStories() {
        $.ajax({
                url: "/get-video-stories",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);
console.log('here is paingVideoStories')            
console.log(data)
                if (data.success) 
                {
                    var record_video = data.record_video;
                    var record_videoDiv = '';
                    var record_inner = '';    
                    var inner_active = false;
                    for (let i=0; i<record_video.length; i++) {
                        const d = new Date(record_video[i]['created_at']);
                        var month1 = d.getMonth() + 1;
                        var day1 = d.getDate();
                        if(month1 < 10) month1 = '0' + month1;
                        if(day1 < 10) day1 = '0' + day1;
                        var datetime  = d.getFullYear() + '-' + month1 + '-' + day1;
                        //for give like button
                        var givelike_div = '';
                        if (record_video[i]['is_givelike'] == null) {
                            givelike_div = `<a class="btn btn-success" onclick="record_heart('` + record_video[i]['self_email'] + `', this);" title="Give Like"><i class="fa fa-heart"></i></a>`;
                        }
                        //for add friend button
                        var add_friend_div = '';
                        if(record_video[i]['is_add_friend'] == 0) {
                            add_friend_div = `<a class="btn btn-primary ml-1" onclick="record_add_friend('` + data.self_email + `', '` + record_video[i]['self_email'] + `', this);" title="Add friend"><i class="fa fa-plus"></i></a>`;
                        }
                        if (inner_active == false)
                        {
                            record_inner += `<div class="carousel-item active">` +
                                                `<video controls><source src="storage/images/record_video/` + record_video[i]['video'] + `" type="video/webm"></video>` + 
                                                `<div class="d-flex story_title">` +
                                                    `<img class="story_img mr-2" src="storage/images/user_photos/` + record_video[i]['user_avatar'] + `" width=50 height=50>` +
                                                    `<div class="d-flex flex-column">` +
                                                        `<p>` + record_video[i]['title'] + `</p>` +
                                                        `<p>` + datetime + `</p>` +
                                                    `</div>` +
                                                `</div>` +
                                                `<div class='story-btn'>` +
                                                    givelike_div + add_friend_div +
                                                `</div>` +
                                            `</div>`;    
                            inner_active = true;
                        }
                        else {
                            record_inner += `<div class="carousel-item">` +
                                                `<video controls><source src="storage/images/record_video/` + record_video[i]['video'] + `" type="video/webm"></video>` + 
                                                `<div class="d-flex story_title">` +
                                                    `<img class="story_img mr-2" src="storage/images/user_photos/` + record_video[i]['user_avatar'] + `" width=50 height=50>` +
                                                    `<div class="d-flex flex-column">` +
                                                        `<p>` + record_video[i]['title'] + `</p>` +
                                                        `<p>` + datetime + `</p>` +
                                                    `</div>` +
                                                `</div>` +
                                                `<div class='story-btn'>` +
                                                    givelike_div + add_friend_div +
                                                `</div>` +
                                            `</div>`;
                        }
                    }                        
                    record_videoDiv =   `<div class="carousel-inner">` +
                                            record_inner +
                                        `</div>` + 
                                        `<a class="carousel-control-prev" href="#demo" data-slide="prev" title="Prev">` +
                                            `<span class="carousel-control-prev-icon"></span>` +
                                        `</a>` +
                                        `<a class="carousel-control-next" href="#demo" data-slide="next" title="Next">` +
                                            `<span class="carousel-control-next-icon"></span>` +
                                        `</a>`;
                    $("#demo").html(record_videoDiv);
                }
                else {
                    
                }
            })
            .catch(function() { });
    }
    function record_heart(email, myObj) {
        let form = new FormData();
        form.append("email", email);
        $.ajax({
                url: "/give-like",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);    console.log(data); 
                if (data.success) {
                    showSuccess('You give a like to this woman successfully!');
                    myObj.remove();  
                } else {
                    showError('You has not enough money to give like');
                } 
            })
            .catch(function() {
                showError('this is an error check minute');
            });
    }
    
    function record_add_friend(self_email, partner_email, myObj) {
        console.log('tthis is record_add_friend function')
        let form = new FormData();
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        form.append("in_where", 'video_stories');
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
                console.log(data); 
                if (data.success) {
                    var contact_state = data.contact_state;
                    if(contact_state == 'add_request'){
                        showSuccess("You send a request to this user");
                        myObj.remove();
                    }
                } 
            })
            .catch(function() {
                showError("An error occured with database");
            });
        
    }
    
    function history_add_friend(self_email, partner_email, myObj) {
        console.log('tthis is record_add_friend function')
        console.log(self_email)
        console.log(partner_email)
        let form = new FormData();
        form.append("self_email", self_email);
        form.append("partner_email", partner_email);
        form.append("in_where", 'video_history');
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
                console.log(data); 
                if (data.success) {
                    var contact_state = data.contact_state;
                    if(contact_state == 'add_request'){
                        showSuccess("You send a request to this user");
                        //myObj.remove();
                    }
                } 
            })
            .catch(function() {
                showError("An error occured with database");
            });
        
    }
    function paintContacts(filter_key) {
        console.log(filter_key)

        let form = new FormData();
        form.append("filter_key", filter_key);
        $.ajax({
                url: "/get-contacts",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data); 
                console.log(data);
                if (data.success) 
                {
                    var send_req = data.data_arr;
                    var favourite = '';
                    var unread_m_content = '';
                    var contact_content = '';
                    var filter_contact_title = '';
                    switch(filter_key) {
                        case 'all': filter_contact_title = 'All friends'; break;
                        case 'online': filter_contact_title = 'Friends online'; break;
                        case 'favourite': filter_contact_title = 'Favourites'; break;
                        case 'unread': filter_contact_title = 'Unread'; break;
                        case 'block': filter_contact_title = 'Blocked friends'; break;
                    }
                    var default_contact = `<div class="header-btn custom-dropdown dropdown-lg ">` +
                                        `<a class="main-link filter_contact_link " data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">` +
                                            `<h3 id="filter_title">` + filter_contact_title + `<i class="fa fa-angle-down ml-2"></i></h3>` +
                                        `</a>` +
                                        `<div class="dropdown-menu dropdown-menu-right ">` +
                                            `<div class="dropdown-header">` +
                                                `<ul>` +
                                                    `<li><a href="#" onclick="paintContacts('all');">All friends</a></li>` +
                                                    `<li><a href="#" onclick="paintContacts('online');">Friends online</a></li>` +
                                                    `<li><a href="#" onclick="paintContacts('favourite');">Favourites</a></li>` +
                                                    `<li><a href="#" onclick="paintContacts('unread');">Unread</a></li>` +
                                                    `<li><a href="#" onclick="paintContacts('block');">Blocked friends</a></li>` +
                                                `</ul>` +
                                                `<div class="mobile-close">` +
                                                    `<h5>close</h5>` +
                                                `</div>` +
                                            `</div>` +
                                        `</div>` +
                                    `</div>` +
                                    `<li class="nav-item" role="presentation">` +
                                        `<a class="nav-link" data-bs-toggle="tab" href="#user2" role="tab" aria-controls="user2" aria-selected="false" onclick="alert('support feature will come soon');">` +
                                            `<div class="media list-media">` +
                                                `<div class="story-img">` +
                                                    `<div class="user-img" style="width:50px; height:50px;">` +
                                                        `<img src="storage/images/source_img/bell.jpg" class="img-fluid blur-up lazyload bg-img" alt="user" style="border-radius:100%; ">` +
                                                    `</div>` +
                                                `</div>` +
                                                `<div class="media-body">` +
                                                    `<h5>Missed a new message</h5>` +
                                                    `<h6>Turn on notification</h6>` +
                                                `</div>` +
                                                `<div class="media-body">` +
                                                    `<div></div>` +
                                                    `<h5><span></span></h5>` +
                                                `</div>` +
                                            `</div>` +
                                        `</a>` +
                                    `</li>` +
                                    `<li class="nav-item" role="presentation">` +
                                        `<a class="nav-link" data-bs-toggle="tab" href="#user2" role="tab" aria-controls="user2" aria-selected="false" onclick="alert('support feature will come soon');" >` +
                                            `<div class="media list-media">` +
                                                `<div class="story-img">` +
                                                    `<div class="user-img" style="width:50px; height:50px;">` +
                                                        `<img src="storage/images/source_img/support.png" class="img-fluid blur-up lazyload bg-img" alt="user" style="border-radius:100%; ">` +
                                                        `<div id="line_state_support"></div>` +
                                                    `</div>` +
                                                `</div>` +
                                                `<div class="media-body">` +
                                                    `<h5>LosMagz Support</h5>` +
                                                    `<h6>Any issue? Contact Us!</h6>` +
                                                `</div>` +
                                                `<div class="media-body">` +
                                                    `<div></div>` +
                                                    `<h5><span></span></h5>` +
                                                `</div>` +
                                            `</div>` +
                                        `</a>` +
                                    `</li>`;
                    contact_content += default_contact;
                    if (send_req.length > 0) {
                        for (var i = 0; i < send_req.length; i++){
                            unread_m_content = '';
                            favourite = '';
                            if( send_req[i]['read_state'] > 0 ) {
                                unread_m_content = `<div class="unread_message ml-1" style="background-color: red;height: 22px;width: 22px;border-radius: 10px;color: white;font-size: 15px;" ><p style="padding: 2px 0px 0px 7px;">` + send_req[i]['read_state'] + `</p></div>`    
                            }
                            
                            if (send_req[i]['favourite'] == 'allow') {
                                favourite = `<img class="" src="storage/images/source_img/red_heart.png" width=35 height=30>`;
                            }
                            
                            contact_content += 
                                `<li class="nav-item" role="presentation">` +
                                    `<a class="nav-link" data-bs-toggle="tab" href="#user2" role="tab" aria-controls="user2" aria-selected="false" onclick="showMessage('` + send_req[i]['self_email'] + `','` + send_req[i]['partner_email'] + `','` + send_req[i]['partner_username'] + `');" id="one_contact` + send_req[i]['partner_email'] + `" >` +
                                        `<div class="media list-media">` +
                                            `<div class="story-img">` +
                                                `<div class="user-img" style="width:50px; height:50px;">` +
                                                    `<img src="storage/images/user_photos/` + send_req[i]['avatar_name'] +`" class="img-fluid blur-up lazyload bg-img" alt="user" style="border-radius:100%; ">` +
                                                    `<div id="line_state` + send_req[i]['partner_email'] + `"></div>` +
                                                `</div>` +
                                            `</div>` +
                                            `<div class="media-body">` +
                                                `<h5>`+ send_req[i]['partner_username'] +`</h5>` +
                                                `<h6 id="recent_message` + send_req[i]['partner_email'] + `">`+ send_req[i]['recent_message'] +`</h6>` +
                                                `<h6 id="recent_message_translated` + send_req[i]['partner_email'] + `">`+ send_req[i]['recent_message_translated'] +`</h6>` +
                                            `</div>` +
                                            `<div class="media-body">` +
                                                `<h5><span  id="datetime_message` + send_req[i]['partner_email'] + `">` + send_req[i]['datetime_message'] + `</span></h5>` +
                                                `<div id="unread_message` + send_req[i]['partner_email'] + `" class="">` + unread_m_content + `</div>` +
                                            `</div>` +
                                            `<div class="media-body d-flex justify-content-end" id="fav_btn` + send_req[i]['partner_email'] + `">` +
                                                favourite +
                                            `</div>` +
                                        `</div>` +
                                    `</a>` +
                                `</li>`;
                        }    
                    }
                    else {
                        //contact_content += `<h1>No contact matched</h1>`;
                    }
                    
                    $("#myTab").html(contact_content);
                    $("#myTabContent").html(`<img class="" src="storage/images/source_img/chat_home.png" >`);
                    
                }
            })
            .catch(function() {  showError();
            });
    }
    
    
    
       