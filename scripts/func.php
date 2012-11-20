<?php
 

//Db Login Info
function connectToDb(){
    $host="db.csh.rit.edu"; // Host name
    $dbusername="kevin_ride"; // Mysql username
    $dbpassword="vim66#appositive"; // Mysql password
    $db_name="kevin_ride"; // Database name
    //$tbl_name="0~0"; // Table name
    
    // Connect to server and select databse.
    
    mysql_connect("$host", "$dbusername", "$dbpassword")or die();
    mysql_select_db("$db_name")or die();
}


function secureInput($inputString)
{
      $safeString = mysql_real_escape_string($inputString);
      return $safeString;
}

function uxRedirect($edata='') 
{
     connectToDb();
   // echo  "SELECT * FROM `kevin_ride`.`eventList` WHERE `depatrueEnd` >= NOW()"  ;
     $eventListTable = mysql_query("SELECT * FROM `kevin_ride`.`eventList` WHERE `depatrueEnd` >= NOW()") ;
     $numActiveEvents = mysql_num_rows($eventListTable);
     
     if($numActiveEvents==1)
     {
        $eventListRow = mysql_fetch_array($eventListTable);
        $eventId =  $eventListRow['id']; 
        header("location:joinRide.php?eventId=$eventId&currentEvents=1&e=$edata");  
     } 
     elseif($numActiveEvents==2) 
     {
          $eventListRow = mysql_fetch_array($eventListTable);
          $eventId1 =  $eventListRow['id'];  
          $eventListRow = mysql_fetch_array($eventListTable);  
          $eventId2 =  $eventListRow['id'];
        header("location:joinRide.php?eventId=$eventId1&eventId2=$eventId2&currentEvents=1&e=$edata");   
     }
     else
     {
         if(strstr("selectEvent")!=false)
         header("location:selectEvent.php?type=join&e=$edata");   
     }
}

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function isUserEligibleToJoinRide($eventId, $userName){
    connectToDb()  ;
    
    $createdRide = false;
    $joinedRide = false;
    
    $eventId = secureInput($eventId);
    $userName = secureInput($userName); 
    
    //Check if user has created a ride
    $query =     "SELECT *FROM `rideList` WHERE `driverName` ='$userName' AND `eventId`=$eventId";  
    //echo    $query;
    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);
    
    if ($numRows > 0)  //User has created a ride and is not eligiable to join
    {
        $createdRide = true;    

    }
    //Check to see if user has ride
    $query =     "SELECT *FROM `passengers` WHERE `eventId` =$eventId AND `passengerName` LIKE '$userName' AND `carId`!=0";  
    //echo    $query; 
    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);
    if ($numRows >  0)     //User has joined a ride and cannot join another.
    {
        $joinedRide = true;    
    }
    
    if($createdRide==false && $joinedRide==false ) //can join ride
    {
        return true;
    }
    else
    {
       return false;    
    }
    return false;
    
}

function didUserCreateRide($eventId, $userName, $carId='')
{ 
    connectToDb();
          
    $eventId = secureInput($eventId);
    $userName = secureInput($userName);
    $carId = secureInput($carId);
    
    if($carId=='') //General case. Did user create ride for this event
    {
        $query =     "SELECT * FROM `rideList` WHERE `eventId` =$eventId AND `driverName` LIKE '$userName'";     
    }
    else
    {
        $query =     "SELECT * FROM `rideList` WHERE `eventId` =$eventId AND `driverName` LIKE '$userName' AND `carId` =$carId";  
    }
    
  //echo  $query;
        
    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);  

    // echo $numRows;
     
    if ($numRows == '1')
    {  
         //echo 'TRUE';     
         return true;      

    }    
    else 
    {
       return false;     
    }
      
}

function isUserAPassengerForThisRide($eventId, $carId, $userName)
{
    connectToDb();
    $eventId = secureInput($eventId);
    $carId = secureInput($carId);  
    $userName = secureInput($userName);
    
    
    $query =     "SELECT * FROM `passengers` WHERE `eventId` =$eventId AND `carId` =$carId AND `passengerName` LIKE '$userName'";  
    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);
    
    if ($numRows ==1)
    {
        return true;    
    }    
    else 
    {
        return false;    
    }
}

