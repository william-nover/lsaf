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
			alert('Time Out');
			/*$.ajax({
				type : 'POST',
				dataType: "json",
				url: "<?php echo BASE_URL;?>/tim6_ajax/timeout",
				success: function(data){
					$( ".gagal-redirect-pesan" ).text('Waktu anda telah habis');
					$('.gagal-redirect-popup').modal({
						closeHTML:"",
						escClose:false,
					});
				},
				error: function( xhr, tStatus, err ) {
					if (xhr.status === 0 || xhr.readyState === 0) {
						alert('Maaf koneksi internet Anda bermasalah!');
					}
					console.log("e expiredTimer :" + xhr.status + " " + xhr.readyState  + " " + tStatus + " " + err);
				}
			});*/
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
        <p> 2 Marks </p>
    </div>
    <div class="header-2b">
    	<h1> Time Remaining </h1>
        <p id="expired"> </p>
    </div>
    <div class="header-2c">
    	<h1> <div> 60% Complete </div> </h1>
        <a href="#" onclick="toggle_visibility('foo');">
        	<p>Test Progress Detail</p>
        </a>
        <div class="line-progress"> </div>
    </div>
    <div class="header-2d">
    	<h1> FFA Financial Accounting </h1>
        <p> Feb 14 - Aug 15 </p>
        <p> Test Number 1 </p>
    </div>
    <a href="#"> <div class="exit"><div> Exit </div></div> </a>
</div>
<div class="clear"> </div>
<div id="foo" class="toogle" style="display:none;">
	<div class="toogle-left">
    	<p> &nbsp; </p>
    </div>
    <div class="toogle-right">
    	<div class="prog-info">
        	<div class="prog-info-1"> Complete </div>
            <div class="prog-info-2"> Incomplete </div>
            <div class="prog-info-3"> Flagged </div>
        </div>
        <div class="clear"> </div>
        <div class="prog-bullet">
        	<div id="info-bullet"> <div> 1 </div> </div>
            <div id="info-bullet"> <div> 2 </div> </div>
            <div id="info-bullet"> <div> 3 </div> </div>
            <div id="info-bullet"> <div> 4 </div> </div>
            <div id="info-bullet"> <div> 5 </div> </div>
            <div id="info-bullet"> <div> 6 </div> </div>
            <div id="info-bullet"> <div> 7 </div> </div>
            <div id="info-bullet"> <div> 8 </div> </div>
            <div id="info-bullet"> <div> 9 </div> </div>
            <div id="info-bullet"> <div> 10 </div> </div>
            <div id="info-bullet"> <div> 11 </div> </div>
            <div id="info-bullet"> <div> 12 </div> </div>
            <div id="info-bullet"> <div> 13 </div> </div>
            <div id="info-bullet"> <div> 14 </div> </div>
            <div id="info-bullet"> <div> 15 </div> </div>
            <div id="info-bullet"> <div> 16 </div> </div>
            <div id="info-bullet"> <div> 17 </div> </div>
            <div id="info-bullet"> <div> 18 </div> </div>
            <div id="info-bullet"> <div> 19 </div> </div>
            <div id="info-bullet"> <div> 20 </div> </div>
            <div id="info-bullet-clear"> <div> 21 </div> </div>
            <div id="info-bullet-black"> <div> 22 </div> </div>
            <div id="info-bullet"> <div> 23 </div> </div>
            <div id="info-bullet"> <div> 24 </div> </div>
            <div id="info-bullet"> <div> 25 </div> </div>
            <div id="info-bullet"> <div> 26 </div> </div>
            <div id="info-bullet"> <div> 27 </div> </div>
            <div id="info-bullet"> <div> 28 </div> </div>
            <div id="info-bullet"> <div> 29 </div> </div>
            <div id="info-bullet-clear"> <div> 30 </div> </div>
            <div id="info-bullet-clear"> <div> 31 </div> </div>
            <div id="info-bullet-clear"> <div> 32 </div> </div>
            <div id="info-bullet-clear"> <div> 33 </div> </div>
            <div id="info-bullet-clear"> <div> 34 </div> </div>
            <div id="info-bullet-clear"> <div> 35 </div> </div>
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
		<a href="#"> <div class="help"> <div> Help </div> </div> </a>
        <input type="hidden" name="page" id="idpage" value="<?php echo $page;?>">
		<?php if($pageNext < $TotalQuestion){ ?>
			<a href="<?php echo BASE_URL;?>/Entrytest/Start/<?php echo $pageNext; ?>" class="next_question" id="btnNext"> <div class="next"> <div> Next </div> </div> </a>
		<?php } else { ?>
			<a href="#" class="next_question" id="btnFinish"> <div class="next"> <div> Finish </div> </div> </a>
		<?php } ?>
		
        <a href="#"> <div class="flag"> <div> Flag </div> </div> </a> 
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
			alert('OK');
		});
	});
</script>
</body>
</html>
