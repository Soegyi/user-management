<?php

class user {

    private $pdo;

    public function __construct($con) {
        $this->pdo = $con;
    }

    public function registerUser($user, $pwd, $email, $role) {

        $query = $this->pdo->prepare("INSERT INTO user SET username=?, password=?, email=?, role=?");
        return $query->execute([$user, $pwd, $email, $role]);
    }
    public function getUserInfo($user){
        
        $stm = $this->pdo->prepare("SELECT * FROM user WHERE username=?");
        $stm->execute([$user]);
        return  $result = $stm->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllUser(){
        
        $result = $this->pdo->query("SELECT * FROM user");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    } 
    public function deleteUser($uid){
        
        $stm = $this->pdo->prepare("DELETE FROM user WHERE userid=?");
        return $result = $stm->execute([$uid]);
    }
    public function updateUser($pass, $email, $uid){
        
        $query = $this->pdo->prepare("UPDATE user SET password=?, email=? WHERE userid=?");
        return $result = $query->execute([$pass, $email, $uid]); 
    }

}
