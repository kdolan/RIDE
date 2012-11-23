<?php 
require_once("func.php");

  connectToDb();
    
  $eventId = secureInput($_GET['eventId']);
  $carId = secureInput($_GET['carId']);
  
  //getUsername
  if(isAdmin())
   {
      $driverName= queryName(secureInput($_POST['driverName']));
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