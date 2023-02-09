<!DOCTYPE>
<html>
<head>
<link href="<?php echo IMAGES_BASE_URL;?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Progress Exam - <?php echo $subject_title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo CSS_BASE_URL; ?>/style.css" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.plugin.js"></script>
<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.countdown.js"></script>
<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.form.js"></script>
<style>
#progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
#bar { background-color: #B4F5B4; width:0%; height:20px; border-radius: 3px; }
#percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>
<script type="text/javascript">
	$(function () {
		function expiredTimer(){
			<?php if($type == 1){ ?>
			var groupid = "";
			var type = "";
			
			groupid = $("#groupid").val();
			type = $("#type").val();
			
			var params = 'groupid='+groupid+'&type='+type;
			
			$.ajax({
				type : 'POST',
				dataType: "json",
				data: params,
				url: "<?php echo BASE_URL;?>/Progress_test_ajax/Timeout",
				success: function(data){
					if(data.status == 1){
						window.location.href = "<?php echo BASE_URL;?>/Progress_test/Finish"; 
					} else {
						alert(data.msg);
					}
				},
				error: function( xhr, tStatus, err ) {
					if (xhr.status === 0 || xhr.readyState === 0) {
						alert('Maaf koneksi internet Anda bermasalah!');
					}
					console.log("e expiredTimer :" + xhr.status + " " + xhr.readyState  + " " + tStatus + " " + err);
				}
			});
			
			<?php } else { ?>
			
			var groupid = "";
			
			groupid = $("#groupid").val();
			
			var params = 'groupid='+groupid;
			
			$.ajax({
				type : 'POST',
				dataType: "json",
				data: params,
				url: "<?php echo BASE_URL;?>/Progress_test_ajax/TimeoutEssay",
				success: function(data){
					if(data.status == 1){
						window.location.href = "<?php echo BASE_URL;?>/Progress_test/Finish"; 
					} else {
						alert(data.msg);
					}
				},
				error: function( xhr, tStatus, err ) {
					if (xhr.status === 0 || xhr.readyState === 0) {
						alert('Maaf koneksi internet Anda bermasalah!');
					}
					console.log("e expiredTimer :" + xhr.status + " " + xhr.readyState  + " " + tStatus + " " + err);
				}
			});
			
			<?php } ?>
		}
		
		var t = "<?php echo $now;?>".split(/[- :]/);
		var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
		
		$('#expired').countdown({
			until: new Date(<?php echo intval($arrTimer[0]);?>, <?php echo intval($arrTimer[1]);?>-1, <?php echo intval($arrTimer[2]);?>, <?php echo intval($arrTimer[3]);?>, <?php echo intval($arrTimer[4]);?>,<?php echo intval($arrTimer[5]);?>),
			compact:true,
			onExpiry: expiredTimer,
			serverSync: serverTime,
		});
	});

	
	function serverTime() {  
		var time = null;  
		$.ajax({url: '<?php echo BASE_URL;?>/stime', 
			async: false, dataType: 'text',  
			success: function(text) {  
				time = new Date(text);  
			}, error: function(http, message, exc) {  
				time = new Date();  
		}});  
		 
		return time;  
	}
</script>
<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>
</head>
<body>
<div class="header-2">
	<img src="<?php echo IMAGES_BASE_URL;?>/test-logo.png">
	<img src="<?php echo IMAGES_BASE_URL;?>/test-acca.png">
	<div class="header-2a">
    	<h1> Progress Exam </h1>
    </div>
    <div class="header-2b">
    	<h1> Time Remaining </h1>
        <p id="expired"> </p>
    </div>
	<?php if($type == 1 ) { ?>
    <div class="header-2c">
		<span><?php echo $percenProgress; ?>%</span>
		<h1> <div style="width:<?php echo $percenProgress; ?>%;background:#F7931E;"></div> </h1>
        <a href="#" onclick="toggle_visibility('foo');">
        	<p>Progress Detail</p>
        </a>
        <div class="line-progress"> </div>
    </div>
	<?php } ?>
    <div class="header-2d">
        <h1> <?php echo $subject_title; ?> </h1>
		<p> <?php echo date('d M Y');?></p>
		<p> <?php if($type == 1 ) { ?> Multiple Choice <?php } else { ?> Essay <?php } ?> </p>
    </div>
