<?php
require ("dbConnect.php");
include_once("ldap_wrapper.php"); 

function secureInput($inputString)
{
      $safeString = mysql_real_escape_string($inputString);
      return $safeString;
}

function queryUsername($username)
{
    $ldap = new LdapWrapper();
    return $ldap->query_username($username);
}

function queryName($name)
{
    $ldap = new LdapWrapper();
    return $ldap->query_name($name);
}

function stripUsername($combinedName) //combinedName is in the format "Kevin Dolan (kdolan)"
{
    //validate that the input string has an open parenthese followed by a closing parenthese. 
    $subString = strstr($combinedName,'(');
    if($subString!=false)
    {
        if(strstr($subString,')')!=false)
        {
        $usernameArray = explode('(',$combinedName);
        $username = substr_replace($usernameArray[1] ,"",-1); //remove the last character in the string. Will be ')'. Left with username.
        return $username;
        }
    }
    return $combinedName;
}

function printSuperbarArray()
{
    $my_var = file_get_contents('https://eval.csh.rit.edu/api/members.php?active');
    echo '<script type="text/javascript">
        selected = new Array()
        names = new Array()
        names.push("Chris Lockfort (clockfort)")
        names.push("Gabbie Burns (yinyang)")
        names.push("Will Ziener-Dignazio (slackwill)")
        names.push("Ross Delinger (rossdylan)")
        names.push("Grant Cohoe (cohoe)")
        names.push("Ross Guarino (eos)")
        names.push("Channon Price (chprice)")
        names.push("Matt Soucy (msoucy)")
        names.push("Frank Hrach (knarf1393)")
        names.push("Ethan House (ehouse)")
        names.push("Benjamin Meyer (bmeyer)")
        names.push("Ben Centra (bencentra)")
        names.push("Joshua Winemiller (jewinemiller21)")
        names.push("Travis Whitaker (tmobile)")
        names.push("Andrew Hanes (ahanes)")
        names.push("Michael Moffitt (moffitt)")
        names.push("Julian Hammerstein (Hammerstein)")
        names.push("Ryan S Brown (ryansb)")
        names.push("Drew Stebbins (astebbin)")
        names.push("Gerard Geer (gman)")
        names.push("Eric Adams (grizzlyadams)")
        names.push("John Feulner (peppy)")
        names.push("Sarah Clauser (sclauser)")
        names.push("Duncan Keller (duncannons)")
        names.push("Cliff Chapman (mrdoom)")
        names.push("Anqi Chen (totoro)")
        names.push("Megan McNeice (mmcneice)")
        names.push("Michail Yasonik (gorbachev)")
        names.push("Alex Berkowitz (berky93)")
        names.push("Emily Egeland (ducktape)")
        names.push("Alex Walcutt (awalcutt)")
        names.push("Josh McSavaney (mcsaucy)")
        names.push("Daniel Tyler (dtyler)")
        names.push("Dan Fuhry (fuhry)")
        names.push("Anthony Gargiulo (agargiulo)")
        names.push("Russ Harmon (russ)")
        names.push("Benjamin Russell (benrr101)")
        names.push("Jeff Haak (zemon1)")
        names.push("Will Orr (worr)")
        names.push("Grant Kurtz (grnt426)")
        names.push("Connor Monahan (kerberos)")
        names.push("Alex Howland (ducker)")
        names.push("Andrew Glaude (ajgajg1134)")
        names.push("Joseph Batchik (jd)")
        names.push("Julien Eid (jeid)")
        names.push("Kevin Dolan (kdolan)")
        names.push("Michael A. Wilmoth (leroyflyer)")
        names.push("Michael Bax Bradley (mike5)")
        names.push("Ross Bayer (rostepher)")
        names.push("Schuyler Martin (skyguysciguy)")
        names.push("Stephen Demos (demos)")
        names.push("Nikko Williard (urfriendlyvirus)")
        names.push("Ryan Buzzell (rbuzzell)")
        names.push("Jacqueline McGraw (jackiedmcgraw)")
        names.push("Joseph Gambino (gambino)")
        names.push("Matt Gambogi (gambogi)")
        names.push("Michael G. Cunney (kanye)")
        names.push("Mike Janitor (thejanitor)")
        names.push("Reed Swiernik (rswiernik)")
        names.push("Tal Cohen (tcohen)")
        names.push("Derek Gonyeo (dgonyeo)")
        names.push("Nick Hilton (hilton)")
        names.push("Robert Glossop (robgssp)")
        names.push("Michael Swan (swanboy)")
        names.push("Scott Jordan (swinejelly)")
        names.push("Sophie Song (sophiesong)")
        names.push("Gregory Chambers (grg)")
        names.push("Austin Levesque (austinlvsq)")
        names.push("Samuel Lucidi (mansam)")
        names.push("Henry Brown (spotdart)")
        names.push("Matthew Rose (cobert)")
        names.push("Keller Lewis (keller)")
        names.push("Peter Vowell (caliswag)")
        names.push("f_NateLemoi (f_NateLemoi)")
        names.push("Shareef Ali (shareefalis)")
        names.push("f_ColinONeill (f_ColinONeill)")
        names.push("f_TylerCromwell (f_TylerCromwell)")
        names.push("Nick Depinet (nick)")
        names.push("Alexander Kyte (alexanderkyte)")
        names.push("f_EliFerraro (f_EliFerraro)")
        </script>';

}

