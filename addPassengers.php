<?php 
require_once("scripts/func.php");
$eData = $_GET['e'];
//uxRedirect($eData); 
 connectToDb();
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
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {<link rel="stylesheet" type="text/css" href="">
        padding-top: 60px;
        padding-bottom: 40px;
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
          $eeData = $_GET['ee']; //Error Messages
        
       $output = array("User has been added to your ride.");
       $outputEE = array("Your ride is full. No action taken.");  
                   
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
      
      ?>
               <form ACTION=<?php if($_GET['edit']==1) {echo "scripts/sEditEvent.php";}else{echo 'scripts/sCreateEvent.php';} ?> METHOD="post">
          <legend>Add Passengers:</legend>
          <?php 
          //GET INFO
          $eventId = $_GET['eventId'];
          $driverCarId = secureInput($_GET['carId']);
          //Select for all passengers that need a ride for this event.
          
          $query = "SELECT * FROM  `passengers` WHERE  `eventId` =$eventId AND  `carId` =0";
          $passengers = mysql_query($query);
          if(mysql_num_rows($passengers)!=0 and fullRide($eventId, $driverCarId)==false)
          {
              echo '       
                  <table class="table table-condensed">    
                    <thead>
                    <tr>
                      <th width="2%">#</th>
                      <th width="50%">Passenger Name</th> 
                      <th width="20%">Comment</th> 
                      <th width="30%">Actions</th> 
                    </tr>
                  </thead>
              <tbody>';

              $count = 0;
              while($passenger = mysql_fetch_array($passengers))
              {
                  $count++;
                   echo '<tr>';
                   echo '<td>'.$count.'</td>';
                   echo '<td>'.queryUsername($passenger['passengerName']).'</td>';
                   echo '<td>'."User needs a ride for this event.".'</td>';
                   echo '<td>'.'<a class="btn btn-primary" href="scripts/sAddPassenger.php?eventId='.$eventId.'&carId='.$driverCarId.'&passengerName='.$passenger['passengerName'].'">Add Passenger &raquo;</a>'.'</td>';
                   echo '</tr>';
              }
              echo '</table>';
          }
          else
          {
              if(fullRide($eventId, $driverCarId))
              {
                echo '<table class="table table-condensed" align="center">
                <tr class="error">
                <td><h4>Your ride is full and you cannot add any more passengers.</h4></td>
                </tr>
                </table>';
              }
              else
              {
              echo '<table class="table table-condensed" align="center">
                <tr class="warning">
                <td><h4>No passengers are seaking a ride at this time.</h4></td>
                </tr>
                </table>';
              }

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
