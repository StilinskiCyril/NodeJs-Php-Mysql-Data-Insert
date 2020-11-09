const http = require('http');
const mysql = require('mysql');
const { parse } = require('querystring');

//initialise the database connection
const con = mysql.createConnection({
    host: "localhost",
    user: "your mysql user",
    password: "your mysql pass",
    database: "NODEJSPHPINSERT"
});

// Create a server object
const server = http.createServer(function (req, res) {
    res.write('Data inserted');
    // res.end();
    if(req.url ==='/save') {
        collectRequestData(req, result => {
            //connect to the database
            con.connect(function(err) {
                // in case of error
                if(err){
                    console.log(err.code);
                    console.log(err.fatal);
                }
                const user_name = result.name;
                const user_email = result.email;
                const user_phone = result.phone;
                const sql = 'INSERT INTO users (`name` , `email`, `phone`) VALUES ?';
                const values = [
                    [user_name, user_email, user_phone]
                ];
                //execute the query
                con.query(sql, [values], function (err, rows) {
                    if(err){
                        console.log("An error occurred performing the query.");
                        return;
                    }
                    console.log(rows.affectedRows + "row(s) affected");
                });
                // Close the connection
                con.end(function(){
                    // The connection has been closed
                });
            });
        });
    }
})

server.listen(4000, function() {

    // The server object listens on port 3000
    console.log("server start at port 4000");
});

function collectRequestData(request, callback) {
    const FORM_URLENCODED = 'application/x-www-form-urlencoded';
    if(request.headers['content-type'] === FORM_URLENCODED) {
        let body = '';
        request.on('data', chunk => {
            body += chunk.toString();
        });
        request.on('end', () => {
            callback(parse(body));
        });
    }
    else {
        callback(null);
    }
}






