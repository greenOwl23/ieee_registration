<!DOCTYPE html>
<html lang="en">
<?php include 'header.php' ?>
<style media="screen">

#addVisit{
background:#158305;
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
font-size: 17px;
position:absolute;
bottom:-90px;
right:60px;
}
</style>
<body>
    <?php include 'banner.php'?>
    <br>
    <br>
    <div id="row">
        <div><?php include 'auto.php'?></div>
        <br>
        <br>
        <div> <?php include 'attd.php'?></div>
    </div>

<a href="visitor_new.php" id="addVisit"><span class="glyphicon glyphicon-plus"></span> Add Visitor</a>
</body>
</html>
