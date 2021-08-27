<?php

namespace App\Models;
use PDO;

use App\Services\Connection;

class Company
{
    protected $email = null;
    protected $address = null;
    protected $telephone = null;
    protected $cnpj = null;
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
            $stmt = $open_connection->prepare("select * from company");
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
            $stmt = $open_connection->prepare("select * from company where id=:id");
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

    public function remove($id)
    {
        try {
            $connection = new Connection();

            $open_connection = $connection->db_connect();
            $stmt = $open_connection->prepare("delete from company where id= :id");
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

    public function setAddress($address) 
    {
        $this->address = $address;
    }

    public function setTelephone($telephone) 
    {
        $this->telephone = $telephone;
    }

    public function setCnpj($cnpj) 
    {
        $this->cnpj = $cnpj;
    }

    public function save() 
    {
        try {
            $connection = new Connection();

            $open_connection = $connection->db_connect();
            $stmt = $open_connection->prepare("insert into company(email, address, telephone, cnpj, created_at, updated_at) values(
            :email, :address, :telephone, :cnpj, :created_at, :updated_at)");
            
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":telephone", $this->telephone);
            $stmt->bindParam(":cnpj", $this->cnpj);
            $stmt->bindParam(":created_at", $this->created_at);
            $stmt->bindParam(":updated_at", $this->updated_at);
           
            $stmt->execute();
            $connection->db_close();
           
            echo json_encode([
                'email'=> $this->email,
                'address'=> $this->address,
                'telephone'=> $this->telephone,
                'cnpj'=> $this->cnpj,
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

            $stmt = $open_connection->prepare("update company set email = :email, address = :address, telephone = :telephone, cnpj = :cnpj, updated_at = :updated_at where id=:id");
            
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":telephone", $this->telephone);
            $stmt->bindParam(":cnpj", $this->cnpj);
            $stmt->bindParam(":updated_at", $this->updated_at);
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
            $connection->db_close();
            
            echo json_encode([
                'email'=> $this->email,
                'address'=> $this->address,
                'telephone'=> $this->telephone,
                'cnpj'=> $this->cnpj,
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
}