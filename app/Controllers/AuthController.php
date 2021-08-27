<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Check Auth User
     */
    public function authentication() {
    
        if (isset($_POST["email"])) {
            $this->user->setEmail($_POST["email"]);
        }
       
        if (isset($_POST["password"])) {
            echo $this->user->authentication($_POST["password"]);   
        }else {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode([
                'message'=> "unauthorized access",
            ]);
            exit;
        }
    }

    public function logout() {
        unset( $_SESSION['login'] );

        echo json_encode([
            'message'=> "user logged out successfully",
        ]);
    }
}