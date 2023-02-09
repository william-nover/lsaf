<!DOCTYPE>
<html>
<head>
<link href="<?php echo IMAGES_BASE_URL;?>/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entry Test</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo CSS_BASE_URL; ?>/style.css" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.plugin.js"></script>
<script type="text/javascript" src="<?php echo JS_BASE_URL; ?>/jquery.countdown.js"></script>
<script type="text/javascript">
	$(function () {
		function expiredTimer(){
			$.ajax({
				type : 'POST',
				dataType: "json",
				url: "<?php echo BASE_URL;?>/Entrytest_ajax/Timeout",
				success: function(data){
					if(data.status == 1){
						window.location.href = "<?php echo BASE_URL;?>/Entrytest/Finish"; 
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
    	<h1> Entry Test </h1>
        <p> Question <?php echo $page;?> </p>
    </div>
    <div class="header-2b">
    	<h1> Time Remaining </h1>
        <p id="expired"> </p>
    </div>
    <div class="header-2c">
    	<span><?php echo $percenProgress; ?>%</span>
		<h1> <div style="width:<?php echo $percenProgress; ?>%;background:#F7931E;"></div> </h1>
        <a href="#" onclick="toggle_visibility('foo');">
        	<p>Progress Detail</p>
        </a>
        <div class="line-progress"> </div>
    </div>
    <div class="header-2d">
        <p> <?php echo date('d M Y');?></p>
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
						<a href="<?php echo BASE_URL;?>/Entrytest/Start/<?php echo $qstNo['no']; ?>"><div id="info-bullet"> <div> <?php echo $qstNo['no']; ?> </div> </div></a>
					<?php } else { ?>
						<a href="<?php echo BASE_URL;?>/Entrytest/Start/<?php echo $qstNo['no']; ?>"><div id="info-bullet-clear"> <div> <?php echo $qstNo['no']; ?> </div> </div></a>
					<?php } ?>
				<?php } ?>
			<?php } ?>
        </div>
    </div>
</div>

<?php if($countExam > 0){?>
<div class="question">
	<?php foreach($Exam as $keyQuestion => $examQuestion){ ?>
	<h1> Question <?php echo $page;?> </h1>
    <input type="hidden" name="question_id" id="idQuestion<?php echo $keyQuestion;?>" value="<?php echo $examQuestion['entry_question_id'];?>">
	<?php echo $examQuestion['entry_question_title'];?>
	
    <h3>Choose one answer. </h3>
    <?php if(count($examQuestion['answer']) > 0){ ?>
	<div class="pilihan">
    	<?php foreach($examQuestion['answer'] as $keyAnswer => $examAnswer){ ?>
		<div>
            <input type="radio" name="answer_id<?php echo $keyQuestion;?>" id="idAnswer<?php echo $examQuestion['entry_question_id'];?>" value="<?php echo $examAnswer['entry_answer_id'];?>" <?php if($examAnswer['is_answered'] == 1) { echo "checked";} ?> />
            <label for="c1"><?php echo $examAnswer['entry_answer_title'];?></label>
        </div>
		<?php } ?>
		<script type="text/javascript" >
		$(document).ready(function() {
			$("input[name=answer_id<?php echo $keyQuestion;?>]:radio").change(function(e){
				e.preventDefault();
				
				var questionid = $("#idQuestion<?php echo $keyQuestion;?>").val();
				var answerid = $('input:radio[name=answer_id<?php echo $keyQuestion;?>]:checked').val();
				
				var params = "q_id="+questionid+"&a_id="+answerid;
				
				if(answerid != undefined){
					$.ajax({
						type : 'POST',
						dataType: "json",
						url: "<?php echo BASE_URL;?>/Entrytest_ajax/SubmitRadio",
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
 
<div class="footer-2">
	<div class="footer-2-isi">
        <input type="hidden" name="page" id="idpage" value="<?php echo $page;?>">
		<?php if($pageNext <= $TotalQuestion){ ?>
			<a href="<?php echo BASE_URL;?>/Entrytest/Start/<?php echo $pageNext; ?>" class="next_question" id="btnNext"> <div class="next"> <div> Next </div> </div> </a>
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

<script type="text/javascript" >
	$(document).ready(function() {
		$('#btnFinish').click(function (e) {
			e.preventDefault();
			var csfr = "";
			csrf = $("#idCsrf").val();
			
			var params = "csfr="+csrf;
			
			var txt;
			var r = confirm("Are you sure want to finish Entry Test? ");
			if (r == true) {
				$.ajax({
					type : 'POST',
					dataType: "json",
					url: "<?php echo BASE_URL;?>/Entrytest_ajax/SubmitFinish",
					data: params,
					success: function(data){
						if(data.status == 1){
							window.location.href = "<?php echo BASE_URL;?>/Entrytest/Finish"; 
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
</body>
</html>
