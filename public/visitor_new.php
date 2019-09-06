<!DOCTYPE html>
<html lang="en">
<head>
    <link href="vis.css" rel="stylesheet" media="all">
</head>

<body>
  <?php include 'banner.php'?>
  <div class="container">
  <div class="content">
   <div class="test"></div>
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
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php include 'resource.php' ?>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
