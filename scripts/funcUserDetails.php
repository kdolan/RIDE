<?php   

      function getRidesGiven()
      {
          $userName = $_SERVER['WEBAUTH_USER'];   
          $table = mysql_query("SELECT * FROM `kevin_ride`.`rideList` WHERE `driverName` LIKE '$userName'") ;     
          return mysql_num_rows($table);
      }
      function getRidesTaken()
      {
          $userName = $_SERVER['WEBAUTH_USER'];   
          $table = mysql_query("SELECT * FROM `kevin_ride`.`passengers` WHERE `passengerName` LIKE '$userName'") ;     
          return mysql_num_rows($table);
      }
      function getEventsAttended()
      {
          
          return getRidesTaken() + getRidesGiven() ;
      }
      
      function printUserEvents()
      {     
          
        $userName = $_SERVER['WEBAUTH_USER']; 
        $passengerQuery = "SELECT * FROM `kevin_ride`.`passengers` WHERE `passengerName` LIKE '$userName'";
        $passenerTable = mysql_query($passengerQuery);
        
       // echo $passengerQuery;
        
        $driverQuery = "SELECT * FROM `kevin_ride`.`rideList` WHERE `driverName` LIKE '$userName'";
        $driverTable= mysql_query($driverQuery);
        
       // echo $driverQuery;  
        
        $eventIds = array();
        while( $row = mysql_fetch_array($passenerTable))
        {
           $eventIds[] = $row['eventId'];  
        }
        while( $row = mysql_fetch_array($driverTable))
        {                                                                    
           $eventIds[] = $row['eventId'];                                          
        }
        sort($eventIds);
        $activeEvents = false;
          foreach ($eventIds as $eventId)
          {
              
              $query = "SELECT * FROM `kevin_ride`.`eventList` WHERE `id` = $eventId AND `depatrueEnd` >= NOW()";
              $eventTable = mysql_query($query); 
              if(mysql_num_rows($eventTable)!=0)
              {
                  $activeEvents = true;
                  break; 
              }
             
          } 
        
            if($activeEvents)  
            {
                echo '<table class="table table-condensed">
                        <thead>
                        <tr>
                          <th width="12%">#</th>
                          <th width="40%">Event Name</th> 
                          <th width="50%">Details</th> 
                        </tr>
                      </thead>
                  <tbody> ';
                  $count = 0;
                  foreach ($eventIds as $eventId)
                  {
                      
                      $query = "SELECT * FROM `kevin_ride`.`eventList` WHERE `id` = $eventId AND `depatrueEnd` >= NOW()";
                      $eventTable = mysql_query($query); 
                      if(mysql_num_rows($eventTable)!=0)
                      {
                          $count++; 
                          $event = mysql_fetch_array($eventTable);
                           echo '<tr>
                          <td>'.$count.'</td>
                          <td>'.$event['eventName'].'</td>
                          <td><a class="btn btn-primary" href="joinRide.php?eventId='.$event['id'].'">Event Details &raquo;</a></td>
                        </tr>';  
                      }
                     
                  } 

                   echo '</tbody>
                </table> '; 
            }
            else
            {
                 echo '<table class="table table-condensed" align="center">
                            <tr class="warning">
                                <td><h4>You have no active events at this time.</h4></td>
                             </tr>
                        </table>';
            }
           
      }
      
      function printDetailsOFUserEvents()
      {
        $userName = $_SERVER['WEBAUTH_USER']; 
        $passengerQuery = "SELECT * FROM `kevin_ride`.`passengers` WHERE `passengerName` LIKE '$userName'";
        $passenerTable = mysql_query($passengerQuery);
        
        $driverQuery = "SELECT * FROM `kevin_ride`.`rideList` WHERE `driverName` LIKE '$userName'";
        $driverTable= mysql_query($driverQuery); 
        
        $eventIds = array();
        while( $row = mysql_fetch_array($passenerTable))
        {
           $eventIds[] = $row['eventId'];  
        }
        while( $row = mysql_fetch_array($driverTable))
        {                                                                    
           $eventIds[] = $row['eventId'];                                          
        }
        sort($eventIds);
        $activeEvents = false;
          foreach ($eventIds as $eventId)
          {
              
              $query = "SELECT * FROM `kevin_ride`.`eventList` WHERE `id` = $eventId AND `depatrueEnd` >= NOW()";
              $eventTable = mysql_query($query); 
              if(mysql_num_rows($eventTable)!=0)
              {
                  $activeEvents = true;
                  break; 
              }
             
          } 
        
            if($activeEvents)  
            {
                echo '<table class="table table-condensed">
                  <thead>
                    <tr>
                      <th width="3%">#</th>
                      <th width="16%">Event Name</th>
                      <th width="14%">Driver Name</th>
                      <th width="17%">Departure Time</th>
                      <th width="13%">Seats Available</th>
                      <th width="18%">Current Passengers</th>
                      <th width="19%">Comments</th>
                    </tr>
                  </thead>
                  <tbody> ';
                  $count = 0;
                  foreach ($eventIds as $eventId)
                  {
                      
                      $queryEvent = "SELECT * FROM `kevin_ride`.`eventList` WHERE `id` = $eventId AND `depatrueEnd` >= NOW()";
                      $eventTable = mysql_query($queryEvent);
                      
                      $queryPassenger = "SELECT * FROM `kevin_ride`.`passengers` WHERE `eventId` = $eventId AND `passengerName` LIKE '$userName'";
                      $passengerTable = mysql_query($queryPassenger); 
                      $passenger = mysql_fetch_array($passengerTable);
                      
                      
                      $carId = $passenger['carId'];
                      if($carId=='')
                      {
                          $rideQuery= "SELECT * FROM `kevin_ride`.`rideList` WHERE `eventId` = $eventId AND `driverName` LIKE '$userName'";
                          $rideTable = mysql_query($rideQuery); 
                          $ride = mysql_fetch_array($rideTable);
                          $carId=$ride['carId'];
                      }
                      
                      $queryRide = "SELECT * FROM `kevin_ride`.`rideList` WHERE `eventId` = $eventId AND `carId` = $carId";
                      $rideTable = mysql_query($queryRide); 
                       
                      if(mysql_num_rows($eventTable)!=0)
                      {
                          $count++; 
                          $event = mysql_fetch_array($eventTable);
                          $ride = mysql_fetch_array($rideTable);
                          
                        $eventDepartStart = $event['depatrueStart'];
                        $eventDepartStartTimeStamp = strtotime($eventDepartStart);
                        
                        $eventDepartEnd = $event['depatrueEnd'];
                        $eventDepartEndTimeStamp = strtotime($eventDepartEnd);
                        
                        $rideDepartTime = $ride['depatrueTime']; 
                        $rideDepartTimeStamp = strtotime($rideDepartTime);
                        
                         //Passenger Count
                         $passengers = mysql_query("SELECT * FROM `passengers` WHERE `passengers`.`carId` = $carId AND `passengers`.`eventId`=$eventId") ;
                         $passengerCount=mysql_num_rows($passengers); 
                         $seatsAvail =   abs($ride['seatsAvailable']  - $passengerCount) ;
                          
                           echo '<tr>
                          <td>'.$count.'</td>
                          <td>'.$event['eventName'].'</td>
                          <td>'; if($ride['driverName']==''){echo "Need Ride"; } else { echo queryUsername($ride['driverName']);} echo '</td> 
                          <td>';if($ride['driverName']==''){echo "N/A"; } else { echo date('D M d \a\t h:i A',$rideDepartTimeStamp);} echo '</td>  
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
                                    
                                    }  echo '</td> 
                          <td>';if($ride['driverName']==''){echo "Members who need a ride for this event."; } else { echo $ride['comments'];} echo '</td>
                        </tr>';  
                      }
                     
                  } 

                   echo '</tbody>
                </table> '; 
            }
            else
            {
                 echo '<table class="table table-condensed" align="center">
                            <tr class="warning">
                                <td><h4>You have no active events at this time.</h4></td>
                             </tr>
                        </table>';
            }
      }
      function printTentDetails()
      {
            /* <table class="table table-condensed">
          <thead>
            <tr>
              <th width="3%">#</th>
              <th width="16%">Event Name</th>
              <th width="14%">Tent Owner</th>
              <th width="17%">Tent Name</th>
              <th width="13%">Spots Available</th>
              <th width="18%">Current Residents</th>
              <th width="19%">Comments</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Fall Camping</td>
              <td>Kevin</td>
              <td>Best Tent</td>
              <td>0/5</td>
              <td>Person1, Person2, Person3, Person4, Person5</td>
              <td>Humm</td>
            </tr>
          </tbody>
        </table>  */
      }
?>