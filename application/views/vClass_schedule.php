<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>

    <link rel='stylesheet' href='<?php echo TOOLS_BASE_URL?>/fullcalendar/lib/cupertino/jquery-ui.min.css' />
<link href='<?php echo TOOLS_BASE_URL?>/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo TOOLS_BASE_URL?>/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo TOOLS_BASE_URL?>/fullcalendar/lib/moment.min.js'></script>
<script src='<?php echo TOOLS_BASE_URL?>/fullcalendar/lib/jquery.min.js'></script>
<script src='<?php echo TOOLS_BASE_URL?>/fullcalendar/fullcalendar.min.js'></script>

<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			theme: true,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '<?php echo $now ?>',
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events:<?php echo $json ?>
		});
		
	});

</script>
</head>

<body>
<?php include_once("analyticstracking.php") ?>
<?php include "include/fixed.php"; ?>
<div class="container">	
   <?php include "include/vheader.php"; ?>
   <div class="clear"> </div>
            <div class="clear"> </div>
	<div class="dasboard">
            <?php include "include/dasboard-left.php"; ?>
            <div class="dasboard-right">
            	<br/><br/>
                 <div class="clear"> </div>
                
                   <div id='calendar'></div>
                 
               

    </div>
    <div class="clear"> </div>
</div><div class="clear"> </div>
 <?php include "include/vfooter.php"; ?>
     
</div>



</body>
</html>
