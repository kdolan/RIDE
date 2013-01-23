
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CSH - RIDE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {<link rel="stylesheet" type="text/css" href="">
        padding-top: 60px;
        padding-bottom: 40px;
      }
    .container .hero-unit table tr td legend {
	text-align: left;
}
    </style>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php">RIDE</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index.php?r=1">Home</a></li>
              <li <?php if($_GET[currentEvents]==1){ echo 'class="active"';}?>)><a href="selectEvent.php?type=join">Current Events</a></li>
              <li><a href="userDetails.php">User Details</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
      
      <?php 
	      require_once("scripts/func.php");     
          connectToDb();
      //1 = Event Created Suc
        $eData = $_GET['e'];
        $eeData = $_GET['ee'];
        
        
        $output = array("Ride Joined Successfully","Ride Canceled Successfully","Ride Canceled Successfully. Any passengers in your car have been notified.","Ride Created Successfully","Event Upadated Successfully","Event Created Successfully","Ride Updated Successfully");
        $outputEE = array("This ride is already full and you are unable to join.");  
                   
        if($eData<=0)
        {
                
        }
        else 
        {
            echo '<table class="table table-condensed" align="center">
          <tr class="success">
        <td>'.$output[$eData-1].'</td>
          </tr>
          </table>';
        
        }
        if($eeData<=0)
        {
                
        }
        else 
        {
            echo '<table class="table table-condensed" align="center">
          <tr class="error">
        <td>'.$outputEE[$eeData-1].'</td>
          </tr>
          </table>';
        
        }
        
        $eventId = secureInput($_GET['eventId']);
        $eventId2 = $_GET['eventId2']; 
		$selTent = $_GET['tent'];
        $selTent2 = $_GET['tent2']; 
		
        //REPLACED
			/*$query =     "SELECT *FROM `rideList` WHERE `rideList`.`eventId` =$eventId" ;
		$rideListTable = mysql_query($query) 
			 or die(mysql_error());    
			 
			 
		  //Get Event nave
		   $singleEvent = mysql_query("SELECT * FROM `eventList` WHERE `eventList`.`id`=$eventId") 
			 or die(mysql_error()); 
			 $event = mysql_fetch_array( $singleEvent );
			 $eventName = $event['eventName'];      */
      ?>
      <!-- <table width="99%" border="0">
        <tr>
          <td><legend><?php //echo $eventName;?> ~ Join Ride</legend></td>
          <td><?php //echo printCreateRideButton($event['id']);?></td> 
        </tr>
      </table> -->
      
      <form>
          <?php 
          
                $query = "SELECT * FROM  `eventList` WHERE  `id` =$eventId";
                $result = mysql_query($query);
                if(mysql_num_rows($result)==0)
                {
                    echo '<table class="table table-condensed" align="center">
                      <tr class="error">
                    <td>'."<h4>This event does not exist!</h4>".'</td>
                      </tr>
                      </table>';
                }
                else
                {
                    printJoinRideTable($eventId, $selTent);
                    if($eventId2!='')
                    {
                        printJoinRideTable($eventId2, $selTent2);
                    } 
                   /* if($selTent != 1)
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
                             echo '<td>'; printNeedRideButton($eventId); echo '</td>';
                          
                            

                          echo  '</tbody>
                        </table>';
                        
                        if($eventId2!='')
                        {
                            
                            $eventId =  $eventId2;
                            
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
                             echo '<td>'; printNeedRideButton($eventId); echo '</td>';
                          
                            

                          echo  '</tbody>
                        </table>';       
                        }
                    }
                else {
                        echo '
                        <legend>[Event Name] ~ Join Tent:</legend> 
                        <table class="table table-condensed">
                             <thead>
                            <tr>
                              <th width="2%">#</th>
                              <th width="12%">Tent Owner</th>
                              <th width="15%">Tent Name</th>
                              <th width="15%">Spots  Available</th>
                              <th width="19%">Current Residents</th> 
                              <th width="18%">Comments</th>
                              <th width="19%">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Kevin</td>
                              <td>Best Tent Ever</td>
                              <td>1/7</td>
                              <td>Kevin, Joe, Smith, Bob, Alex, Robert</td>
                               <td>Humm</td>
                              <td><a class="btn btn-primary" href="#">Join Tent &raquo;</a>
                              <a class="btn btn-primary disabled" href="#">Join Tent &raquo;</a>
                              <a class="btn btn-danger" href="#">Cancel Tent &raquo;</a>
                               <a class="btn btn-warning" href="createTent.php?edit=1&id=1">Edit Tent &raquo;</a>
                             </td>
                            </tr>
                            
                           </tbody>
                        </table>';
                    
                }    */ 
                }
 

            
        ?>  
        </form> 
      </div>

      <!-- Example row of columns -->
      <hr>

      <footer>
        <p>Created by Kevin J Dolan</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

</body>
</html>
