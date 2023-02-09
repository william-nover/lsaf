<!DOCTYPE>
<html>
<head>
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
                        <li><a href="#view1">Progress Test</a></li>
                        <li><a href="#view2">Mock Exam   </a></li>
                        <li><a href="#view3">Weekly Independent Assignment</a></li>
                        </ul>
                    <div class="panel-container">
                        <div id="view1">
                        	<div class="das-table">
                                <h2>TEST REPORT</h2>
                                <table class="gridtable">
                                    <tr>
                                        <th style="text-align:left;">Section</th><th>Test 01</th><th>Test 02</th><th>Test 03</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">A (MCQ)</td><td>99</td><td>99</td><td>99</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">B (MTQ)</td><td>99</td><td>99</td><td>99</td>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td style="text-align:left;">TOTAL</td><td>99</td><td>99</td><td>99</td>
                                    </tr>
                                 </table>
                            </div>
                            <div class="das-note">
                            	  <h3> notes* </h3>
                                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. <br>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.

                            </p>
                            </div>
                        </div>
                        <div id="view2">
                            <div class="das-table">
                                <h2>MOCK EXAM</h2>
                                <table class="gridtable">
                                    <tr>
                                        <th style="text-align:left;">Section</th><th>Test 01</th><th>Test 02</th><th>Test 03</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">A (MCQ)</td><td>99</td><td>99</td><td>99</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">B (MTQ)</td><td>99</td><td>99</td><td>99</td>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td style="text-align:left;">TOTAL</td><td>99</td><td>99</td><td>99</td>
                                    </tr>
                                 </table>
                            </div>
                            <div class="das-note">
                            	  <h3> notes* </h3>
                                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. <br>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.

</p>
                            </div>
                        </div>
                        <div id="view3">
                            <div class="das-table">
                                <h2>WEEKLY INDEPENDENT ASSIGNMENT</h2>
                                <table class="gridtable">
                                    <tr>
                                        <th style="text-align:left;">Section</th><th>Test 01</th><th>Test 02</th><th>Test 03</th>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">A (MCQ)</td><td>99</td><td>99</td><td>99</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left;">B (MTQ)</td><td>99</td><td>99</td><td>99</td>
                                    </tr>
                                    <tr style="font-weight:bold;">
                                        <td style="text-align:left;">TOTAL</td><td>99</td><td>99</td><td>99</td>
                                    </tr>
                                 </table>
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
