<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * VideoModel
 * @package Models
 */

class Video extends Zend_Db_Table {

  protected $_name = 'video';

    
    public function getAllVideo()
    {
    	$select = $this -> select() 
        		->from('video')
        		->where('video = 1');
		
        $result = $this ->fetchAll($select);
        return $result;
    }
    
    public function getVideoByIdAbstract($id)
    {
    	$select = $this -> select() 
        		-> from('video')
        		->join('abstract', 'video.idAbstract = abstract.idAbstract', null)
       			->join('importedfile', 'importedfile.idAbstract = abstract.idAbstract', array('hashImportedfile', 'fileNameImportedfile'))
        		->setIntegrityCheck(false)
        		->where('video.idAbstract = ?', $id);
		
        $result = $this ->fetchRow($select);
        return $result;
    }
    
    
    public function updateVideoVideoAbstract($id)
    {
    	$this->update(array('videoVideo'=>new Zend_Db_Expr('videoVideo + 1')), 'idAbstract ='.$id);
    }

  }




