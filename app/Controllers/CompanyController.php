<?php
namespace App\Controllers;

use App\Models\Company;
use App\Services\Utils;

class CompanyController {

    public function __construct()
    {
        $this->company = new Company();
    }

    /**
     * Show list form company.
     */
    public function list() {
        include "ROOT_PATH" . "../../../resource/views/company/list.php";
    }

    /**
     * Display a listing of the companies.
     */
    public function index() {

        echo $this->company->find();
    }

    /**
     * Display specific company.
     */
    public function show($id) {
        echo $this->company->findOne($id);
    }

    /**
     * Show the form for creating a new company.
     */
    public function create() {
        include "ROOT_PATH" . "../../../resource/views/company/create.php";
    }
    /**
     * Store a new created company in storage.
     */
    public function store() {
        
        if (isset($_POST["email"])) {
            $this->company->setEmail($_POST["email"]);
        }

        if (isset($_POST["address"])) {
            $this->company->setAddress($_POST["address"]);
        }

        if (isset($_POST["telephone"])) {
            $this->company->setTelephone($_POST["telephone"]);
        }

        if (isset($_POST["cnpj"])) {
            $this->company->setCnpj($_POST["cnpj"]);
        }

        echo $this->company->save();
    }
    /**
     * Display the specified company from updated.
     */
    public function edit() {
        include "ROOT_PATH" . "../../../resource/views/company/edit.php";
    }

    public function update($id) {

        $data = Utils::patchMethod();

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
     * Remove the specified company from storage.
     */
    public function destroy($id) {
        echo $this->company->remove($id);
    }
}