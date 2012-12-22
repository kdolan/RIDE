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
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../bootstrap/timepicker/compiled/timepicker.css" type="text/css" rel="stylesheet" />
    <link href="../bootstrap/datepicker/css/datepicker.css" rel="stylesheet">
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
    <script>$('.timepicker-default').timepicker();</script>
    <script src="scripts/superbar.js">
</script>
  </head>

  <body>
         <script type="text/javascript">
    selected = new Array()
    names = new Array()
    names.push("Chris Lockfort (clockfort)");
    names.push("Gabbie Burns (yinyang)");
    names.push("Will Ziener-Dignazio (slackwill)");
    names.push("Ross Delinger (rossdylan)");
    names.push("Grant Cohoe (cohoe)");
    names.push("Ross Guarino (eos)");
    names.push("Channon Price (chprice)");
    names.push("Matt Soucy (msoucy)");
    names.push("Frank Hrach (knarf1393)");
    names.push("Ethan House (ehouse)");
    names.push("Benjamin Meyer (bmeyer)");
    names.push("Ben Centra (bencentra)");
    names.push("Joshua Winemiller (jewinemiller21)");
    names.push("Travis Whitaker (tmobile)");
    names.push("Andrew Hanes (ahanes)");
    names.push("Michael Moffitt (moffitt)");
    names.push("Julian Hammerstein (Hammerstein)");
    names.push("Ryan S Brown (ryansb)");
    names.push("Drew Stebbins (astebbin)");
    names.push("Gerard Geer (gman)");
    names.push("Eric Adams (grizzlyadams)");
    names.push("John Feulner (peppy)");
    names.push("Sarah Clauser (sclauser)");
    names.push("Duncan Keller (duncannons)");
    names.push("Cliff Chapman (mrdoom)");
    names.push("Anqi Chen (totoro)");
    names.push("Megan McNeice (mmcneice)");
    names.push("Michail Yasonik (gorbachev)");
    names.push("Alex Berkowitz (berky93)");
    names.push("Emily Egeland (ducktape)");
    names.push("Alex Walcutt (awalcutt)");
    names.push("Josh McSavaney (mcsaucy)");
    names.push("Daniel Tyler (dtyler)");
    names.push("Dan Fuhry (fuhry)");
    names.push("Anthony Gargiulo (agargiulo)");
    names.push("Russ Harmon (russ)");
    names.push("Benjamin Russell (benrr101)");
    names.push("Jeff Haak (zemon1)");
    names.push("Will Orr (worr)");
    names.push("Grant Kurtz (grnt426)");
    names.push("Connor Monahan (kerberos)");
    names.push("Alex Howland (ducker)");
    names.push("Michael Bax Bradley (mike5)");
    names.push("Nikko Williard (urfriendlyvirus)");
    names.push("Peter Vowell (caliswag)");
    names.push("Alexander Kyte (alexanderkyte)");
    names.push("Reed Swiernik (rswiernik)");
    names.push("Dan Brockwell (dbrocks)");
    names.push("Mike Janitor (thejanitor)");
    names.push("Michael Swan (swanboy)");
    names.push("Michael A. Wilmoth (leroyflyer)");
    names.push("f_MeghanSchafer (f_MeghanSchafer)");
    names.push("Jacqueline McGraw (jackiedmcgraw)");
    names.push("Ross Bayer (rostepher)");
    names.push("Schuyler Martin (skyguysciguy)");
    names.push("Matthew Lavine (mattlavine)");
    names.push("Nick Depinet (nick)");
    names.push("Michael G. Cunney (kanye)");
    names.push("Kevin Dolan (kdolan)");
    names.push("f_TroyCaro (f_TroyCaro)");
    names.push("Andrew Glaude (ajgajg1134)");
    names.push("Tyler Cromwell (tyler)");
    names.push("Joseph Batchik (jd)");
    names.push("Matt Gambogi (gambogi)");
    names.push("Stephen Demos (demos)");
    names.push("Derek Gonyeo (dgonyeo)");
    names.push("f_ColinMurphy (f_ColinMurphy)");
    names.push("f_DavidKisluk (f_DavidKisluk)");
    names.push("f_JasonNoll (f_JasonNoll)");
    names.push("f_ColtonSurdyk (f_ColtonSurdyk)");
    names.push("f_AndrewWood (f_AndrewWood)");
    names.push("f_CorySollberger (f_CorySollberger)");
    names.push("Robert Glossop (robgssp)");
    names.push("f_JayNdow (f_JayNdow)");
    names.push("f_ShawWinner (f_ShawWinner)");
    names.push("f_DerekCloos (f_DerekCloos)");
    names.push("f_DavidSeidman (f_DavidSeidman)");
    names.push("f_NathanielFalcone (f_NathanielFalcone)");
    names.push("f_PeterGilosa (f_PeterGilosa)");
    names.push("Nick Hilton (hilton)");
    names.push("Tal Cohen (tcohen)");
    names.push("f_MichaelEaton (f_MichaelEaton)");
    names.push("f_JoshuaHampton (f_JoshuaHampton)");
    names.push("Ryan Buzzell (rbuzzell)");
    names.push("Austin Levesque (austinlvsq)");
    names.push("Matthew Rose (cobert)");
    names.push("Julien Eid (jeid)");
    names.push("Sophie Song (sophiesong)");
    names.push("Scott Jordan (swinejelly)");
    names.push("Jennifer Dziuba (candy)");
    names.push("f_NateLemoi (f_NateLemoi)");
    names.push("f_ShareefAli (f_ShareefAli)");
    names.push("f_JoeGambino (f_JoeGambino)");
    names.push("f_ColinONeill (f_ColinONeill)");
