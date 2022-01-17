    //get the details
    (function() {
        console.log("I am working in profile.js for get-profiles");
        $.ajax({
                url: "/get-profiles",
            })
            .done(function(data) {
                data = JSON.parse(data);    console.log(data);
                if (data.success) {
                    var profile_info = data.data;
                    
                    var element = document.getElementById("edit_username");
                    element.classList.add("hide_edit_username");
                    
                    document.getElementById("username").innerHTML = profile_info['username']; 
                    $("#username_input").val(profile_info['username']);
                    
                } else {
                    showErrorAlert("Could not get the profile info");
                }
            })
            .catch(function() {
                showErrorAlert("Could not get the profile info.");
            });
    })();
$("#edit_btn").on("click", function(e) {
    e.preventDefault();
    
    var display_div = document.getElementById("display_username");
    display_div.classList.remove("show_edit_username");
    display_div.classList.add("hide_edit_username");
    
    var element = document.getElementById("edit_username");
    element.classList.remove("hide_edit_username");
    element.classList.add("show_edit_username");
});


$("#edit_submit").on("click", function(e) {
    e.preventDefault();
    
    var display_div = document.getElementById("display_username");
    display_div.classList.remove("hide_edit_username");
    display_div.classList.add("show_edit_username");
    
    var element = document.getElementById("edit_username");
    element.classList.remove("show_edit_username");
    element.classList.add("hide_edit_username");
    
    let form = new FormData();
    form.append("username", $("#username_input").val());
    $.ajax({
            url: "/update-username",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);    
            var username = data.data;
            if (data.success) {
                $("#username").html(username);
                showSuccess("Your name is changed successfully");
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
        });
});


$(".upload-photo").on("click", function(e) {
    e.preventDefault();
    
    let form = new FormData();
    
    if($("#myimage").prop("files")[0] == undefined ) {
        showError('Please choose photos!');
        return;
    }
    form.append("myimage", $("#myimage").prop("files")[0]);
    
    $.ajax({
            url: "/upload-avatar",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);    
            
            if (data.success) {
            
                showSuccess("Your photo is upload successfully");
            } else {
                showError('An error occured while uploading a photo! Your photo is too heavy. Select the others.');
            }
        })
        .catch(function() {
            showError('An error occured while uploading a photo! Your photo is too heavy. Select the others');
        });
});



