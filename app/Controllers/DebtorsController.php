<?php
namespace App\Controllers;

use App\Models\Debtor;
use App\Services\Utils;

class DebtorsController {

    public function __construct()
    {
        $this->debtor = new Debtor();
    }

    /**
     * Show list form user.
     */
    public function list() {
        include "ROOT_PATH" . "../../../resource/views/debtor/list.php";
    }

    /**
     * Display a listing of the companies.
     */
    public function index() {

        echo $this->debtor->find();
    }

    /**
     * Display specific user.
     */
    public function show($id) {
        echo $this->debtor->findOne($id);
    }

    /**
     * Show the form for creating a new debtor.
     */
    public function create() {
        include "ROOT_PATH" . "../../../resource/views/debtor/create.php";
    }
    /**
     * Store a new created debtor in storage.
     */
    public function store() {
        
        if (isset($_POST["email"])) {
            $this->debtor->setEmail($_POST["email"]);
        }

        if (isset($_POST["address"])) {
            $this->debtor->setAddress($_POST["address"]);
        }

        if (isset($_POST["type_cod"])) {
            $this->debtor->setTypeCod($_POST["type_cod"]);
        }

        if (isset($_POST["cod"])) {
            $this->debtor->setCod($_POST["cod"]);
        }

        if (isset($_POST["company_id"])) {
            $this->debtor->setCompanyId($_POST["company_id"]);
        }

        if (isset($_POST["date_of_birth"])) {
            $this->debtor->setDateOfBirth($_POST["date_of_birth"]);
        }

        if (isset($_POST["description"])) {
            $this->debtor->setDescription($_POST["description"]);
        }

        if (isset($_POST["value"])) {
            $this->debtor->setValue($_POST["value"]);
        }
    
        echo $this->debtor->save();
    }
    /**
     * Display the specified debtor from updated.
     */
    public function edit() {
        include "ROOT_PATH" . "../../../resource/views/debtor/edit.php";
    }

    public function update($id) {
        $data = Utils::patchMethod();

        if (isset($data["email"])) {
            $this->debtor->setEmail($data["email"]);
        }

        if (isset($data["address"])) {
            $this->debtor->setAddress($data["address"]);
        }

        if (isset($data["type_cod"])) {
            $this->debtor->setTypeCod($data["type_cod"]);
        }

        if (isset($data["cod"])) {
            $this->debtor->setCod($data["cod"]);
        }

        if (isset($data["company_id"])) {
            $this->debtor->setCompanyId($data["company_id"]);
        }

        if (isset($data["date_of_birth"])) {
            $this->debtor->setDateOfBirth($data["date_of_birth"]);
        }

        if (isset($data["description"])) {
            $this->debtor->setDescription($data["description"]);
        }

        if (isset($data["value"])) {
            $this->debtor->setValue($data["value"]);
        }

        echo $this->debtor->update($id);
    }
    /**
     * Remove the specified debtor from storage.
     */
    public function destroy($id) {
        echo $this->debtor->remove($id);
    }
}