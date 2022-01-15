<?php 

    namespace services;

    class Service{ 

        protected $_errors; 

        protected function _set_error( $error ){
            $this -> _errors[] = $error;
        }

        public function get_errors(){
            return $this -> _errors;
        }

    }

?>