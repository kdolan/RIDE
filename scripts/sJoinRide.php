<?php 
require_once("func.php");

    //Verify user can join ride
        //User is not part of other rides for event
        //User has not created a ride for this event
    

  connectToDb();
    
  $eventId = secureInput($_GET['eventId']);
  $carId = secureInput($_GET['carId']);
  
  //getUsername
  $userName = $_SERVER['WEBAUTH_USER'];
  
  //Add to passenger table
  
  //Get next avalibable ID
    $queryNextAvail="SELECT * FROM `kevin_ride`.`passengers` ORDER BY `passengers`.`id` DESC";
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
       //If user is listed as needing ride. Remove them from the table as needing ride  
    $query = "   DELETE FROM `kevin_ride`.`passengers` WHERE 
             `passengers`.`eventId` =$eventId AND `passengers`.`carId`=0 AND `passengers`.`passengerName` LIKE '$userName'";
  
    mysql_query($query); 
    
  //Add user to passenger table
    $query = "INSERT INTO `kevin_ride`.`passengers` (`id`, `eventId`, `carId`, `addedByDriver`, `passengerName`) 
    
    VALUES ($id, '$eventId', '$carId', '0', '$userName')";
    
    mysql_query($query);
  
  
    
    //echo $query;
    
    header("location:../joinRide.php?e=1&eventId=".$eventId);  

?>