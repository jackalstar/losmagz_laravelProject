/*jshint esversion: 6 */
/*jshint node: true */
const geoip = require("geoip-country");
let videoUsers = [];
let textUsers = [];
//set user properties and request next partner
function handleStart(socket, io, data) {    
    let geo = geoip.lookup(data.ip) || "127.0.0.1";
    let user = {
        id: socket.id,
        email: data.email,
        username: data.username,
        gender: data.gender,
        country: geo.country,
        ip: data.ip,
        isWaiting: true,
        isConnected: false,
        partner: null,
        PartnerEmail: '',
        chatType: '',
        genderFilter: data.genderFilter,
        countryFilter: data.countryFilter,
    };
    textUsers[socket.id] = user;
    videoUsers[socket.id] = user;
    console.log('videoUsers in handleStart');
    console.log(videoUsers);
    console.log('textUsers in handleStart');
    console.log(textUsers);
    sendToPeer(io, {
        type: "selfData",
        toSocketId: socket.id,
        country: geo.country,
        ip: user.ip,
    });    
}
//find a partner
function handleNext(currentUser, socketId, io, data) {
    let partner;
    console.log("In handleNext(video), I am " + currentUser.username);
    
    //release the current connection if any
    if (videoUsers[socketId].isConnected && videoUsers[socketId].partner) {
        let partnerId = videoUsers[socketId].partner;
        setVideoUserProperties(socketId, true, false, null, '');
        if (videoUsers[partnerId]) {
            //notify the opponent if available
            sendToPeer(io, {
                type: "partnerLeft",
                toSocketId: partnerId,
            });
            setVideoUserProperties(partnerId, true, false, null, '');
        }
    }
    //find the partner from videoUsers
    for (let possiblePartner of Object.values(videoUsers)) {
        if (
            possiblePartner.id !== currentUser.id &&
            possiblePartner.isWaiting &&
            possiblePartner.chatType == 'video' &&
            checkFilter(
                currentUser.gender,
                possiblePartner.gender,
                currentUser.genderFilter,
                possiblePartner.genderFilter
            ) &&
            checkFilter(
                currentUser.country,
                possiblePartner.country,
                currentUser.countryFilter,
                possiblePartner.countryFilter
            )
        ) {
            partner = possiblePartner;
            console.log('In handleNext(video) I am connected with ' + partner.username );
            console.log('videoUsers in handleNext');
            console.log(videoUsers);
            break;
        }
    }
    try {
        if (partner && partner.isWaiting && currentUser.isWaiting) {
            console.log('before seting why they are connected')
            console.log(videoUsers);
            setVideoUserProperties(partner.id, false, true, currentUser.id, currentUser.email);
            setVideoUserProperties(currentUser.id, false, true, partner.id, partner.email);
            videoUsers[currentUser.id].chatType = '';
            videoUsers[partner.id].chatType = '';
            console.log('after seting why they are connected')
            console.log(videoUsers);
            sendToPeer(io, {
                type: "match",
                toSocketId: currentUser.id,
                email: partner.email,
                username: partner.username,
                partnerCountry: partner.country,
                ip: partner.ip,
                country: currentUser.country,
                chatType: 'video',
            });
        }
        else {
            console.log('I can not find my partner');
            console.log('before seting why I push videoUsers')
            console.log(currentUser);
            currentUser.chatType = 'video';
            console.log('after seting why I push videoUsers')
            console.log(currentUser);
        }
    } catch (e) {
        console.log("Error occurred: ", e);
    }
}
function handleVideoDisconnect(currentUser, socketId, io, data) {
    console.log('this is video stop part')
    console.log(socketId);
    console.log('videoUsers in disconnect');
    console.log(videoUsers);
    if (videoUsers[socketId].isWaiting) {
        videoUsers[socketId].chatType = '';
        console.log('videoUsers in after deleting');
        console.log(videoUsers);
    }
    else {
        console.log('this user is connected with some one')
        let partnerId = currentUser.partner;
        setVideoUserProperties(currentUser.id, true, false, null, '');
        videoUsers[currentUser.id].chatType = '';
        videoUsers[partnerId].chatType = 'video';
        if (videoUsers[partnerId]) {
            sendToPeer(io, {
                type: "partnerLeft",
                toSocketId: partnerId,
            });
            setVideoUserProperties(partnerId, true, false, null, '');
        }
        console.log('videoUsers in after left');
        console.log(videoUsers);
    }
}

