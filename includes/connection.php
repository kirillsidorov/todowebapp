<?php 
        if ($_SERVER['SERVER_NAME'] == "todowebappforgarage.herokuapp.com") {
            /*$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $host = $url["host"];
            $username = $url["user"];
            $password = $url["pass"];
            $dbname = substr($url["path"], 1);
        */
        $host = 'eu-cdbr-west-03.cleardb.net';
        $dbname = 'heroku_497ae4fd7fac821';
        $username = 'ba9a49bb38ec81';
        $password = '82979d1b';


        } else {
            $host = 'localhost';
            $username = 'root';
            $password = 'root';
            $dbname = 'todoapp';
        }

        $con = mysqli_connect($host, $username,$password,$dbname);
        
        if(!$con){
            die (' Please Your Connectino '.mysqli_error());
        }?>