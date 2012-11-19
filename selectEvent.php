<?php 
require_once("scripts/func.php");
$eData = $_GET['e'];
uxRedirect($eData); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CSH - RIDE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {<link rel="stylesheet" type="text/css" href="">
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">

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
          <a class="brand" href="index.php?r=1">RIDE</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li ><a href="index.php?r=1">Home</a></li>
              <li class="active"><a href="selectEvent.php?type=<?php if($_GET['type']==create) { echo 'create';} else{echo 'join';}?>">Current Events</a></li>
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
      //1 = Event Created Suc
          $eData = $_GET['e'];
        
        $output = array("Event Created Successfully","Event Eddited Successfully");
                   
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
      
      ?>
      <?php 
      
              connectToDb();
             
              $pageType = $_GET["type"];
            
            $eventListTable = mysql_query("SELECT * FROM `eventList` WHERE `depatrueEnd` >= NOW()") 
                     or deveie(mysql_error()); 
                     
                     
                     
                     
            if($pageType == "create" && mysql_num_rows($eventListTable)!=0 ) //For Creating a ride.
            {
                 
                        echo '<legend>Creating A Ride ~ Select Event:</legend>
                  <table class="table table-condensed">
                         <thead>
                        <tr>
                          <th>#</th>
                          <th>Event Name</th> 
                          <th>Event Start and End Time</th> 
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>';
                      $counter = 1;
                      while ($event = mysql_fetch_array( $eventListTable ))
                      {
                        $eventDepartStart = $event['depatrueStart'];
                        $eventDepartStartTimeStamp = strtotime($eventDepartStart);
                        
                        $eventDepartEnd = $event['depatrueEnd'];
                        $eventDepartEndTimeStamp = strtotime($eventDepartEnd);
                        
                        echo '<tr>
                          <td>'.$counter.'</td>
                          <td>'.$event['eventName'].'</td>
                            <td>'. (date('D M d \a\t h:i A',$eventDepartStartTimeStamp)).'<em> to </em>'; 
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
                            //end departure window
                           printSelectRideButtons($event['id'], true, $event['isCamping']);//<td><a class="btn btn-success" href="createRide.php?eventId='.$event['id'].'">Create Ride &raquo;</a>'; //If camping add that button
                          if($event['isCamping']==1) { echo '<p><p><a class="btn btn-primary" href="createTent.php?eventId='.$event['id'].'">Create Tent &raquo;</a>';    }
                          //End row
                          echo '</td>
                        </tr>';
                        $counter += 1;
                      }
                      echo '</tbody>
                </table>';
                
            }
            elseif(mysql_num_rows($eventListTable)!=0){ //For Selecting an event for a ride.
            
                
                echo '<legend>Joining A Ride ~ Select Event:</legend>';
                echo '<table class="table table-condensed">
                   <thead>
                <tr>
                  <th>#</th>
                  <th>Event Name</th> 
                  <th>Event Start and End Time</th> 
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>';
              $counter = 1;
                      while ($event = mysql_fetch_array( $eventListTable ))
                      {
                        $eventDepartStart = $event['depatrueStart'];
                        $eventDepartStartTimeStamp = strtotime($eventDepartStart);
                        
                        $eventDepartEnd = $event['depatrueEnd'];
                        $eventDepartEndTimeStamp = strtotime($eventDepartEnd);
                        
                        echo '<tr>
                          <td>'.$counter.'</td>
                          <td>'.$event['eventName'].'</td>
                            <td>'. (date('D M d \a\t h:i A',$eventDepartStartTimeStamp)).'<em> to </em>'; 
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
                            //end departure window
                          printSelectRideButtons($event['id'], false, $event['isCamping']); //<td><a class="btn btn-success" href="joinRide.php?eventId='.$event['id'].'">Join Ride &raquo;</a>'; //If camping add that button
                          if($event['isCamping']==1) { echo '<p><p><a class="btn btn-primary" href="joinTent.php?eventId='.$event['id'].'">Join Tent &raquo;</a>';   }
                          //End row
                          echo '</td>
                        </tr>';
                        $counter += 1;
                      }
                      echo '</tbody>
                </table>';
                /*
                <tr>
                  <td>1</td>
                  <td>Marks</td>
                  <td>9/18/12 9:30PM - 10:00PM</td>
                  <td><a class="btn btn-primary" href="joinRide.php?eventId=0">Select Ride &raquo;</a><p><p><a class="btn btn-warning" href="createEvent.php?edit=1&eventId=1">Edit Event &raquo;</a></td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Fall Camping</td>
                   <td>9/18/12 10:00AM - 9/20/12 6:00PM</td>
                  <td><a class="btn btn-primary" href="joinRide.php?eventId=0">Select Ride &raquo;</a><p><p><a class="btn btn-info" href="joinRide.php?eventId=0&tent=1">Select Tent &raquo;</a><p><p><a class="btn btn-warning" href="createEvent.php?edit=1&eventId=1">Edit Event &raquo;</a></td>
                </tr>
               </tbody>
        </table>'; */
                
                
            }
            else
            {
                  echo '<table class="table table-condensed" align="center">
                            <tr class="warning">
                                <td><h3>There are no events active at this time.</h3></td>
                             </tr>
                        </table>';
            }
      ?>
          
          
          
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
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../bootstrap/js/bootstrap-alert.js"></script>
    <script src="../bootstrap/js/bootstrap-modal.js"></script>
    <script src="../bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="../bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="../bootstrap/js/bootstrap-tab.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap-popover.js"></script>
    <script src="../bootstrappjs/bootstrap-button.js"></script>
    <script src="../bootstrap/js/bootstrap-collapse.js"></script>
    <script src="../bootstrap/js/bootstrap-carousel.js"></script>
    <script src="../bootstrap/js/bootstrap-typeahead.js"></script>

</body>
</html>
