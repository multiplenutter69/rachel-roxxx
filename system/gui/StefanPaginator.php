<?php

/**
 * Name         : StefanPaginator.php
 * Date         : 15-feb-2016
 * Version      : 1.0
 * Author       : Cesar Cappetto 
 * Description  : 
 * Notes        :
 */
class StefanPaginator {
    private $totalPages;
    private $view;
    private $currentPage;
    
    public function setTotalPages($totalPages) {
        $this->totalPages = $totalPages;
    }

    public function setView($view) {
        $this->view = $view;
    }

    public function setCurrentPage($currentPage) {
        $this->currentPage = $currentPage;
    }

    public function getTotalPages() {
        return $this->totalPages;
    }

    public function getView() {
        return $this->view;
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }
    
    public function isFirstPage(){
        return $this->currentPage == 1; 
    }
    
    public function isFinalPage(){
        return $this->currentPage == $this->totalPages;
    }
    
    public function isPaged(){
        return $this->totalPages > 1;
    }
    
    public function nextPage() {
        if ($this->isFinalPage()) {
            $result = $this->currentPage;
        } else {
            $result = $this->currentPage++;
        }
        return $result;
    }
    
    public function previousPage() {
        if ($this->isFirstPage()) {
            $result = $this->currentPage;
        } else {
            $result = $this->currentPage--;
        }
        return $result;
    }

}
