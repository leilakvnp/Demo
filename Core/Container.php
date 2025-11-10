<?php
namespace Core;
class Container{
    protected $bindings=[];// save bindings like routers
    public function bind(string $key,callable $resolver){
        $this-> bindings[$key]=$resolver;
    }
    public function resolve(string $key){// find resolver for key and execute it
        if(! array_key_exists($key,$this->bindings)){
            throw new \Exception("No matching binding found for {$key}");
        }
        $resolver=$this->bindings[$key];
        return call_user_func($resolver);
    }

}