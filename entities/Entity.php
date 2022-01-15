<?php

    namespace entities;

    class Entity{

        function __get( $name ){
            if(!is_string($name))
                return;
                $method =  'get_'.$name;
            if(method_exists($this, $method)){
                return $this -> $method();
            }else if(property_exists($this, $name))
                return $this -> $name;

            return;
        }

        function __set( $name, $value){
            if(!is_string($name))
                return;

            $method =  'set_'.$name;
            if(method_exists($this, $method)){
                $this -> $method( $value );
            }
        }

        public function get_vars(){
            return get_object_vars($this);
        } 

    }

?>
