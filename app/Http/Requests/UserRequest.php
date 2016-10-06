<?php

namespace TesteLaravel\Http\Requests;

use TesteLaravel\Http\Requests\Request;
use TesteLaravel\User;

class UserRequest extends Request {
    /**
     * @return bool
    */
    public function authorize() { return true;  }

    public function rules(){
        $regras = [
            'name'       => 'required|max:255',
            'password'   => 'required|confirmed',
        ];
        if($this->id){
            $user = User::find($this->id);
            $regras['email']      = 'required|email|unique:users,email,' . $user->id;
        }else{
            $regras['email']      = 'required|email|unique:users,email';
        }
        return $regras;
    }

}
