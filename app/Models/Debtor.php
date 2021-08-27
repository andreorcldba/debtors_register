<?php

namespace App\Models;
use PDO;

use App\Services\Connection;

class Debtor
{
    protected $company_id = null;
    protected $type_cod = null;
    protected $cod = null;
    protected $date_of_birth = null;
    protected $email = null;
    protected $address = null;
    protected $description = null;
    protected $value = null;
    protected $expiration = null;
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
            $stmt = $open_connection->prepare("select * from debtor");
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
            $stmt = $open_connection->prepare("select * from debtor where id=:id");
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
            $stmt = $open_connection->prepare("delete from debtor where id= :id");
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

    public function setTypeCod($type_cod) 
    {
        $this->type_cod = $type_cod;
    }

    public function setCod($cod) 
    {
        $this->cod = $cod;
    }

    public function setCompanyId($company_id) 
    {
        $this->company_id = $company_id;
    }

    public function setDateOfBirth($date_of_birth) 
    {
        $this->date_of_birth = $date_of_birth;
    }

    public function setDescription($description) 
    {
        $this->description = $description;
    }

    public function setValue($value) 
    {
        $this->value = $value;
    }

    public function setExpiration($expiration) 
    {
        $this->expiration = $expiration;
    }

    public function save()
    {
        try {
            $connection = new Connection();
            
            $open_connection = $connection->db_connect();
            $stmt = $open_connection->prepare("insert into debtor(company_id, type_cod, cod, date_of_birth, email, address, description, value, expiration, created_at, updated_at) values(
            :company_id, :type_cod, :cod, :date_of_birth, :email, :address, :description, :value, :expiration, :created_at, :updated_at)");
            
            $stmt->bindParam(":company_id", $this->company_id);
            $stmt->bindParam(":type_cod", $this->type_cod);
            $stmt->bindParam(":cod", $this->cod);
            $stmt->bindParam(":date_of_birth", $this->date_of_birth);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":value", $this->value);
            $stmt->bindParam(":expiration", $this->value);
            $stmt->bindParam(":created_at", $this->created_at);
            $stmt->bindParam(":updated_at", $this->updated_at);
            
            $stmt->execute();
            $connection->db_close();
           
            echo json_encode([
                'company_id'=> $this->company_id,
                'type_cod'=> $this->type_cod,
                'cod'=> $this->cod,
                'date_of_birth'=> $this->date_of_birth,
                'email'=> $this->email,
                'address'=> $this->address,
                'description'=> $this->description,
                'value'=> $this->value,
                'expiration'=> $this->expiration,
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
                    echo json_encode(['message'=> $error]);
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

            $stmt = $open_connection->prepare("update debtor set company_id = :company_id, type_cod = :type_cod, cod = :cod, date_of_birth = :date_of_birth, email = :email, address = :address, description = :description, value = :value, expiration = :expiration, updated_at = :updated_at where id=:id");
            
            $stmt->bindParam(":company_id", $this->company_id);
            $stmt->bindParam(":type_cod", $this->type_cod);
            $stmt->bindParam(":cod", $this->cod);
            $stmt->bindParam(":date_of_birth", $this->date_of_birth);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":value", $this->value);
            $stmt->bindParam(":expiration", $this->expiration);
            $stmt->bindParam(":updated_at", $this->updated_at);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
            $connection->db_close();
            
            echo json_encode([
                'company_id'=> $this->company_id,
                'type_cod'=> $this->type_cod,
                'cod'=> $this->cod,
                'date_of_birth'=> $this->date_of_birth,
                'email'=> $this->email,
                'address'=> $this->address,
                'description'=> $this->description,
                'value'=> $this->value,
                'expiration'=> $this->expiration,
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