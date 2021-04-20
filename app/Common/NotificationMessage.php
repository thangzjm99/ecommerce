<?php

namespace App\Common;

class NotificationMessage{

    private const INSERT_SUCCESS = 'Insert Success';

    private const INSERT_FAIL = 'Insert Fail';

    private const UPDATE_SUCCESS = 'Update Success';

    private const UPDATE_FAIL = 'Update Fail';

    private const DELETE_SUCCESS = 'Delete Success';

    private const DELETE_FAIL = 'Delete Fail';

    private const LOGIN_SUCCESS = 'Login Success';

    private const LOGIN_FAIL = 'Login Fail';

    public function getInsertSuccessMessage(){

        return $this::INSERT_SUCCESS;
    }

    public function getInsertFailMessage(){

        return $this::INSERT_FAIL;
    }
    public function getUpdateSuccessMessage(){

        return $this::UPDATE_SUCCESS;
    }

    public function getUpdateFailMessage(){

        return $this::UPDATE_FAIL;
    }
    public function getDeleteSuccessMessage(){

        return $this::DELETE_SUCCESS;
    }

    public function getDeleteFailMessage(){

        return $this::DELETE_FAIL;
    }

    public function getLoginSuccessMessage(){

        return $this::LOGIN_SUCCESS;
    }

    public function getLoginFailMessage(){
        return $this::LOGIN_FAIL;
    }





    
}
