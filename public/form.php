<!-- <style>
    body{
        background-color:#282222 !important;
    }
</style> -->
<div class="font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Visitor Registration Info</h2>
                    <form method="" id="addForm" autocomplete=false>
                        <div class="input-groupd">
                            <input type="text" id="first_name"  name="first_name" placeholder="First Name"required />
                        </div>
                        <div class="input-groupd">
                            <input type="text" id="middle_name"  name="middle_name" placeholder="Middle Initial" />
                        </div>
                        <div class="input-groupd">
                            <input type="text" id="last_name"  name="last_name" required placeholder="Last Name"/>
                        </div>
                        <div class="input-groupd">
                        <input type="email" id="email"  name="email" required placeholder="Email"/>
                        </div>
                        <div class="input-groupd">
                            <input type="text" id="phone_number"  name="phone_number" placeholder="Phone Number"/>
                        </div>
                        <div class="">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- This templates was made by Colorlib (https://colorlib.com) -->


    <div id="overlay" class="cmodal">
        <div class="cmodal-content">
            <span class="close-button">×</span>
            <h4>Successful!</h4>
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
            toggleModal();
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