<?php

class Config extends Zend_Db_Table {

  protected $_name = 'config';
  

    public function getConfig($id = 1) 
    {
    	$select = $this->select() 
        		->from('config');
		
        $result = $this->fetchRow($select);
        return $result;
    }


}




