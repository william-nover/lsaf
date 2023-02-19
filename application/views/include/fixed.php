<div class="right-fixed">
   <div class="acca-logo"></div>
   <?php if (!$email){ ?> 
   <a href="<?php echo BASE_URL;?>/ApplyOnline">
      <div class="apply"><span>APPLY ONLINE</span></div>
   </a>
   <a href="<?php echo BASE_URL;?>/Location">
      <div class="inquiry"><span>SUBMIT INQUIRY</span></div>
   </a>
   <!-- <button id="myBtn">Open Modal</button> -->
   <a href="#" id="myBtn">
      <div class="brochure"><span>BROCHURE</span></div>
   </a>
   <?php }   else {?>    
   <a href="<?php echo BASE_URL;?>/Location">
      <div class="inquiry"><span>SUBMIT INQUIRY</span></div>
   </a>
   <?php  }?>
 
</div>
<div class="right-wa">
    <ul class="ul_wa list-style-none">
        <li> 
            <a href="https://api.whatsapp.com/send?phone=+628111047338&text=Hi%20LSAF,%20I%20want%20to%20ask%20you%20something."  target="_blank" title="whatsapp">
                <img whatsapp wa-1 src="<?= IMAGES_BASE_URL;?>/wa1.png" alt="628111047338">
            </a> 
        </li>    
        <li> 
            <a href="https://api.whatsapp.com/send?phone=+6287785477338&text=Hi LSAF, I want to ask you something."  target="_blank" title="whatsapp">
                <img whatsapp wa-2 src="<?= IMAGES_BASE_URL;?>/wa2.png" alt="6287785477338">
            </a>
            </li>   
     
     </ul>
</div>


<?php 
  // get edu Level Lists
  $eduLevelLists = PATH_ASSETS."/json/eduLevels.json";
  $arrEduLevel = json_decode(file_get_contents($eduLevelLists),TRUE);

  // get Campus Lists
  $campusLists = PATH_ASSETS."/json/campusLists.json";
  $arrCampusLists = json_decode(file_get_contents($campusLists),TRUE);

  $eduAll = $arrEduLevel;
  $campusAll = $arrCampusLists;
?>

<!-- Modal HTML -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <form id="brochureInputForm">
      <div class="row1">
        <div class="gender-group">
          <label class="gender-label">Mr / Mrs / Ms *</label>
          <input type="text" id="gender_input" name="gender_label" value="" required>
        </div>
        <div class="first-name-group">
          <label class="first-name-label">First Name *</label>
          <input type="text" class="form-control" id="first_name_input" name="first_name" value="" required>
        </div>
        <div class="last-name-group">
          <label class="last-name-label">Last Name *</label>
          <input type="text" class="form-control" id="last_name_input" name="last_name" value="" required>
        </div>
     </div> 
      <div class="row2">
        <div class="email-group">
          <label class="email-label">Email *</label>
          <input type="text" class="form-control" id="email_input" name="email" value="">
        </div>
        <div class="edu-group">
          <label class="edu-label">Level of Education</label>
          <select name="edu" id="edu" class="form-control my-select" required style="width:100%" required>
          <?php foreach($eduAll as $eduLevel){ ?>
            <option value="<?php echo $eduLevel['edu_level_name'];?>"><?php echo $eduLevel['edu_level_name'];?></option>
            <?php } ?>
          </select>
        </div>
        <div class="campus-group">
          <label class="campus-label">Select a SIS campus near you</label>
          <select name="campus" id="campus" class="form-control my-select" required style="width:100%" required>
          <?php foreach($arrCampusLists as $campusList){ ?>
            <option value="<?php echo $campusList['campus_name'];?>"><?php echo $campusList['campus_name'];?></option>
            <?php } ?>
          </select>
        </div>
    </div>
        <div class="row3">
            <button id="btnSubmit" onclick="submitForm()">DOWNLOAD</button>
      </div>
    </form>
  </div>
</div>



