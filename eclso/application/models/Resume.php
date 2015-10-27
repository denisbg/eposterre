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
       			->join('author', 'author.idAbstract = abstract.idAbstract', array('lastName', 'initials', 'city'))
       			->joinLeft('view', 'view.idAbstract = abstract.idAbstract', array('viewSlide', 'viewVideo'))
        		//->where('author.main = 1')
        		->setIntegrityCheck(false)
        		->where('abstract.idAbstract = ?', $id)
        		->order('author.main ASC')
        		->limit(1, 0);

        $result = $this ->fetchAll($select);
        return $result;
    }
    
    public function getAllAbstract($search, $category = null, $admin = 0) 
    {
    	
    	$rechercheMin = strtolower($search);
		$rechercheMaj = strtoupper($search); 

    	$select = $this -> select() 
        		->from('abstract', array('abstract.title', 'abstract.idAbstract', 'idDefinitive', 'deleted'))
       			->joinLeft('view', 'view.idAbstract = abstract.idAbstract', array('viewSlide', 'viewVideo'))
       			->join('category', 'category.idCategory = abstract.idCategory', array('name'))
       			->join('author', 'author.idAbstract = abstract.idAbstract', array('author.firstName', 'author.lastName', 'author.initials', 'author.city', 'author.order', 'author.country'))
       			//->distinct(array('abstract.idAbstract', 'abstract.idUser'))
        		->setIntegrityCheck(false)
        		->where("LOWER(abstract.idDefinitive) LIKE '%".$rechercheMin."%' OR UPPER(abstract.idDefinitive) LIKE '%".$rechercheMaj."%' OR LOWER(abstract.title) LIKE '%".$rechercheMin."%' OR UPPER(abstract.title) LIKE '%".$rechercheMaj."%' OR abstract.idAbstract IN (SELECT author.idAbstract FROM author WHERE UPPER(author.lastName) LIKE '%".$rechercheMaj."%' OR LOWER(author.lastName) LIKE '%".$rechercheMin."%')")
				//->order(array('abstract.idAbstract ASC', 'author.order ASC'));
				->order(array('abstract.idDefinitive ASC', 'abstract.idCategory ASC', 'author.order ASC'));
				if($admin == 0){
					$select->where('abstract.deleted = 0');
				}
        		/*->distinct('abstract.idAbstract')
        		->where('author.main = 1')
       			->group('abstract.idAbstract')*/
       			
       			
       			if($category != null && $category!= 0){ $select->where('abstract.idCategory = '.$category); }

        $result = $this->fetchAll($select);

		$tab = array();
		foreach($result as $res){
			if(!array_key_exists($res->idAbstract, $tab)){
				$tab[$res->idAbstract] = array();
			}
			$tab[$res->idAbstract]['title'] = $res->title;
			$tab[$res->idAbstract]['deleted'] = $res->deleted;
			$tab[$res->idAbstract]['name'] = $res->name;
			$tab[$res->idAbstract]['viewSlide'] = $res->viewSlide;
			$tab[$res->idAbstract]['viewVideo'] = $res->viewVideo;
			$tab[$res->idAbstract]['idDefinitive'] = $res->idDefinitive;
			$tab[$res->idAbstract]['idAbstract'] = $res->idAbstract;
			if(!array_key_exists('author', $tab[$res->idAbstract])) $tab[$res->idAbstract]['author'] = array();
			$tab[$res->idAbstract]['author'][$res->order] = array('initials'=>$res->initials, 'lastName'=>$res->lastName, 'city' => $res->city, 'country' => $res->country);
		}
        return $tab; 
    }
    
    
    public function getAbstractDirectory() 
    {

    	$select = $this -> select() 
        		-> from('abstract', array('idUser', 'idAbstract', 'title'))
       			->join('abstract-file', 'abstract-file.idAbstract = abstract.idAbstract', array('pathFile'))
        		->setIntegrityCheck(false)
        		->where('abstract-file.pathFile LIKE (?)', '%.ppt%')
        		->where('deleted = 0');
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
			
    public function deleteAbstract($id)
    {
    	$this->update(array('deleted'=>1), 'idAbstract ='.$id);
    }
	
	public function activeAbstract($id)
    {
    	$this->update(array('deleted'=>0), 'idAbstract ='.$id);
    }
}




