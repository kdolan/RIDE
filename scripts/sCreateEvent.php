<?php
require_once("func.php");

//verify web-auth

//Store username in variable
   //Then replace DB_USR in query


   //connect to Db
connectToDb(); 

 
//getVars
 $eventName = secureInput($_POST['eventName']);
 $description = secureInput($_POST['description']);
 $isCamping = secureInput($_POST['campingTrip']);
 $startDate = secureInput($_POST['startDate']);
 $startTime = secureInput($_POST['startTime']);
 $endDate = secureInput($_POST['endDate']);
 $endTime = secureInput($_POST['endTime']);
 
//echo $eventName." ".$description." ".$isCamping." ".$startDate." ".$startTime." ".$endDate." ".$endTime;  

    //Get formated start date   --> to format 2012-09-21 00:00:00 
    $startDate = str_replace("-","/",$startDate); 
    $startDate = $startDate." ".$startTime;

    $timestamp_StartDate = strtotime($startDate);
    $startDate = date("Y-m-d H:i:s", $timestamp_StartDate) ;

    //Get formated end date  --> to format 2012-09-21 00:00:00 
    $endDate = str_replace("-","/",$endDate); 
    $endDate = $endDate." ".$endTime;

    $timestamp_EndDate = strtotime($endDate);
    $endDate = date("Y-m-d H:i:s", $timestamp_EndDate);
    

//Get next avalibable ID
$queryNextAvail="SELECT * FROM `kevin_ride`.`eventList` ORDER BY `eventList`.`id` DESC";
$resultNextAvail=mysql_query($queryNextAvail);
$rowNextAvail = mysql_fetch_array($resultNextAvail);
if($rowNextAvail['id']=='')
{
  $id = 1;
}  
else
{   $id = $rowNextAvail['id'];
  $id++;
} 

if($isCamping=="on")
{
   $isCamping=1; 
}
else
{
    $isCamping=0;
}
$userName = $_SERVER['WEBAUTH_USER'];   

$query="INSERT INTO `kevin_ride`.`eventList` (`id`, `eventName`, `description`, `isCamping`, `depatrueStart`, `depatrueEnd`, `eventCreator`) 

VALUES ('$id', '$eventName', '$description', '$isCamping', '$startDate', '$endDate', '$userName');";

mysql_query($query);

header("location:../selectEvent.php?e=6"); 

?>