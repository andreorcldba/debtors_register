<?php

namespace App\Models;
use PDO;

use App\Services\Connection;

class Dashboard
{

    public function findOne($id)
    {
        try {
            $connection = new Connection();

            $open_connection = $connection->db_connect();
            $sql = 
                    "SELECT
                        'Empresas' g,
                        count(*) v
                    from
                        company
                    union all
                    SELECT
                    'Devedores' g,
                        count(*) v
                    from
                        debtor";
              
            $stmt = $open_connection->prepare($sql);
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
}