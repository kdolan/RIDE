<?php
require_once("func.php");

    //Verify user can join ride
        //User is not part of other rides for event
        //User has not created a ride for this event
    

  connectToDb();
    
  $eventId = secureInput($_GET['eventId']);
  $carId = secureInput($_GET['carId']);
  $passengerName = secureInput($_GET['passengerName']);
  
  //getUsername
  $userName = $_SERVER['WEBAUTH_USER'];
  
  $query = "DELETE FROM `kevin_ride`.`passengers` WHERE `passengers`.`eventId` =$eventId AND `passengers`.`carId`=$carId AND `passengers`.`passengerName` LIKE '$passengerName'";
  
  mysql_query($query);
  
  //Notify user that was removed.
  
   header("location:../createRide.php?edit=1&eventId=".$eventId."&carId=".$carId."&e=1"); 
  
  
  ?>