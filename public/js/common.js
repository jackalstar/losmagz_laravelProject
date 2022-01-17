
//set current nav-link active
$('a[data-name="' + location.pathname.split("/")[1] + '"]').addClass("active");

//add headers to all the ajax requests
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

//initialize datatable
$("table")
    .not("#globalConfig, #features, #pages")
    .DataTable({
        responsive: true,
        autoWidth: false,
        order: [0, "desc"],
        pageLength: 50,
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"],
        ],
    });

//initialize global config table
$("#globalConfig").DataTable({
    responsive: true,
    autoWidth: false,
    pageLength: 50,
    lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, "All"],
    ],
});

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
    toastr.error(message || "An error occurred, please try again.");
}

//ajax call to update content
$("#contentEdit").on("submit", function(e) {
    e.preventDefault();

    $("#save").attr("disabled", true);

    $.ajax({
            url: "/update-page",
            data: {
                id: $("#id").val(),
                value: $("#content").summernote("code"),
            },
            type: "post",
        })
        .done(function(data) {
            data = JSON.parse(data);
            $("#save").attr("disabled", false);

            if (data.success) {
                showSuccess("Data updated successfully");
            } else {
                showError();
            }
        })
        .catch(function() {
            showError();
            $("#save").attr("disabled", false);
        });
});

