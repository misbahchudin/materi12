<?php
  date_default_timezone_set('Asia/Jakarta');
  
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "123456";
  $dbname = "db_rs";

  $theLINK = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) 
             or die("Database tidak bisa terhubung");

  $thePORT = "http://127.0.0.1/materi12/";

  $thePROGRAM = "";
?>