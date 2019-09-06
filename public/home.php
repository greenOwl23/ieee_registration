<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Alpha</title>
</head>
<body>
<?php include 'banner.php' ?>
    <div class="container">
        <div class="content">
            <div class="s01 check_in">
                <form id="verifyForm" autocomplete="off">
                    <div class="inner-form">
                    <div class="input-field first-wrap autocomplete">
                        <input id="team_name" type="text" name="team_name" placeholder="Team Name" />
                    </div>
                    <div class="input-field second-wrap">
                        <input id="tl_passport" name ="passport" type="text" placeholder="Team Leader Passport Number" />
                    </div>
                    <div>
                        <span id="isFail">This passport number is incorrect.</span>
                    </div>
                    <div class="input-field third-wrap">
                        <input id="btn_search" class="btn-search" type="submit" value="Search">
                    </div>
                    </div>
                </form>
            </div>
            <div id="attd_container">
            <div id="attd_containter" class="col-md-12">
                <div class="welcome">
                    <h1>Welcome to YESIST12!</h1>
                    <h2>Please check in your team members</h2>
                </div>
                <form id="attd_form" action="">
                    
                    <div class="funkyradio col-md-6 ">
                        <ui id="members"></ui>
                        <input id="btn_submit" class="btn btn-success" type="submit" value="Done">
                    </div>
                </form> 


            </div>
            </div>
            
        </div>
    </div>
    


<?php include 'resource.php' ?>
<link href="../src/css/checkbox.css" rel="stylesheet" />
<link href="../src/css/search.css" rel="stylesheet" />
<script src="../src/js/search.js"></script>
</body>
</html>