<script>
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // When the user clicks the button, open the modal
  btn.onclick = function() {
    modal.style.display = "block";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  $(".modal").click(function(e) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
    });

    $("#dropdown").click(function() {
  $("#options").toggle();
});

$("#options li").click(function() {
  $("#dropdown").val($(this).text());
  $("#options").hide();
  $("#btnSubmit").click(function() {
  // Submit the form or perform any other action you need here
});
});
  var genderInput = document.getElementById('gender_input');
  var firstNameInput = document.getElementById('first_name_input');
  var lastNameInput = document.getElementById('last_name_input');
  var emailInput = document.getElementById('email_input');
      function submitForm() {
        var inputValEmpty = "";
        
        if (genderInput.value == ''){
          inputValEmpty = inputValEmpty + "Gender"
          if(inputValEmpty.length > 0){
            inputValEmpty = inputValEmpty + ", "
          }
        }
        if (firstNameInput.value == ''){
          inputValEmpty = inputValEmpty + "Firts Name"
          if(inputValEmpty.length > 0){
            inputValEmpty = inputValEmpty + ", "
          }
        }
        if (lastNameInput.value == ''){
          inputValEmpty = inputValEmpty + "Last Name"
          if(inputValEmpty.length > 0){
            inputValEmpty = inputValEmpty + ", "
          }
        }
        if (emailInput.value == ''){
          inputValEmpty = inputValEmpty + "Email"
          if(inputValEmpty.length > 0){
            inputValEmpty = inputValEmpty + ", "
          }
        }
        if(inputValEmpty.length > 0){
            inputValEmpty = inputValEmpty.slice(0, -2);
        }
        if (inputValEmpty.length > 0) {
          // If any are empty, prevent the form submission and show an error message
          event.preventDefault();
          alert('Please enter a value for ' + inputValEmpty + ".");
        } else if (!validateEmail(emailInput.value)) {
          // If the email field is not a valid email address, prevent the form submission and show an error message
          event.preventDefault();
          alert('Please enter a valid email address.');
        } else {
          window.open('<?php echo PDF_BASE_URL;?>LSAF.pdf', '_blank').focus();
                $.ajax({
                    url: '<?php echo BASE_URL;?>/Fixed/saveDataPerson',
                    type: 'post',
                    data: $('#brochureInputForm').serialize(),
                    success: function() {
                        alert('Data added successfully!');
                        location.reload();
                    }
                });
         } 
        }
        function validateEmail(email) {
          var re = /\S+@\S+\.\S+/;
          return re.test(email);
        }
</script>



<style>
    .ul_wa {
    line-height: 28px;
    height: 100px;
    max-width: 8%;
    min-width: 100px;
    padding: 0px;
    position: fixed;
    right: 2%;
    text-align: center;
    bottom: 25%;
    z-index: 1;
}
.ul_wa > li {
    display: inline-grid;
}
.ul_wa > li a img {
    max-width: 100%;
    height: auto;
}

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 300; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0, 0, 0); /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
  }

  /* Modal Content/Box */
  .modal-content {
    background-color: #fefefe; /*modal color */
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
    height: 250px; /* Could be more or less, depending on screen size */
  }

  /* The Close Button */
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

.gender-group {
    text-align: center;
    width: 24%;
    margin-right: 3%;
}
.gender-label {
  display: inline-block;
  width: 100%;
  text-align: center;
  margin-bottom: 10px;
  margin-left: 30px;
}
.first-name-group {
    text-align: center;
    width: 33%;
    margin-right: 3%;
}
.first-name-label {
  display: inline-block;
  width: 100%;
  text-align: center;
  margin-bottom: 10px;
  margin-left: 20px;
}
.last-name-group {
    text-align: center;
    width: 33%;
}
.last-name-label {
  display: inline-block;
  width: 100%;
  text-align: center;
  margin-bottom: 10px;
  margin-left: 20px;
}
input[type="text"] {
  width: 100%;
}

.edu-group {
    text-align: center;
    width: 27%;
}
.edu-group #edu {
    width: 100%;
    height: 49px;
    margin-left: 22px;
}

