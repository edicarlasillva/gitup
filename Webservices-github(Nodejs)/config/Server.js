var express = require('express');
var app = express()
var cors = require('cors')

app.use(cors())

var prefix = "/api/v1/"

var gitup = require("../src/router/router")
app.use(prefix+"gitup",gitup)

module.exports = app