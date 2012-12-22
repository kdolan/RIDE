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
        $passenerTable = mysql_query("SELECT * FROM `kevin_ride`.`passengers` WHERE `passengerName` LIKE '$userName'") ;
        $driverTable= mysql_query("SELECT * FROM `kevin_ride`.`rideList` WHERE `driverName` LIKE '$userName'");
        
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
          
        echo '<table class="table table-condensed">
                            <thead>
                            <tr>
                              <th width="12%">#</th>
                              <th width="40%">Event Name</th> 
                              <th width="50%">Deatials</th> 
                            </tr>
                          </thead>
                      <tbody> ';
                      $count = 0;
                      foreach ($eventIds as $eventId)
                      {
                          $count++;
                          $eventTable = mysql_query("SELECT * FROM `kevin_ride`.`eventList` WHERE `eventId` = $eventId") ; 
                          $event = mysql_fetch_array($eventTable);
                           echo '<tr>
                          <td>'.$count.'</td>
                          <td>'.$event['eventName'].'</td>
                          <td><a class="btn btn-primary" href="joinRide.php?eventId='.$eventId.'0">Event Details &raquo;</a></td>
                        </tr>';
                      } 

                       echo '</tbody>
                    </table> ';
      }
      function printDetailsOFUserEvents()
      {
         /* $passenerTable = mysql_query("SELECT * FROM `kevin_ride`.`passengers` WHERE `passengerName` LIKE '$userName'") ;
          $driverTable= mysql_query("SELECT * FROM `kevin_ride`.`rideList` WHERE `driverName` LIKE '$userName'");
        
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
          <tbody>';
        $count = 0;  
        foreach ($eventIds as $eventId)
            {
                $eventTable = mysql_query("SELECT * FROM `kevin_ride`.`eventList` WHERE `eventId` = $eventId AND `depatrueEnd` >= CURDATE(") ; 
                if(mysql_num_rows($eventTable)==0)
                {
                    continue;
                }
                $passengerTable =  mysql_query("SELECT * FROM `kevin_ride`.`passengers` WHERE `eventId` = $eventId and `passengerName` LIKE '$userName' ") ; 
                $rideTable =  mysql_query("SELECT * FROM `kevin_ride`.`eventList` WHERE `eventId` = $eventId") ;  
                $event = mysql_fetch_array($eventTable);
                $count++;
               echo '<tr>
                  <td>'.$count.'</td>
                  <td>'.$event['eventName'].'</td>
                  <td>Kevin</td>
                  <td>12/12/12 5:00 PM 
                  <td>0/5</td>
                  <td>Person1, Person2, Person3, Person4, Person5</td>
                  <td>Humm</td>
                </tr>
            }
          </tbody>
        </table>    */
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