function handleDirectConnect(currentUser, socketId, io, data) {
    console.log(data);
    console.log("In handle DirectConnect, I am " + currentUser.username);
    console.log('in handle DirectConnect, partner_email ' + data.partner_email)
    let partner;
    let PartnerStatus;
    let leftPartner = false;
    //set self textUsers property
    for (let myPartner of Object.values(textUsers)) {
        if ( myPartner.email == currentUser.PartnerEmail && myPartner.PartnerEmail == currentUser.email &&          //if I and my partner is connecting now, I have to disconnect with my partner and 
             myPartner.isWaiting == false && myPartner.isConnected == true && currentUser.isWaiting == false && currentUser.isConnected == true )//I have to set my partner's property to find me.
        {
            //set my partner's property to fine me
            myPartner.isWaiting = true;
            myPartner.isConnected = false;
            //set my property to find another partner
            currentUser.isWaiting = true;
            currentUser.isConnected = false;
            currentUser.partner = null;
            currentUser.PartnerEmail = data.partner_email;
            
            leftPartner = true;
            console.log('my textUsers after left my old partner')
            console.log('currentUser');      
            console.log(currentUser);      
            console.log('myPartner');
            console.log(myPartner);
            break;
        }   
        else {                                                  //if I am in status that is not connected with anyone. then I have to set my property to find my partner.
            currentUser.PartnerEmail = data.partner_email;
            console.log('my textUsers in settings')
            console.log(currentUser);        
        }
    }
    for (let myPartner of Object.values(textUsers)) {
        console.log('I am in sakdfj;lkas')
        console.log(textUsers)
        console.log(currentUser)
        if ( myPartner.email == currentUser.PartnerEmail && myPartner.PartnerEmail == currentUser.email &&
             myPartner.isWaiting == true && myPartner.isConnected == false ) 
        {
            console.log('I am in aaa')
            partner = myPartner;
            PartnerStatus = 'partner';
            
            console.log("In textUsers, I found my partner " + partner.username + " He is partner");
            console.log(partner);
            break;
        }
        else if ( myPartner.email == currentUser.PartnerEmail && myPartner.PartnerEmail == '' &&
                  myPartner.isWaiting == true && myPartner.isConnected == false )
        {
            console.log('I am in bbb')
            partner = myPartner;
            PartnerStatus = 'home';
            console.log("In textUsers, I found my partner " + partner.username + " He is home");
            console.log(partner);
            break;
        }
        else if ( myPartner.email == currentUser.PartnerEmail && myPartner.PartnerEmail != '' && myPartner.PartnerEmail != currentUser.email &&
                  myPartner.isWaiting == true && myPartner.isConnected == false )
        {
            console.log('I am in ccc')
            partner = myPartner;
            PartnerStatus = 'home';
            console.log("In textUsers, I found my partner " + partner.username + " He is finding_other");
            console.log(partner);
            break;
        }
        else if ( myPartner.email == currentUser.PartnerEmail && myPartner.PartnerEmail != '' && myPartner.PartnerEmail != currentUser.email &&
                  myPartner.isWaiting == false && myPartner.isConnected == true )
        {
            console.log('I am in ddd')
            partner = myPartner;
            PartnerStatus = 'home';
            console.log("In textUsers, I found my partner " + partner.username + " He is connected_other");
            console.log(partner);
            break;
            
        }
        else {
            console.log('I am in eee')
            PartnerStatus = 'offline';
            console.log("In textUsers, I didn't find my partner  He is offline");
        }
    }
    try {
        switch (PartnerStatus) {
            case "partner" : {
                currentUser.isWaiting = false;
                currentUser.isConnected = true
                currentUser.partner = partner.id;
                partner.isWaiting = false;
                partner.isConnected = true;
                partner.partner = currentUser.id;
                console.log('textUsers after you connected with someone who you are looking for')
                console.log(textUsers)
                //notify the parner about the match
                sendToPeer(io, {
                    type: "match",
                    toSocketId: currentUser.id,
                    username: partner.username,
                    email: partner.email,
                    country: currentUser.country,
                    partnerCountry: partner.country,
                    ip: partner.ip,
                    chatType: 'text',
                    textPartnerStatus: 'partner',
                    leftPartner: leftPartner,
                });
                break;
            }
            case "home" : {
                currentUser.partner = partner.id;
                //notify the parner about the match
                sendToPeer(io, {
                    type: "match",
                    toSocketId: currentUser.id,
                    username: partner.username,//
                    email: partner.email,
                    country: currentUser.country,
                    partnerCountry: partner.country,//
                    ip: partner.ip,//
                    chatType: 'text',
                    textPartnerStatus: 'home',
                    leftPartner: leftPartner,
                });
                break;
            }
            case "offline" : {
                //notify the parner about the match
                sendToPeer(io, {
                    type: "match",
                    toSocketId: currentUser.id,
                    email: data.partner_email,
                    country: currentUser.country,
                    chatType: 'text',
                    textPartnerStatus: 'offline',
                    leftPartner: leftPartner,
                });
                break;
            }
        }
    } catch (e) {
        console.log("Error occurred: ", e);
    }
}
function handleUnreadMessage(currentUser, socketId, io, data) {
    console.log('this is in handleUnreadMessage function');
    console.log(data)
    console.log('textUsers in handle unread message')
    console.log(textUsers)
    let partner;
    for (let myPartner of Object.values(textUsers)) {
        if (myPartner.email == data.PartnerEmail) {
            partner = myPartner;
            console.log('I found my unread message partner in textUsers')
            console.log(partner)
            break;
        }
    }
    try {
        if (partner) {
            console.log('data for update recent message data for update recent message data for update recent message data for update recent message data for update recent message')
            console.log(data)
            //notify the parner about the match
            sendToPeer(io, {
                type: "notify_unread_message",
                toSocketId: partner.id,
                partner_email: data.partner_email,
                message_source: data.message_source,
                message_trans: data.message_trans,
                message_type: data.message_type,
                read: data.read,
            });
        }
    }
    catch(e){
        console.log("Error occurred: ", e);
    }
    
} 
function handleCallOffer(currentUser, socketId, io, data) {
    console.log('This is in handleCallOffer function')
    console.log(data);
    let partner;
    for (let myPartner of Object.values(videoUsers)) {
        console.log('If your partner is online or offline in videoUsers')
        console.log('videoUsers')
        console.log(videoUsers)
        if ( myPartner.email == data.partner_email ) 
        {
            partner = myPartner;
            break;
        }
    }
    try {
        if(partner) {
            console.log('your partner is online')
            console.log(partner.id)
            //notify the opponent
            sendToPeer(io, {
                type: "callOffer",
                toSocketId: partner.id,
                partner_email: data.email,
                call_status: 'success',
            });
        }
        else {
            //notify the opponent
            sendToPeer(io, {
                type: "callOffer",
                toSocketId: currentUser.id,
                partner_email: data.email,
                call_status: 'failed',
            });
        }
    }
    catch(e) {
        console.log('an erroro occured in handle direct call function')
    }
}
function handleCallOfferCancel(currentUser, socketId, io, data) {
    console.log('This is in handleCallOfferCancel function')
    console.log(data);
    let partner;
    for (let myPartner of Object.values(videoUsers)) {
        if ( myPartner.email == data.partner_email ) 
        {
            partner = myPartner;
            sendToPeer(io, {
                type: "callOfferCancel",
                toSocketId: partner.id,
                message: "This user is offline. I am socket js",
            });
            break;
        }
    }
}

