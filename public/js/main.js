//add headers to all the ajax requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    },
});
var aum = 3;
//show success toaster
function showSuccess(message) {
    toastr.success(message);
}

//show warning toaster
function showInfo(message) {
    toastr.info(message);
}

//show error toaster
function showError(message) {
    toastr.error(message || 'An error occurred, please try again.');
}

//set the initial theme icon
if (currentTheme) {
    if (currentTheme === 'dark') {
        $('#themeSwitch').removeClass('feather-moon').addClass('feather-sun');
        var elem = `<i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="sun"></i>`;    
        $('#themeSwitch').html(elem);
    }
}

//change the theme on button click
$('.dark-theme-setting').on('click', function() {
    if (document.documentElement.getAttribute('data-theme') === 'light') {

        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
        
        var elem = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun icon-light stroke-width-3 iw-16 ih-16"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>`;    
        $('#themeSwitch').html(elem);
    } else {

        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
        
        var elem = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon icon-light stroke-width-3 iw-16 ih-16"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>`;    
        $('#themeSwitch').html(elem);
    }
});

//set href into the social links
//$('#fbShare').attr('href', 'https://www.facebook.com/sharer/sharer.php?u=' + location.hostname + '&quote=' + socialInvitation);
//$('#twitterShare').attr('href', 'https://twitter.com/share?url=' + location.hostname + '&text=' + socialInvitation);
//$('#waShare').attr('href', 'https://api.whatsapp.com/send?text=' + socialInvitation + ' \n ' + location.hostname);

//stripe payment handler
var $form = $(".validation");
$("form.validation").bind("submit", function(e) {
    var $form = $(".validation"),
        inputVal = ["input[type=email]", "input[type=password]", "input[type=text]", "input[type=file]", "textarea"].join(", "),
        $inputs = $form.find(".required").find(inputVal),
        $errorStatus = $form.find("div.error"),
        valid = true;
    $errorStatus.addClass("hide");
    $("#payNow").attr('disabled', true);

    $(".has-error").removeClass("has-error");
    $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === "") {
            $input.parent().addClass("has-error");
            $errorStatus.removeClass("hide");
            e.preventDefault();
        }
    });

    if (!$form.data("cc-on-file")) {
        e.preventDefault();
        Stripe.setPublishableKey($form.data("stripe-publishable-key"));
        Stripe.createToken({
                number: $(".card-number").val(),
                cvc: $(".card-cvc").val(),
                exp_month: $(".card-expiry-month").val(),
                exp_year: $(".card-expiry-year").val(),
            },
            stripeHandleResponse
        );
    }
});

function stripeHandleResponse(status, response) {
    if (response.error) {
        $('.error').removeClass('hide').find('.alert').text(response.error.message);
        $('#payNow').attr('disabled', false);
    } else {
        var token = response['id'];
        $form.find('input[type=text]').empty();
        $form.append('<input type="hidden" name="stripeToken" value="' + token + '"/>');
        $form.get(0).submit();
    }
}

//ajax call to update the password
$('#changePasswordEdit').on('submit', function(e) {
    e.preventDefault();

    $('#save').attr('disabled', true);

    $.ajax({
            url: 'update-password',
            data: $(this).serialize(),
            type: 'post',
        })
        .done(function(data) {
            data = JSON.parse(data);
            $('#save').attr('disabled', false);

            if (data.success) {
                showSuccess('Data updated successfully');
                $('#changePasswordEdit')[0].reset();
            } else {
                showError();
            }
        })
        .catch(function() {
            showError();
            $('#save').attr('disabled', false);
        });
});
$('.message-dropdown').on('click', function(e) {
    e.preventDefault();
    
    var li_div = this.parentNode.children;
    console.log(this)
    
    if (li_div[1].style.display == 'none') {
        li_div[1].style.display = 'block';
        var li_div1 = document.querySelector('.announcement-dropdown').parentNode.children;
        if(li_div1[1].style.display == 'block') li_div1[1].style.display = 'none';
    }
    
    else if (li_div[1].style.display == 'block') {
        li_div[1].style.display = 'none';
    }
});

$('.announcement-dropdown').on('click', function(e) {
    e.preventDefault();
    
    var li_div = this.parentNode.children;
    console.log(this)
    
    if (li_div[1].style.display == 'none') {
        li_div[1].style.display = 'block';
        var li_div1 = document.querySelector('.message-dropdown').parentNode.children;
        if(li_div1[1].style.display == 'block') li_div1[1].style.display = 'none';
    }
    
    else if (li_div[1].style.display == 'block') {
        li_div[1].style.display = 'none';
    }
});

