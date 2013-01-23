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
  
  //getUsername
  if(isAdmin())
   {
      //Do nothing. Allow user to add ride.
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
   
   if(fullRide($eventId,$carId)==false)
   {
        //Change user from needing ride to correct ride. Added by driver is true.
        $query = " UPDATE  `kevin_ride`.`passengers` SET  `carId` =  '$carId', `addedByDriver` =  '1' WHERE  `passengers`.`passengerName`='$passengerName' AND `passengers`.`eventID`=$eventId AND `passengers`.`carID`=0;" ;
  
      //echo $query;
      
      mysql_query($query);
      
      
      //Notify user that they were added to ride.
      

       header("location:../addPassengers.php?eventId=".$eventId."&carId=".$carId."&e=1"); 
   
   }
   else
   {
       header("location:../addPassengers.php?eventId=".$eventId."&carId=".$carId."&ee=1"); 
   }
  

  
  ?>