<?php
require_once("func.php");

  

//connect to Db
connectToDb();   
 
//getVars
 $eventId = secureInput($_POST['eventId']);
 $departDate = secureInput($_POST['departDate']);
 $departTime = secureInput($_POST['departTime']);
 $comments = secureInput($_POST['comments']);
 $seatsAvaliable = secureInput($_POST['seatsAvaliable']);
 
 $carId = secureInput($_POST['carId']);
 
//Store username in variable
   //Get driverName from webauth or textbox if user is admin 
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

$passengers = $_POST['passegers']; //get array of passengers.
 


    //Get formated start date   --> to format 2012-09-21 00:00:00 
    $departDate = str_replace("-","/",$departDate); 
    $departDate = $departDate." ".$departTime;

    $timestamp_DepartDate = strtotime($departDate);
    $departDate = date("Y-m-d H:i:s", $timestamp_DepartDate) ;
    

//=== Add Ride to rideTable.




        $query="UPDATE `kevin_ride`.`rideList` SET
            `comments` = '$comments',
            `driverName` = '$driverName',
            `depatrueTime` = ' $departDate',
            `seatsAvailable` = '$seatsAvaliable' WHERE `rideList`.`eventId` =$eventId AND `rideList`.`carId`=$carId;" ;

        //echo $query;

        mysql_query($query);
        
        //If driver is listed as needing ride. Remove them from the table as needing ride  
         $query = "DELETE FROM `kevin_ride`.`passengers` WHERE 
             `passengers`.`eventId` =$eventId AND `passengers`.`carId`=0 AND `passengers`.`passengerName` LIKE '$driverName'";
             mysql_query($query); 

//Add passengers to table
 //Check to see if passenger already has a ride for this event  
    
    //Remove duplicates from array of passengers
    if($passengers==null)
    {
        header("location:../joinRide?eventId=$eventId&currentEvents=1&e=7"); 
    }
    $passengers = array_unique($passengers);
    
    //Make sure no users listed already have rides.
    foreach($passengers as $passengerName) 
    {
        //Get the username of the passenger if $passengerName is the format "Kevin Dolan (kdolan)"
        $passengerName = stripUsername($passengerName);
        
        $passengerName = secureInput($passengerName);
        $query = "SELECT * FROM `kevin_ride`.`passengers` WHERE `passengers`.`eventId`=$eventId AND `passengers`.`passengerName` LIKE '$passengerName' AND `passengers`.`carId`!=0";
         //echo  $query;
        $result = mysql_query($query);
        $numRows = mysql_num_rows($result);
        
        if($numRows >= 1)
        {
            //user already has ride for this event.
            header("location:../createRide.php?edit=1&eventId=".$eventId."&carId=".$carId."&ee=1");
            die(); 
        }
    }
    //Then if no errors add passengers to table
        
    foreach($passengers as $passengerName) {
        //echo $passengerName.'<br />';
        
        if($passengerName=='')
        {
            continue;
        }
        //Get the username of the passenger if $passengerName is the format "Kevin Dolan (kdolan)"
        $passengerName = stripUsername($passengerName);
        
        $passengerName = secureInput($passengerName);
        
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
        
        VALUES ($id, '$eventId', '$carId', '1', '$passengerName');  ";
        
         mysql_query($query);
         
        //If user is listed as needing ride. Remove them from the table as needing ride  
         $query = "   DELETE FROM `kevin_ride`.`passengers` WHERE 
             `passengers`.`eventId` =$eventId AND `passengers`.`carId`=0 AND `passengers`.`passengerName` LIKE '$passengerName'";
             mysql_query($query); 
    } 
     header("location:../joinRide?eventId=$eventId&currentEvents=1&e=7"); 
?> 