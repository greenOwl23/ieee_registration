const tform = document.getElementById('team_name');
    tform.addEventListener('mouseover',function(e){
        e.preventDefault();
        const input = document.getElementById('team_name').value;
        const form_Data = new FormData();
        form_Data.append("team_name",input);
        console.log(form_Data);
    
        fetch('../public/api/participants/teams',{
            method:'post',
            body:form_Data
        }).then(function(response){
            return response.json();
        }).then(function(json){
            console.log(json);
            document.getElementById("tl_passport").placeholder = json[0].First_name +" "+ json[0].Last_Name +"' Passport Number";

        }).catch(function (error){
            console.log(error);

        })
    });
    const tform2 = document.getElementById('tl_passport');
    tform2.addEventListener('mouseover',function(e){
        e.preventDefault();
        const input = document.getElementById('team_name').value;
        const form_Data = new FormData();
        form_Data.append("team_name",input);
        fetch('../public/api/participants/teams',{
            method:'post',
            body:form_Data
        }).then(function(response){
            return response.json();
        }).then(function(json){
            console.log(json);
            document.getElementById("tl_passport").placeholder = json[0].First_name +" "+ json[0].Last_Name +"' Passport Number";
        }).catch(function (error){
            console.log(error);

        })
    });
const vform = document.getElementById('verifyForm');
vform.addEventListener('submit',function(e){
    clearList();
    e.preventDefault();
    console.log('sub');
    
    // var tname = document.getElementById('team_name').value;
    const formData = new FormData(this);
    // formData.append("team_name",tname);
    fetch('../public/api/participants/teams/verify',{
        method:'post',
        body:formData
    }).then(function(response){
        return response.json();
    }).then(function(mList){
        console.log('CRAJDFLKSDs');
        
        console.log(mList);
        if(mList !==null){
          for(member of mList){
            addMember(member);
          };
        }else if(mList==null){
          document.getElementById("btn_search").value='Unknown';
          document.getElementById("btn_search").style.background='orange';
        }
        
        // mList.forEach(addMember);
        // console.log(mList);
    }).catch(function (error){
        console.log(error);

    })
});
const attd_form = document.getElementById('attd_form');
attd_form.addEventListener('submit',function(e){
    e.preventDefault();
    clearAll();
});
///FUNCTION
function clearList(){
    document.getElementById('members').innerHTML ="";
    document.getElementById('attd_container').style.display="none";
}
function clearAll(){
    clearList();
    document.getElementById('team_name').value="";
    document.getElementById('tl_passport').value="";
    document.getElementById('tl_passport').placeholder="Team Leader Passport Number";
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
    // document.getElementById("isFail").style.display='none';
    document.getElementById("btn_search").value='Search';
    document.getElementById("btn_search").style.background='#0095DC';
    document.getElementById('attd_container').style.display="block";
    document.getElementById("members").innerHTML += "<div class='funkyradio-success'><input type='checkbox' name='"+id+"' id='"+id+"' checked/><label for='"+id+"'>"+first_name +" " + last_name+"</label></div>" ;
    // <input type="checkbox" name="4" id="4" data-toggle="toggle" data-onstyle="default"  data-width="500%" >

  }else if(Is_show=="0"){
    // document.getElementById("isFail").style.display='none';
    document.getElementById("btn_search").value='Search';
    document.getElementById("btn_search").style.background='#0095DC';
    document.getElementById('attd_container').style.display="block";
    document.getElementById("members").innerHTML += "<div class='funkyradio-success'><input type='checkbox' name='"+id+"' id='"+id+"'/><label for='"+id+"'>"+first_name +" " + last_name+"</label></div>" ;
  }else{
    // document.getElementById("isFail").style.display='block';
    document.getElementById("btn_search").value='Incorrect';
    document.getElementById("btn_search").style.background='red';
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
var teams = [];
const api_url = "../public/api/participants/teams";
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

var teams_isShowed= [];
const api_url_isShowed = "../public/api/participants/teams/isShowed";
async function getTeam_isShowed(){
    const response = await fetch(api_url_isShowed);
    const data = await response.json();
    for(var i = 0;i<data.length;i++){
    teams_isShowed.push(data[i].Team_name);
    };
    console.log("SHOWOOWSHOSHOSHOHWOHWOS");
    
    console.log(teams_isShowed);
    // autocomplete(document.getElementById("team_name"), teams);

}
var tempt_isShowed =  getTeam_isShowed();
console.log(tempt_isShowed);



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

