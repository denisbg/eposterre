<?php

if(isset($_POST['choix']))
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




	if($_POST['choix'] == 0)
	{
		$query = 'SELECT distinct title, author.city, author.initials, author.lastName, abstract.idPoster, abstract.idCases, previewPassed  
				FROM abstract, decision, assess, author  
				WHERE decision.idAbstract = abstract.idAbstract
				AND decision.idCases = abstract.idCases
				AND assess.idAbstract = abstract.idAbstract
				AND assess.idCases = abstract.idCases
				AND author.idAbstract = abstract.idAbstract
				AND author.idCases = abstract.idCases
				AND author.main=1
				AND decision.decision = "rejected"
				ORDER BY abstract.moderateSession DESC, assess.assess DESC, title ASC';
				
	}
	elseif($_POST['choix'] == 3)
	{
	
		$query = 'SELECT distinct title, author.city, author.initials, author.lastName, abstract.idPoster, abstract.idCases, previewPassed  
				FROM abstract, decision, assess, author    
				WHERE decision.idAbstract = abstract.idAbstract
				AND decision.idCases = abstract.idCases
				AND assess.idAbstract = abstract.idAbstract
				AND assess.idCases = abstract.idCases
				AND author.idAbstract = abstract.idAbstract
				AND author.idCases = abstract.idCases
				AND decision.decision = "rejected"
				AND author.main=1
				AND abstract.moderateSession = 1
				ORDER BY abstract.moderateSession DESC, assess.assess DESC, title ASC';
				
	}
	else
	{

		$query = 'SELECT distinct title, author.city, author.initials, author.lastName, abstract.idPoster, abstract.idCases, previewPassed  
				FROM abstract, decision, assess, author    
				WHERE decision.idAbstract = abstract.idAbstract
				AND decision.idCases = abstract.idCases
				AND assess.idAbstract = abstract.idAbstract
				AND assess.idCases = abstract.idCases
				AND author.idAbstract = abstract.idAbstract
				AND author.idCases = abstract.idCases
				AND decision.decision = "rejected"
				AND author.main=1
				AND abstract.idCases = '.$_POST['choix'].'
				ORDER BY abstract.moderateSession DESC, assess.assess DESC, title ASC';
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
				echo '<li>';
			}
	
			$i++;
    	
			
			?>
			
			<div class="abstract">
            <h3><?php echo html_entity_decode($row[0]); ?></h3>
            <p>
            <?php
                echo $row[2].' '.$row[3].' - '.$row[1].' - ';


                if($row[5]==1)
                {
                    echo 'Clinical tips & tricks';
                }
                else
                {
                    echo 'Complications';
                }

            ?>
            </p>
        </div>
        <div class="abstract-btns">
            <?php if($row[6] == 1)
            {
            ?>

                <a href="/<?php echo $tab[1]; ?>/index/video/abstract/<?php echo $row[4]; ?>" title="Vidéo" class="btn-video">
                    <span>Vidéo</span>
                </a>&nbsp;

            <?php
            }
            ?>      
        
            <a href="/<?php echo $tab[1]; ?>/index/slide/abstract/<?php echo $row[4]; ?>" title="Diaporama" class="btn-diapo">
                <span>Diaporama</span>
            </a>
        </div>
		</li>
			
			
		<?php
    		
		}while($row = $resultats->fetch());
		echo '</ul>';
	}
	else
	{
	
		echo '<p align="center"><strong>No result</strong></p>';
		
	}

}