//ajax call to global config
$("#globalConfigEdit").on("submit", function(e) {
    e.preventDefault();
    $("#save").attr("disabled", true);
    let form = new FormData();
    form.append("id", $("#id").val());
    form.append("key", $("#key").val());
    form.append("value", $("#value").val());
    form.append(
        "image",
        $("#value").prop("files") ? $("#value").prop("files")[0] : ""
    );
    
    $.ajax({
            url: "/update-global-config",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {
            data = JSON.parse(data);
            $("#save").attr("disabled", false);

            if (data.success) {
                showSuccess("Data updated successfully");
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
            $("#save").attr("disabled", false);
        });
});

//ajax call to update user status
$(".user-status").on("click", function() {
    let currentRow = $(this);
    let userId = currentRow.data("id");
    let checked = currentRow.is(":checked");

    currentRow.attr("disabled", true);

    $.ajax({
            url: "/update-user-status",
            type: "post",
            data: {
                id: userId,
                checked: checked,
            },
        })
        .done(function(data) {
            data = JSON.parse(data);
            currentRow.attr("disabled", false);

            if (data.success) {
                showSuccess("Status updated successfully");
            } else {
                showError();
            }
        })
        .catch(function() {
            currentRow.attr("disabled", false);
            showError();
        });
});
//ajax call to update user text-chat
$(".user-text-chat").on("click", function() {
    let currentRow = $(this);
    let userId = currentRow.data("id");
    let checked = currentRow.is(":checked");

    currentRow.attr("disabled", true);

    $.ajax({
            url: "/update-user-text-chat",
            type: "post",
            data: {
                id: userId,
                checked: checked,
            },
        })
        .done(function(data) {
            data = JSON.parse(data);
            currentRow.attr("disabled", false);

            if (data.success) {
                showSuccess("Text-Chat updated successfully");
            } else {
                showError();
            }
        })
        .catch(function() {
            currentRow.attr("disabled", false);
            showError();
        });
});
//ajax call to update user video-chat
$(".user-video-chat").on("click", function() {
    let currentRow = $(this);
    let userId = currentRow.data("id");
    let checked = currentRow.is(":checked");

    currentRow.attr("disabled", true);

    $.ajax({
            url: "/update-user-video-chat",
            type: "post",
            data: {
                id: userId,
                checked: checked,
            },
        })
        .done(function(data) {
            data = JSON.parse(data);
            currentRow.attr("disabled", false);

            if (data.success) {
                showSuccess("Video-Chat updated successfully");
            } else {
                showError();
            }
        })
        .catch(function() {
            currentRow.attr("disabled", false);
            showError();
        });
});
//ajax call to update user verify
$(".user-verify-status").on("click", function() {
    let currentRow = $(this);
    let userId = currentRow.data("id");
    let checked = currentRow.is(":checked");

    currentRow.attr("disabled", true);

    $.ajax({
            url: "/update-user-verify-status",
            type: "post",
            data: {
                id: userId,
                checked: checked,
            },
        })
        .done(function(data) {
            data = JSON.parse(data);
            currentRow.attr("disabled", false);

            if (data.success) {
                showSuccess("Photo verify updated successfully");
            } else {
                showError();
            }
        })
        .catch(function() {
            currentRow.attr("disabled", false);
            showError();
        });
});
//ajax call to close account
$(".btn-closeaccount").on("click", function() {
    if (confirm("Are you sure you want to delete this user?")) {
        let currentRow = $(this);
        let userId = currentRow.data("id");
        let checked = currentRow.is(":checked");
        currentRow.attr("disabled", true);
            $.ajax({
                    url: "/close-account",
                    type: "post",
                    data: {
                        id: userId,
                        checked: checked,
                    },
                })
                .done(function(data) {
                    data = JSON.parse(data); console.log(data);
                    currentRow.attr("disabled", false);
        
                    if (data.success) {
                        showSuccess("This account has been deleted successfully. Please click back button.");
                    } else {
                        showError();
                    }
                })
                .catch(function() {
                    currentRow.attr("disabled", false);
                    showError();
                });
    }
});
//ajax call to verify license
$("#verifyLicense").on("click", function() {
    $(this).attr("disabled", true);

    $.ajax({
            url: "/verify-license",
        })
        .done(function(data) {
            data = JSON.parse(data);    
            $("#verifyLicense").attr("disabled", false);

            if (data.success) {
                showSuccess("Your license is valid. Type: " + data.type);
            } else {
                showError("Your license is invalid. Error: " + data.error);
            }
        })
        .catch(function() {
            $("#verifyLicense").attr("disabled", false);
            showError();
        });
});

//ajax call to uninstall license
$("#uninstallLicense").on("click", function() {
    if (!confirm("Are you sure you want to uninstall the license?")) return;

    $(this).attr("disabled", true);

    $.ajax({
            url: "/uninstall-license",
        })
        .done(function(data) {  
            data = JSON.parse(data);
            $("#uninstallLicense").attr("disabled", false);

            if (data.success) {
                showSuccess("License uninstalled");
            } else {
                showError(
                    "License uninstallation failed. Error: " + data.error
                );
            }
        })
        .catch(function() {
            $("#uninstallLicense").attr("disabled", false);
            showError();
        });
});

//ajax call to check for update
$("#checkForUpdate").on("click", function() {
    $(this).attr("disabled", true);

    $.ajax({
            url: "/check-for-update",
        })
        .done(function(data) {
            data = JSON.parse(data);

            if (data.success) {
                $("#downloadUpdate").removeAttr("hidden");
                $("#changelog").html(data.changelog || "-");
                showSuccess("An update is available: Version: " + data.version);
            } else if (data.error) {
                showError(data.error);
            } else {
                $("#checkForUpdate").attr("disabled", false);
                showInfo(
                    "Application is already at latest version. Version: " +
                    data.version
                );
            }
        })
        .catch(function() {
            $("#checkForUpdate").attr("disabled", false);
            showError();
        });
});

//ajax call to download the update
$("#downloadUpdate").on("click", function() {
    $(this).attr("disabled", true);

    $.ajax({
            url: "/download-update",
        })
        .done(function(data) {
            data = JSON.parse(data);
            $("#downloadUpdate").removeAttr("hidden");

            if (data.success) {
                showSuccess(
                    "The application has been successfully updated to the latest version."
                );
            } else if (data.error) {
                showError(data.error);
            } else {
                $("#downloadUpdate").attr("disabled", false);
                showError("Update failed. Error: " + data.error);
            }
        })
        .catch(function() {
            $("#downloadUpdate").attr("disabled", false);
            showError();
        });
});

//ajax call to check signaling
$("#checkSignaling").on("click", function() {
    $("#checkSignaling").attr("disabled", true);

    $.ajax({
            url: "/check-signaling",
        })
        .done(function(data) {
            data = JSON.parse(data);
            $("#checkSignaling").attr("disabled", false);
            $("#status").html(data.status);

            if (data.status == "Running") {
                $("#status")
                    .removeClass("badge-danger")
                    .addClass("badge-success");
            } else {
                $("#status")
                    .removeClass("badge-success")
                    .addClass("badge-danger");
            }
        })
        .catch(function() {
            $("#checkSignaling").attr("disabled", false);
            showError();
        });
});
//send message to client
$("#sendmessageclient").on("click", function() {
    $.ajax({
            url: "/send-message-client",
        })
        .done(function(data) {
            data = JSON.parse(data);
            $("#checkSignaling").attr("disabled", false);
            $("#status").html(data.status);

            if (data.status == "Running") {
                $("#status")
                    .removeClass("badge-danger")
                    .addClass("badge-success");
            } else {
                $("#status")
                    .removeClass("badge-success")
                    .addClass("badge-danger");
            }
        })
        .catch(function() {
            $("#checkSignaling").attr("disabled", false);
            showError();
        });
});

//show reported image
$(".reported-image").on("click", function() {
    $("#reportedImageModal").modal("show");
    reportedImage.src = $(this).attr("src");
});

//ajax call to ignore the user
$(".ignore").on("click", function() {
    if (confirm("Are you sure you want to ignore this user?")) {
        let currentRow = $(this);
        currentRow.attr("disabled", true);

        let form = new FormData();
        form.append("id", currentRow.data("id"));

        $.ajax({
                url: "ignore-user",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);

                if (data.success) {
                    currentRow.parent().parent().remove();
                    showSuccess("The user has been ignored");
                } else {
                    showError(data.error);
                }
            })
            .catch(function() {
                showError();
            });
    }
});

//ajax call to ban the user
$(".ban").on("click", function() {
    if (confirm("Are you sure you want to ban this user?")) {
        let currentRow = $(this);
        currentRow.attr("disabled", true);

        let form = new FormData();
        form.append("id", currentRow.data("id"));

        $.ajax({
                url: "ban-user",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);

                if (data.success) {
                    currentRow.parent().parent().remove();
                    showSuccess("The user has been banned");
                } else {
                    showError(data.error);
                }
            })
            .catch(function() {
                showError();
            });
    }
});

