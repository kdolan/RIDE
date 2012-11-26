<?php 
   require_once("scripts/func.php"); 
   require_once("scripts/funcUserDetails.php");
   connectToDb();  
   //curPageURL();
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
              <li><a href="selectEvent.php?type=join">Current Events</a></li>
              <li class="active"><a href="userDetails.php">User Details</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <legend>User Details:</legend>
 <div class="row">
        <div class="span5">
          <h2>User Totals</h2>
          <p>Events Attended: <?php echo getEventsAttended(); ?></p> 
          <p>Rides Given: <?php echo getRidesGiven(); ?></p> 
          <p>Rides Taken: <?php echo getRidesTaken(); ?></p> 
        </div>
        <div class="span5">
          <h2>Your Active Events</h2>
          <?php print printUserEvents(); ?>
          <p></p>
        </div>
      <div class="span10">
        <h2> Status of Your Active Events</h2>
        <?php printDetailsOFUserEvents(); ?>
      </div>
      </div>  
      </div>

        <!--<table class="table table-condensed">
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
          <tbody>
            <tr>
              <td>1</td>
              <td>Fall Camping</td>
              <td>Kevin</td>
              <td>12/12/12 5:00 PM 
              <td>0/5</td>
              <td>Person1, Person2, Person3, Person4, Person5</td>
              <td>Humm</td>
            </tr>
          </tbody>
        </table>
        
         <table class="table table-condensed">
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
        </table>
      </div>
      </div>  
      </div>
           -->
           
      <!-- Example row of columns -->
      <hr>

      <footer>
        <p>Created by Kevin J Dolan</p>
      </footer>

    </div>  <!-- /container -->

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
