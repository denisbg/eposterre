<?php

if(isset($_POST['search']) && isset($_POST['choix']))
{

	if($_POST['search'] != '' )
	{
	
		$PARAM_hote='localhost'; // le chemin vers le serveur
		$PARAM_nom_bd='intranet_eposter'; // le nom de votre base de données
		$PARAM_utilisateur='cchusseau'; // nom d'utilisateur pour se connecter
		$PARAM_mot_passe='2cls451'; // mot de passe de l'utilisateur pour se connecter
	
		try 
		{ 
			$connexion = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
			$connexion->query('SET NAMES UTF8');
		} 
		catch (PDOException $e) 
		{ 
   			die( "Erreur ! : " . $e->getMessage() ); 
		}

		$tab =  explode('/', $_SERVER['PHP_SELF']); //url


		$rechercheMin = strtolower($_POST['search']);

		if($_POST['choix'] == 0)
		{
			$query = 'SELECT distinct title, author.city, author.initials, author.lastName, abstract.idPoster, abstract.idCases, previewPassed  
				FROM abstract, decision, author  
				WHERE decision.idAbstract = abstract.idAbstract
				AND decision.idCases = abstract.idCases
				AND author.idAbstract = abstract.idAbstract
				AND author.idCases = abstract.idCases
				AND decision.decision = "rejected"
				AND author.main=1
				AND (LOWER(author.lastName) LIKE "%'.$rechercheMin.'%"
				OR LOWER(title) LIKE "%'.$rechercheMin.'%")';
		}
		elseif($_POST['choix'] == 3)
		{
	
			$query = 'SELECT distinct title, author.city, author.initials, author.lastName, abstract.idPoster, abstract.idCases, previewPassed  
				FROM abstract, decision, author  
				WHERE decision.idAbstract = abstract.idAbstract
				AND decision.idCases = abstract.idCases
				AND author.idAbstract = abstract.idAbstract
				AND author.idCases = abstract.idCases
				AND decision.decision = "rejected"
				AND author.main=1
				AND abstract.moderateSession = 1
				AND (LOWER(author.lastName) LIKE "%'.$rechercheMin.'%"
				OR LOWER(title) LIKE "%'.$rechercheMin.'%")';
				
		}
		else
		{

			$query = 'SELECT distinct title, author.city, author.initials, author.lastName, abstract.idPoster, abstract.idCases, previewPassed 
				FROM abstract, decision, author 
				WHERE decision.idAbstract = abstract.idAbstract
				AND decision.idCases = abstract.idCases
				AND author.idAbstract = abstract.idAbstract
				AND author.idCases = abstract.idCases
				AND decision.decision = "rejected"
				AND author.main=1
				AND abstract.idCases = '.$_POST['choix'].'
				AND (LOWER(author.lastName) LIKE "%'.$rechercheMin.'%"
				OR LOWER(title) LIKE "%'.$rechercheMin.'%")';
		}
		
		
		$resultats=$connexion->query($query);
		$resultats->setFetchMode(PDO::FETCH_BOTH);
		$row = $resultats->fetch();
	
		if(count($row)!=1)
		{
			echo '<ul>';
			$i=0;
    		do
    		{ 
   		
   				if($i%2==0)
				{
					echo '<li class="lineColor">';
				}
				else
				{
					echo '<li  class="line">';
				}
	
				$i++;
   		    	$replace = array($_POST['search'] => '<span class="highlight">'.$_POST['search'].'</span>', ucFirst($_POST['search'])=>'<span class="highlight">'.ucFirst($_POST['search']).'</span>', strtoupper($_POST['search'])=>'<span class="highlight">'.strtoupper($_POST['search']).'</span>');
    				
   				echo '<a href="/'.$tab[1].'/admin/modifier/abstract/'.$row[4].'" title="'.$row[0].'" onmouseover="closeListe = false;" onmouseout="closeListe = true;">'.strtr($row[0], $replace).'</a>';
    				
    			echo '<p>'.str_replace($_POST['search'], '<span class="highlight">'.$_POST['search'].'</span>', $row[2]).' '.$row[3].' - '.$row[1].' - ';

				if($row[5]==1)
				{
					echo 'Clinical tips & tricks';
				}
				else
				{
					echo 'Complications';
				}
			
				echo '</p></li>';
    		
			
			}while($row = $resultats->fetch());
		echo '</ul>';
		}
		else
		{
	
			echo '<ul><li class="lineColor">No result</li></ul>';
		
		}
		
		
	}	

}