function handleCallAnswerCancel(currentUser, socketId, io, data) {
    console.log('This is in handleCallAnswerCancel function')
    console.log(data);
    let partner;
    for (let myPartner of Object.values(videoUsers)) {
        if ( myPartner.email == data.partner_email ) 
        {
            partner = myPartner;
            sendToPeer(io, {
                type: "callAnswerCancel",
                toSocketId: partner.id,
                message: "I don't like you",
            });
            break;
        }
    }
}
function handleCallAnswerAccept(currentUser, socketId, io, data) {
    console.log('This is in handleCallAnswerAccept function')
    console.log(data);
    let partner;
    for (let myPartner of Object.values(videoUsers)) {
        if ( myPartner.email == data.partner_email ) 
        {
            partner = myPartner;
            sendToPeer(io, {
                type: "callAnswerAccept",
                toSocketId: partner.id,
                message: "I agree with you",
            });
            console.log('videoUsers in call accept before deleting')
            console.log(videoUsers)
            setVideoUserProperties(partner.id, false, true, currentUser.id, currentUser.email);
            setVideoUserProperties(currentUser.id, false, true, partner.id, partner.email);
            
            console.log('videoUsers in call accept after deleting')
            console.log(videoUsers)
            
            sendToPeer(io, {
                type: "match",
                toSocketId: currentUser.id,
                email: videoUsers[partner.id].email,
                username: videoUsers[partner.id].username,
                partnerCountry: videoUsers[partner.id].country,
                ip: videoUsers[partner.id].ip,
                country: currentUser.country,
                chatType: 'video',
            });
            break;
        }
    }
}
//check gender and country filter
function checkFilter(self, partner, selfFilter, partnerFilter) {
    if (!selfFilter && !partnerFilter) return true;

    let flagSelf = true;
    let flagPartner = true;

    if (partnerFilter) {
        flagSelf = self === partnerFilter;
    }

    if (selfFilter) {
        flagPartner = partner === selfFilter;
    }

    return flagSelf && flagPartner;
}

