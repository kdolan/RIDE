<?php
require_once("func.php");


//Store username in variable
   //Get driverName from webauth or textbox if user is admin 
   if(isAdmin())
   {
      $driverName= queryName(secureInput($_POST['driverName']));
   }
   else
   {
       $driverName = $_SERVER['WEBAUTH_USER'];  
   }
   
//connect to Db
connectToDb();   
 
//getVars
 $eventId = secureInput($_POST['eventId']);
 $departDate = secureInput($_POST['departDate']);
 $departTime = secureInput($_POST['departTime']);
 $comments = secureInput($_POST['comments']);
 $seatsAvaliable = secureInput($_POST['seatsAvaliable']);
 //$passengers = $_POST['passengers[]'][2];
 //echo $driverName."<br>";
//echo "Passengers: ".$passengers;

$passengers = $_POST['passegers'];
 


    //Get formated start date   --> to format 2012-09-21 00:00:00 
    $departDate = str_replace("-","/",$departDate); 
    $departDate = $departDate." ".$departTime;

    $timestamp_DepartDate = strtotime($departDate);
    $departDate = date("Y-m-d H:i:s", $timestamp_DepartDate) ;
    

//=== Add Ride to rideTable.
        //Get next avalibable ID
        $queryNextAvail="SELECT * FROM `kevin_ride`.`rideList` ORDER BY `rideList`.`id` DESC";
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

        //Get next avalibable car-ID
        $queryNextAvail="SELECT * FROM `kevin_ride`.`rideList` WHERE `eventId`='$eventId' ORDER BY `rideList`.`carId` DESC";
        $resultNextAvail=mysql_query($queryNextAvail);
        $rowNextAvail = mysql_fetch_array($resultNextAvail);
        if($rowNextAvail['id']=='')
        {
          $carId = 1;
        }  
        else
        {   $carId = $rowNextAvail['id'];
          $carId++;
        } 



        $query="INSERT INTO `kevin_ride`.`rideList` (`id`, `eventId`, `carId`, `isTent`, `tentName`, `driverName`, `comments`, `depatrueTime`, `seatsAvailable`) 
        VALUES ($id, '$eventId', '$carId', '0', 'NA', '$driverName', '$comments', '$departDate', '$seatsAvaliable');";

        //echo $query;

        mysql_query($query);

//Add passengers to table
//Remove duplicates from array of passengers
    $passengers = array_unique($passengers);
     
    //Make sure no users listed already have rides.
    foreach($passengers as $passengerName) 
    {
        //Get the username of the passenger if $passengerName is the format "Kevin Dolan (kdolan)"
        $passengerName = stripUsername($passengerName);
        
        $passengerName = secureInput($passengerName);
        $query = "SELECT * FROM `kevin_ride`.`passengers` WHERE `passengers`.`eventId`=$eventId AND `passengers`.`passengerName` LIKE '$passengerName'";
        $result = mysql_query($query);
        $numRows = mysql_num_rows($result);
        
        if($numRows >= 1)
        {
            //user already has ride for this event.
            header("location:../createRide.php?edit=1&eventId=".$eventId."&carId=".$carId."&ee=2");
            die();
        }
    }
    //Then if no errors add passengers to table
    foreach($passengers as $passengerName) {
        //echo $passengerName.'<br />';
        //Get the username of the passenger if $passengerName is the format "Kevin Dolan (kdolan)"
        $passengerName = stripUsername($passengerName);
        
        $passengerName = secureInput($passengerName);
        
        if($passengerName=='')
        {
            continue;
        }
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
       header("location:../joinRide.php?eventId=".$eventId."&carId=".$carId."&e=4");   
?>