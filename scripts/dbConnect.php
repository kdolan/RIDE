<?php
//Db Login Info
function connectToDb(){
    $host="host"; // Host name
    $dbusername="username"; // Mysql username
    $dbpassword="password"; // Mysql password
    $db_name="dbName"; // Database name
    //$tbl_name="0~0"; // Table name
    
    // Connect to server and select databse.
    
    mysql_connect("$host", "$dbusername", "$dbpassword")or die();
    mysql_select_db("$db_name")or die();
}
?>