function doesUserHaveRide($eventId,$userName)
{
    connectToDb();
    $eventId = secureInput($eventId);
    $userName = secureInput($userName);
    
    $query =     "SELECT * FROM `passengers` WHERE `eventId` =$eventId AND `passengerName` LIKE '$userName' AND `carId`!=0";  
    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);
    
    if ($numRows >=1)
    {
        return true;    
    }    
    else 
    {
        return false;    
    }
}

function isUserListedAsNeedingRide($eventId,$userName)
{
    connectToDb();
    $eventId = secureInput($eventId);
    $userName = secureInput($userName);
    
    $query =     "SELECT * FROM `passengers` WHERE `eventId` =$eventId AND `carId`=0 AND `passengerName` LIKE '$userName'";  
    $result = mysql_query($query);
    $numRows = mysql_num_rows($result);

    
    if ($numRows >=1)
    {
        return true;    
    }    
    else 
    {
        return false;    
    }
}


function printJoinRideButtons($eventId, $carId, $seatsAvail)
{
    //Get Username
    $userName = $_SERVER['WEBAUTH_USER'];
    
    $eventId = secureInput($eventId);
    $carId = secureInput($carId);   
    $seatsAvail = secureInput($seatsAvail);       
    
    $canJoinRides = isUserEligibleToJoinRide($eventId, $userName);
    $createdRide = didUserCreateRide($eventId,$userName, $carId);
    $isPassenger = isUserAPassengerForThisRide($eventId, $carId,  $userName);
    $fullRide = false;
    
    if($seatsAvail==0)
    {
        $fullRide = true;
    }
    
    if($canJoinRides && $fullRide==false ){
        //print Join Ride Button
        echo '<a class="btn btn-primary" href="scripts/sJoinRide.php?eventId='.$eventId.'&carId='.$carId.'">Join Ride &raquo;</a>';
    }
    elseif($createdRide)
    {
        //Print edit ride button
         echo '<a class="btn btn-warning" href="createRide.php?edit=1&eventId='.$eventId.'&carId='.$carId.'">Edit Ride &raquo;</a>' ;
    }
    elseif($isPassenger)
    {
        //Print Cancel Ride button    
         echo '<a class="btn btn-danger" href="scripts/sCancelRide.php?eventId='.$eventId.'&carId='.$carId.'">Cancel Ride &raquo;</a>';
    }
    elseif($fullRide)
    {  
        //Print Ride Full Button
        echo '<a class="btn disabled">Ride Full</a> ';
    }
    else
    {
      
        //Print no action button
        echo '<a class="btn disabled">No Actions</a> ';  
    }
    
}
function printNeedRideButton($eventId)
{
    //If user has a ride print or created a ride no actions button 
    //If user does not have a ride Print warning button 'Need Ride'
    //If user currently is listed as needs ride print danger 'No Longer Need Ride' button.
    
    //Get Username
    $userName = $_SERVER['WEBAUTH_USER']; 
    $eventId = secureInput($eventId);  
    
    $currentlyListedAsNeedsRide = isUserListedAsNeedingRide($eventId,$userName);
    $createdRide = didUserCreateRide($eventId,$userName);       
    $userHasRide = doesUserHaveRide($eventId,$userName); 
    
    //echo 'TESShh: '.$createdRide;
    
    if($userHasRide or $createdRide)
    {
          echo '<a class="btn disabled">No Actions</a> ';  
    }
    elseif($currentlyListedAsNeedsRide )
    {
       echo '<a class="btn btn-danger" href="scripts/sCancelRide.php?eventId='.$eventId.'&carId=0">Don\'t Need Ride</a>';  
    } 
 
    else
    {
        echo '<a class="btn btn-warning" href="scripts/sJoinRide.php?eventId='.$eventId.'&carId=0">Need Ride &raquo;</a>' ; 
    } 
}

function printCreateRideButton($eventId)
{
    $userName = $_SERVER['WEBAUTH_USER']; 
    $eventId = secureInput($eventId);  
    $canJoinRides = isUserEligibleToJoinRide($eventId, $userName);
    $createdRide = didUserCreateRide($eventId, $userName);
    
         if($createdRide==false && $canJoinRides==true)  //Print View Rides Button
         {
            echo '<a class="btn btn-success" href="createRide.php?eventId='.$eventId.'">Create Ride &raquo;</a>';  

         }

         //Code For tents here
                                                                                 
}


