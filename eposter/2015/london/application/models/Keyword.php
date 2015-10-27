<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * KeywordModel
 * @package Models
 */

class Keyword extends Zend_Db_Table {

  protected $_name = 'keyword-family-pcr';
  

    public function getKeywords() 
    {
    	$select = $this -> select() 
        		->from(array('kf'=>'keyword-family-pcr'), array("idFamily", "familyData"))
       			->join(array('kp'=>'keyword-pcr'), 'kp.idFamily = kf.idFamily', array("idKeyword", "keywordData"))
       			->order(array("familyOrder ASC", "keywordOrder ASC"))
       			->where("idTheme = 2")
       			->where("kp.idKeyword IN(SELECT distinct idKeyword FROM `keyword-pcr` k, `abstract-keyword` a where k.idKeyword = a.keyword_idKeyword)")
        		->setIntegrityCheck(false);

        $result = $this ->fetchAll($select);
        return $result;
    }
    
    public function getKeywordsUsed($keywords) 
    {
    	$select = $this -> select() 
        		->from(array('ak'=>"abstract-keyword"), "keyword_idKeyword")
       			->join(array('kp'=>'keyword-pcr'), 'kp.idKeyword = ak.keyword_idKeyword', null)
       			->join(array('a'=>'abstract'), 'a.idAbstract = ak.abstract_idAbstract', null)
        		->join(array('kf'=>'keyword-family-pcr'), "kp.idFamily = kf.idFamily", null)
        		->join(array("dc"=>'decision'), "dc.idAbstract = a.idAbstract", null)
       			->where("abstract_idAbstract IN (?)", new Zend_Db_Expr($this->select()->from("abstract", "idAbstract")->join(array("ak"=>"abstract-keyword"), "idAbstract = ak.abstract_idAbstract", null)
        		->setIntegrityCheck(false)->where("keyword_idKeyword IN (?)", $keywords)->group("idAbstract")->having(new Zend_Db_Expr("COUNT(distinct keyword_idKeyword) = ".count($keywords)))))
        		->where("idTheme = 2")
       			->where("dc.decision = 'accepted'")
       			->where("dc.idPassage = 2")
				->group("keyword_idKeyword")
        		->setIntegrityCheck(false);
		

        $result = $this ->fetchAll($select);
        return $result;
    }


    public function getFamilyKeyword($keywords) 
    {
    	$select = $this -> select() 
        		->from(array('kf'=>'keyword-family-pcr'), "idFamily")
       			->join(array('kp'=>'keyword-pcr'), 'kp.idFamily = kf.idFamily', "idKeyword")
       			->order(array("familyOrder ASC", "keywordOrder ASC"))
        		->where("idKeyword IN (?)", $keywords)
        		->setIntegrityCheck(false);
	
        $result = $this ->fetchAll($select);
        return $result;
    }
}




