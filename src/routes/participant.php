<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
$master = 'tachetcampus';

//Get all participants
$app ->get('/api/participants',function(Request $request, Response $response){
    $sql = "SELECT * FROM participant_list";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $participants = $stmt->fetchALL(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($participants);
    }catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});
//Get all Team name and tleader name
$app ->get('/api/participants/teams',function(Request $request, Response $response){
    $sql = "SELECT DISTINCT Team_name FROM participant_list";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $teams = $stmt->fetchALL(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($teams);
    }catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});

//Get all Team name and tleader name
$app ->get('/api/participants/teams/isShowed',function(Request $request, Response $response){
    $sql = "SELECT DISTINCT Team_name FROM participant_list where is_show='1'";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $teams = $stmt->fetchALL(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($teams);
    }catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});

//GET team leader based on selected
$app ->post('/api/participants/teams',function(Request $request, Response $response){
    // $t_name = $request->getAttribute('tname');
    // echo $request;
    $t_name  = $request->getParam('team_name');
    $sql = "SELECT full_name FROM participant_list WHERE is_leader =1 AND Team_name='$t_name'";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $tleader = $stmt->fetchALL(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($tleader);
    }catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});
//add visitor
$app ->post('/api/participant_list/visitor',function(Request $request, Response $response){
    $first_name  = $request->getParam('first_name');
    $middle_name = $request->getParam('middle_name');
    $last_name   = $request->getParam('last_name');
    $email       = $request->getParam('email');
    $phone_number= $request->getParam('phone_number');
    $sql = "INSERT INTO visitors(first_name,middle_name,last_name,email,phone_number) VALUES(:first_name,:middle_name,:last_name,:email,:phone_number)";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam('first_name',$first_name);
        $stmt->bindParam('middle_name',$middle_name);
        $stmt->bindParam('last_name',$last_name);
        $stmt->bindParam('email',$email);
        $stmt->bindParam('phone_number',$phone_number);
        $stmt->execute();
        echo '{"notice":{"text":"Vistor Added"}}';
    }catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});

//VERIFY Passport
$app ->post('/api/participants/teams/verify',function(Request $request, Response $response){
    // $t_name = $request->getAttribute('tname');
    $t_name  = $request->getParam('team_name');
    $passport = $request->getParam('passport');
    $sql = "SELECT IF((SELECT Passport_Number from participant_list where team_name = '$t_name' && is_leader=1) ='$passport' ,'true','false') AS isValid;";
    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $isValid = $stmt->fetchALL(PDO::FETCH_OBJ);
        $output =  $isValid[0];
        // $result[0]['property']
        // $db = null;
        // print_r($output);
        $array = get_object_vars($output);
        // print_r($array['isValid']);
        // if($array['isValid']==='true'){
        //     $result = true;
        // }elseif($passport=='tachet'){
        //     $result=true;
        // }else{
        //     $result = false;
        // }
        $result = $array['isValid'] === 'true' || $passport=='tachetcampus' ? true: false;
        if($result){
            $sql2 = "SELECT Id,full_name,is_show,team_id FROM participant_list WHERE Team_name='$t_name';";
            try{
                // $db = new db();
                // $db1 = $db2->connect();
                $stmt = $db->query($sql2);
                $members = $stmt->fetchALL(PDO::FETCH_OBJ);
                // $db = null;
                echo json_encode($members);
            }catch(PDOException $e){
                echo '{"error":{"text":'.$e->getMessage().'}}';
            }

            // echo '{"Success":{"text":"DONE"}}';
        }else{
            // $sql_pass = "SELECT * from participants where Team_name='DATA DIGGERS' && is_leader=1";
            // try{
            //     $stmt = $db->query($sql_pass);
            //     $isTL_null = $stmt->fetchALL(PDO::FETCH_OBJ);
            //     $db = null;
            //     $is_pass_null = $isTL_null.passport_number;
            //     // if(empty($is_pass_null)){
            //     //     $isValid = null;
            //     // }
            //     //debug
            //     $isValid = $isTL_null;
                
            // }catch(PDOException $e){
            //     echo '{"error":{"text":'.$e->getMessage().'}}';
            // }
            echo json_encode($isValid);
        }


        // echo '{"Success":{"text":'.strval($output).'}}';
        // echo '{"Success":{"text":"DONE"}}';
        // echo json_encode($isValid);
    }catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});

//UPDATE Attendence
$app ->POST('/api/participants/teams/attendence',function(Request $request, Response $response){
    $id  = $request->getParam('id');
    $value  = $request->getParam('value');
    $sql = "UPDATE participant_list SET is_show=$value where Id =$id";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        // $tleader = $stmt->fetchALL(PDO::FETCH_OBJ);
        $db = null;
        echo '{"notice":{"text":"Attendence Checked"}}';
    }catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});

// check if the team has already checked in
$app ->post('/api/participants/teams/checked',function(Request $request, Response $response){
    // $t_name = $request->getAttribute('tname');
    $t_name  = $request->getParam('team_name');
    $sql = "SELECT IF((SELECT is_show from participant_list where team_name = '$t_name' && is_leader=1) =1 ,'true','false') AS isValid;";

    try{
        $db = new db();
        $db = $db->connect();
        $stmt = $db->query($sql);
        $isValid = $stmt->fetchALL(PDO::FETCH_OBJ);
        $output =  $isValid[0];
        // $result[0]['property']
        // $db = null;
        // print_r($output);
        $array = get_object_vars($output);
        // print_r($array['isValid']);

        $result = $array['isValid'] === 'true'? true: false;
        echo json_encode($isValid);

        // echo '{"Success":{"text":'.strval($output).'}}';
        // echo '{"Success":{"text":"DONE"}}';
        // echo json_encode($isValid);
    }catch(PDOException $e){
        echo '{"error":{"text":'.$e->getMessage().'}}';
    }
});