function printSelectRideButtons($eventId, $createRide, $isCamping)
{
    //Get Username
    //$userName = $_SERVER['WEBAUTH_USER']; 
    $eventId = secureInput($eventId); 
    //$eventId = secureInput($createRide);
    //$isCamping = secureInput($createRide);   
    
    //$canJoinRides = isUserEligibleToJoinRide($eventId, $userName);
    //$createdRide = didUserCreateRide($eventId, $userName);
    
    
    echo '<td><a class="btn btn-info" href="joinRide.php?eventId='.$eventId.'">Select Event &raquo;</a>';   
    
    /*if($createRide) //Print create ride button if they can create a ride or view rides button.
    {     
      
         if($createdRide)  //Print View Rides Button
         {
             echo '<td><a class="btn btn-info" href="joinRide.php?eventId='.$eventId.'">View Rides &raquo;</a>';   

         }
         else      //Create ride button
         {      
            echo '<td><a class="btn btn-success" href="createRide.php?eventId='.$eventId.'">Create Ride &raquo;</a>';    
         }
         
         //Code For tents here
    }
    else     //Print Join Ride button or view rides button.
    {
         if($canJoinRides) //print Join Ride Button
         {
              echo '<td><a class="btn btn-primary" href="joinRide.php?eventId='.$eventId.'">Join Ride &raquo;</a>';   
         }
         else //Print View Rides Button
         {
              echo '<td><a class="btn btn-info" href="joinRide.php?eventId='.$eventId.'">View Rides &raquo;</a>';         
         }
         
         //Code for tents here
    }*/
    
    
}

