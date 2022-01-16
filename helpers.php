<?php 
    if( !defined('START') ) die('...'); 
    /*
        @Param  (numeric) $price   
        @Param  (bool)    $show_symbol   
        @Param  (string)  $currency   
        @Return (string)
    */
    function mask_price( $price , $show_symbol = false , $currency  = 'BRL'){
        if(!is_numeric( $price ))
            $price = '999999999999999999999999999999999999.99';

        $price = number_format( $price  , 2, ',', '.');

        $currencies = ['BRL' => 'R$', 'USD' => '$', 'JPY' => '¥', 'EUR' => '€'];

        if( $show_symbol === true ){
            if( in_array( $currency, array_keys($currencies), true ) ){
                $current_currency = $currencies[$currency];;
            }else{
                $current_currency = $currencies['BRL'];
            }
            $price =  $current_currency  . ' '. $price;
        }

        return $price;
    }

?>