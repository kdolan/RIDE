<?php
    require_once("scripts/func.php");     
    //connectDb(); 
    $noRe = $_GET['r'];
    if($noRe!=1){uxRedirect();
    }
    
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
          <a class="brand" href="index.php">RIDE</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="selectEvent.php?type=join">Current Events</a></li>
              <li><a href="userDetails.php">User Details</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
       <?php //echo $_SERVER['WEBAUTH_USER'] ;   ?>
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
      
        <h1>CSH - RIDE</h1>
        <p>CSH RIDE (<strong>R</strong>emote <strong>I</strong>deal <strong>D</strong>eparture <strong>E</strong>ngine) is desined to ensure all CSH members have a ride to various off campus CSH events.</p>
        <p><a class="btn btn-primary btn-large" href="selectEvent.php?type=join">View Current Events &raquo;</a></p>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span4">
          <h2>Create An Event</h2>
          <p>It is impossible to have a ride board without an event.</p> <br>
          <p><a class="btn btn-success" href="createEvent.php">Create Event &raquo;</a></p>
        </div>
        <div class="span4">
          <h2>Do You Have A Car?</h2>
          <p>Are you driving to a CSH event? Want to take other CSH's with you? Create a ride so other members can ride along.</p>
          <p><a class="btn btn-success" href="selectEvent.php?type=create">Create Ride &raquo;</a></p>
       </div>
        <div class="span4">
          <h2>User Status</h2>
          <p>Forget what car you are in or when you are leaving? Check the user details page for information on your rides.</p>
          <p><a class="btn btn-info" href="userDetails.php">User Details &raquo;</a></p>
        </div>
      </div>

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
