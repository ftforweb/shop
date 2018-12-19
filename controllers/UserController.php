<?php
include_once ROOT."/models/User.php";
class UserController {
    public function actionRegister(){
        $email = '';
        $password = '';
        
        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $result = User::register($email, $password);
            
        }     
        require_once(ROOT. '/views/user/register.php');
        return true;
    }
}
