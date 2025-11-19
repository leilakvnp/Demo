<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class Loginform
{
    //protected $attributes = [];
    protected $errors = [];
    public function __construct(public array $attributes)
    {
        //$this->attributes = $attributes;
        if (!Validator::email($this->attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }
        if (!Validator::string($this->attributes['password'],7)) {
            $this->errors['password'] = 'Please provide a  valid password .';
        }
    }
    /**
     * @param array $attributes
     */
    public static function validate(array $attributes)
    {
        $instance = new static($attributes);
       
        return $instance->failed()? $instance->throw():$instance;
    }
    /**
     * @return bool
     */
    public function failed(): bool
    {
        return  !empty($this->errors);
    }
    /**
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }
   /** @noinspection PhpUndefinedVariableInspection */
    public function setError(string $field,string $message)
    {
        $this->errors[$field] = $message;
        return $this;
    }
    public function throw()// send both errors and old data to exception
    {
        ValidationException::throw($this->errors(),$this->attributes);
    }
}
// namespace Http\Forms;

// use Core\Validator;

// class Loginform
// {
//     protected $errors = [];
//     public function errors(){
//         return $this->errors;
//     }
//     public function setError($field,$message){
//         $this->errors[$field]=$message;
//     }
//     protected $attributes=[];
//     public static function validate($attributes)
//     {
//        //$instatnce= new static ($attributes);
//     }
    
//     public function __construct($attributes)
//         {
//              if (!Validator::email($this->attributes['email'])) {
//             $this->errors['email'] = 'Please provide a valid email address.';
//         }
//         if (!Validator::string($this->attributes['password'])) {
//             $this->errors['password'] = 'Please provide a  valid password .';
//         }
   
//         }
// }