/*jshint esversion: 6 */
/*jshint node: true */
"use strict";

require("dotenv").config();

const express = require("express");
const app = express();
const fs = require("fs");
const cors = require('cors')
const options = {
    key: fs.readFileSync(process.env.KEY_PATH),
    cert: fs.readFileSync(process.env.CERT_PATH),
};

app.use(function(req, res, next) {
  res.header("Access-Control-Allow-Origin", "https://losmagz.com");
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  next();
});

const https = require("https").Server(options, app);
const io = require("socket.io")(https);
const listner = https.listen(process.env.PORT, function () {
    console.log("Listening on app.js ", listner.address().port);
});

//allow only the specified domain to connect
//io.set("origins", process.env.DOMAIN + ":*");
io.set('origins', '*:*');

require("./socket")(io);
