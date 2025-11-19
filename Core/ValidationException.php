<?php 
namespace Core;
class ValidationException extends \Exception
{
    public readonly array $errors;
    public readonly array $old ;
  
    public static function throw(array $errors, array $old)
    {
        $instance = new static;
        $instance->errors = $errors;
        $instance->old = $old;
        throw $instance;
    }

   
}
// class ValidationException extends \Exception
// {
//     public function __construct(
//         protected array $errors = [],
//         protected array $old = []
//     ) {
//         parent::__construct('Validation failed');
//     }
    
//     public static function throw(array $errors, array $old)
//     {
//         $instance = new static;
//         $instance->errors = $errors;
//         $instance->old = $old;
//         throw $instance;
//     }

//     public function errors(): array
//     {
//         return $this->errors;
//     }
    
//     public function old(): array
//     {
//         return $this->old;
//     }
// }