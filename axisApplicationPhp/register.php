<?php
include_once("table_config.php");
$postdata = file_get_contents("php://input");
$crud = new Crud();
if(isset($postdata) && !empty($postdata))
{
    $request = json_decode($postdata);
    $name = isset($request->name) ? trim($request->name) : '';
    $mobile = isset($request->mobile) ? trim($request->mobile) : '';
    $email = isset($request->email) ? trim(strtolower($request->email)) : '';
    $company = isset($request->company) ? trim($request->company) : '';
    $designation = isset($request->designation) ? trim($request->designation) : '';
    if(!empty($email) && !empty($name) && !empty($mobile) && !empty($company) && !empty($designation)){

        //Check email exist in database
        $sql = "SELECT * FROM $users_table where email='$email'";
        $result = $crud->rows($sql);
        $rows = array();
        if (count($result) > 0) {    
            $rows[] = $result[0];
            $rows['msg'] = 'Entered email is already registered with us. Please login.';
            echo json_encode($rows);
        }else
        {
            //Insert new user record
            $user = array();
            $user['name'] = $name;
            $user['mobile'] = $mobile;
            $user['email'] = $email;
            $user['company'] = $company;
            $user['designation'] = $designation;
            $user['regon'] = $crud->current_datetime();
            $userId = $crud->insert($users_table, $user);
            if ($userId>0) {
                http_response_code(201);
                $authdata = [
                    'name' => $name,
                    'mobile' => $mobile,
                    'email' => $email,
                    'company' => $company,
                    'designation' => $designation,
                    'Id' => $userId
                    ];
                 $authdata['msg'] = '';
                    echo json_encode($authdata);
            } else {
                http_response_code(422);
            }
        }
        
    }    
}

?>