<?php 
class commonClass{
    
    public function sessionStart(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function redirect($location){
        header('Location: '.$location); exit;
    }
}
?>