$(".friend_request_link").on("click", function(e) {
    e.preventDefault();
    paintHeaderFriendRequest();
});
function request_accept(self_email, partner_email)
{   
    let form = new FormData();
    form.append("partner_email", self_email);
    form.append("self_email", partner_email);
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
            showSuccess("You have a new contact!");
            var requests_id = 'one_request' + self_email;
            document.getElementById(requests_id).className += " request_hide";
        })
        .catch(function() {
            showError();
        });
}
function request_decline(self_email, partner_email)
{   
    let form = new FormData();
    form.append("partner_email", self_email);
    form.append("self_email", partner_email);
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
            var requests_id = 'one_request' + self_email;
            document.getElementById(requests_id).className += " request_hide";
        })
        .catch(function() {
            showError();
        });
}
// $(".unread_message_link").on("click", function(e) {
//     e.preventDefault();
//     paintHeaderUnreadMessage();
// });
function paintHeaderUnreadMessage() {
    console.log('paintHeaderUnreadMessage');
    let form = new FormData();
    form.append("filter_key", "unread");
    $.ajax({
            url: "/unread-recent-contacts",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data); 
            var unread_contacts = data.data_arr;
            var elmentDiv = '';
            var unr_mes_cnt = 0;
            if (data.success)
            {
                var cnt = (unread_contacts.length < aum) ? unread_contacts.length : aum;
                for (var i = 0; i < cnt; i++)
                {
                    um_number_div = (unread_contacts[i]['read_state'] == 0) ? '' : `<span class="count success" style="top: 5px; right: 40px; width:20px; height:20px;">` + unread_contacts[i]['read_state'] + `</span>`;
                    elmentDiv += `<li>` +
                                    `<a onclick="openUserChat(event, 'text', '` + unread_contacts[i]['self_email'] + `','` + unread_contacts[i]['partner_email'] + `','` + unread_contacts[i]['partner_username'] + `')">` +
                                        `<div class="media">` +
                                            `<img src="storage/images/user_photos/`+ unread_contacts[i]['avatar_name'] +`" alt="user">` +
                                            `<div class="media-body">` +
                                                `<h5 class="mt-0">`+ unread_contacts[i]['partner_username'] +`</h5>` +
                                                `<h6>`+ unread_contacts[i]['recent_message'] +`</h6>` +
                                                `<h6>`+ unread_contacts[i]['recent_message_translated'] +`</h6>` +
                                                um_number_div +
                                            `</div>` +
                                        `</div>` +
                                        `<div id="line_state_d` + unread_contacts[i]['partner_email'] + `" class="active-status">` +
                                            `<span class="offline"></span>` +
                                        `</div>` +
                                    `</a>` +
                                `</li>`;
                    unr_mes_cnt += unread_contacts[i]['read_state'];
                }
            }
            else {
                elmentDiv += `<h3 style="margin:10px 30px;">No friend requests</h3>`;
                $(".unread_message_counter").remove();
            }
            elmentDiv += `<li>` +
                            `<a id="text_btn" class="pagelinks " onclick="openPage(event, 'text')" title="Text chat"  >` +
                                `<i class="iw-16 ih-16" data-feather="maximize"></i>View more` +
                            `</a>` +
                        `</li>`;         
            $(".unread_message_dropdown").html(elmentDiv);
            (unr_mes_cnt == 0) ? document.getElementById('unread_message_counter').firstChild.remove() : $("#unread_message_counter").html('<span class="count success ">' + unr_mes_cnt + '</span>');
            
        })
        .catch(function() { });
}
function paintHeaderFriendRequest() {
    console.log('paintHeaderFriendRequest');
    $.ajax({
            url: "/view-requests",
            type: "post",
        })
        .done(function(data) {  
            data = JSON.parse(data); 
            var contacts = data.contacts;
            var elmentDiv = '';
            if (data.success)
            {
                for (var i = 0; i < contacts.length; i++)
                {
                    elmentDiv += `<li>` +
                                    `<div class="media">` +
                                        `<img src="storage/images/user_photos/`+ contacts[i]['avatar_name'] +`" alt="user">` +
                                        `<div class="media-body">` +
                                            `<div>` +
                                                `<h5 class="mt-0">`+ contacts[i]['self_username'] +`</h5>` +
                                                `<h6>`+ contacts[i]['self_username'] +`</h6>` +
                                            `</div>` +
                                        `</div>` +
                                    `</div>` +
                                    `<div class="action-btns">` +
                                        `<button type="button" class="btn btn-solid" onclick="request_accept('`+ contacts[i]['self_email'] +`','`+ contacts[i]['partner_email'] +`')">confirm</button>` +
                                        `<button type="button" class="btn btn-outline ms-1" onclick="request_decline('`+ contacts[i]['self_email'] +`','`+ contacts[i]['partner_email'] +`')">delete</button>` +
                                    `</div>` +
                                `</li>`;
                }
            }
            else {
                elmentDiv += `<h3 style="margin:10px 30px;">No friend requests</h3>`;
            }
            $(".friend_request_dropdown").html(elmentDiv);
        })
        .catch(function() {
            showErrorAlert("An error occured with database");
        });
}
function openUserChat(evt, pagerouteName, self_email, partner_email, partner_username) {
    openPage(evt, pagerouteName)
    showMessage(self_email, partner_email, partner_username);
    //for make to contact active
    
    var one_contact_div = 'one_contact' + partner_email;
    console.log(one_contact_div)
    console.log(document.getElementById(one_contact_div));
    ///document.getElementById(one_contact_div).className += " active";
}