</div>
<div class="clear"> </div>
<div id="foo" class="toogle" style="display:none;">
    <div class="toogle-one-coloumn">
    	<div class="prog-info">
        	<div class="prog-info-1"> Complete </div>
            <div class="prog-info-2"> Incomplete </div>
        </div>
        <div class="clear"> </div>
        <div class="prog-bullet">
			<?php if(count($AllQuestion) > 0) {?>
				<?php foreach($AllQuestion as $keyQstNo => $qstNo){ ?>
					<?php if($qstNo['is_answered'] == 1) {?>
						<a href="<?php echo BASE_URL;?>/Progress_test/Start/<?php echo $groupid; ?>/<?php echo $type; ?>/<?php echo $qstNo['no']; ?>"><div id="info-bullet"> <div> <?php echo $qstNo['no']; ?> </div> </div></a>
					<?php } else { ?>
						<a href="<?php echo BASE_URL;?>/Progress_test/Start/<?php echo $groupid; ?>/<?php echo $type; ?>/<?php echo $qstNo['no']; ?>"><div id="info-bullet-clear"> <div> <?php echo $qstNo['no']; ?> </div> </div></a>
					<?php } ?>
				<?php } ?>
			<?php } ?>
        </div>
    </div>
</div>

<input type="hidden" value="<?php echo $type; ?>" id="type">
<?php if($type == 1){ ?>

<?php if($countExam > 0){?>
<div class="question">
	<?php foreach($Exam as $keyQuestion => $examQuestion){ ?>
	<h1> Question <?php echo $page;?> </h1>
    <input type="hidden" name="question_id" id="idQuestion<?php echo $keyQuestion;?>" value="<?php echo $examQuestion['progress_exam_question_id'];?>">
	
	<?php if(!empty($examQuestion['progress_exam_question_images'])){ ?>
	<a id="questionImage" href="<?php echo BASE_URL.$examQuestion['progress_exam_question_images'];?>"><img src="<?php echo BASE_URL.$examQuestion['progress_exam_question_images'];?>" title="Question <?php echo $page;?>" height="125" class="gmbr-question" ></a>
	<?php } ?>
	<?php echo $examQuestion['progress_exam_question_title'];?>
	
	<div class="clear"> </div>
    <h3>Choose one answer. </h3>
    <?php if(count($examQuestion['answer']) > 0){ ?>
	<div class="pilihan">
		<input type="hidden" value="<?php echo $groupid; ?>" id="groupid">
    	<?php foreach($examQuestion['answer'] as $keyAnswer => $examAnswer){ ?>
		<div>
            <input type="radio" name="answer_id<?php echo $keyQuestion;?>" id="idAnswer<?php echo $examQuestion['progress_exam_question_id'];?>" value="<?php echo $examAnswer['progress_exam_answer_id'];?>" <?php if($examAnswer['is_answered'] == 1) { echo "checked";} ?> />
            <label for="c1"><?php echo $examAnswer['progress_exam_answer_title'];?></label>
        </div>
		<?php } ?>
		<script type="text/javascript" >
		$(document).ready(function() {
			$("input[name=answer_id<?php echo $keyQuestion;?>]:radio").change(function(e){
				e.preventDefault();
				
				var questionid = $("#idQuestion<?php echo $keyQuestion;?>").val();
				var answerid = $('input:radio[name=answer_id<?php echo $keyQuestion;?>]:checked').val();
				var groupid = $("#groupid").val();
				
				var params = "q_id="+questionid+"&a_id="+answerid+"&groupid="+groupid;
				
				if(answerid != undefined){
					$.ajax({
						type : 'POST',
						dataType: "json",
						url: "<?php echo BASE_URL;?>/Progress_test_ajax/SubmitRadio",
						data: params,
						success: function(data){

						},
						error: function( xhr, tStatus, err ) {
							if (xhr.status === 0 || xhr.readyState === 0) {
								alert('Maaf koneksi internet Anda bermasalah!');
							}
							console.log("e radio :" + xhr.status + " " + xhr.readyState  + " " + tStatus + " " + err);
						}
					});
				}
				
				return false;			
			});
		});
		</script>
   </div>  
   <?php } ?>
   
   <?php } ?>
</div>
<?php } ?>
 
<script type="text/javascript" >
	$(document).ready(function() {
		$('#btnFinish').click(function (e) {
			e.preventDefault();
			var csfr = "";
			var groupid = "";
			var type = "";
			
			csrf = $("#idCsrf").val();
			groupid = $("#groupid").val();
			type = $("#type").val();
			
			var params = 'csfr='+csrf+'&groupid='+groupid+'&type='+type;
			
			var txt;
			var r = confirm("Are you sure want to finish Progress Exam ? ");
			if (r == true) {
				$.ajax({
					type : 'POST',
					dataType: "json",
					url: "<?php echo BASE_URL;?>/Progress_test_ajax/SubmitFinish",
					data: params,
					success: function(data){
						if(data.status == 1){
							window.location.href = "<?php echo BASE_URL;?>/Progress_test/Finish"; 
						} else {
							alert(data.msg);
						}
					},
					error: function( xhr, tStatus, err ) {
						if (xhr.status === 0 || xhr.readyState === 0) {
							alert('Maaf koneksi internet Anda bermasalah!');
						}
						console.log("e radio :" + xhr.status + " " + xhr.readyState  + " " + tStatus + " " + err);
					}
				});
			}
		});
	});
</script>

<div class="footer-2">
	<div class="footer-2-isi">
        <input type="hidden" name="page" id="idpage" value="<?php echo $page;?>">
		<?php if($pageNext <= $TotalQuestion){ ?>
			<a href="<?php echo BASE_URL;?>/Progress_test/Start/<?php echo $groupid; ?>/<?php echo $type; ?>/<?php echo $pageNext; ?>" class="next_question" id="btnNext"> <div class="next"> <div> Next </div> </div> </a>
		<?php } else { ?>
			<input type="hidden" name="csrf" id="idCsrf" value="<?php echo $csrfString;?>">
			<a href="#" class="next_question" id="btnFinish"> <div class="next"> <div> Finish </div> </div> </a>
		<?php } ?>
    </div>
    <div class="clear"> </div>
    <footer style="margin-top:10px; background:#808080;">
        <div class="footer-isi" style="width:95%;">
            <h1> @ London School of Accountancy and Finance . Indonesia 2016 . ALL RIGHT RESERVED </h1>
        </div>
    </footer>
</div>
<?php } else { ?>

<?php if($countExam > 0){ ?>
<div class="question-essay">
	<form id="myForm" action="<?php echo BASE_URL;?>/Progress_test_ajax/uploadEssay" method="post" enctype="multipart/form-data">
	<h1> Question </h1>
	<input type="hidden" value="<?php echo $groupid; ?>" id="groupid" name="groupid">
	<?php foreach($Exam as $keyQuestion => $examQuestion){ ?>
    <input type="hidden" name="question_id" id="idQuestion<?php echo $keyQuestion;?>" value="<?php echo $examQuestion['progress_exam_question_id'];?>">
	<?php $no = $keyQuestion + 1; ?>
	<?php echo "Number. ".$no;?>
	<?php if(!empty($examQuestion['progress_exam_question_images'])){ ?>
	<a id="questionImage" href="<?php echo BASE_URL.$examQuestion['progress_exam_question_images'];?>"><img src="<?php echo BASE_URL.$examQuestion['progress_exam_question_images'];?>" title="Question <?php echo $page;?>" height="125" class="gmbr-question-essay" align="right"></a>
	<?php } ?>
	<?php echo $examQuestion['progress_exam_question_title'];?>
    <?php } ?>
	<input type="file" size="60" name="myfile"><br><br>
	<input type="submit" value="Upload Answer" id="btnUpload">
	<input type="hidden" name="csrf" id="idCsrf" value="<?php echo $csrfString;?>">
	</form>
	
	<div id="progress" style="display:none;">
        <div id="bar"></div>
        <div id="percent">0%</div >
	</div>
	<br/>
	<div id="message"></div>
</div>
<?php } ?>
<div class="footer-question">
    <footer style="margin-top:10px; background:#808080;">
        <div class="footer-question-isi" style="width:95%;">
            <h1> @ London School of Accountancy and Finance . Indonesia 2016 . ALL RIGHT RESERVED </h1>
        </div>
    </footer>
</div>

<script type="text/javascript" >
	$(document).ready(function() {
		var msg = "";
		var options = { 
			beforeSend: function(arr, $form, options) {
				$("#progress").show();
				$("#bar").width('0%');
				$("#message").html("");
				$("#percent").html("0%");
			},
			uploadProgress: function(event, position, total, percentComplete) {
				$("#bar").width(percentComplete+'%');
				$("#percent").html(percentComplete+'%');
			},
			success: function() {
				$("#bar").width('100%');
				$("#percent").html('100%');
			},
			complete: function(response) {
				if(response.responseText == "2"){
					$("#progress").hide();
					msg = "Parameter incomplete";
					$("#message").html("<font color='red'>"+msg+"</font>");
				} else if(response.responseText == "2"){
					$("#progress").hide();
					msg = "Please select file";
					$("#message").html("<font color='red'>"+msg+"</font>");
				} else if(response.responseText == "3"){
					$("#progress").hide();
					msg = "File upload not allowed format";
					$("#message").html("<font color='red'>"+msg+"</font>");
				} else if(response.responseText == "4"){
					$("#progress").hide();
					msg = "Maximum upload file 10 Mb";
					$("#message").html("<font color='red'>"+msg+"</font>");
				} else if(response.responseText == "5"){
					$("#progress").hide();
					msg = "Maximum attempt 3";
					$("#message").html("<font color='red'>"+msg+"</font>");
				} else {
					$("#message").html("<font color='green'>"+response.responseText+"</font>");
					window.setTimeout(function() {
						window.location.href = "<?php echo BASE_URL;?>/Progress_test/Finish"; 
					}, 1000);
				}
				
			},
			error: function(){
				$("#progress").hide();
				$("#message").html("<font color='red'> ERROR: unable to upload files</font>");
			}
		}; 	
		
		$("#myForm").ajaxForm(options);
	});
</script>

<?php } ?>

</body>
</html>
