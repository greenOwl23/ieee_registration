<!DOCTYPE html>
<html lang="en">
<?php include 'header.php' ?>
<style media="screen">
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

body{
  background-image: url("background4.png");
  background-color: #cccccc;
  height: 600px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
.container{
  margin: auto;
  margin-top:30px;
  right: 0;
  bottom: 0;
  left: 0;
  width: 40%;
  background-color: #FFFFFF;
  padding:70px;
  height:40%;
  border-radius: 5px;
}
.autocomplete{
  margin: auto;
  right: 0;
  bottom: 0;
  left: 0;
  width: 60%;
}
</style>
<body>
    <?php include 'banner.php'?>
    <br>
    <br>
    <div class="container">
      <form id="searchForm" autocomplete="off">
        <div class="autocomplete" style="width:300px;">
          <input id="team_name" type="text" name="team_name" placeholder="Enter your name">
        </div>
        <input class="cbtn" type="submit" value="Search">
      </form>
    </div>

</body>
</html>
