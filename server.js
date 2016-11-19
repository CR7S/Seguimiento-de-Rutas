var express = require('express');
var app = express();
var path = require('path');
var bodyParser = require('body-parser');
var fs = require('fs');
var http = require('http').Server(app);
var io = require('socket.io')(http);

io.on('connection', function(socket){
  console.log('usuario conectado');
});

fs.watch('cordenadas/', 
	function (event, filename) {
		console.log('filename: ' + filename);
		fs.readFile('cordenadas/'+filename, 
			'utf8', 
			function (err, data) {
				try{
					if (err) throw err;
					var datos = JSON.parse(data);
					io.emit('datos', datos);
				}
				catch(err){
					
					io.emit('datos',datos);
				}
		});
});

app.use(express.static(__dirname + '/public'));
app.set('views', __dirname + '/views');
app.engine('html', require('ejs').renderFile);
app.set('view engine', 'html');

app.get('/', function(req, res) {
    res.render('index.html');
});

http.listen(3000, function(){
  console.log('Escuchando en puerto 3000');
});
