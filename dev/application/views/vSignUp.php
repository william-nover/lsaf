<!DOCTYPE>
<html>
<head>
<?php include "include/style.php"; ?>
</head>

<body>

<?php include_once("analyticstracking.php") ?>
<?php include "include/fixed.php"; ?>


<div class="container">	
   <?php include "include/vheader.php"; ?>

   <div class="sign-up">
    	<div class="sign-up-left">
        	<a href="#"> <img src=" <?php echo IMAGES_BASE_URL; ?>/sign-up-prev.png"> </a>
            <div class="step-line-small"> <div class="line-small"> </div> </div>
            <div class="step-isi-small">
                <div id="step-small">
                    <div id="bullet-small">
                        <div id="bullet-inner-small"> <p> 1 </p></div>
                    </div>
                </div>
                <div id="step-small">
                    <div id="bullet-small-off">
                        <div id="bullet-inner-small-off"> <p> 2 </p></div>
                    </div>
                </div>
                <div id="step-small">
                    <div id="bullet-small-off">
                        <div id="bullet-inner-small-off"> <p> 3 </p></div>
                    </div>
                </div>
                <div id="step-small">
                    <div id="bullet-small-off">
                        <div id="bullet-inner-small-off"> <p> 4 </p></div>
                    </div>
                </div>
                <div id="step-small">
                    <div id="bullet-small-off">
                        <div id="bullet-inner-small-off"> <p> 5 </p></div>
                    </div>
                </div>
             </div>
         </div>
         <div class="sign-up-right">
         	<h1>Step 01 - Sign up </h1>
                 
                  <?php echo form_open(BASE_URL.'/ApplyOnline/SignUp', 'class="register-page" id="myform"'); ?>
                <label>
                    <span> Full Name </span>
                    <input id="full_name" type="text" name="full_name" />
                    <?php echo form_error('full_name'); ?>
                </label>
               <div class="clear"> </div>
               <label>
                   <span> Date of Birth </span>  <?php echo date_dropdown();?>
                </label>   
               <div class="clear"> </div>
              
                <label>
                    <span> Phone Number </span>
                    <input class="date-dis-a" style="width:80px" id="phone1" type="text" name="phone1"/>
                   
                    <input class="date-dis-a" style="margin-left:10px; width:295px" id="phone2" type="text" name="phone2"/>                  
                     <?php echo form_error('phone1'); ?>
                     <?php echo form_error('phone2'); ?>
                </label>
               <div class="clear"> </div>
                <label>
               <span style="padding-top:0px;">
                    	Postal Address
                        <h4> for corespondence LSAF  </h4>
                    </span>
                    <input id="addr1" type="text" name="addr1" />
                    <div class="clear"> </div>
                    <input class="addres-poss" style="margin-left:130px;" id="addr2" type="text" name="addr2" />
                     <?php echo form_error('addr1'); ?>
                </label> 
                <div class="clear"> </div> 
                <label>
                    <span>Postal Code</span>
                    <input class="date-dis-a" style="width:80px" id="postal_code" type="text" name="postal_code"/>
                     <?php echo form_error('postal_code'); ?>
                </label>
                <div class="clear"> </div> 
                <label>
                     <span style="padding-top:0px;">
                    	Email Address
                        <h4> for corespondence LSAF  </h4>
                    </span>                  
                    <input id="email" type="text" name="email" />
                    <p><?php if (!empty($emailExist)) {echo $emailExist;} ?></p>
                    <?php echo form_error('email'); ?>
                </label>
                <div class="clear"> </div> 
                <label>
                    <span>Nationality </span>
                     <select id="country_id" class="" name="country_id">
                        <?php foreach ($Nationality as $nat) { ?>
                         <option value="<?php echo $nat-> country_id;?>"><?php echo $nat->country_name ;?></option>       
                        <?php } ?>                    
                    </select>
                </label>
                <div class="clear"> </div> 
                <label>
                    <input type="submit" class="button" value="Sign Up" />
                </label> 
                <p> By Clicking Sign Up, You Agree to our Terms and that you have read and understand our data use policy including our cookies use.</p>
             <?php echo form_close(); ?>
       
         </div>
         
    </div>
    <div class="clear"> </div>
   <?php include "include/vfooter.php"; ?>
     
</div>


</body>
</html>
