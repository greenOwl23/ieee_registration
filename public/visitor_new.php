<!DOCTYPE html>
<html lang="en">
<head>
    <link href="vis.css" rel="stylesheet" media="all">
</head>

<body>
  <?php include 'banner.php'?>
  <div class="container">
  <div class="content">
  <br>
    <div class="form-style-10 ">
  <h1>Welcome to IEEE YESIST12!<span></span></h1>

  <div class="form_container col-md-6">
  <form id="addForm" autocomplete=false>
    <!-- <div class="section"><span>1</span>Name</div> -->
    <div class="">
        <label>First Name<input type="text" id="first_name"  name="first_name" required /></label>
        <label>Middle Name<input type="text" id="middle_name"  name="middle_name" /></label>
        <label>Last Name<input type="text" id="last_name"  name="last_name" required /></label>
        <label>Email Address <input type="email" id="email"  name="email" required /></label>
        <label>Phone Number <input type="text" id="phone_number"  name="phone_number" required /></label>
    </div>
    <br>
    <div class="button-section"><input type="submit" name="Sign Up" value="Add"/>
    <button onClick="refreshPage()" id="cancel">Cancel</button>
    </div>
  </form>
  </div>
  
</div>

   </div>
  </div>
  </div>
  

  <script>
      const tform = document.getElementById('addForm');
      tform.addEventListener('submit',function(e){
          e.preventDefault();
          const formData = new FormData(this);
          fetch('../public/api/participants/visitor',{
              method:'post',
              body:formData
          }).then(function(response){
              return response.json();
          }).then(function(json){
            
            document.getElementById("addForm").reset();
            // bootbox.alert({
            //   message: "This alert can be dismissed by clicking on the background!",
            //   backdrop: true
            // });
              // alert('Welcome and ');
              console.log(json);
          }).catch(function (error){
              console.log(error);

          })
      });

function refreshPage(){
    window.location.reload();
}
</script>




<?php include 'resource.php' ?>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
<!-- end document-->