//ajax call to unban the user
$(".unban").on("click", function() {
    if (confirm("Are you sure you want to unban this user?")) {
        let currentRow = $(this);
        currentRow.attr("disabled", true);

        let form = new FormData();
        form.append("ip", currentRow.data("ip"));

        $.ajax({
                url: "unban-user",
                data: form,
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
            })
            .done(function(data) {
                data = JSON.parse(data);

                if (data.success) {
                    currentRow.parent().parent().remove();
                    showSuccess("The user has been unbanned");
                } else {
                    showError(data.error);
                }
            })
            .catch(function() {
                showError();
            });
    }
});

//ajax call to update feature status
$(".feature-status").on("click", function() {
    let currentRow = $(this);
    let featureId = currentRow.data("id");
    let checked = currentRow.is(":checked");

    currentRow.attr("disabled", true);

    $.ajax({
            url: "/update-feature-status",
            type: "post",
            data: {
                id: featureId,
                checked: checked,
            },
        })
        .done(function(data) {
            data = JSON.parse(data);
            currentRow.attr("disabled", false);

            if (data.success) {
                showSuccess("Feature updated successfully");
            } else {
                showError();
            }
        })
        .catch(function() {
            currentRow.attr("disabled", false);
            showError();
        });
});

//ajax call to update feature paid
$(".feature-paid").on("click", function() {
    let currentRow = $(this);
    let featureId = currentRow.data("id");
    let checked = currentRow.is(":checked");

    currentRow.attr("disabled", true);

    $.ajax({
            url: "/update-feature-paid",
            type: "post",
            data: {
                id: featureId,
                checked: checked,
            },
        })
        .done(function(data) {
            data = JSON.parse(data);
            currentRow.attr("disabled", false);

            if (data.success) {
                showSuccess("Feature updated successfully");
            } else {
                showError(data.message);
                currentRow.prop("checked", false);
            }
        })
        .catch(function() {
            currentRow.attr("disabled", false);
            showError();
        });
});
//ajax call to package edit
$("#packageEdit").on("submit", function(e) {
    e.preventDefault();
    $("#packagesave").attr("disabled", true);
    let form = new FormData();
    form.append("id", $("#id").val());
    form.append("package_name", $("#package_name").val());
    form.append("price", $("#price").val());
    form.append("currency", $("#currency").val());
    form.append("minute", $("#minute").val());
    $.ajax({
            url: "/package-update",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);
            $("#packagesave").attr("disabled", false);

            if (data.success) {
                showSuccess("Data updated successfully");
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
            $("#packagesave").attr("disabled", false);
        });
});
//ajax call to create gift
$("#newGiftForm").on("submit", function(e) {
    e.preventDefault();
    $("#new_gift_start").attr("disabled", true);
    
    let form = new FormData();
    form.append("name", $("#name").val());
    form.append("cost_minute", $("#cost_minute").val());
    form.append("receive_minute", $("#receive_minute").val());
    form.append("image", $("#image").prop("files")[0]);
    
    $.ajax({
            url: "/gift-create",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);
            

            if (data.success) {
                $("#new_gift_start").attr("disabled", false);
                
                showSuccess("A gift created successfully");
            } else {
                showError();
            }
        })
        .catch(function() {
            showError();
            $("#new_gift_start").attr("disabled", false);
        });
});
//ajax call to create gift
$("#newEmojiForm").on("submit", function(e) {
    e.preventDefault();
    $("#new_emoji_start").attr("disabled", true);
    
    let form = new FormData();
    form.append("name", $("#name").val());
    form.append("image", $("#image").prop("files")[0]);
    
    $.ajax({
            url: "/emoji-create",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);
            if (data.success) {
                $("#new_emoji_start").attr("disabled", false);
                
                showSuccess("A emoji created successfully");
            } else {
                showError();
            }
        })
        .catch(function() {
            showError();
            $("#new_emoji_start").attr("disabled", false);
        });
});
//ajax call to edit gift
$("#giftEdit").on("submit", function(e) {
    e.preventDefault();
    
    $("#giftsave").attr("disabled", true);
    
    let form = new FormData();
    form.append("id", $("#id").val());
    form.append("name", $("#name").val());
    form.append("cost_minute", $("#cost_minute").val());
    form.append("receive_minute", $("#receive_minute").val());
    form.append("image", $("#image").prop("files")[0]);
    
    $.ajax({
            url: "/gift-update",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);
            $("#giftsave").attr("disabled", false);

            if (data.success) {
                showSuccess("A gift updated successfully");
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
            $("#giftsave").attr("disabled", false);
        });
});
//ajax call to edit gift
$("#emojiEdit").on("submit", function(e) {
    e.preventDefault();
    
    $("#emojisave").attr("disabled", true);
    
    let form = new FormData();
    form.append("id", $("#id").val());
    form.append("name", $("#name").val());
    form.append("image", $("#image").prop("files")[0]);
    
    $.ajax({
            url: "/emoji-update",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {  
            data = JSON.parse(data);
            $("#emojisave").attr("disabled", false);

            if (data.success) {
                showSuccess("A emoji updated successfully");
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
            $("#emojisave").attr("disabled", false);
        });
});
//ajax call to modify minute
$("#editUserMinute").on("submit", function(e) {
    e.preventDefault();
    $("#modify_minute_button").attr("disabled", true);
    let form = new FormData();
    form.append("user_id", $("#user_id").val());
    form.append("user_points", $("#user_points").val());
    
    $.ajax({
            url: "/user-minute-update",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {          
            data = JSON.parse(data);
            $("#modify_minute_button").attr("disabled", false);

            if (data.success) {
                showSuccess("Data updated successfully");
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
            $("#modify_minute_button").attr("disabled", false);
        });
});
function removeRecordVideo(id, email, myObj) {
    let form = new FormData();
        form.append('id', id);
        form.append('email', email);
        $.ajax({
            url: "/record-one-delete",
            type: "post",
            data: form,
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
                myObj.parentNode.parentNode.remove();  
            }
        })
        .catch(error => {});
}
function removePhotoVideoMessage(id, myObj) {
    
    let form = new FormData();
    form.append('id', id);
    $.ajax({
        url: "/photovideo-message-delete",
        type: "post",
        data: form,
        cache: false,
        contentType: false,
        processData: false,
    })
    .done(function(data) {
        data = JSON.parse(data);
        console.log(data);
        if(data.success)
        {
            showSuccess('A photo or video message deleted successfully!');
            myObj.parentNode.parentNode.remove();  
        }
    })
    .catch(error => {});
}
//ajax call to modify minute
$("#heart_save").on("click", function(e) {
    e.preventDefault();
    $("#heart_save").attr("disabled", true);
    
    let form = new FormData();
    form.append("heart_value", $("#heart_value").val());
    form.append("destroy_value", $("#destroy_value").val());
    $.ajax({
            url: "/record-video-set-update",
            data: form,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
        })
        .done(function(data) {          
            data = JSON.parse(data);
            $("#heart_save").attr("disabled", false);

            if (data.success) {
                showSuccess("Data updated successfully");
            } else {
                showError(data.error);
            }
        })
        .catch(function() {
            showError();
            $("#heart_save").attr("disabled", false);
        });
});