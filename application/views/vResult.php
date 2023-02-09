<!DOCTYPE>
<html>
<head>
<title>Dashboard - Result Test</title>
<?php include "include/style.php"; ?>
    <script src="<?php echo JS_BASE_URL; ?>/responsive-tabs.js" type="text/javascript"></script>
    <link href="<?php echo TOOLS_BASE_URL; ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
</head>

<body>

<?php include "include/fixed.php"; ?>


<div class="container">	
   <?php include "include/vheader.php"; ?>
   <div class="clear"> </div>
            <div class="clear"> </div>
	<div class="dasboard">
            <?php include "include/dasboard-left.php"; ?>
            <div class="dasboard-right">
            	<br/><br/>
                <div class="das-r-menu">
                	<ul class="rtabs">
                        <li><a href="#ResultProgress">Progress Exam</a></li>
                        <li><a href="#ResultMock">Mock Exam   </a></li>
                        <li><a href="#ResultWeekly">Weekly Independent Assignment</a></li>
                        </ul>
                    <div class="panel-container">
                        <div id="ResultProgress">
                        	<div class="das-table">
                                <?php if($countProgressExamSubject > 0 ){ ?>
								<h2>PROGRESS EXAM</h2>
								<?php foreach($rsProgressExamSubject as $key => $progressexamsubject){ ?>
								<table class="gridtable">
                                    <tr>
                                        <th style="text-align:left;"><?php echo $progressexamsubject['subject_title'];?></th><th>Attempt 1</th><th>Attempt 2</th><th>Attempt 3</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">Multiple Choice</td>
										<?php
										$arrResultMultipleChoice = array();
										$attempt = 3;
										$attemptresult = $attempt - count($progressexamsubject['result']);

										if(count($progressexamsubject['result'])) {?>
											<?php foreach($progressexamsubject['result'] as $keyresult => $result){ ?>
												<td>
												<?php
												$percent = 100;
												if($result['attempt'] == 2){
													$percent = 80;
												} else if($result['attempt'] == 3){
													$percent = 60;
												} 
												$score = round(($result['progress_exam_result_value'] / $result['total_question']) * $percent, 2);
												array_push($arrResultMultipleChoice,$score);
												?>
												<?php echo $score;?></td>
											<?php } ?>
											<?php for($i=0; $i<$attemptresult; $i++){ array_push($arrResultMultipleChoice,0)?>
												<td>Incomplete</td>
											<?php } ?>
										<?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">Essay</td>
										<?php
										$arrResultEssay = array();
										$attempt = 3;
										$attemptresult = $attempt - count($progressexamsubject['result_essay']);

										if(count($progressexamsubject['result_essay'])) {?>
											<?php foreach($progressexamsubject['result_essay'] as $keyresult => $result){ ?>
												<td>
												<?php
												$percent = 100;
												if($result['attempt'] == 2){
													$percent = 80;
												} else if($result['attempt'] == 3){
													$percent = 60;
												} 
												$score_essay = round(($result['progress_exam_essay_value']/100) * $percent, 2);
												array_push($arrResultEssay,$score_essay);
												?>
												<?php 
												if(!empty($result['progress_exam_essay_update_date'])){
													echo $score_essay;
												} else {
													echo "On Progress";
												}
												?>
												</td>
											<?php } ?>
											<?php for($i=0; $i<$attemptresult; $i++){ array_push($arrResultEssay,0);?>
												<td>Incomplete</td>
											<?php } ?>
										<?php } ?>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td style="text-align:left;">TOTAL</td>
										<?php
										$arrResult = array();
										foreach (array_keys($arrResultMultipleChoice + $arrResultEssay) as $key) {
											$arrResult[$key] = $arrResultMultipleChoice[$key] + $arrResultEssay[$key];
										}
										?>
										
										<?php if(count($arrResult) > 0) { ?>
											<?php foreach($arrResult as $key => $result){ ?>
											<td><?php echo $result; ?></td>
											<?php } ?>
										<?php } ?>
                                    </tr>
                                 </table>
								 <br>
								 <?php } ?>
								 <?php } ?>
                            </div>
                            <div class="das-note">
                            	  <h3> notes* </h3>
                                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. <br>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.

                            </p>
                            </div>
                        </div>
                        <div id="ResultMock">
                            <div class="das-table">
                                <?php if($countMockExamSubject > 0 ){ ?>
								<h2>MOCK EXAM</h2>
								<?php foreach($rsMockExamSubject as $key => $mockexamsubject){ ?>
								<table class="gridtable">
                                    <tr>
                                        <th style="text-align:left;"><?php echo $mockexamsubject['subject_title'];?></th><th>Attempt 1</th><th>Attempt 2</th><th>Attempt 3</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">Multiple Choice</td>
										<?php
										$arrResultMultipleChoice = array();
										$attempt = 3;
										$attemptresult = $attempt - count($mockexamsubject['result']);

										if(count($mockexamsubject['result'])) {?>
											<?php foreach($mockexamsubject['result'] as $keyresult => $result){ ?>
												<td>
												<?php
												$percent = 100;
												if($result['attempt'] == 2){
													$percent = 80;
												} else if($result['attempt'] == 3){
													$percent = 60;
												} 
												$score = round(($result['mock_exam_result_value'] / $result['total_question']) * $percent, 2);
												array_push($arrResultMultipleChoice,$score);
												?>
												<?php echo $score;?></td>
											<?php } ?>
											<?php for($i=0; $i<$attemptresult; $i++){ array_push($arrResultMultipleChoice,0)?>
												<td>Incomplete</td>
											<?php } ?>
										<?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">Essay</td>
										<?php
										$arrResultEssay = array();
										$attempt = 3;
										$attemptresult = $attempt - count($mockexamsubject['result_essay']);

										if(count($mockexamsubject['result_essay'])) {?>
											<?php foreach($mockexamsubject['result_essay'] as $keyresult => $result){ ?>
												<td>
												<?php
												$percent = 100;
												if($result['attempt'] == 2){
													$percent = 80;
												} else if($result['attempt'] == 3){
													$percent = 60;
												} 
												$score_essay = round(($result['mock_exam_essay_value']/100) * $percent, 2);
												array_push($arrResultEssay,$score_essay);
												?>
												<?php 
												if(!empty($result['mock_exam_essay_update_date'])){
													echo $score_essay;
												} else {
													echo "On Progress";
												}
												?>
												</td>
											<?php } ?>
											<?php for($i=0; $i<$attemptresult; $i++){ array_push($arrResultEssay,0);?>
												<td>Incomplete</td>
											<?php } ?>
										<?php } ?>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td style="text-align:left;">TOTAL</td>
										<?php
										$arrResult = array();
										foreach (array_keys($arrResultMultipleChoice + $arrResultEssay) as $key) {
											$arrResult[$key] = $arrResultMultipleChoice[$key] + $arrResultEssay[$key];
										}
										?>
										
										<?php if(count($arrResult) > 0) { ?>
											<?php foreach($arrResult as $key => $result){ ?>
											<td><?php echo $result; ?></td>
											<?php } ?>
										<?php } ?>
                                    </tr>
                                 </table>
								 <br>
								 <?php } ?>
								 <?php } ?>
                            </div>
                            <div class="das-note">
                            	  <h3> notes* </h3>
                                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. <br>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.

</p>
                            </div>
                        </div>
                        <div id="ResultWeekly">
                            <div class="das-table">
                                <?php if($countWeeklyExamSubject > 0 ){ ?>
								<h2>WEEKLY INDEPENDENT ASSIGNMENT</h2>
								<?php foreach($rsWeeklyExamSubject as $key => $weeklyexamsubject){ ?>
								<table class="gridtable">
                                    <tr>
                                        <th style="text-align:left;"><?php echo $weeklyexamsubject['subject_title'];?></th><th>Attempt 1</th><th>Attempt 2</th><th>Attempt 3</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">Multiple Choice</td>
										<?php
										$arrResultMultipleChoice = array();
										$attempt = 3;
										$attemptresult = $attempt - count($weeklyexamsubject['result']);

										if(count($weeklyexamsubject['result'])) {?>
											<?php foreach($weeklyexamsubject['result'] as $keyresult => $result){ ?>
												<td>
												<?php
												$percent = 100;
												if($result['attempt'] == 2){
													$percent = 80;
												} else if($result['attempt'] == 3){
													$percent = 60;
												} 
												$score = round(($result['weekly_exam_result_value'] / $result['total_question']) * $percent, 2);
												array_push($arrResultMultipleChoice,$score);
												?>
												<?php echo $score;?></td>
											<?php } ?>
											<?php for($i=0; $i<$attemptresult; $i++){ array_push($arrResultMultipleChoice,0)?>
												<td>Incomplete</td>
											<?php } ?>
										<?php } ?>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">Essay</td>
										<?php
										$arrResultEssay = array();
										$attempt = 3;
										$attemptresult = $attempt - count($weeklyexamsubject['result_essay']);

										if(count($weeklyexamsubject['result_essay'])) {?>
											<?php foreach($weeklyexamsubject['result_essay'] as $keyresult => $result){ ?>
												<td>
												<?php
												$percent = 100;
												if($result['attempt'] == 2){
													$percent = 80;
												} else if($result['attempt'] == 3){
													$percent = 60;
												} 
												$score_essay = round(($result['weekly_exam_essay_value']/100) * $percent, 2);
												array_push($arrResultEssay,$score_essay);
												?>
												<?php 
												if(!empty($result['weekly_exam_essay_update_date'])){
													echo $score_essay;
												} else {
													echo "On Progress";
												}
												?>
												</td>
											<?php } ?>
											<?php for($i=0; $i<$attemptresult; $i++){ array_push($arrResultEssay,0);?>
												<td>Incomplete</td>
											<?php } ?>
										<?php } ?>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td style="text-align:left;">TOTAL</td>
										<?php
										$arrResult = array();
										foreach (array_keys($arrResultMultipleChoice + $arrResultEssay) as $key) {
											$arrResult[$key] = $arrResultMultipleChoice[$key] + $arrResultEssay[$key];
										}
										?>
										
										<?php if(count($arrResult) > 0) { ?>
											<?php foreach($arrResult as $key => $result){ ?>
											<td><?php echo $result; ?></td>
											<?php } ?>
										<?php } ?>
                                    </tr>
                                 </table>
								 <br>
								 <?php } ?>
								 <?php } ?>
                            </div>
                            <div class="das-note">
                            	  <h3> notes* </h3>
                                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. <br>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.

</p>
                            </div>
                    	</div>
                        
               	   </div>
                   
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
