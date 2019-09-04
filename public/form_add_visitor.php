
<div class="container_visits">
  <h2>Add New Visitor</h2>
  <form id="addForm">
    <div class="form-group row">
      <label for="first_name" class="col-sm-2 col-form-label">First Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control " id="first_name" placeholder="Enter First Name" name="first_name" required>
      </div>
    </div>
    <div class="form-group row ">
      <label for="middle_name" class="col-sm-2 col-form-label">Middle Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="middle_name" placeholder="Enter Middle Name" name="middle_name" >
      </div>
    </div>
    <div class="form-group row ">
      <label for="last_name" class="col-sm-2 col-form-label">Last Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" required>
      </div>
      </div>
    <div class="form-group row ">
      <label for="email" class="col-sm-2 col-form-label">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
      </div>
      </div>
    <div class="form-group row">
      <label for="phone_number" class="col-sm-2 col-form-label">Phone Number:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="phone_number" placeholder="Enter Phone Number" name="phone_number" required>
      </div>
      </div>
      <div class="form-group row">
      <label for="submit" class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10">
      <input class="cbtn" type="submit" class="btn btn-default " value="Add">
      <span>"dsfasdf "</span>
      </div>
      </div>

  </form>
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
</script>
