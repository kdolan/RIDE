
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

      <!-- Main hero unit for a primary marketing message or call to action -->
      <div class="hero-unit">
        <form>
          <legend>Creating A Tent ~ [Event Name]:</legend>
          <label>Owner Name </label>
          <input type="text" placeholder="Auto Populate">
          <label>Tent Name </label>
          <input type="text" placeholder="Tent Name">
          <label>Comments</label>
          <textarea name="textarea" cols="20" rows="2"> </textarea>
          <label>Total Spots Avaliable <font face="" color="#666666">(The total number of people that can sleep in the tent.)</font></label>
         
          <input type="number" id="seatsAvaliable" onChange="addInput('dynamicInput',this.value);">
           <span class="help-block">Leave "Add Resident" field empty to dsignate as open.</span>
     <h5>Include yourself if you plan on sleeping in this tent</h5>
             <div id="dynamicInput" style="margin-left:15px" >
             <label>Add Resident</label>
           	<input type="text" placeholder="Resident Name" name="myInputs[]" >
           </div>
          <button type="submit" class="btn btn-primary btn-large"><?php if($_GET['edit']==1) {echo "Edit";} else {echo 'Create';} ?> Tent&raquo;</button>
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
			function addInput(divName, number) {
			 if (number > limit) {
				  alert("The max number of people in one tent is "+limit+". Unless Potter got a biger cabbin >:)");
				  var seats = document.getElementById("seatsAvaliable")
				  seats.value = "12";
				  number = 12
			 }
		 		var pa= document.getElementById(divName);
				 while(pa.lastChild)pa.removeChild(pa.lastChild); //remove all Add Passenger text boxes.
				 
				 var count = 0;
				 do
				 {
					  var newdiv = document.createElement('div');
					  newdiv.innerHTML = "Add Resident <br><input type='text' placeholder='Resident Name' name='myInputs[]'>";
					  document.getElementById(divName).appendChild(newdiv);
					  count++;
				 }
				 while (count<number);
			
		}
	  </script>
      
      <script type="text/javascript">
        $(document).ready(function () { 
            $('.timepicker-default').timepicker();

            $('.timepicker-1').timepicker({
                minuteStep: 1,
                template: 'modal',
                showSeconds: true,
                showMeridian: false
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
