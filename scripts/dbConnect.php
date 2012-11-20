<?php
//Db Login Info
function connectToDb(){
    $host="hostname.com"; // Host name
    $dbusername="db_user"; // Mysql username
    $dbpassword="db_password"; // Mysql password
    $db_name="db_name"; // Database name
    //$tbl_name="0~0"; // Table name
    
    // Connect to server and select databse.
    
    mysql_connect("$host", "$dbusername", "$dbpassword")or die();
    mysql_select_db("$db_name")or die();
}
?>