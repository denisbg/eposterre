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

    
    public function updateViewAbstract($id)
    {
    	
    	$this->update(array('view'=>new Zend_Db_Expr('view + 1')), 'idAbstract ='.$id);
    }

  }




