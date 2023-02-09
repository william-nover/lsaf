<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>
   
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
                 <div class="clear"> </div>
                 <div id="container" class="das-table">
                    <form action="<?php echo BASE_URL;?>/Ask_question/sendQuestion" method="post" class="register-page">
               <label>
                    <span>Lectures Subject </span>
                     <select id="subject_id" class="" name="subject_id">
                        <?php foreach ($ListSubject as $ls) { ?>
                         <option value="<?php echo $ls-> subject_id;?>"><?php echo $ls->subject_title;?></option>       
                        <?php } ?>                    
                    </select>
                </label>
                <div class="clear"> </div> 
                <label>
                    <span> Question Subject </span>
                    <input id="question_subject" type="text" name="question_subject" />
                </label>
                <label>
                    <span>Question Detail</span>
                    <textarea name="question_detail" id="question_detail" style="height:120px"> </textarea>
                </label>
                <div class="clear"> </div> 
                
                <div class="clear"> </div> 
                
                <div class="clear"> </div> 
                <label>
                    <input type="submit" class="button" value="Send" />
                </label> 
                 </form>
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
