<?php

/**
 * Name         : Sesion.php
 * Date         : 11-ene-2016
 * Version      : 1.0
 * Author       : Cesar Cappetto 
 * Description  : Static Class. Provides a collection of services
 *              : to asist Session handling
 * Notes        :
 */
class Session {

    /**
     * Performs a session_start only if there is no session_id activated
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    private static function activate() {

        if (session_id() == "") {
            $result = session_start();
        }

        return $result;
    }

    /**
     * Performs a regeneration of the session_id keeping the session alive
     */
    public static function update() {
        session_regenerate_id(true);
    }

    /**
     * Saves a value into the SESSION[] key => value array 
     * @param string $key The key used to save the value on the array
     * @param value $value The value to be saved.<br>It coud be any type of 
     * value, a serialize array or a serialized object
     */
    public static function setValue($key, $value) {
        $this->activate();
        $_SESSION[$key] = $value;
    }

    /**
     * Returns the value saved on the SESSION[] key => value array
     * @param string $key The key used to save the value on the array
     * @return value The value saved on the SESSION[] array.<br>It coud be any 
     * type of value, a serialize array or a serialized object
     */
    public static function getValue($key) {
        $result = false;

        $this->activate();
        if (isset($_SESSION[$key])) {
            $result = $_SESSION[$key];
        }

        return $result;
    }

    /**
     * Deletes a value saved on the SESSION[] key => value array
     * @param string $key The key used to save the value on the array
     * @return boolean
     */
    public static function deleteValue($key) {

        $result = false;

        $this->activate();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            $result = true;
        }

        return $result;
    }

    /**
     * Performs te closure of the session of a project.<br>
     * @param string $project The name of the current project
     */
    public static function close($project) {
        $this->activate();

        reset($_SESSION);
        while (list($key, $val) = each($_SESSION)) {
            if (String::contains($key, $project)) {
                $this->deleteValue($key);
            }
        }

        reset($_SESSION);
    }

    /**
     * Performs the destruction of the current session
     */
    public static function destroy() {
        $this->activate();
        session_destroy();
    }

}
