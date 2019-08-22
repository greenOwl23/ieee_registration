
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<script type="text/javascript" src="jquery.js">

</script>
</head>
<body>
<h1>Need to make sure that the json get updated</h1>
<h2>Autocomplete</h2>

<p>Start typing:</p>

<!--Make sure the form has the autocomplete function switched off:-->
<!-- <form autocomplete="off"> -->
  <div class="autocomplete" style="width:300px;">
    <input onclick="selectTeam()" id="myInput" type="text" name="myCountry" placeholder="Team Name">
  </div>
  <button onclick="selectTeam()">Go</button>
<br>
<br>
<!-- </form> -->
<span id="feedback"></span>

<br>
<br>

<!-- <form autocomplete="off" action="second_page.html" method="post"> -->
  <input onchange="checkPassport()" id = "passport" type="text">
  <br>
  <br>
  <div id="members" style="display:none">
  </div>
  <br>
  <br>
  <br>
  <button id ="btn_submit" disabled="True" type="submit" onclick="updateAttn()">Submit</button>

<!-- </form> -->

<script>
var tl_passport;
var tl_name;

var all_is_show =[];
var allFirstNames = [];
var allLastNames = [];
var allIds =[];

function checkPassport(){
  var input = $('#passport').val();
  if(input==tl_passport){
    document.getElementById("members").style.display="block";
    document.getElementById("btn_submit").removeAttribute("disabled");
    console.log("True");
  }

}

// function unhide(div_id){
//   var y = document.getElementById(div_id);
//   if(y.style.display == "none"){
//     y.style.display="block";
//   }
// }

function selectTeam(){
  all_is_show =[];
  allFirstNames = [];
  allLastNames = [];
  allIds =[];
  document.getElementById("members").style.display="none";
  var teamName = $('#myInput').val();
  // $.post('auto.php',{'is_update':'1'});
  console.log(teamName);
  console.log(arr_tname);



  for(var i = 0; i < teamInfo.length;i++){
    if(teamInfo[i].Team_name==teamName && teamInfo[i].is_leader==1){
      tl_name=teamInfo[i].First_name;
      tl_passport = teamInfo[i].Passport_Number;
      console.log(tl_passport);
      document.getElementById("feedback").innerHTML = tl_name;
    }
    if(teamInfo[i].Team_name==teamName){
      allFirstNames.push(teamInfo[i].First_name);
      allLastNames.push(teamInfo[i].Last_Name);
      allIds.push(parseInt(teamInfo[i].Id));
      all_is_show.push(teamInfo[i].is_show);

    }
  }
  console.log(allFirstNames);
  console.log(allLastNames);
  var fullNames = "";
  for(var i =0; i<allLastNames.length;i++){
    if(all_is_show[i]==1){
      fullNames+="<div  class='form-check'><input id='"+allIds[i]+"' type='checkbox' class='form-check-input' onclick='checkAttdn("+allIds[i]+")' checked><label class='form-check-label' for='materialChecked2'>"+allFirstNames[i] +" " + allLastNames[i]+"</label></div>";
    }
    else{
      fullNames+="<div  class='form-check'><input id='"+allIds[i]+"' type='checkbox' class='form-check-input' onclick='checkAttdn("+allIds[i]+")' unchecked><label class='form-check-label' for='materialChecked2'>"+allFirstNames[i] +" " + allLastNames[i]+"</label></div>";
    }

  }
  document.getElementById("members").innerHTML = fullNames;
}

function checkAttdn(id){
  console.log(id);
  var checkbox = document.getElementById(id);
  if(checkbox.checked==true){
    console.log("checked");
    all_is_show[allIds.indexOf(id)]="1";
    console.log(all_is_show);
    // $.post('auto.php',{'is_show_val':'1','id':id});
    //update the datebase on is_show
  }
  else{
    console.log("unchecked");
    all_is_show[allIds.indexOf(id)]="0";
    console.log(all_is_show);
    // $.post('auto.php',{'is_show_val':'0','id':id});
  }
}

function updateAttn(){
  //$.post('auto.php',{attdn_list:all_is_show,attdn_id:allIds});

    //   $.post( "auto.php", function( data ) {
    //   $( ".result" ).html( data );
    // });

        $.post( "server.php", { attdn_list:all_is_show,attdn_id:allIds})
      .done(function( data ) {
        alert( "Data Loaded: " + data );
      });
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
var teamInfo =[];
var oReq = new XMLHttpRequest(); // New request object
oReq.onload = function() {
    // This is where you handle what to do with the response.
    // The actual data is found on this.responseText
    //alert(this.responseText); // Will alert: 42
    //teamInfo = this.responseText;
    var tempt = JSON.parse(this.responseText);
  for(var i=0;i<tempt.length;i++){
    teamInfo.push(tempt[i]);
  }
};
oReq.open("POST", "server.php", false);
//                               ^ Don't block the rest of the execution.
//                                 Don't wait until the request finishes to
//                                 continue.
oReq.send();


console.log("X");
console.log(teamInfo);
console.log(typeof teamInfo);
console.log(teamInfo.length);
console.log("Y");
var arr_tname= (findObjectByKey(teamInfo,'is_leader',1));
// console.log(findObjectByKey(teamInfo,'is_leader',1));



function findObjectByKey(array, key, value) {
  var arr_res = [];
    for (var i = 0; i < array.length; i++) {
        if (array[i][key] == value) {
            arr_res.push(array[i]['Team_name']);
        }
    }
    return arr_res;
}



var teamLeader = [];
var leaderPassport =[];

/*An array containing all the country names in the world:*/


/*initiate the autocomplete function on the "myInput" element, and pass along the arr_tname array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), arr_tname);
</script>

</body>
</html>
