<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div id="attd_container">
<h1>Welcome!</h1>
<form id = "attdForm">
    <ul id = "members">
    <!-- <input type="checkbox"  name="4" id="4" data-toggle="toggle" data-onstyle="default"  data-width="500%" > -->
    <!-- <label for="4">fasdfdsa</label> -->
    </ul>
    <input class="cbtn" class="btn_bt_right" type ='submit' >
</form>
</div>


<script>
    // function update_attd(){
    //     console.log(this.id);

    //     var data = {};
    //     data.id = this.id;
    //     data.value = $(this).is(':checked') ? 1 : 0;
    //     // console.log($(this).attr('id'));

    //     console.log(data);

    //     $.ajax({
    //         type: "POST",
    //         url: "/apiTest/public/api/participants/teams/attendence",
    //         data: data,
    //     }).done(function(data) {
    //             console.log(data);
    //     });

    // }

function pageLoad()
{
  $(document).ready(function(){

    $('input[type="checkbox"]').on('click', function(){
    console.log("CHECK");
var data = {};
data.id = $(this).attr('id');
data.value = $(this).is(':checked') ? 1 : 0;

console.log(data);

$.ajax({
    type: "POST",
    url: "../public/api/participants/teams/attendence",
    data: data,
}).done(function(data) {
        console.log(data);
});
});

  });
}

</script>

<!-- <script>
const aform = document.getElementById('attdForm');
aform.addEventListener('submit',function(e){
    e.preventDefault();
    console.log(aform);


    var cb_ids = [];


    const formData = new FormData(this);
    console.log(formData);

    fetch('/apiTest/public/api/participants/teams/attendence',{
        method:'put',
        body:formData
    }).then(function(response){
        return response.json();
    }).then(function(json){
        console.log(json);
    }).catch(function (error){
        console.log(error);
    })
});
</script> -->
