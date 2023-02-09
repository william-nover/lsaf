<!DOCTYPE>
<html>
<head>
<title>Take Test - Weekly Independent Assignment - <?php echo $rsWeeklyExamSchedule[0]['subject_title']; ?></title>
<?php include "include/style.php"; ?>
    <script src="<?php echo JS_BASE_URL; ?>/responsive-tabs.js" type="text/javascript"></script>
    <link href="<?php echo TOOLS_BASE_URL; ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
</head>

<body>

<?php include "include/fixed.php"; ?>


<div class="container">	
   <?php include "include/vheader.php"; ?>
   <div class="clear"> </div>
   <div class="dasboard">
		<?php include "include/dasboard-left.php"; ?>
		<div class="dasboard-right">
			<img src="<?php echo IMAGES_BASE_URL;?>/acca-mini.png">
			<div class="clear"> </div>
			<h3> Weekly Independent Assignment - <?php echo $rsWeeklyExamSchedule[0]['subject_title']; ?> </h3>
			<?php if($countQuestionMultiple > 0) { ?>
				<?php if($attempt_multiplechoice >= 3) { ?>
					<div id="take-test"><span>Multiple Choice</span><br><span id="date">Attempt <?php echo $attempt_multiplechoice;?></span></div>
				<?php } else { ?>
					<a href="<?php echo BASE_URL; ?>/Take_test/Start/<?php echo $rsWeeklyExamSchedule[0]['weekly_exam_group_id'];?>/1"><div id="take-test"><span>Multiple Choice</span><br><span id="date">Attempt <?php echo $attempt_multiplechoice;?></span></div></a>
				<?php } ?>
			<?php } else { ?>
				<a href="#"><div id="take-test"><span>Multiple Choice</span><br><span id="date" style="color:red;">Question Not Ready</span></div></a>
			<?php } ?>
			
			<?php if($countQuestionEssay > 0) { ?>
				<?php if($attempt_essay >= 3) { ?>
					<div id="take-test"><span>Essay</span><br><span id="date">Attempt <?php echo $attempt_essay;?></span></div>
				<?php } else { ?>
					<?php if($attempt_multiplechoice > 0) { ?>
						<a href="<?php echo BASE_URL; ?>/Take_test/Start/<?php echo $rsWeeklyExamSchedule[0]['weekly_exam_group_id'];?>/2"><div id="take-test"><span>Essay</span><br><span id="date">Attempt <?php echo $attempt_essay;?></span></div></a>
					<?php } else { ?>
						<div id="take-test"><span>Essay</span><br><span id="date">Attempt <?php echo $attempt_essay;?></span></div>
					<?php } ?>
				<?php } ?>
			<?php } else { ?>
				<a href="#"><div id="take-test"><span>Essay</span><br><span id="date" style="color:red;">Question Not Ready</span></div></a>
			<?php } ?>
			<div class="clear"> </div>
			<p> &nbsp; </p>
			<div class="das-note">
				  <h3> notes* </h3>
				  <p>1. Maximum Attempt (Multiple Choice & Essay) is 3</p>
				  <p>2. First, select Multiple Choice could afterwards to take Essay</p>
			</div>
		</div>
	</div>
    <div class="clear"> </div>
 <?php include "include/vfooter.php"; ?>
     
</div>


<script type="text/javascript">
$('.person-responsive').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
	{
	  breakpoint: 1024,
	  settings: {
		slidesToShow: 3,
		slidesToScroll: 3,
		infinite: true,
		dots: true
	  }
	},
	{
	  breakpoint: 600,
	  settings: {
		slidesToShow: 2,
		slidesToScroll: 2
	  }
	},
	{
	  breakpoint: 480,
	  settings: {
		slidesToShow: 1,
		slidesToScroll: 1
	  }
	}
	// You can unslick at a given breakpoint now by adding:
	// settings: "unslick"
	// instead of a settings object
  ]
});
</script> 
</body>
</html>
