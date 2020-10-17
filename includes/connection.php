<?php 
        $host = '';
        $dbname = '';
        $username = '';
        $password = '';
        
        if ($_SERVER['SERVER_NAME'] == "thawing-island-242342379.herokuapp.com") {
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $host = $url["host"];
            $username = $url["user"];
            $password = $url["pass"];
            $dbname = substr($url["path"], 1);
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