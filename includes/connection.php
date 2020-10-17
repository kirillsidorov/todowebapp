<?php 

        $con = mysqli_connect('localhost','root','root','todoapp');
        if(!$con)
        {
            die (' Please Your Connectino '.mysqli_error());
        }

?>