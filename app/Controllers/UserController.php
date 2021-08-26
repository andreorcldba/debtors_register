<?php

namespace App\Controllers;

use App\Models\User;

class UserController {

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Display a listing of the users.
     */
    public function index() {

        echo $this->user->find();
    }

    /**
     * Display specific user.
     */
    public function show($id) {
        echo $this->user->findOne($id);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create() {
        include "ROOT_PATH" . "../../../resource/views/user/create.php";
    }
    /**
     * Store a new created user in storage.
     */
    public function store() {
       
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        if (isset($data["email"])) {
            $this->user->setEmail($data["email"]);
        }

        if (isset($data["password"])) {
            $this->user->setPassword($data["password"]);
        }

        echo $this->user->save();   
    }
    /**
     * Display the specified user from updated.
     */
    public function edit() {
        include "ROOT_PATH" . "../../../resource/views/user/edit.php";
    }

    public function update($id) {
       
        $json = file_get_contents("php://input");
        $data = json_decode($json, true);

        if (isset($data["email"])) {
            $this->user->setEmail($data["email"]);
        }

        if (isset($data["password"])) {
            $this->user->setPassword($data["password"]);
        }

        echo $this->user->update($id);
    }
    /**
     * Remove the specified user from storage.
     */
    public function destroy($id) {
        echo $this->user->remove($id);
    }
}