</script>   <!--Insert DB wrapper here -->
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

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
      
       <?php 
       //Print sussess messae if user was removed susessfully
      //1 = Event Created Suc
          $eData = $_GET['e']; //Success messages
          $eeData = $_GET['ee']; //Error Messages
        
        $outputE = array("User Removed From Ride","Ride Edited Successfully","Ride Created Successfully");
        $outputEE = array("One of the users specified already has a ride for this event. No changes have been made. ","One or more of the users specified already have
        a ride for this event. Your ride was created but no passengers were added.");  
                   
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
      
      <?php
	  	$eventId = $_GET['eventId'];
		$carId = $_GET['carId'];
		
	  	$query = "SELECT * FROM `eventList` WHERE `eventList`.`id` = $eventId";
		$eventTable = mysql_query($query);
		$event = mysql_fetch_array( $eventTable );
		
		$eventDepartStart = $event['depatrueStart'];
		$eventDepartStartTimeStamp = strtotime($eventDepartStart);
		
		$eventDepartEnd = $event['depatrueEnd'];
		$eventDepartEndTimeStamp = strtotime($eventDepartEnd);
	
		if($_GET['edit']==1)
		{
			//get info from database for form fields
			
			$query = "SELECT * FROM `rideList` WHERE `rideList`.`eventId` = $eventId AND `rideList`.`carId`=$carId";
			//echo $query;
			$rideTable = mysql_query($query);
			$ride = mysql_fetch_array( $rideTable );
			
			$departureDateTime = $ride['depatrueTime'];
			$departureTimeStamp = strtotime($departureDateTime);
			//echo $departureTimeStamp;
			
			$departureDate = date("m-d-Y",$departureTimeStamp);
			$departureTime = date("h:i A",$departureTimeStamp);

			 	
		}
	  ?>
        <form id="ride" ACTION=<?php if($_GET['edit']==1) {echo "scripts/sEditRide.php";}else{echo 'scripts/sCreateRide.php';} ?> method="post" onsubmit="return false;">
         <input type="hidden" name="eventId" value="<?php echo $eventId;?>">
         <input type="hidden" name="carId" value="<?php echo $carId;?>"> 
          <legend><?php if($_GET['edit']==1) {echo "Editing Ride ~ ".$event['eventName'];} else {echo 'Createing a Ride ~ '.$event['eventName'];} ?>:</legend>
          
          <label>Driver Name </label>
          <input type="text" value="<?php 
          if($_GET['edit']==1) {
              echo queryUsername($ride['driverName']);
          }
          else{ 
              echo queryUsername($_SERVER['WEBAUTH_USER']);
          }
            ?>" id="driverName" name="driverName" readonly>
          <?php 
          if(isAdmin())
          {
              echo '<button id="overrideButton" class="btn btn-warning" onclick="overrideActive()" type="button">*Override Driver*</button>';  
          }
          ?>
          <span class="help-block">Valid Departure Window: <?php echo (date('D M d \a\t h:i A',$eventDepartStartTimeStamp)); ?> <em>to</em> 
		  <?php 
		  				if( date('D M d',$eventDepartStartTimeStamp) == date('D M d',$eventDepartEndTimeStamp ) )
						{
							echo (date('h:i A',$eventDepartEndTimeStamp )); 
						}
						else
						{
							echo date('D M d \a\Ft h:i A',$eventDepartEndTimeStamp);	
						}
						
		  ?></span>
      <label>Departure Date 
       
      </label>
			  <div class="input-append date" id="dp3" data-date="<?php if($_GET['edit']==1) {echo (date('m-d-Y',$departureTimeStamp));} else {echo (date('m-d-Y'));} ?>" data-date-format="mm-dd-yyyy">
				<input class="span2" size="16" type="text" value="<?php if($_GET['edit']==1) {echo (date('m-d-Y',$departureTimeStamp));} else {echo (date('m-d-Y'));} ?>"  readonly name="departDate">
				<span class="add-on"><i class="icon-th"></i></span>
			  </div>
          <label>Departure Time </label>
<div class="input-append bootstrap-timepicker-component">
  <input type="text" class="timepicker-1 input-small" name="departTime">
  <span class="add-on">
        <i class="icon-time"></i>
    </span>
</div>
          <label>Comments</label>
           <textarea name="comments" cols="20" rows="2"><?php if($_GET['edit']==1) {echo $ride['comments'];}?> </textarea>
          <label>Seats Avaliable <font face="" color="#666666">(Not including the driver)</font></label>
         
          <input type="number" id="seatsAvaliable" onChange="addInput('dynamicInput',this.value);" name="seatsAvaliable" value="<?php if($_GET['edit']==1) {echo $ride['seatsAvailable'];} else {echo '3';}?>">
           <span class="help-block">Leave "Add Passenger" field empty to dsignate as open.</span>
           <?php 
           
           
                if($_GET['edit']==1) 
                {
                    
                    $counterAddPassengers = 0 ;
                    $numberOfCurrentPassengers = 0;
                    $passengers = mysql_query("SELECT * FROM `passengers` WHERE `passengers`.`carId` = $carId AND `passengers`.`eventId`=$eventId");
                    
                    $printedFormating = false;
                    while ($counterAddPassengers < $ride['seatsAvailable'])
                    {

                        $passenger =  mysql_fetch_array( $passengers );
                        $passengerName = $passenger['passengerName'];
                        if($passengerName != '')
                        {
                                if(!$printedFormating)
                                {
                                   echo '<div id="staticPassemgers" style="margin-left:15px" > 
                                <label>Current Passenger</label> ';
                                    $printedFormating = true; 
                                }
                               echo '<input type="text" readonly placeholder="Passenger Name" value="'.queryUsername($passengerName).'" name="na" > 
                            <a class="btn btn-danger" href="scripts/sRemovePassenger.php?eventId='.$eventId.'&carId='.$carId.'&passengerName='.$passengerName.'">Remove Passenger</a><br>';
                            $numberOfCurrentPassengers++;
                            
                        }
                        $counterAddPassengers++;
                    }
                    if($printedFormating)
                    {
                        echo '</div> '; 
                    }
                }
                   
           ?>   
           
             <div id="dynamicInput" style="margin-left:15px" >
             
             <?php 
			 	    
                     if($_GET['edit']==1) 
                     {    
                        $counterAddPassengers = 0 ;
                        $passengers = mysql_query("SELECT * FROM `passengers` WHERE `passengers`.`carId` = $carId AND `passengers`.`eventId`=$eventId");
                        while ($counterAddPassengers < $ride['seatsAvailable'])
                        {
                            $passenger =  mysql_fetch_array( $passengers );
                            $passengerName = $passenger['passengerName'];
                            if($passengerName == '')
                            {
                                   //echo '<label>Add Passenger</label><input type="text" placeholder="Passenger Name" name="passegers[]" ><br>'; 
                                   echo '<label>Add Passenger</label>'."<input type=\"text\" class=\"superbar\" id=\"superbar".$counterAddPassengers."\" onkeyup=\"search('superbar".$counterAddPassengers."', event, addSelected);\" placeholder='Passenger Name' name='passegers[]'/>".'<br>';       
                            }
                            $counterAddPassengers++;
                        } 
                     }
                     else
                     {
                        $numberOfCurrentPassengers = 0;
                        echo '<label>Add Passenger</label>'."<input type=\"text\" class=\"superbar\" id=\"superbar1\" onkeyup=\"search('superbar1', event, addSelected);\" placeholder='Passenger Name' name='passegers[]'/>".'<br>';
                        echo '<label>Add Passenger</label>'."<input type=\"text\" class=\"superbar\" id=\"superbar2\" onkeyup=\"search('superbar2', event, addSelected);\" placeholder='Passenger Name' name='passegers[]'/>".'<br>';
                        echo '<label>Add Passenger</label>'."<input type=\"text\" class=\"superbar\" id=\"superbar3\" onkeyup=\"search('superbar3', event, addSelected);\" placeholder='Passenger Name' name='passegers[]'/>".'<br>';
                        //echo '<label>Add Passenger</label><input type="text" placeholder="Passenger Name" name="passegers[]" ><br>';
                        //echo '<label>Add Passenger</label><input type="text" placeholder="Passenger Name" name="passegers[]" ><br>';
                        

                     }
			?>
           </div>
           <div id="results" class="results">
                 
                                 <div id="results" class="results">
                                 
                                 </div>
                                 </div>
          <button type="button" onclick="document.forms[0].submit();" class="btn btn-<?php if($_GET['edit']==1) {echo "info";} else {echo 'primary';} ?> btn-large"><?php if($_GET['edit']==1) {echo "Edit";} else {echo 'Create';} ?> Ride&raquo;</button>
          <?php if($_GET['edit']==1) { echo '<a class="btn btn-danger btn-large" href="scripts/sCancelFullRide.php?eventId='.$eventId.'&carId='.$carId.'">Cancel Ride &raquo;</a>';} ?>
</form>
      </div>

     
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
			
			var limit = 12;
            var peopleOnRide = <?php echo $numberOfCurrentPassengers.';'; ?>
			function addInput(divName, number) {
			 if (number > limit) {
				  alert("The max number of people in one car is "+limit+". Unless we have a new party bus >:)");
				  var seats = document.getElementById("seatsAvaliable");
				  seats.value = "12";
				  number = 12
			 }
             if (number < 1) {
                  var seats = document.getElementById("seatsAvaliable");
                  seats.value = "1";
                  number = 1
             }
             if(number < peopleOnRide) {
                  var seats = document.getElementById("seatsAvaliable");
                  seats.value = peopleOnRide;
             }
		 		var pa= document.getElementById(divName);
				 while(pa.lastChild)pa.removeChild(pa.lastChild); //remove all Add Passenger text boxes.
				 
				 var count = peopleOnRide;
				 while (count<number)
				 {
					  var newdiv = document.createElement('div');
                      
					  newdiv.innerHTML = "<label>Add Passenger</label><input type=\"text\" class=\"superbar\" id=\"superbar"+count+"\" onkeyup=\"search('superbar"+count+"', event, addSelected);\" placeholder='Passenger Name' name='passegers[]'/>";  //"Add Passenger <br><input type='text' placeholder='Passenger Name' name='passegers[]'>";
					  document.getElementById(divName).appendChild(newdiv);
					  count++;
				 }

			
		}
	  </script>
      <?php 
          if(isAdmin())
          {
              echo '      
              <script type="text/javascript">
                    function overrideActive()
                    {
                        var driverName = document.getElementById(\'driverName\');
                        var overrideButton = document.getElementById(\'overrideButton\');
                        
                        driverName.readOnly = false;
                        overrideButton.style.visibility="hidden";
                    }
              </script>';
          }
      ?>

      <script type="text/javascript">
        $(document).ready(function () { 
            $('.timepicker-default').timepicker();

            $('.timepicker-1').timepicker({
                minuteStep: 1,
                showSeconds: false,
                showMeridian: true,
				defaultTime: <?php if($_GET['edit']==1) {echo "'".$departureTime."'";} else {echo "'".(date('h:i A'))."'";} ?>
            });

            $('.timepicker-2').timepicker({
                minuteStep: 5,
                showInputs: false,
                disableFocus: true
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
