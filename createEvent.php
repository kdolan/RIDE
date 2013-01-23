 <?php
    require_once("scripts/func.php");
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
    <link href="../bootstrap/timepicker/compiled/timepicker.css" type="text/css" rel="stylesheet" />
    <link href="../bootstrap/datepicker/css/datepicker.css" rel="stylesheet">
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
    <script>$('.timepicker-default').timepicker();</script>
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
              <li><a href="selectEvent.php?type=join">Current Events</a></li>
              <li><a href="userDetails.php">User Details</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
       <?php
    
        if($_GET['edit']==1) 
        {
            //get info from database for form fields
            $eventId = $_GET['eventId'];
            
            $query = "SELECT * FROM `kevin_ride`.`eventList` WHERE `eventList`.`id` = $eventId";
            //echo $query;
            $eventTable = mysql_query($query);
            $event = mysql_fetch_array( $eventTable );
            
            $eventDepartStart = $event['depatrueStart'];
            $eventDepartStartTimeStamp = strtotime($eventDepartStart);
            $eventDepartStartTime = date("h:i A",$eventDepartStartTimeStamp);  
            
            $eventDepartEnd = $event['depatrueEnd'];
            $eventDepartEndTimeStamp = strtotime($eventDepartEnd);
            $eventDepartEndTime = date("h:i A",$eventDepartEndTimeStamp);  
            
            $currentTime = date_create();
            $currentTimeStamp = 0;//date_timestamp_get($date);  Causes warning. Removed but works without.
           // echo   $currentTimeStamp;
            
            

                 
        }
        ?>
      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
       <?php 
       //Print sussess messae if user was removed susessfully
      //1 = Event Created Suc
          $eData = $_GET['e']; //Success messages
          $eeData = $_GET['ee']; //Error Messages
        
        $outputE = array("Event Created Sucessfully","Event Updated Sucessfully");
        $outputEE = array("");  
                   
        if($eData<=0)
        {
                
        }
        else 
        {
            echo '<table class="table table-condensed" align="center">
          <tr class="success">
        <td>'.$outputE[$eData-1].'</td>
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
      <table class="table table-condensed" align="center" style="display:none;" id="pastWarning">
          <tr class="warning">  
        <td>Warning: Event Starts in past</td>
          </tr>
      </table>
      <table class="table table-condensed" align="center" style="display:none;" id="endDateError">
          <tr class="error">
        <td>ERROR: End date cannot be before start date</td>
          </tr>
      </table>
        <form ACTION=<?php if($_GET['edit']==1) {echo "scripts/sEditEvent.php";}else{echo 'scripts/sCreateEvent.php';} ?> METHOD="post">
         <input type="hidden" name="eventId" value="<?php echo $event['id'];?>">  
          <legend>Creating An Event:</legend>
          <label>Event Name</label>
          <input name="eventName" type="text" placeholder="Event Name" value="<?php if($_GET['edit']==1) {echo $event['eventName'];}  ?>">
          <label>Description</label>
         <textarea rows="2" cols="20" name="description"><?php if($_GET['edit']==1) {echo $event['description'];}  ?></textarea>
         <label class="checkbox">
                <!--<input type="checkbox" name="campingTrip" <?php //if($event['isCamping']==1){echo 'checked'; }?>>Camping Trip
          </label>
         <span class="help-block">Adds ability to create/join tents as well as rides. (Fall Camping)</span>   -->
          <label><h5>Event Time: </h5></label>
          <div style="margin-left:15px"> <label>Event Start Time: </label> 
              <div class="input-append date" onmouseover="validDates()"  id="dp2" data-date="<?php if($_GET['edit']==1) {echo (date('m-d-Y',$eventDepartStartTimeStamp));} else {echo (date('m-d-Y'));} ?>"data-date-format="mm-dd-yyyy">
                    <input class="span2"  size="16" id="startDate" onchange="validDates()" onfocus="validDates()" type="text" value="<?php if($_GET['edit']==1) {echo (date('m-d-Y',$eventDepartStartTimeStamp));} else {echo (date('m-d-Y'));} ?>"  readonly name="startDate">
                    <span class="add-on" ><i class="icon-th"></i></span>
                    </div>
                    <div class="input-append bootstrap-timepicker-component">
                          <input type="text" onchange="validDates()" class="timepicker-1 input-small" name="startTime" id="startTime">  
                        <span class="add-on" onmouseover="validDates()">
                            <i class="icon-time" onmouseover="validDates()"></i>
                        </span>
                    </div>
                    
         </div>

     <div style="margin-left:15px"> <label>Event End Time: </label> 
               <div class="input-append date" onmouseover="validDates()" onchange="validDates()" id="dp3" data-date="<?php if($_GET['edit']==1) {echo (date('m-d-Y',$eventDepartEndTimeStamp));} else { echo (date('m-d-Y')); }?>" data-date-format="mm-dd-yyyy">
                    <input class="span2" size="16" type="text" id="endDate"  value="<?php if($_GET['edit']==1) {echo (date('m-d-Y',$eventDepartEndTimeStamp));} else { echo (date('m-d-Y')); }?>"  readonly name="endDate">
                    <span class="add-on"><i class="icon-th"></i></span>
                    </div>
                    <div class="input-append bootstrap-timepicker-component">
                        <input type="text" onchange="validDates()" class="timepicker-2 input-small" name="endTime" id="endTime">
                        <span class="add-on" onmouseover="validDates()">
                            <i class="icon-time" onmouseover="validDates()" ></i>
                        </span>
                    </div>
                    
         </div>
         <br>
     <div id="dynamicInput" style="margin-left:15px" ></div>
           <button type="submit" id="submit1" onmouseover="validDates()" class="btn btn-<?php if($_GET['edit']==1) {echo "info";} else {echo 'primary';} ?> btn-large"><?php if($_GET['edit']==1) {echo "Edit";} else {echo 'Create';} ?> Event&raquo;</button>
          
</form>
      </div>

     
      <hr>
      <!--<input type="text" id="test">
      <input type="button" onclick="validDates()" value="123">        -->
      <footer>
        <p>Created by Kevin J Dolan</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../bootstrap/js/jquery.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
    <!-- <script src="../bootstrap/js/bootstrap-alert.js"></script>
    <script src="../bootstrap/js/bootstrap-modal.js"></script>
    <script src="../bootstrap/js/bootstrap-dropdown.js"></script>
    <script src="../bootstrap/js/bootstrap-scrollspy.js"></script>
    <script src="../bootstrap/js/bootstrap-tab.js"></script>
    <script src="../bootstrap/js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap-popover.js"></script>
    <script src="../bootstrappjs/bootstrap-button.js"></script>
    <script src="../bootstrap/js/bootstrap-collapse.js"></script>
    <script src="../bootstrap/js/bootstrap-carousel.js"></script>-->
     <script src="../bootstrap/timepicker/js/bootstrap-timepicker.js"></script>
      <script src="../bootstrap/datepicker/js/bootstrap-datepicker.js"></script>
      
      
                                                                                       
      <script type="text/javascript">
      
        function validDates()
        {
            var test =   document.getElementById("test"); 
              
            var submitButton = document.getElementById("submit1");
             
            var startDate = document.getElementById("startDate");
            var startTime = document.getElementById("startTime");     
            
            var endDate = document.getElementById("endDate");
            var endTime = document.getElementById("endTime"); 
            
            var pastWarning = document.getElementById("pastWarning");
            var endDateError = document.getElementById("endDateError");   
                                                                                      
            var startDateTime = new Date(startDate.value+" "+startTime.value)
            var endDateTime = new Date(endDate.value+" "+endTime.value)
                
            var today = new Date();
             
            if(endDateTime<startDateTime)
            {
                
                pastWarning.style.display="none";
                endDateError.style.display=""; 
                submitButton.disabled=true;
                
            }
            else if(startDateTime<today)
            {
                //past 
                pastWarning.style.display="";
                endDateError.style.display="none"; 
                submitButton.disabled=false;
            }
            else
            {
                pastWarning.style.display="none";
                endDateError.style.display="none"; 
                submitButton.disabled=false;
            }
            
        }
      
      </script>
      
      <?php
       $date = new DateTime();
       $currentTimeStamp =   $date->getTimestamp(); 
       $prev = $date->getTimestamp() - ($date->getTimestamp() % 1800);
       $currentTimeStamp = $prev + 1800;
       
      ?>
     <script type="text/javascript">
        $(document).ready(function () { 
            $('.timepicker-default').timepicker();

            $('.timepicker-1').timepicker({
                minuteStep: 1,
                showSeconds: false,
                showMeridian: true,
                defaultTime: <?php if($_GET['edit']==1) {echo "'".$eventDepartStartTime."'";} else {echo "'".(date('h:i A',$currentTimeStamp+1))."'";} ?>
            });

            $('.timepicker-2').timepicker({
                minuteStep: 1,
                showSeconds: false,
                showMeridian: true,
                defaultTime: <?php if($_GET['edit']==1) {echo "'".$eventDepartEndTime."'";} else {echo "'".(date('h:i A',$currentTimeStamp+5400))."'";} ?>
            });

            $('.timepicker-3').timepicker({
                minuteStep: 1,
                secondStep: 5,
                showInputs: false,
                template: 'modal',
                modalBackdrop: true,
                showSeconds: true,
                showMeridian: false
            });

            $('.timepicker-4').timepicker({
                template: false,
                showInputs: false,
                minuteStep: 5
            });
        });
    </script>
    <script>
        $(function(){
            window.prettyPrint && prettyPrint();
            $('#dp1').datepicker({
                format: 'mm-dd-yyyy'
            });
            $('#dp2').datepicker();
            $('#dp3').datepicker();
            
            
            var startDate = new Date(2012,1,20);
            var endDate = new Date(2012,1,25);
            $('#dp4').datepicker()
                .on('changeDate', function(ev){
                    if (ev.date.valueOf() > endDate.valueOf()){
                        $('#alert').show().find('strong').text('The start date can not be greater then the end date');
                    } else {
                        $('#alert').hide();
                        startDate = new Date(ev.date);
                        $('#startDate').text($('#dp4').data('date'));
                    }
                    $('#dp4').datepicker('hide');
                });
            $('#dp5').datepicker()
                .on('changeDate', function(ev){
                    if (ev.date.valueOf() < startDate.valueOf()){
                        $('#alert').show().find('strong').text('The end date can not be less then the start date');
                    } else {
                        $('#alert').hide();
                        endDate = new Date(ev.date);
                        $('#endDate').text($('#dp5').data('date'));
                    }
                    $('#dp5').datepicker('hide');
                });
        });
        
    </script>
</body>
</html>
