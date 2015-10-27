<?php

/**
 * INTRANET v1
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2009
 * @version 1.0
 */

/**
 * ResumeModel
 * @package Models
 */

class Resume extends Zend_Db_Table {

  protected $_name = 'abstract';
  
  
    public function getAbstractById($id) 
    {
    	$select = $this -> select() 
        		-> from('abstract')
       			->join('author', 'author.idAbstract = abstract.idAbstract', "GROUP_CONCAT(distinct CONCAT(UPPER(`author`.`lastName`),' ',CONCAT(LEFT(`author`.`firstName`,1),'.')) ORDER BY author.order ASC SEPARATOR ' - ') as authors")
        		->setIntegrityCheck(false)
        		->where('abstract.idAbstract = ?', $id);
        
        if(Zend_Registry::get('config')->option->keyword == true){
        	$select->join(array("d"=>new Zend_Db_Expr("(SELECT CONCAT('<strong>',familyData, '</strong> : ', GROUP_CONCAT(distinct keywordData SEPARATOR ', ')) as keywords
FROM `abstract-keyword` AS `ak`
INNER JOIN `keyword-pcr` AS `k` ON k.idKeyword = ak.keyword_idKeyword 
INNER JOIN `keyword-family-pcr` AS `f` ON k.idFamily = f.idFamily 
WHERE (ak.abstract_idAbstract = '".$id."')
group by f.idFamily)")), null, new Zend_Db_Expr("group_concat(distinct keywords SEPARATOR '. ') AS keyword"));

       	}		
        		
        if(Zend_Registry::get('config')->option->view == true){
	       	$select->join('view', 'view.idAbstract = abstract.idAbstract', 'view');
       	}
        $result = $this ->fetchRow($select);
        return $result;
    }


	
    public function getAllAbstract($search, $type) 
    {
    	
    	$rechercheMin = strtolower($search);
		$rechercheMaj = strtoupper($search); 
    	
    	$select = $this -> select() 
        		-> from(array("d"=>new Zend_Db_Expr("(SELECT abstract_idAbstract, CONCAT('<strong>',familyData, '</strong> : ', GROUP_CONCAT(distinct keywordData SEPARATOR ', ')) as keywords
        											FROM `abstract-keyword` AS `ak`
        											INNER JOIN `keyword-pcr` AS `k` ON k.idKeyword = ak.keyword_idKeyword 
        											INNER JOIN `keyword-family-pcr` AS `f` ON k.idFamily = f.idFamily 
        											group by f.idFamily, ak.abstract_idAbstract)")), new Zend_Db_Expr("group_concat(distinct keywords SEPARATOR '. ') AS keyword"))									
        		->join(array("a"=>'abstract'), "a.idAbstract = d.abstract_idAbstract", array('a.title', 'a.idAbstract', 'idDefinitive'))
        		->join(array("dc"=>'decision'), "dc.idAbstract = a.idAbstract", null)
       			->join('author', 'author.idAbstract = a.idAbstract', "GROUP_CONCAT(distinct CONCAT(`author`.`lastName`,' ',CONCAT(LEFT(`author`.`firstName`,1),'.')) ORDER BY author.order ASC SEPARATOR ' - ') as authors")
       			->where("dc.decision = 'accepted'")
       			->where("dc.idPassage IN (".Zend_Registry::get('config')->resume->passage.")")
        		->setIntegrityCheck(false)
        		->group("d.abstract_idAbstract");
        
        if(Zend_Registry::get('config')->option->view == true){
	       	$select->join('view', 'view.idAbstract = a.idAbstract', 'view');
       	}

        if($type == "author"){
	        $select->where("a.idAbstract IN (SELECT author.idAbstract FROM author WHERE UPPER(author.lastName) LIKE '%".$rechercheMaj."%' OR LOWER(author.lastName) LIKE '%".$rechercheMin."%')")
	        	->order('authors ASC');
        }
        		
		if($type == "title"){
			$select->where("LOWER(a.title) LIKE '%".$rechercheMin."%' OR UPPER(a.title) LIKE '%".$rechercheMaj."%'")
				->order('a.title ASC');
		}
//echo $select;
        $result = $this ->fetchAll($select);

		$tab = array();
		foreach($result as $res){
			if(!array_key_exists($res->idAbstract, $tab)){
				$tab[$res->idAbstract] = array();
			}
			if($type == "title" && !empty($rechercheMin)){
			 $pattern = '/('.$rechercheMin.')/i';
			 $replacement = '<span class="vignette">$1</span>';
			 $tab[$res->idAbstract]['title'] = preg_replace($pattern, $replacement, ucfirst($res->title));
			}else{
			 $tab[$res->idAbstract]['title'] = ucfirst($res->title);
			}
			$tab[$res->idAbstract]['idDefinitive'] = $res->idDefinitive;
			if($type == "author" && !empty($rechercheMin)){
			 $pattern = '/('.$rechercheMin.')/i';
			 $replacement = '<span class="vignette">$1</span>';
			 $tab[$res->idAbstract]['authors'] = preg_replace($pattern, $replacement, $res->authors);
            }else{
             $tab[$res->idAbstract]['authors'] = $res->authors;  
            }
			if(Zend_Registry::get('config')->option->keyword == true){
				$tab[$res->idAbstract]['keyword'] = $res->keyword;
			}
			if(Zend_Registry::get('config')->option->view == true){
				$tab[$res->idAbstract]['view'] = $res->view;
			}
		}

        return $tab; 
    }
    
    
    
        public function getAllAbstractKeywords($keywords) 
    {
    	
    	$select = $this -> select() 
        		-> from(array("d"=>new Zend_Db_Expr("(SELECT abstract_idAbstract, CONCAT('<strong>',familyData, '</strong> : ', GROUP_CONCAT(distinct keywordData SEPARATOR ', ')) as keywords
        											FROM `abstract-keyword` AS `ak`
        											INNER JOIN `keyword-pcr` AS `k` ON k.idKeyword = ak.keyword_idKeyword 
        											INNER JOIN `keyword-family-pcr` AS `f` ON k.idFamily = f.idFamily 
        											group by f.idFamily, ak.abstract_idAbstract)")), new Zend_Db_Expr("group_concat(distinct keywords SEPARATOR '.<br/> ') AS keyword"))
        		->join(array("a"=>'abstract'), "a.idAbstract = d.abstract_idAbstract", array('a.title', 'a.idAbstract', 'idDefinitive'))
        		->join(array("dc"=>'decision'), "dc.idAbstract = a.idAbstract", null)
       			->join('author', 'author.idAbstract = a.idAbstract', "GROUP_CONCAT(distinct CONCAT(`author`.`lastName`,' ',CONCAT(LEFT(`author`.`firstName`,1),'.')) ORDER BY author.order ASC SEPARATOR ' - ') as authors")
       			->join(array("ak"=>'abstract-keyword'), 'ak.abstract_idAbstract = a.idAbstract ', null)
        		->setIntegrityCheck(false)
       			->where("dc.decision = 'accepted'")
       			->where("dc.idPassage IN (".Zend_Registry::get('config')->resume->passage.")")
        		->where("keyword_idKeyword IN (?)", $keywords)
        		->group("d.abstract_idAbstract")
        		->having(new Zend_Db_Expr("COUNT(distinct keyword_idKeyword) = ".count($keywords)));

        
        if(Zend_Registry::get('config')->option->view == true){
	       	$select->join('view', 'view.idAbstract = a.idAbstract', 'view');
       	}

        $result = $this ->fetchAll($select);

		$tab = array();
		foreach($result as $res){
			if(!array_key_exists($res->idAbstract, $tab)){
				$tab[$res->idAbstract] = array();
			}
			
			$tab[$res->idAbstract]['title'] = $res->title;
			$tab[$res->idAbstract]['idDefinitive'] = $res->idDefinitive;
			$tab[$res->idAbstract]['authors'] = $res->authors;
			if(Zend_Registry::get('config')->option->keyword == true){
				$tab[$res->idAbstract]['keyword'] = $res->keyword;
			}
			if(Zend_Registry::get('config')->option->view == true){
				$tab[$res->idAbstract]['view'] = $res->view;
			}
		}

        return $tab; 
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function getAbstractDirectory() 
    {

    	$select = $this -> select() 
        		-> from('abstract', array('idUser', 'idAbstract', 'title'))
       			->join('abstractFile', 'abstractFile.idAbstract = abstract.idAbstract', array('pathFile'))
        		->setIntegrityCheck(false)
        		->where('abstractFile.pathFile LIKE (?)', '%.ppt%');
        		//->where('decision.decision = "rejected"');
        $result = $this ->fetchAll($select);
        return $result;
    
    }
    
    
    public function updateAbstract($id, $preview, $moderate)
    {
    	$this->update(array('previewPassed'=>$preview, 'moderateSession'=>$moderate), 'idPoster ='.$id);
    }
    
    
    public function deleteVideo($id)
    {
    	$this->update(array('previewPassed'=>0), 'idPoster ='.$id);
    }
    
    public function updateViewSlideAbstract($id)
    {
    	$this->update(array('viewSlide'=>new Zend_Db_Expr('viewSlide + 1')), 'idPoster ='.$id);
    }
    public function updateViewVideoAbstract($id)
    {
    	$this->update(array('viewVideo'=>new Zend_Db_Expr('viewVideo + 1')), 'idPoster ='.$id);
    }

    
    public function getAllAbstractViewed($search) 
    {    	
    	
    	$rechercheMin = strtolower($search);
		$rechercheMaj = strtoupper($search); 
    	
    	$select = $this -> select() 
        		-> from('abstract')
       			->joinLeft('assess', 'assess.idCases = abstract.idCases AND assess.idAbstract = abstract.idAbstract', '')
       			->join('decision', 'decision.idCases = abstract.idCases AND decision.idAbstract = abstract.idAbstract')
       			->joinLeft('note', 'note.idPoster = abstract.idPoster', 'AVG(note) as notation')
       			->join('author', 'author.idCases = abstract.idCases AND author.idAbstract = abstract.idAbstract', array('lastName', 'initials', 'city'))
       			->distinct(array('abstract.idPoster', 'abstract.idUser'))
        		->setIntegrityCheck(false)
        		->where("LOWER(title) LIKE '%".$rechercheMin."%' OR UPPER(title) LIKE '%".$rechercheMaj."%' OR UPPER(author.lastName) LIKE '%".$rechercheMaj."%' OR LOWER(author.lastName) LIKE '%".$rechercheMin."%'")
        		->where('decision.decision = "rejected"')
        		->where('author.main = 1')
       			->group('idPoster')
       			->order(array('viewSlide DESC', 'abstract.moderateSession DESC', 'assess.assess DESC', 'title ASC'));
		
        $result = $this ->fetchAll($select);
        return $result; 
    }

    public function getAllAbstractNote($search) 
    {    	
    	
    	$rechercheMin = strtolower($search);
		$rechercheMaj = strtoupper($search); 
    	
    	$select = $this -> select() 
        		-> from('abstract')
       			->joinLeft('assess', 'assess.idCases = abstract.idCases AND assess.idAbstract = abstract.idAbstract', '')
       			->join('decision', 'decision.idCases = abstract.idCases AND decision.idAbstract = abstract.idAbstract')
       			->joinLeft('note', 'note.idPoster = abstract.idPoster', 'AVG(note) as notation')
       			->join('author', 'author.idCases = abstract.idCases AND author.idAbstract = abstract.idAbstract', array('lastName', 'initials', 'city'))
       			->distinct(array('abstract.idPoster', 'abstract.idUser'))
        		->setIntegrityCheck(false)
        		->where("LOWER(title) LIKE '%".$rechercheMin."%' OR UPPER(title) LIKE '%".$rechercheMaj."%' OR UPPER(author.lastName) LIKE '%".$rechercheMaj."%' OR LOWER(author.lastName) LIKE '%".$rechercheMin."%'")
        		->where('decision.decision = "rejected"')
        		->where('author.main = 1')
       			->order(array('notation DESC', 'abstract.moderateSession DESC', 'assess.assess DESC', 'title ASC'))
       			->group('idPoster');
		
        $result = $this ->fetchAll($select);
        return $result; 
    }

    public function getAllAbstractModerate($search) 
    {
    	
    	$rechercheMin = strtolower($search);
		$rechercheMaj = strtoupper($search); 
    	
    	$select = $this -> select() 
        		-> from('abstract')
       			->joinLeft('assess', 'assess.idCases = abstract.idCases AND assess.idAbstract = abstract.idAbstract', '')
       			->join('decision', 'decision.idCases = abstract.idCases AND decision.idAbstract = abstract.idAbstract')
       			->joinLeft('note', 'note.idPoster = abstract.idPoster', 'AVG(note) as notation')
       			->join('author', 'author.idCases = abstract.idCases AND author.idAbstract = abstract.idAbstract', array('lastName', 'initials', 'city'))
       			->distinct(array('abstract.idPoster', 'abstract.idUser'))
        		->setIntegrityCheck(false)
        		->where("LOWER(title) LIKE '%".$rechercheMin."%' OR UPPER(title) LIKE '%".$rechercheMaj."%' OR UPPER(author.lastName) LIKE '%".$rechercheMaj."%' OR LOWER(author.lastName) LIKE '%".$rechercheMin."%'")
        		->distinct('abstract.idPoster')
        		->where('decision.decision = "rejected"')
        		->where('author.main = 1')
       			->group('idPoster')
				->where('abstract.moderateSession = 1')
       			->order(array('abstract.moderateSession DESC', 'assess.assess DESC', 'title ASC'));
		
        $result = $this ->fetchAll($select);
        return $result; 
    }

    public function getAllAbstractChoice($choix, $search) 
    {
    	
    	$rechercheMin = strtolower($search);
		$rechercheMaj = strtoupper($search); 
    	
    	$select = $this -> select() 
        		-> from('abstract')
       			->joinLeft('assess', 'assess.idCases = abstract.idCases AND assess.idAbstract = abstract.idAbstract', '')
       			->join('decision', 'decision.idCases = abstract.idCases AND decision.idAbstract = abstract.idAbstract')
       			->joinLeft('note', 'note.idPoster = abstract.idPoster', 'AVG(note) as notation')
       			->join('author', 'author.idCases = abstract.idCases AND author.idAbstract = abstract.idAbstract', array('lastName', 'initials', 'city'))
       			->distinct(array('abstract.idPoster', 'abstract.idUser'))
        		->setIntegrityCheck(false)
        		->where("LOWER(title) LIKE '%".$rechercheMin."%' OR UPPER(title) LIKE '%".$rechercheMaj."%' OR UPPER(author.lastName) LIKE '%".$rechercheMaj."%' OR LOWER(author.lastName) LIKE '%".$rechercheMin."%'")
        		->distinct('abstract.idPoster')
        		->where('decision.decision = "rejected"')
        		->where('author.main = 1')
       			->group('idPoster')
				->where('abstract.idCases = ?', $choix)
       			->order(array('abstract.moderateSession DESC', 'assess.assess DESC', 'title ASC'));
		
        $result = $this ->fetchAll($select);
        return $result; 
    }
			

}




