<?php
include_once("table_config.php");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$crud = new Crud();
if(isset($postdata) && !empty($postdata))
{
 
  // Validate.
  if(trim($request->username) === '' || trim($request->username) === '')
  {
    return http_response_code(400);
  }else{
    $email = trim(strtolower($request->username));
    $sql = "SELECT * FROM $users_table where email='$email'";
    $result = $crud->rows($sql);
    $rows = array();
    if (count($result) > 0) {    
        $rows[] = $result[0];
        //Insert user login table
        $loginUser = array();		
        $loginUser['reg_user_id'] = $result[0]['id'];
        $loginUser['ipaddress'] = $crud->ip_address();
        $loginUser['logon'] = $crud->current_datetime();
        $userId = $crud->insert($users_login_table, $loginUser);
        if($userId > 0){
          echo json_encode($rows);
        }else{
          http_response_code(404);
        }
    }else
    {
        http_response_code(404);
    }
  }

}
?>