function printJoinRideTable($eventId, $selTent)
{
    
        //Get userName
        $userName = $_SERVER['WEBAUTH_USER'];
        
        $eventId = secureInput($eventId); 
        $selTent = secureInput($selTent);
        
        $query =     "SELECT *FROM `rideList` WHERE `rideList`.`eventId` =$eventId" ;
        $rideListTable = mysql_query($query) 
             or die(mysql_error());    
             
             
          //Get Event nave
           $singleEvent = mysql_query("SELECT * FROM `eventList` WHERE `eventList`.`id`=$eventId") 
             or die(mysql_error()); 
             $event = mysql_fetch_array( $singleEvent );
             $eventName = $event['eventName'];
             
              $eventDepartStart = $event['depatrueStart'];
              $eventDepartStartTimeStamp = strtotime($eventDepartStart);
                        
              $eventDepartEnd = $event['depatrueEnd'];
              $eventDepartEndTimeStamp = strtotime($eventDepartEnd);
             
        echo '<table width="99%" border="0">  
        <tr>
          <td><legend>'.$eventName.' ~ Join Ride</legend>'. str_replace('<td>','', '' ) .'</td> ';
             echo ' <td> Departure Window: '. (date('D M d \a\t h:i A',$eventDepartStartTimeStamp)).'<em> to </em>'; 
                            //dearture window
                                  if( date('D M d',$eventDepartStartTimeStamp) == date('D M d',$eventDepartEndTimeStamp ) )
                                    {
                                        echo (date('h:i A',$eventDepartEndTimeStamp )); 
                                    }
                                    else
                                    {
                                        echo date('D M d \a\t h:i A',$eventDepartEndTimeStamp);    
                                    } 
        echo '</td>'; 
        if($event['eventCreator']==$userName) {  
            echo '<td><a class="btn btn-info" href="createEvent.php?eventId='.$eventId.'&edit=1">Edit Event &raquo;</a></td>';        
                }     
       echo '</tr>
      </table>';
      
      echo 'Event Description: '.$event['description'];
              
               
      
   
                if($selTent != 1)
                { 
                    echo '       
                          <table class="table table-condensed">    
                            <thead>
                            <tr>
                              <th width="2%">#</th>
                              <th width="12%">Driver Name</th> 
                              <th width="15%">Departure Time</th> 
                              <th width="15%">Seats Available</th> 
                              <th width="19%">Current Passengers</th> 
                              <th width="19%">Comments</th> 
                              <th width="19%">Actions</th>
                            </tr>
                          </thead>
                      <tbody>';
                      $count = 1;
                      while ($ride = mysql_fetch_array( $rideListTable ))
                      {      
                        $carId =  $ride['carId'];
                        $eventId = $ride['eventId'];
                        $passengers = mysql_query("SELECT * FROM `passengers` WHERE `passengers`.`carId` = $carId AND `passengers`.`eventId`=$eventId") 
                     or die(mysql_error());    
                     
                        $rideDepartTime = $ride['depatrueTime']; 
                        $rideDepartTimeStamp = strtotime($rideDepartTime);

                     //Passenger Count
                     $passengerCount=mysql_num_rows($passengers); 
                     $seatsAvail =   $ride['seatsAvailable']  - $passengerCount ;
                     
                     //Print Table
                        echo '<tr>
                          <td>'.$count.'</td>
                          <td>'.$ride['driverName'].'</td>
                          <td>'. date('D M d \a\t h:i A',$rideDepartTimeStamp) .'</td>
                          <td>'.$seatsAvail.'/'.$ride['seatsAvailable'].'</td>
                          <td>'; 
                                      $counter = 0;
                                    
                                      while ($passenger =  mysql_fetch_array( $passengers )) 
                                    { 
                                          
                                         if ($counter==0)
                                        {                                          
                                             echo $passenger['passengerName'];             
                                        }
                                        else
                                        {    
                                         echo ', '.$passenger['passengerName'];       
                                              
                                        }
                                        //echo $counter; 
                                        $counter = $counter+ 1;
                                    
                                    }  
                                          echo '</td>
                          <td>'.$ride['comments'].'</td>';
                          /*<td><a class="btn btn-primary" href="scripts/sJoinRide.php?eventId='.$ride['eventId'].'&carId='.$ride['carId'].'">Join Ride &raquo;</a>
                           <a class="btn disabled" href="#">No Actions</a>
                          <a class="btn btn-danger" href="scripts/sCancelRide.php?evnetId='.$ride['eventId'].'&carId='.$ride['carId'].'">Cancel Ride &raquo;</a><br>
                          <a class="btn btn-warning" href="createRide.php?edit=1&evnetId='.$ride['eventId'].'&carId='.$ride['carId'].'">Edit Ride &raquo;</a>*/
                          echo '
                          <td>'; echo printJoinRideButtons($ride['eventId'], $ride['carId'], $ride['seatsAvailable']);
                            echo '</td></tr>';
                            $count++;
                      }
                      //Last row in table is need ride row
                      //Car id of 0 designates that a user needs a ride for that event
                      $passengersNeedRide = mysql_query("SELECT * FROM `passengers` WHERE `passengers`.`carId` = 0 AND `passengers`.`eventId`=$eventId");
                      echo '<tr>
                          <td>'.$count.'</td>
                          <td>'.'Need Ride'.'</td>
                          <td>'.'N/A'.'</td>
                          <td>'.mysql_num_rows($passengersNeedRide).'/'.'0'.'</td>
                          <td>'; 
                                      $counter = 0;
                                    
                                      while ($passenger =  mysql_fetch_array( $passengersNeedRide )) 
                                    { 
                                          
                                         if ($counter==0)
                                        {                                          
                                             echo $passenger['passengerName'];             
                                        }
                                        else
                                        {    
                                         echo ', '.$passenger['passengerName'];       
                                              
                                        }
                                        //echo $counter; 
                                        $counter = $counter+ 1;
                                    
                                    }  
                                          echo '</td>
                          <td>'.'Members who need a ride for this event.'.'</td>'; 
                         echo '<td>'; printNeedRideButton($eventId); echo '<p>'; printCreateRideButton($eventId);  echo '</td>';
                      
                        
                        /*<td>2</td>
                        <td><b>Need Ride</b></td>
                          <td>(End of valid depart window)</td>
                          <td>N/A</td>
                          <td><b>Joe, Smith, Bob</b></td>
                          <td>People who need a ride to the event.</td>
                          <td><a class="btn btn-warning" href="#">Need Ride &raquo;</a>
                           <a class="btn btn-warning disabled" href="#">Need Ride &raquo;</a>
                          <a class="btn btn-danger" href="#">Cancel Ride &raquo;</a><br>
                            </td>
                        </tr>*/
                      echo  '</tbody>
                    </table>';  
                }
}

?>