<!DOCTYPE>
<html>
<head>
<title>Take Test - Weekly Independent Assignment </title>
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
			<?php if($countWeeklyExamSchedule > 0){?>
			<h3> Weekly Independent Assignment </h3>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
				<?php foreach($rsWeeklyExamSchedule as $keyWeeklyExamSchedule => $weeklyExam){ ?>
					<a href="<?php echo BASE_URL; ?>/Take_test/Section/<?php echo $weeklyExam['weekly_exam_group_id'];?>"><div id="take-test"><span><?php echo $weeklyExam['subject_title'];?></span><br><span id="date"><?php echo $weeklyExam['weekly_exam_group_start'];?> - <?php echo $weeklyExam['weekly_exam_group_end'];?></span></div></a>
				<?php } ?>
			<div class="clear"> </div>
			<?php } ?>
			
			
			<?php if($countMockExamSchedule > 0){?>
			<h3> Mock Exam </h3>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
				<?php foreach($rsMockExamSchedule as $keyMockExamSchedule => $mockExam){ ?>
					<a href="<?php echo BASE_URL; ?>/Take_test/SectionMock/<?php echo $mockExam['mock_exam_group_id'];?>"><div id="take-test"><span><?php echo $mockExam['subject_title'];?></span><br><span id="date"><?php echo $mockExam['mock_exam_group_start'];?> - <?php echo $mockExam['mock_exam_group_end'];?></span></div></a>
				<?php } ?>
			<div class="clear"> </div>
			<?php } ?>
			
			
			<?php if($countProgressExamSchedule > 0){?>
			<h3> Progress Exam </h3>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
				<?php foreach($rsProgressExamSchedule as $keyProgressExamSchedule => $progressExam){ ?>
					<a href="<?php echo BASE_URL; ?>/Take_test/SectionProgress/<?php echo $progressExam['progress_exam_group_id'];?>"><div id="take-test"><span><?php echo $progressExam['subject_title'];?></span><br><span id="date"><?php echo $progressExam['progress_exam_group_start'];?> - <?php echo $progressExam['progress_exam_group_end'];?></span></div></a>
				<?php } ?>
			<div class="clear"> </div>
			<?php } ?>
			
			<p> &nbsp; </p>
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
