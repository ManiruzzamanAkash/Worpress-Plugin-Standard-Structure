<?php

namespace WeDevs\Academy\Traits;

/**
 * Form Error Trait
 */
trait Form_Error {

    /**
     * Errors
     * 
     * Errors will be stored here by key
     * 
     * @var array
     */
    public $errors = [];


    /**
     * Check if there is any error by key
     *
     * @param string $key
     * 
     * @return boolean
     */
    public function has_error( $key )
    {
        return isset( $this->errors[ $key ]) ? true : false;
    }

    /**
     * Get Error
     *
     * @param string $key
     * 
     * @return string
     */
    public function get_error( $key )
    {
        if ( isset( $this->errors[ $key ] ) ) {
            return $this->errors[ $key ];
        }
    }

}