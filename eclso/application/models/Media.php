<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * MediaModel
 * @package Models
 */

class Media extends Zend_Db_Table {

  protected $_name = 'media';

    
    public function getAllVideo($idAbstract, $slide)
    {
    	$select = $this -> select() 
        		->from('media')
       			->join(array('af' => 'abstract-file'), 'af.idFile = media.slide_idSlide')
       			->join('abstract', 'abstract.idAbstract = af.idAbstract')
       		//	->join('importedfile', 'importedfile.idImportedfile = slide.importedfile_idImportedfile', array('hashImportedfile'))
        		->setIntegrityCheck(false)
        		->where('af.pathFile = ?', $slide);
		
        $result = $this ->fetchAll($select);
        return $result;
    }
    

  }




