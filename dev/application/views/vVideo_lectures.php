<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>
   
    <link href="<?php echo TOOLS_BASE_URL; ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
  
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
            <div class="header-content">  </div> 
                 <div id="container" class="das-table">
                   <div class="das-r-menu">
                     <?php $ym = $month;
                     $prev = date('Y-m', strtotime('-1 month', strtotime($ym)));
                     $next = date('Y-m', strtotime('+1 month', strtotime($ym)));
                     
                     ?>  
                    <ul class="rtabs">
                        <li><a href="<?php echo BASE_URL;?>/Video_lectures/<?php echo $prev;?>"><< Prev</a></li>
                        <li><a href="<?php echo BASE_URL;?>/Video_lectures/<?php echo $next;?>">Next >>   </a></li>
                       
                    </ul>
                    <div class="panel-container">
                        <div id="view1">
                        	<div class="das-table">
                                <h2><?php echo $month; ?></h2>
                                <table class="gridtable">
                                    <thead>
                                   
                                        <th style="text-align:left;">No</th>
                                        <th>Video Title</th>                                     
                                        <th>Video Date</th>
                                        <th>Video Subject</th>
                                        <th>Lecturer Name</th>
                                    
                                    </thead>
                                    <tbody>
                                  <form name="formAssignment" method="POST" action="" onsubmit="return false;">
                                    <?php
                                          if(count($ListVideo_Lectures) > 0){
                                          $no=0;
                                          foreach($ListVideo_Lectures as $vl){
                                                  $no++;
                                    ?>
                                    <tr>    
                                          <td><?php echo $no;?></td>
                                            <td>
                                                <a href="<?php echo BASE_URL;?>/Video_lectures/detail/<?php echo $vl['video_lectures_id'];?>"><?php echo $vl['video_lectures_title'];?></a>
                                            </td>
                                            <td><?php echo $vl['video_lectures_date'];?></td>
                                            <td><?php echo $vl['subject_title'];?></td>
                                            <td><?php echo $vl['lecturer_name'];?></td>
                                                    
                                    </tr>
                                    <?php } ?>
                                    <?php } else {?>
                                    <tr>
                                     <td align="center" colspan="10">Data Not Found</td>
                                    </tr>
                                    <?php } ?>
                                    </form>
                                  </tbody>
                                   
                                 </table>
                            </div>

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
