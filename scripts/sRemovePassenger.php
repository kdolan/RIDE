<?php
require_once("func.php");
require_once("notify/api.php");

    //Verify user can join ride
        //User is not part of other rides for event
        //User has not created a ride for this event
    

  connectToDb();
  
    
  $eventId = secureInput($_GET['eventId']);
  $carId = secureInput($_GET['carId']);
  $passengerName = secureInput($_GET['passengerName']);
  
  //getUsername
  $userName = $_SERVER['WEBAUTH_USER'];
  
  //getUsername
  if(isAdmin())
   {
      //Do nothing. Remove the user from ride.
   }
   else
   {
       $driverName = $_SERVER['WEBAUTH_USER'];
       //Permission error if user did not create this ride
       $query = "SELECT * FROM `rideList` WHERE `eventId`=$eventId AND `carId`=$carId AND `driverName` LIKE '$driverName';";
       $result = mysql_query($query);
       if(mysql_num_rows($result)!=1)
       {
           //user did not create this ride. Permission error.
           echo 'You do not have permission to edit this ride.';
           die();
       }  
   }
  
  $query = "DELETE FROM `kevin_ride`.`passengers` WHERE `passengers`.`eventId` =$eventId AND `passengers`.`carId`=$carId AND `passengers`.`passengerName` LIKE '$passengerName'";
  
  mysql_query($query);
  
 
  //PassengerName is what is stored in the db in the passenger table. 
  //If queryUsername does not return a valid full name then this person is 
  //a non member. Return
  //$passengerName is now validated as a valid CSH username.
  $fullName = queryUsername($passengerName);
  
  if($fullName == "username_query_returns_null")
  {
      //user is not part of CSH. Nothing else to do. Return.
      header("location:../createRide.php?edit=1&eventId=".$eventId."&carId=".$carId."&e=1"); 
      die();
  }

  //Notify user that was removed.
  $queryEvent = "SELECT * FROM  `eventList` WHERE `id`=$eventId";
  $eventResult = mysql_query($queryEvent);
  $event = mysql_fetch_array($eventResult);
  $eventName = $event['eventName'];
  notify($passengerName, "You have been removed from your ride for ".$eventName.". Check rides.csh.rit.edu for more info.");
  
  //Added by driver is set to 1 becasue the user is being removed by an admin or the driver.
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
   $query = "INSERT INTO `kevin_ride`.`passengers` (`id`, `eventId`, `carId`, `addedByDriver`, `passengerName`) 
    
    VALUES ($id, '$eventId', '0', '1', '$passengerName')";
    
    mysql_query($query);
  
   header("location:../createRide.php?edit=1&eventId=".$eventId."&carId=".$carId."&e=1"); 
  
  
  ?>