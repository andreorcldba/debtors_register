<?php
namespace App\Controllers;

use App\Models\Company;

class CompanyController {

    public function __construct()
    {
        $this->company = new Company();
    }

    /**
     * Display a listing of the companies.
     */
    public function index() {

        echo $this->company->find();
    }

    /**
     * Display specific user.
     */
    public function show($id) {
        echo $this->company->findOne($id);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create() {
        include "ROOT_PATH" . "../../../resource/views/company/create.php";
    }
    /**
     * Store a new created user in storage.
     */
    public function store() {

        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        if (isset($data["email"])) {
            $this->company->setEmail($data["email"]);
        }

        if (isset($data["address"])) {
            $this->company->setAddress($data["address"]);
        }

        if (isset($data["telephone"])) {
            $this->company->setTelephone($data["telephone"]);
        }

        if (isset($data["cnpj"])) {
            $this->company->setCnpj($data["cnpj"]);
        }

        echo $this->company->save();   
    }
    /**
     * Display the specified user from updated.
     */
    public function edit() {
        include "ROOT_PATH" . "../../../resource/views/company/edit.php";
    }

    public function update($id) {
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        if (isset($data["email"])) {
            $this->company->setEmail($data["email"]);
        }

        if (isset($data["address"])) {
            $this->company->setAddress($data["address"]);
        }

        if (isset($data["telephone"])) {
            $this->company->setTelephone($data["telephone"]);
        }

        if (isset($data["cnpj"])) {
            $this->company->setCnpj($data["cnpj"]);
        }

        echo $this->company->update($id);   
    }
    /**
     * Remove the specified user from storage.
     */
    public function destroy($id) {
        echo $this->company->remove($id);
    }
}