//handle disconnect event
function handleDisconnect(socketId, io) {
    console.log('deleted socket id is :' + socketId);
    console.log('videoUsers in disconnect');
    console.log(videoUsers);
    console.log('textUsers in disconnect');
    console.log(textUsers);
    //for remove line state when user disconnect
    if (videoUsers[socketId] != undefined) {
        sendToAll(io, {
            type: "offlineCount", 
            email: videoUsers[socketId].email,
        });    
    }
    if (videoUsers[socketId] && videoUsers[socketId].isConnected) {
        //notify the opponent
        sendToPeer(io, {
            type: "partnerLeft",
            toSocketId: videoUsers[socketId].partner,
        });
    }
    if (videoUsers[socketId]) delete videoUsers[socketId];
    if (textUsers[socketId]) delete textUsers[socketId];
    
    console.log('videoUsers in after deleting');
    console.log(videoUsers);
    console.log('textUsers in after deleting');
    console.log(textUsers);
}
function setVideoUserProperties(socketId, isWaiting, isConnected, partner, PartnerEmail) {
    if (!videoUsers[socketId]) return;
    videoUsers[socketId].isWaiting = isWaiting;
    videoUsers[socketId].isConnected = isConnected;
    videoUsers[socketId].partner = partner;
    videoUsers[socketId].PartnerEmail = PartnerEmail;
}
//send the message to particular user
function sendToPeer(io, data) {
    
    console.log("SendToPeer function type is " + data.type)
    console.log("toSocketId " + data.toSocketId)
    io.to(data.toSocketId).emit("message", JSON.stringify(data));
}

//send the message to all the users
function sendToAll(io, data) {
    io.sockets.emit("message", JSON.stringify(data));
}

module.exports = function(io) {
    //broadcast online users count
    setInterval(function() {
        const all_users = [];
        for (let alluser of Object.values(videoUsers)) {
            all_users.push(alluser.email);
        }
        sendToAll(io, {
            type: "onlineCount", 
            all_users: all_users,
        })
    }, 1000);

    //handle connection event
    io.sockets.on("connection", function(socket) {
        
        socket.on("message", function(data) {
            data = JSON.parse(data);
            switch (data.type) {
                case "start":
                    handleStart(socket, io, data);   
                    break;
                case "next":
                    if (videoUsers[socket.id])
                        handleNext(videoUsers[socket.id], socket.id, io, data);
                    break;
                case "directconnect":
                    if (textUsers[socket.id])
                    {
                        if ( textUsers[socket.id].PartnerEmail == '' || ( textUsers[socket.id].PartnerEmail != '' && textUsers[socket.id].PartnerEmail != data.partner_email )) {
                            console.log( 'Call handle direct connect function ')
                            handleDirectConnect(textUsers[socket.id], socket.id, io, data);       
                        }
                    }
                    break;
                case "unread_message":
                    if (textUsers[socket.id])
                    {
                        console.log('here is unread message handle');
                        handleUnreadMessage(textUsers[socket.id], socket.id, io, data);
                    }
                    break;
                case "callOffer":
                    if (videoUsers[socket.id])
                    {
                        handleCallOffer(videoUsers[socket.id], socket.id, io, data); 
                    }
                    break;
                case "callOfferCancel":
                    if (videoUsers[socket.id])
                    {
                        handleCallOfferCancel(videoUsers[socket.id], socket.id, io, data); 
                    }
                    break;
                case "callAnswerCancel":
                    if (videoUsers[socket.id])
                    {
                        handleCallAnswerCancel(videoUsers[socket.id], socket.id, io, data); 
                    }
                    break;
                case "callAnswerAccept":
                    if (videoUsers[socket.id])
                    {
                        handleCallAnswerAccept(videoUsers[socket.id], socket.id, io, data); 
                    }
                    break;
                case "offer":
                case "answer":
                case "candidate":
                case "message":
                case "textConnected":
                case "typing":
                    if (videoUsers[socket.id]) {
                        data.toSocketId = videoUsers[socket.id].partner;
                        sendToPeer(io, data);
                    }
                    break;
                case "updateGenderFilter":
                    videoUsers[socket.id].genderFilter = data.genderFilter;
                    break;
                case "updateCountryFilter":
                    videoUsers[socket.id].countryFilter = data.countryFilter;
                    break;
                case "video-stop":
                    if (videoUsers[socket.id])
                    {
                        handleVideoDisconnect(videoUsers[socket.id], socket.id, io, data);   
                    }
                    break;
            }
        });

        socket.on("disconnect", function() {
            console.log('socket.js disconnect work')
            handleDisconnect(socket.id, io);
        });
    });
};