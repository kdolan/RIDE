<?php 
require_once("func.php");

    //Verify user is on this ride and can cancel it
        //User has not created a ride for this event
    

  connectToDb();
    
  $eventId = secureInput($_GET['eventId']);
  $carId = secureInput($_GET['carId']);
  
  $userName = $_SERVER['WEBAUTH_USER'];
  
  //Remove from passenger table
  
  
    $query = "DELETE FROM `kevin_ride`.`passengers` 
    WHERE `passengers`.`eventId` = $eventId AND `passengers`.`carId` = '$carId' AND `passengers`.`passengerName` LIKE '$userName' " ;
    
    mysql_query($query);
    
    //echo $query;
    
     header("location:../joinRide.php?e=2&eventId=".$eventId);    

?>