.edu-label {
  display: inline-block;
  width: 100%;
  text-align: center;
  margin-bottom: 5px;
  margin-left: 15px;
}
.email-group {
    text-align: center;
    width: 33%;
    margin-right: 3%;
}
.email-label {
  display: inline-block;
  width: 100%;
  text-align: center;
  margin-bottom: 10px;
  margin-left: 20px;
}
.campus-group {
    text-align: center;
    width: 33%;
}
.campus-group #campus {
    width: 100%;
    height: 49px;
    margin-left: 37px;
}
.campus-label {
  display: inline-block;
  width: 100%;
  text-align: center;
  margin-bottom: 5px;
  margin-left: 15px;
}

.row1 {
  display: flex;
  flex-direction: row;
}

.row2 {
  display: flex;
  flex-direction: row;
}
.row3 {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-top: 20px;
}

#options {
  list-style: none;
  margin: 0;
  padding: 0;
  position: absolute;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 4px;
  width: 200px;
  z-index: 1;
}

#options li {
  padding: 10px;
  cursor: pointer;
}

#options li:hover {
  background-color: #eee;
}

button#btnSubmit {
  padding: 5px 10px;
  background-color: #ddd;
  border: 1px solid #ccc;
  width: 300px;
  height: 45px;
  text-align: center;
  cursor: pointer;
}
.my-select {
  -webkit-appearance: none; /* Remove default styling for Safari */
  -moz-appearance: none; /* Remove default styling for Firefox */
  appearance: none; /* Remove default styling for other browsers */
  border: none;
  background-color: #F0F0F0;
  padding: 0;
  margin: 0;
  font-size: 16px;
  font-family: inherit;
  width: 100%;
}

.my-select:focus {
  outline: none;
}

/* Add a border and border-radius to mimic an input element */
.my-select {
  border: 1px solid #dedede;
}

/* Add padding to mimic an input element */
.my-select {
  padding: 8px;
}

/* Add a box-shadow to mimic a focused input element */
.my-select:focus {
  box-shadow: 0 0 4px #4a90e2;
}
  @media only screen and (max-width:800px) {
      .row1 {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
        margin-left: -40px;
      }
      .row2 {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
        margin-left: -40px;
      }
      .row3 {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
      }
      .modal-content {
        background-color: #fefefe; /*modal color */
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 50%; /* Could be more or less, depending on screen size */
        height: 650px; /* Could be more or less, depending on screen size */
      }
      @media only screen and (max-width:300px) {
          .modal-content {
            background-color: #fefefe; /*modal color */
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 50%; /* Could be more or less, depending on screen size */
            height: 670px; /* Could be more or less, depending on screen size */
          }
      }
      .gender-group {
          text-align: center;
          width: 50%;
      }
      .gender-label {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin-left: 35px;
      }
      .first-name-group {
          text-align: center;
          width: 50%;
      }
      .first-name-label {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin-left: 32px;
      }
      .last-name-group {
          text-align: center;
          width: 50%;
      }
      .last-name-label {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin-left: 32px;
      }
      input[type="text"] {
        width: 100%;
      }

      .edu-group {
          text-align: center;
          width: 55%;
      }
      .edu-group #edu {
          width: 100%;
          height: 49px;
      }

      .edu-label {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin-left: 28px;
      }
      .email-group {
          text-align: center;
          width: 50%;
      }
      .email-label {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin-left: 32px;
      }
      .campus-group {
          text-align: center;
          width: 55%;
          margin-top: 20px;
          margin-left: -28px;
      }
      .campus-group #campus {
          width: 100%;
          height: 49px;
      }
      .campus-label {
        display: inline-block;
        width: 100%;
        text-align: center;
        margin-left: 37px;
      }
      button#btnSubmit {
        padding: 5px 10px;
        background-color: #ddd;
        border: 1px solid #ccc;
        width: 100%;
        height: 45px;
        text-align: center;
        cursor: pointer;
      }
  }
}
</style>
