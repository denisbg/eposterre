<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * ViewModel
 * @package Models
 */

class View extends Zend_Db_Table {

  protected $_name = 'view';

    
    public function updateViewSlideAbstract($id)
    {
    	$this->update(array('viewSlide'=>new Zend_Db_Expr('viewSlide + 1')), 'idAbstract ='.$id);
    }
    
    public function updateViewVideoAbstract($id)
    {
    	$this->update(array('viewVideo'=>new Zend_Db_Expr('viewVideo + 1')), 'idAbstract ='.$id);
    }

  }




