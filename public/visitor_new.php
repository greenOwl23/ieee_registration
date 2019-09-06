<!DOCTYPE html>
<html lang="en">
<head>
    <link href="vis.css" rel="stylesheet" media="all">
</head>

<body>
  <?php include 'banner.php'?>
  <div class="reg">
    <br>
    <div class="form-style-10">
  <h1>Welcome to IEEE YESIST12!<span></span></h1>
  <form id="addForm">
    <!-- <div class="section"><span>1</span>Name</div> -->
    <div class="inner-wrap">
        <label>First Name<input type="text" id="first_name" placeholder="Enter First Name" name="first_name" required /></label>
        <label>Middle Name<input type="text" id="middle_name" placeholder="Enter Middle Name" name="middle_name" /></label>
        <label>Last Name<input type="text" id="last_name" placeholder="Enter Last Name" name="last_name" required /></label>
        <label>Email Address <input type="email" id="email" placeholder="Enter Email" name="email" required /></label>
        <label>Phone Number <input type="text" id="phone_number" placeholder="Enter Phone Number" name="phone_number" required /></label>
    </div>
    <br>
    <div class="button-section">
     &nbsp;&nbsp;<input type="submit" name="Sign Up" value="Add"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button onClick="refreshPage()" id="cancel">Cancel</button>
     </body>
     <span class="privacy-policy">
     </span>
    </div>
  </form>
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
            bootbox.alert({
              message: "This alert can be dismissed by clicking on the background!",
              backdrop: true
            });
            document.getElementById("addForm").reset();
              console.log(json);
          }).catch(function (error){
              console.log(error);

          })
      });

function refreshPage(){
    window.location.reload();
}
</script>
  </script>
<?php include 'resource.php' ?>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
