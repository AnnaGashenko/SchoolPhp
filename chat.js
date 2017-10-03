/**
 * chat.js - это и есть код сервера (код нашего apache)
 * это серверная сторона
 * пишем серверный код
 * как будет сервер реагировать на запросы к нему и что он будет отвечать
 * */

var app = require('express')();
var http = require('http').Server(app);

// отправляем запрос на сервер
app.get('/', function (req, res) {
    res.send('<h1>Hello world</h1>');
});

// получаем ответ с сервера
// 3000 порту работают socet.io и node.js
http.listen(3000, function () {
    console.log('listening on *:3000');
});
