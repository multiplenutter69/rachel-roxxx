<?php

/**
 * Name         : Validator.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Static Class. Provides a collection of services
 *              : to asist field validation
 * Notes        :
 */
class Validator {

    /**
     * Validates require condition on a field
     * @param value $field The value that needs to be checked
     * <br>Could be an array as well
     * @return boolean <b>TRUE</b> if the field is NULL<br>
     * <b>FALSE</b> otherweise
     */
    public static function isNull($field) {
        return empty($field);
    }

    /**
     * Validates that to fields have the same content
     * @param string $field The first field to check
     * @param string $otherField The second field to check
     * @return boolean <b>TRUE</b> if the field is NULL<br>
     * <b>FALSE</b> otherweis
     */
    public static function equalsTo($field, $otherField) {
        return $field == $otherField;
    }

    /**
     * Validates that the length on the field is not less tan a value
     * @param value $field The value that needs to be checked
     * @param integer $length The minimun length thath te field needs to have
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function minLength($field, $length) {
        return strlen($field) >= $length;
    }

    /**
     * Validates that the length on the field is not bigger tan a value
     * @param value $field The value that needs to be checked
     * @param integer $length The maximum length thath te field needs to have
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function maxLength($field, $length) {
        return strlen($field) <= $length;
    }

    /**
     * Validates that the value of the field is not less tan a determined value
     * @param value $field The value that needs to be checked
     * @param integer $value The minimun value thath te field needs to have
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function minValue($field, $value) {
        return $field >= $value;
    }

    /**
     * Validates that the value of the field is not great tan a determined value
     * @param value $field The value that needs to be checked
     * @param integer $value The maximum value thath te field needs to have
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function maxValue($field, $value) {
        return $field <= $value;
    }

    /**
     * Validates numbers only format  on a field
     * @param value $field The value that needs to be checked
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function numbersOnly($field) {

        $result = false;
        $pattern = "/^[0-9]+$/i";

        if (preg_match($pattern, $field)) {
            $result = true;
        }

        return $result;
    }

    /**
     * Validates letters only format  on a field
     * @param value $field The value that needs to be checked
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function lettersOnly($field) {

        $result = false;
        $pattern = "/^[a-z\s]+$/i";

        if (preg_match($pattern, $field)) {
            $result = true;
        }

        return $result;
    }

    /**
     * Validates E-mail format on a field
     * @param value $field The value that needs to be checked
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function emailValidation($field) {
        return filter_var($field, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Validates a date.<br>
     * It does not validate the format, just the content of the date
     * @param integer $month The Month value of the date
     * @param integer $day The Day value of the date
     * @param integer $year The year value of the date
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function dateValidation($month, $day, $year) {
        $result = false;

        if (checkdate($month, $day, $year)) {
            $result = true;
        }

        return $result;
    }

    /**
     * Validates MySQL date time format on a field
     * @param value $field The value that needs to be checked
     * <br>Could be an array as well
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function dateTimeValidation($field) {

        $result = false;

        $pattern = "/^(((\d{4})(-)(0[13578]|10|12)(-)(0[1-9]|[12][0-9]|3[01]))|((\d{4})(-)(0[469]|1‌​1)(-)([0][1-9]|[12][0-9]|30))|((\d{4})(-)(02)(-)(0[1-9]|1[0-9]|2[0-8]))|(([02468]‌​[048]00)(-)(02)(-)(29))|(([13579][26]00)(-)(02)(-)(29))|(([0-9][0-9][0][48])(-)(0‌​2)(-)(29))|(([0-9][0-9][2468][048])(-)(02)(-)(29))|(([0-9][0-9][13579][26])(-)(02‌​)(-)(29)))(\s([0-1][0-9]|2[0-4]):([0-5][0-9]):([0-5][0-9]))$/";
        if (preg_match($pattern, $field)) {
            $result = true;
        }

        return $result;
    }

    /**
     * Validates MySQL time format on a field
     * @param value $field The value that needs to be checked
     * <br>Could be an array as well
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function timeValidation($field) {

        $result = false;

        $pattern = "/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])[\:]([0-5][0-9])$/";
        if (preg_match($pattern, $field)) {
            $result = true;
        }

        return $result;
    }

    /**
     * Validates CUIT format on a field
     * @param value $field The value that needs to be checked
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function cuitValidation($field) {

        $result = false;
        $checkDigits = array();
        $cuitDigits = array();

        if (strlen($field) == 11) {
            $cuitCode = "6789456789";
            $checkDigits = str_split($cuitCode);
            $cuitDigits = str_split($field);

            $tempValue = 0;
            for ($i = 0; $i <= 9; $i++) {
                $tempValue += ($cuitDigits[$i] * $checkDigits[$i]);
            }

            $tempValue = ($tempValue % 11);

            if ($tempValue == $cuitDigits[10]) {
                $result = true;
            }
        }

        return $result;
    }

    /**
     * Validates that the $_FILE[] field has a certain file type
     * @param string $fileType The $_FILE["type"] you need to check
     * @param string $type The type yo need to validate Eg: "image"
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function fileTypeValidation($fileType, $type) {
        return preg_match('#' . $type . '#i', $fileType);
    }

    /**
     * Validates that the $_FILE[] field has a allowed extension
     * @param string $fileName The $_FILE["name"] you need to check
     * @param array $whiteList Array of allowed extensions
     * @param array $blackList Array of forbidden extensions
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function fileExtensionValidation($fileName, $whiteList = array(), $blackList = array()) {
        $result = true;

        $temp = explode('.', strtolower($fileName));

        if (!in_array(end($temp), $whiteList)) {
            $result = false;
        }

        if (in_array(end($temp), $blackList)) {
            $result = false;
        }

        return $result;
    }

    /**
     * Validates that the $_FILE[] field size is less than a certain value
     * @param string $fileSize The $_FILE["size"] you need to check
     * @param integer $value The maximum number of bytes allowed
     * @return boolean <b>TRUE</b> on success<br>
     * <b>FALSE</b> on failure
     */
    public static function fileMaxSizeValidation($fileSize, $value) {
        return $fileSize > $value;
    }

}
