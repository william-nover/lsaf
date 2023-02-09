<div class="dasboard-left">
<h1> <span> <?php echo $full_name;?></span> </h1>
    <ul>
    <a href="<?php echo BASE_URL;?>/Dashboard"> <li class="<?php if ($menu_left == 'Dashboard'){echo "current-info-act";}else{ echo "current-info";}?>">CURRENT INFORMATION  </li> </a> 
    
	<?php if($student_id) { ?>
	<a href="<?php echo BASE_URL;?>/Class_schedule"> <li class="<?php if ($menu_left == 'Class_schedule'){echo "class-schd-act";}else{ echo "class-schd";}?>"> CLASS SCHEDULE </li> </a> 
    <a href="<?php echo BASE_URL;?>/Module_lectures"> <li class="<?php if ($menu_left == 'Module_lectures'){echo "lecture-mdl-act";}else{ echo "lecture-mdl";}?>"> LECTURES MODULE </li> </a>
    <a href="<?php echo BASE_URL;?>/video_lectures"> <li class="<?php if ($menu_left == 'video_lectures'){echo "video-schd-act";}else{ echo "video-schd";}?>"> VIDEO SCHEDULE </li> </a> 
    <a href="<?php echo BASE_URL;?>/Skype_lectures"> <li class="<?php if ($menu_left == 'Skype_lectures'){echo "skype-schd-act";}else{ echo "skype-schd";}?>"> SKYPE SCHEDULE </li> </a> 
    <a href="<?php echo BASE_URL;?>/Take_test"> <li class="<?php if ($menu_left == 'Take_test'){echo "taketest-act";}else{ echo "taketest";}?>"> <strong> TAKE TEST  </strong></li> </a>
    <a href="<?php echo BASE_URL;?>/Result"> <li class="<?php if ($menu_left == 'Result'){echo "result-test-act";}else{ echo "result-test";}?>"> <strong> RESULT TEST </strong></li> </a>  
    <a href="<?php echo BASE_URL;?>/Ask_question"> <li class="<?php if ($menu_left == 'Ask_question'){echo "ask-act";}else{ echo "ask";}?>"> ASK A QUESTION </li> </a>
    <?php } ?>
	<a href="<?php echo BASE_URL;?>/Student_info"> <li class="<?php if ($menu_left == 'Student_info'){echo "personal-act";}else{ echo "personal";}?>"> PERSONAL INFO </li> </a>
    </ul>
</div>