<?php 
require_once("func.php");

  connectToDb();
    
  $eventId = secureInput($_GET['eventId']);
  $carId = secureInput($_GET['carId']);
  
  //getUsername
  $userName = $_SERVER['WEBAUTH_USER'];
  
  //Remove from passenger table
  
  
    $query = "DELETE FROM `kevin_ride`.`rideList` 
    WHERE `rideList`.`eventId` = $eventId AND `rideList`.`carId` = '$carId'" ;
    
    if(mysql_query($query))
    {
       //If susessfull also delte the passengers of that ride
         $passengersOfRide = mysql_query("SELECT * FROM `kevin_ride`.`passengers` WHERE `passengers`.`eventId`=$eventId AND `passengers`.`carId`=$carId");
         while($passenger = mysql_fetch_array($passengersOfRide))
         {
             $passengerName = $passenger['passengerName'];
             $query = "DELETE FROM `kevin_ride`.`passengers` WHERE 
             `passengers`.`eventId` =$eventId AND `passengers`.`carId`=$carId AND `passengers`.`passengerName` LIKE '$passengerName'";
             mysql_query($query);
  
             //Notify user that was removed. 
        
         }
        
    }
    
    //echo $query;
    
     header("location:../joinRide.php?e=3&eventId=".$eventId);    

?>