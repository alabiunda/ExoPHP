<?php

class UserDAO extends DAO {
    protected $table;
    protected $properties;

    function __construct() {
        $this->table = 'users';
        $this->properties = ['pk', 'username'];
        parent::__construct();
    }

    function create($data) {
        return new User(
            $data['pk'],
            $data['username']
        );
    }

    function fetchLogin($uname){
      
    }

}
