<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;
  background-image: url("background4.png");
  background-color: #cccccc;
  height: 600px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9;
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important;
  color: #ffffff;

}
.check_in{
  margin: auto;
  margin-top:30px;
  right: 0;
  bottom: 0;
  left: 0;
  width: 40%;
  /* border-radius: 3px; */
  /* border: 2px solid black; */
  background-color: #FFFFFF;
  padding:70px;
  height:100%;
  border-radius: 5px;
}
#name_container{
  text-align: left;
  margin-top: 30px;
  margin-left: 25px;
  margin-bottom: -25px;
  color: #1CB105;
}

  input[type="submit"]{
	background: #2A88AD;
	padding: 8px 20px 8px 20px;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	color: #fff;
	text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
	font: normal 30px 'Bitter', serif;
	-moz-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	-webkit-box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	box-shadow: inset 0px 2px 2px 0px rgba(255, 255, 255, 0.17);
	border: 1px solid #257C9E;
	font-size: 15px;
}
</style>
<div class="check_in">
  <form id="searchForm" autocomplete="off">
    <div class="autocomplete" style="width:300px;">
      <input id="team_name" type="text" name="team_name" placeholder="Team Name">
    </div>
    <input class="cbtn" type="submit" value="Search">
  </form>
  <div id="name_container">
      <div><span id="first_name"></span> <span id="last_name"></span></div>
  </div>
  <form id="verifyForm" autocomplete="off">

    <div class="autocomplete" style="width:300px;">
      <input id="passport" type="text" name="passport" placeholder="Team Leader Passport">
    </div>
    <input class = "cbtn" onclick='pageLoad(); clearList()' type="submit" value="Verify">
    <div>
      <span id="isFail">This passport number is incorrect.</span>
    </div>

  </form>

</div>
<!--Make sure the form has the autocomplete function switched off:-->



<script>


///CODE
const tform = document.getElementById('searchForm');
    tform.addEventListener('submit',function(e){
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/apiTest/public/api/participants/teams',{
            method:'post',
            body:formData
        }).then(function(response){
            return response.json();
        }).then(function(json){
            console.log(json);
            document.getElementById('first_name').innerHTML = json[0].First_name;
            document.getElementById('last_name').innerHTML = json[0].Last_Name;

        }).catch(function (error){
            console.log(error);

        })
    });
const vform = document.getElementById('verifyForm');
vform.addEventListener('submit',function(e){
    e.preventDefault();
    var tname = document.getElementById('team_name').value;
    const formData = new FormData(this);
    formData.append("team_name",tname);
    fetch('/apiTest/public/api/participants/teams/verify',{
        method:'post',
        body:formData
    }).then(function(response){
        return response.json();
    }).then(function(json){
        json.forEach(addMember);
        console.log(json);
    }).catch(function (error){
        console.log(error);

    })
});

///FUNCTION
function clearList(){
    document.getElementById('members').innerHTML ="";
    document.getElementById('attd_container').style.display="block";
}

function addMember(item,index){
  console.log(item);

  var id = item.Id;
  var Is_show = item.is_show;
  var first_name = item.First_name;
  var middle_name = item.Middle_Name;
  var last_name =item.Last_Name;
  console.log(Is_show);

  if(Is_show=="1"){
    document.getElementById("isFail").style.display='none';
    document.getElementById("members").innerHTML += "<input checked type ='checkbox' name='"+id+"' id='"+id+"' data-toggle='toggle' data-onstyle='default'><label class='form-check-label' for='materialChecked2'>"+first_name +" " + last_name+"</label><br>" ;
    // <input type="checkbox" name="4" id="4" data-toggle="toggle" data-onstyle="default"  data-width="500%" >

  }else if(Is_show=="0"){
    document.getElementById("isFail").style.display='none'
    document.getElementById("members").innerHTML +=  "<input unchecked type ='checkbox' name='"+id+"' id='"+id+"' data-toggle='toggle' data-onstyle='default'><label class='form-check-label' for='materialChecked2'>"+first_name +" " + last_name+"</label><br>" ;
  }else{
    document.getElementById("isFail").style.display='block';
    document.getElementById("attd_container").style.display='none';
  }
  pageLoad();

  // document.getElementById("members").innerHTML += index + ":" + item.First_name +" "+item.Last_Name+ "<br>";
}
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
// fetch('http://localhost/apiTest/public/api/participants/teams')
//     .then(response => response.json())
//     .then(data => {
//         console.log(data);

//         // Do what you want with your data
//     })
//     .catch(err => {
//         console.error('An error ocurred', err);
//     });

// async function getTeams(){
//     let response = await fetch('http://localhost/apiTest/public/api/participants/teams');
//     let data = await response.json();
//     return data;
// }

// function getTeams(){
//  fetch(`http://localhost/apiTest/public/api/participants/teams`)
//   .then(function(response) {
//     return response.json();
//   })
//   .then(function(json) {
//     console.log(json);
//   });
// };


// $.ajax({
//   dataType: "json",
//   url: http://localhost/apiTest/public/api/participants/teams,
//   data: data,
//   success: success
// });

// const tempt = getTeams().then(data =>console.log(data));
var teams = [];
const api_url = "/apiTest/public/api/participants/teams";
async function getTeam(){
    const response = await fetch(api_url);
    const data = await response.json();
    for(var i = 0;i<data.length;i++){
    teams.push(data[i].Team_name);
    };
    console.log(teams);
    autocomplete(document.getElementById("team_name"), teams);

}
var tempt =  getTeam();
</script>
