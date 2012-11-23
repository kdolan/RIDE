<?php
require_once("func.php");

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
 
 $eventId = secureInput($_POST['eventId']);
 
 //Store username in variable
   //getUsername
  if(isAdmin())
   {
      $userName= queryName(secureInput($_POST['driverName']));
   }
   else
   {
       $userName = $_SERVER['WEBAUTH_USER'];
       //Permission error if user did not create this event
       $query = "SELECT * FROM `eventList` WHERE `id`=$eventId AND `eventCreator` LIKE '$userName';";
       $result = mysql_query($query);
       if(mysql_num_rows($result)!=1)
       {
           //user did not create this ride. Permission error.
           echo 'You do not have permission to edit this ride.';
           die();
       }  
   }
 
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
    

if($isCamping=="on")
{
   $isCamping=1; 
}
else
{
    $isCamping=0;
}

if(isAdmin())
{
    //Does not include username verification
      $query="UPDATE `kevin_ride`.`eventList` SET `eventName` = '$eventName',
`description` = '$description',
`isCamping` = '$isCamping',
`depatrueStart` = '$startDate',
`depatrueEnd` = '$endDate'
WHERE `eventList`.`id`=$eventId;";  
}
else
{
  $query="UPDATE `kevin_ride`.`eventList` SET `eventName` = '$eventName',
`description` = '$description',
`isCamping` = '$isCamping',
`depatrueStart` = '$startDate',
`depatrueEnd` = '$endDate'
WHERE `eventList`.`eventCreator` LIKE '$userName' AND `eventList`.`id`=$eventId;";  
}


//echo $query;

mysql_query($query);

header("location:../selectEvent.php?e=5");

?>