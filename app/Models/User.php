<?php

namespace App\Models;
use PDO;

use App\Services\Connection;

class User
{
    protected $email = null;
    protected $password = null;
    protected $created_at = null;
    protected $updated_at = null;

    public function __construct()
    {
        $this->created_at = date('Y-m-d H:m:s');
        $this->updated_at = date('Y-m-d H:m:s');
    }

    public function find()
    {
        try {
            $connection = new Connection();

            $open_connection = $connection->db_connect();
            $stmt = $open_connection->prepare("select * from users order by id asc");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($result);

            $connection->db_close();

            return $json;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function findOne($id)
    {
        try {
            $connection = new Connection();

            $open_connection = $connection->db_connect();
            $stmt = $open_connection->prepare("select * from users where id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($result);

            $connection->db_close();

            return $json;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function findByEmailAuth($email)
    {
        try {
            $connection = new Connection();

           $open_connection = $connection->db_connect();
           $stmt = $open_connection->prepare("select * from users where active is true and email=:email");
           $stmt->bindParam(":email", $email);
           $stmt->execute();

           $result = $stmt->fetch(PDO::FETCH_ASSOC);
           $json = json_encode($result);

           $connection->db_close();

           return $json;
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function remove($id)
    {
        try {
            $connection = new Connection();

            $open_connection = $connection->db_connect();
            $stmt = $open_connection->prepare("delete from users where id= :id");
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $connection->db_close();
            
            echo json_encode(['msg'=>'success']);
        } catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function setEmail($email) 
    {
        $this->email = $email;
    }

    public function setPassword($password) 
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function save() 
    {
        try {
            $connection = new Connection();

            $open_connection = $connection->db_connect();
            $stmt = $open_connection->prepare("insert into users(email, pass, created_at, updated_at) values(
            :email, :pass, :created_at, :updated_at)");
            
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":pass", $this->password);
            $stmt->bindParam(":created_at", $this->created_at);
            $stmt->bindParam(":updated_at", $this->updated_at);

            $stmt->execute();
            $connection->db_close();
            
            echo json_encode([
                'email'=> $this->email,
                'pass'=> $this->password,
                'created_at'=> $this->created_at,
                'updated_at'=> $this->updated_at
            ]);
        }catch(\Throwable $error) {
   		    $error = explode(':', $error->getMessage());
            http_response_code(500);
            switch ($error[0]) {
                
                case 'SQLSTATE[23000]':
                    echo json_encode(['message'=> 'This record already exists']);
                break;
                
                default:
                    echo json_encode(['message'=> 'unknown error']);
                break;
            }
            exit;
        } 
    }

    public function update($id) 
    {
        try {
            $connection = new Connection();
            $open_connection = $connection->db_connect();

            if($this->password != '') {
                $stmt = $open_connection->prepare("update users set email = :email, pass = :pass, updated_at = :updated_at where id=:id");
            } else {
                $stmt = $open_connection->prepare("update users set email = :email, updated_at = :updated_at where id=:id");
            }
            $stmt->bindParam(":email", $this->email);
            
            if($this->password != '') {
                $stmt->bindParam(":pass", $this->password);
            }
            
            $stmt->bindParam(":updated_at", $this->updated_at);
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
            $connection->db_close();
            
            echo json_encode([
                'email'=> $this->email,
                'pass'=> $this->password,
                'created_at'=> $this->created_at,
                'updated_at'=> $this->updated_at
            ]);
        }catch(\Throwable $error) {
            echo $error;
            // $error = explode(':', $error->getMessage());
            // http_response_code(500);
            // switch ($error[0]) {
                
            //     case 'SQLSTATE[23000]':
            //         echo json_encode(['message'=> 'This record already exists']);
            //     break;
                
            //     default:
            //         echo json_encode(['message'=> 'unknown error']);
            //     break;
            // }
            // exit;
        }
    }

    public function authentication($password) 
    {
        $user = json_decode($this->findByEmailAuth($this->email), true);
  
        if (password_verify($password, $user['pass'])) {
            $_SESSION['login'] = $this->email;
        } else {
            header("HTTP/1.1 401 Unauthorized");
            echo json_encode([
                'message'=> "unauthorized access",
            ]);
            exit;
        }
    }
}