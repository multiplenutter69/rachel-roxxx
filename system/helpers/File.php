<?php

/**
 * Name         : File.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Static Class. Provides a collection of services to assist
 *              : file managment
 * Notes        :
 */

class File {
    
    //THE $_FILE[] ARRAY 
    private $file;
    
    public function __construct($file) {
        $this->file = $file;
    }

    public function getName(){
        return $this->file["name"];
    }
    
    public function getTempName(){
        return $this->file["temp_name"];
    }
    
    public function getSize(){
        return $this->file["size"];
    }
    
    public function getType(){
        return $this->file["type"];
    }
    
    public function getError(){
        return $this->file["error"];
    }
    
    /**
     * Copies a file to a destination folder on the server
     * @param string $fileName The $_FILE["tmp_name"] for the file to upload
     * @param string $destination The path (with final name) where the file
     * is going to be uploaded
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public function upload($fileName, $destination){
        return copy($fileName,$destination);
    }
    
    /**
     * Removes a file from the server
     * @param string $path The path (with name and extension) from the file that
     * needs to be removed
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public function remove($path){
        return unlink($path);
    }
            
    
}