function isAdmin()
{
    connectToDb();
    $username = $_SERVER['WEBAUTH_USER'];
    $query = "SELECT * FROM `admin` WHERE `username`='$username'";
    $adminQueryTable = mysql_query($query);
    if(mysql_num_rows($adminQueryTable)==1)
    {
        return true;
    }
    return false;
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
         //if(strstr("selectEvent")!=false)
         //header("location:selectEvent.php?type=join&e=$edata");   
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

function fullRide($eventId, $carID)
{
    connectToDb();
    $eventId = secureInput($eventId);
    $carID = secureInput($carID);
    $queryPassengers = "SELECT * FROM `passengers` WHERE `eventId` =$eventId AND `carId`=$carID";
    $queryRide = "SELECT * FROM `rideList` WHERE `eventId` =$eventId AND `carId`=$carID";
    //echo "    ".$queryPassengers."    ".$queryRide;
    
    //echo $queryPassengers;
    
    $passengerTable = mysql_query($queryPassengers);
    $rideTable = mysql_query($queryRide);
    
    $numberOfPassengers = mysql_num_rows($passengerTable);
    $ride = mysql_fetch_array($rideTable);
    
    $maxPassengers = $ride['seatsAvailable'];
    if($maxPassengers<=$numberOfPassengers)
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
    $fullRide = fullRide($eventId,$carId);
    
    $isAdmin = isAdmin();

    
    if($canJoinRides && $fullRide==false ){
        //print Join Ride Button
        echo '<a class="btn btn-primary" href="scripts/sJoinRide.php?eventId='.$eventId.'&carId='.$carId.'">Join Ride &raquo;</a>';
        if($isAdmin)
        {
        echo '<a class="btn btn-warning" href="createRide.php?edit=1&eventId='.$eventId.'&carId='.$carId.       '">*Edit Ride* &raquo;</a>' ; 
        }
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
        if($isAdmin)
        {
            echo '<a class="btn btn-warning" href="createRide.php?edit=1&eventId='.$eventId.'&   carId='.$carId.       '">*Edit Ride* &raquo;</a>' ; 
        }
    }
    elseif($fullRide)
    {  
        //Print Ride Full Button
        echo '<a class="btn disabled">Ride Full</a> ';
        if($isAdmin)
        {
            echo '<a class="btn btn-warning" href="createRide.php?edit=1&eventId='.$eventId.'&   carId='.$carId.       '">*Edit Ride* &raquo;</a>' ; 
        }
    }
    else
    {
      
        //Print no action button
        if($isAdmin)
        {
        echo '<a class="btn btn-warning" href="createRide.php?edit=1&eventId='.$eventId.'&   carId='.   $carId.       '">*Edit Ride* &raquo;</a>' ; 
        }
        else
        {
            echo '<a class="btn disabled">No Actions</a> ';  
        }
        
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
    
    if($userHasRide)
    {
          echo '<a class="btn disabled">No Actions</a> ';  
    }
    elseif($createdRide)
    {
        //Check to see if there are passengers who need ride
        $checkQuery = "SELECT * FROM  `passengers` WHERE  `eventId` =$eventId AND  `carId` =0"; 
        $result = mysql_query($checkQuery);
        
        //Get carId
        $query = "SELECT * FROM `rideList` WHERE `eventId` =$eventId AND `driverName` LIKE '$userName'"; 
        $rideResult = mysql_query($query);
        $ride = mysql_fetch_array($rideResult);
        $carId = $ride['carId'];
         
        if(mysql_num_rows($result)!=0 and fullRide($eventId, $carId)==false)
        {
        
         echo '<a class="btn btn-primary" href="addPassengers.php?eventId='.$eventId.'&carId='.$carId.'">Add Passengers &raquo;</a>' ;  
        }
        else
        {
            echo '<a class="btn disabled">No Actions</a> '; 
        }
        
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
        elseif(isAdmin())
        {
            echo '<td><a class="btn btn-info" href="createEvent.php?eventId='.$eventId.'&edit=1">*Edit Event* &raquo;</a></td>';  
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
                          <td>'.queryUsername($ride['driverName']).'</td>
                          <td>'. date('D M d \a\t h:i A',$rideDepartTimeStamp) .'</td>
                          <td>'.$seatsAvail.'/'.$ride['seatsAvailable'].'</td>
                          <td>'; 
                                      $counter = 0;
                                    
                                      while ($passenger =  mysql_fetch_array( $passengers )) 
                                    { 
                                          
                                         if ($counter==0)
                                        {     
                                            $fullName = queryUsername($passenger['passengerName']);   
                                            if($fullName=="username_query_returns_null")
                                            {
                                                echo $passenger['passengerName'];
                                            }    
                                            else
                                            {
                                                echo queryUsername($passenger['passengerName']);
                                            }
                                                                                   
                                        }
                                        else
                                        {    
                                            $fullName = queryUsername($passenger['passengerName']);   
                                            if($fullName=="username_query_returns_null")
                                            {
                                                echo ', '.$passenger['passengerName'];
                                            }    
                                            else
                                            {
                                                echo ', '.queryUsername($passenger['passengerName']); 
                                            }
                                              
                                              
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
                                            $fullName = queryUsername($passenger['passengerName']);   
                                            if($fullName=="username_query_returns_null")
                                            {
                                                echo $passenger['passengerName'];
                                            }    
                                            else
                                            {
                                                echo queryUsername($passenger['passengerName']);
                                            }
                                                                                   
                                        }
                                        else
                                        {    
                                            $fullName = queryUsername($passenger['passengerName']);   
                                            if($fullName=="username_query_returns_null")
                                            {
                                                echo ', '.$passenger['passengerName'];
                                            }    
                                            else
                                            {
                                                echo ', '.queryUsername($passenger['passengerName']); 
                                            }
                                              
                                              
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