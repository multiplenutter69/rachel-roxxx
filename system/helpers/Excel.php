<?php

/**
 * Name         : Excel.php
 * Date         : Jan 2016
 * Version      : 
 * Author       : Stefan
 * Description  : Entity Class. Provides a collection of services to assist
 *              : with Excel functionality
 * Notes        : The development of this functionality, deppends on 
 *              : the well known PHPExcel. All rigths reserved to 
 *              : the original authors of this framework
 */
require_once (dirname(__FILE__) . "/excel/PHPExcel/IOFactory.php");

class Excel {

    /**
     * Performs the load of an Excel file
     * @param string $file Path to the file (complete with extension)
     * @return object PHPExcel object of the loaded file
     */
    public function load($file) {
        try {
            $result = PHPExcel_IOFactory::load($file);
        } catch (Exception $ex) {
            $result = null;
        }

        return $result;
    }

    /**
     * Gets a single Sheet object of a PHPExcel object
     * @param object $phpExcel the PHPExcel object
     * @param integer $index The position of the sheet requested
     * @return object PHPExcel Sheet object
     */
    public function getSheet($phpExcel, $index) {
        try {
            $result = $phpExcel->getSheet($index);
        } catch (Exception $ex) {

            $result = null;
        }

        return $result;
    }

    /**
     * Returns the title of a certain sheet
     * @param object $sheet The PHPExcel Sheet object
     * @return string The title of the sheet
     */
    public function getSheetTitle($sheet) {
        try {
            $result = $sheet->getTitle();
        } catch (Exception $ex) {
            $result = "";
        }
        return $result;
    }

    /**
     * Returns the index value of the last used column from a sheet
     * <br>The index value represents a number from 0 to N-1, where 
     * N represent the number of columns used on the sheet
     * @param object $sheet The PHPExcel Sheet object
     * @return integer The N-1 value
     */
    public function getMaxColumnSheet($sheet) {
        try {
            $result = PHPExcel_Cell::columnIndexFromString($sheet->getHighestColumn());
        } catch (Exception $ex) {
            $result = 0;
        }
        return $result;
    }

    /**
     * Returns the index value of the last used row from a sheet
     * <br>The index value represents a number from 1 to N, where 
     * N represent the number of rows used on the sheet
     * @param object $sheet The PHPExcel Sheet object
     * @return integer The N value
     */
    public function getMaxRowSheeet($sheet) {
        try {
            $result = $sheet->getHighestRow();
        } catch (Exception $ex) {
            $result = 1;
        }
        return $result;
    }

    /**
     * Returns the content of a certain cell
     * <br>The return value is located at Sheet X, row Y, column Z
     * @param object $sheet The PHPExcel Sheet object
     * @param integer $row The row number of the cell to get
     * @param integer $column The column position of the cell to get
     * @return string Cell value
     */
    public function getCell($sheet, $row, $column) {
        try {
            $result = $sheet->getCellByColumnAndRow($column, $row)->getValue();
        } catch (Exception $ex) {
            $result = "";
        }
        return $result;
    }

}
