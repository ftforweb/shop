<?php
class User {
    public static function register($email, $password){
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO user (email, password) '
                .'VALUES (:email, :password)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
    }
    
    public static function checkEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    
    public static function checkPassword($password){
        if (strlen($password) >= 6) {
            return true;
        }
        
        return false;
    }
    
    public static function checkEmailExist(){
        $db = Db::getConnection();
        
        $sql = 'SELECT COUNT (*) FROM user WHERE email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        
        if ($result->fetchColumn()) {
            return true;
        }
        return false;
    }
}
