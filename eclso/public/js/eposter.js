/**
 * ePoster
 *
 * @author Cindy Chusseau
 * @copyright EUROPA ORGANISATION ©2010
 * @version 1.0
 */
 
/**
 * ePoster
 * @package js
 */


/**
 * -----------------------------------------------------------------------------------
 * COMMON FUNCTIONS
 * -----------------------------------------------------------------------------------
 */

/**
 * Send an AJAX request
 * @param url
 * @param data
 */
function sendAjaxRequest(url, data, callback) {
  $.ajax({
	  type: "GET",
	  url: url,
	  data: data,
	  success: function(message) {
		  if (callback) {
			  callback();
		  }
	  },
	  error: function(xhr) {
		  alert("KO : " + xhr.status);
	  }
  });
}

/**
 * Send an AJAX request and load response content in the specified container
 * @param containerId
 * @param url
 * @param data
 */
function showView(containerId, url, data, callback) {
	$.ajax({
		type: "GET",
		url: url,
		data: data,
		success: function(content) {
			$("#" + containerId).html(content);
			if (callback) {
		
				callback();
			}
		
		},
		error: function(xhr) {
			alert("KO : " + xhr.status);
		}
	});	
}


function showViewPost(containerId, url, data, callback) {
	$.ajax({
		type: "POST",
		url: url,
		data: data,
		success: function(content) {
			$("#" + containerId).html(content);
			if (callback) {
		
				callback();
			}
		
		},
		error: function(xhr) {
			alert("KO : " + xhr.status);
		}
	});	
}

/**
* -----------------------------------------------------------------------------------
* Recherche 
* -----------------------------------------------------------------------------------
*/
var closeListe = true;

function chercher(admin){
	var recherche = $('input[id="search"]').val();
	var choix = $('#choix').val();
		
	if(recherche.length > 0){
		showViewPost('resultatRecherche', baseUrl+'/index/search', {search:recherche,choice:choix,admin:admin}, function(){$('#resultatRecherche').show();})
	}else if(recherche=='' || recherche.length < 1){
		$("#resultatRecherche").css("display", "none");
	}
}

function setChoice(){
	var choix = $('#choix').val();
	showViewPost('listeAbstract', baseUrl+'/index/listecomplete', {choice:choix})
	
}

/*
function afficher(admin)
{

	choix = document.getElementById('choix').options[document.getElementById('choix').selectedIndex].value;


	var xhr = Xhr();
    xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                var res = xhr.responseText;
                document.getElementById('listeAbstract').innerHTML = res;
            }
            else
            if (xhr.readyState == 4) alert(" Probleme de connexion au serveur")
    }
    
    if(admin == 1)
    {
    	xhr.open("POST",'/ePoster/public/php/afficherAdmin.php',true);
    }
    else
    {
		xhr.open("POST",'/ePoster/public/php/afficher.php',true);
	}
    
	
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xhr.send("choix="+choix);

}
*/

function Xhr()
    {
       var objRequete = null;
       try { objRequete = new ActiveXObject("Microsoft.XMLHTTP");}
       catch(Error) {
           try { objRequete = new ActiveXObject("MSXML2.XMLHTTP");}
           catch(Error) {
               try { objRequete = new XMLHttpRequest();
                 // pour éviter un bogue du navigateur Safari
                 if (objRequete.overrideMimeType)
                 {
                         objRequete.overrideMimeType("text/xml")
                 }
                }
               catch(Error) { alert(' Impossible de créer l\'objet XMLHttpRequest')}
           }
      }
      return  objRequete;
    }
    
    
    

/**
* -----------------------------------------------------------------------------------
* Slideshow
* -----------------------------------------------------------------------------------
*/
var slide;
var slideMin;
var idName;

function init(){

	if(slide == 0)document.getElementById('prevSlide').style.display ='none'
	if(document.getElementById("prevMiniature") && slideMin == 0) document.getElementById("prevMiniature").style.display ="none";
	if(document.getElementById("nextMiniature") && slideMin >= tab.length-5) document.getElementById("nextMiniature").style.display ="none";
}



function slideShow(direction, id)
{
	
	idName = id;
	if(direction == 2 )
	{
		if(slide<tab.length-1)
		{
			slide++;
		}
	
		if(slide == tab.length){overlay($('#slideView'), baseUrl, idAbstract)}
	
		if(slide == tab.length-1) //supprime l'affichage du bouton suivant si la slide affichée est la derniere du diapo
		{
			alert('je cache')
			$('#nextSlide').hide();
		}

	
		if(tab[slide] =='/ePoster/public/images/options.png'){
			$('#slide').removeAttr('ondblclick');
			overlay($('#slideView'), baseUrl, idAbstract);
		}


		if(idName == 'slideFullScreen' && slide == tab.length-2 && tab[tab.length-1]=='/ePoster/public/images/options.png' ){
			document.getElementById('nextSlide').style.display ='none'
			
		}
		
		if(slide > 0) //affiche le bouton suivant sila slide affichée et l'avant derniere ou avant l'avant derniere
		{
			document.getElementById('prevSlide').style.display ='block'
		}
	
		if(idName != 'slideFullScreen'){	
		
			diapo0 = tab[0].substring(tab[0].lastIndexOf('/')+1, tab[0].length)
			firstDiapo = diapo0.replace('Diapositive', '').replace('.PNG', '')
			
			dern = document.getElementById('slideMiniature4').src
			derniere =dern.substring(dern.lastIndexOf('/')+1, dern.length).replace('Diapositive', '').replace('.PNG', '')
			
			if(firstDiapo == 0)
			{
				lastDiapo = tab.length-1
			}
			else
			{
				lastDiapo = tab.length
			}

			if(lastDiapo > derniere)slideMiniature(2)
		}
		
	}
	else
	{
		
		slide--;
		
		
		if(tab[slide] !='/ePoster/public/images/options.png'){
			deleteOverlay();
			$('#slide').dblclick(function(){'fullscreen('+baseUrl+', '+tab[slide]+')'});
		}
		
		if(slide==tab.length-1){deleteOverlay();}
		
		if(slide == 0) //affiche le bouton suivant sila slide affichée et l'avant derniere ou avant l'avant derniere
		{
			document.getElementById('prevSlide').style.display ='none'
		}
		
		if(slide < tab.length-1) //affiche le bouton suivant sila slide affichée et l'avant derniere ou avant l'avant derniere
		{
			document.getElementById('nextSlide').style.display ='block'
		}
		
		if(idName != 'slideFullScreen'){
	
			diapo0 = tab[0].substring(tab[0].lastIndexOf('/')+1, tab[0].length)
			firstDiapo = diapo0.replace('Diapositive', '').replace('.PNG', '')
			
			prem = document.getElementById('slideMiniature0').src
			premiere =prem.substring(prem.lastIndexOf('/')+1, prem.length).replace('Diapositive', '').replace('.PNG', '')

			if(premiere >firstDiapo )slideMiniature(1)
		}
	}
	
	document.getElementById(idName).src = tab[slide];
	slideScreen()
}


function slideMiniature(direction)
{

	if(direction == 2 ) //vers la fin du diapo
	{
		slideMin++;
		
		if(slideMin+5 == tab.length) //cache le bouton suivant si la derniere diapo est affichée en derniere position des miniature
		{
			document.getElementById('nextMiniature').style.display ='none'
			$('#slideMiniature4').click(function(){overlay($('#slideView'), baseUrl, idAbstract)})
			
		}
	
		if(slideMin > 0)
		{
			document.getElementById('prevMiniature').style.display ='block'

		}
	
		var slide = slideMin;
				

	}
	else //vers le debut du diapo
	{
		
		slideMin--;
		if(slideMin+5 == tab.length-1) // réaffiche le bouton suivant, si décalage vers la gauche
		{
			document.getElementById('nextMiniature').style.display ='block'

		}
		
		
		if(slideMin == 0)
		{
			document.getElementById('prevMiniature').style.display ='none'
			

		}
		
		var slide = slideMin;
		
	}
	
	
	for(var i = 0 ; i<5; i++)
	{
		document.getElementById('slideMiniature'+i).src = tab[slide];
		slide ++;
	}
	slideScreen();
}



function showSlide(slideChoisie)
{
	
	diapo = document.getElementById(slideChoisie).src
	document.getElementById(idName).src = diapo

	if($('#modal').size()>0){deleteOverlay();}

	for(var i =0;i<tab.length;i++)
	{
		if(tab[i].substring(tab[i].lastIndexOf('/')+1, tab[i].length) == diapo.substring(diapo.lastIndexOf('/')+1, diapo.length))
		{
			slide = i;
		}
	}
	
	
	if(slide > 0)
	{
		document.getElementById('prevSlide').style.display ='block'

	}
		
	slideScreen();
	
}



function slideScreen()
{

	diapo = document.getElementById(idName).src

	if(idName != 'slideFullScreen'){

		for(var i =0;i<5;i++)
		{
		
			if(document.getElementById('slideMiniature'+i).className == "miniature actif")
			{
			 	actif = i;
			 	break;
			}
			else
			{
				actif=-1;
			}
		
		}
	
		for(var i =0;i<5;i++)
		{
			mini = document.getElementById('slideMiniature'+i).src
		
			if(mini.substring(mini.lastIndexOf('/')+1, mini.length) == diapo.substring(diapo.lastIndexOf('/')+1, diapo.length)) //si miniature de la diapo est présente dans la liste 
			{
				diapoEnCours = mini.substring(mini.lastIndexOf('/')+1, mini.length).replace('Diapositive', '').replace('.PNG', '');

			
				diapo0 = tab[0].substring(tab[0].lastIndexOf('/')+1, tab[0].length)
				firstDiapo = diapo0.replace('Diapositive', '').replace('.PNG', '')

				if(diapoEnCours == firstDiapo) //suppression du bouton precedent si la diapo choisie est la premiere
				{
					 document.getElementById('prevSlide').style.display ='none'
				}
				else
				{
					document.getElementById('prevSlide').style.display ='block'
				}
			
				if(firstDiapo == 0)
				{
					lastDiapo = tab.length-1
				}
				else
				{
					lastDiapo = tab.length
				}
	
				if(diapoEnCours == 'options.png') //suppression du bouton suivant si la diapo choisie est la derniere
				{
					 document.getElementById('nextSlide').style.display ='none'
					 $('#slide').unbind('dbclick');
				
				}
				else
				{
					document.getElementById('nextSlide').style.display ='block'
				}
			
			
				if(actif!=-1)document.getElementById('slideMiniature'+actif).className = "miniature"
				document.getElementById('slideMiniature'+i).className="miniature actif"
				break;
			
			}
			else
			{
				if(actif!=-1)document.getElementById('slideMiniature'+actif).className = "miniature"
			}
			
		}
	}

}

/**
* -----------------------------------------------------------------------------------
* Overlay
* -----------------------------------------------------------------------------------
*/

function overlay(obj, baseUrl){
	if($('#modal').size() == 0){ //ajout de la modal
		$('#'+obj).append('<div id="modal"></div>');
	}	
}

function deleteOverlay(){
	if($('#modal').size() > 0){ //ajout de la modal
		$('#modal').remove();
	}	
}

/**
* -----------------------------------------------------------------------------------
* Email
* -----------------------------------------------------------------------------------
*/

function sendEmail(conteneur, baseUrl, idAbstract, type){
	overlay(conteneur, baseUrl);
	
	showView('modal', baseUrl+'/index/mailer', {abstract:idAbstract, type:type});
}

function checkFormMail(baseUrl, idAbstract, type){
	if($('#subject').val() != '' && $('#message').val() != ''){
		showViewPost('modal', baseUrl+'/index/mailer', {'abstract':idAbstract, 'type':type, 'name':$('#name').val(), 'mail':$('#mail').val(), 'subject':$('#subject').val(), 'message':$('#message').val()})
	}else{
		if($('#mail').val() == ''){
			$('#mail').addClass('errors');
		}else{
			$('#mail').removeClass('errors');
		}
		
		if($('#subject').val() == ''){
			$('#subject').addClass('errors');
		}else{
			$('#subject').removeClass('errors');
		}
		
		if($('#message').val() == ''){
			$('#message').addClass('errors');
		}else{
			$('#message').removeClass('errors');
		}
	}
}

/**
* -----------------------------------------------------------------------------------
* Commentaire
* -----------------------------------------------------------------------------------
*/

function addComment(conteneur, baseUrl, idAbstract, type){
	overlay(conteneur, baseUrl);
	showView('modal', baseUrl+'/index/commenter', {abstract:idAbstract, type:type});
}


function checkFormComment(baseUrl, idAbstract, type){
	if($('#name').val() != '' && $('#comment').val() != ''){
		showViewPost('modal', baseUrl+'/index/commenter', {'abstract':idAbstract, 'type':type, 'name':$('#name').val(), 'comment':$('#comment').val()})
	}else{
		if($('#name').val() == ''){
			$('#name').addClass('errors');
		}else{
			$('#name').removeClass('errors');
		}
		
		if($('#comment').val() == ''){
			$('#comment').addClass('errors');
		}else{
			$('#comment').removeClass('errors');
		}
	}
}



//other


function overlayVideo(obj, baseUrl, idAbstract){
		if($('#modal').size() == 0){ //ajout de la modal
			
			$(obj).children('object').css('display', 'none');
			$('#option').css('display', 'none');
			
			$(obj).append('<div id="modal" class="modalVideo"></div>');
			$('#modal').width($(obj).children('object').width());
			$('#modal').height($(obj).children('object').height());
			showView('modal', baseUrl+'/index/showoption', {'abstract':idAbstract, 'type':'video'}, function(){addNote(baseUrl, idAbstract, 'video'); return false;});
		}	
}

function deleteOverlayVideo(){

		if($('#modal').size() > 0){ //ajout de la modal
			$('#modal').remove();
			$('#videoView').children('object').css('display', 'inline-block');
			$('#option').css('display', 'block');
		}	
}


/**
* -----------------------------------------------------------------------------------
* Notation
* -----------------------------------------------------------------------------------
*/

function addNote(baseUrl, idAbstract, categorie){
	$(document).ready(function(){
	
		$("#stars-wrapper2").stars({
			inputType: "select",
			oneVoteOnly: true,
			callback: function(ui, type, value){
			
        		sendAjaxRequest(baseUrl+'/index/noter', {'abstract':idAbstract, 'note':value, 'type':categorie}); //sauvegarde de la note
        			
        		/*Message de sauvegarde de la note*/
        		//$("#ratingScore").html("Rating saved! ("+value+")").stop().css("opacity", 1).fadeIn(30);
         		//setTimeout(function(){ $("#ratingScore").fadeOut(1000) }, 1000);
        	}
		});

	
	});
}

/**
* -----------------------------------------------------------------------------------
* Relancer
* -----------------------------------------------------------------------------------
*/
 function relancerSlide(){
 	
 	document.getElementById('slide').src = tab[0];
 	$(document).ready(function(){
 		deleteOverlay();
 	})
 	
 	for(i=0; i<5;i++){
 		document.getElementById('slideMiniature'+i).src = tab[i];
 	}
 	
 	$('#slideMiniature4').removeClass('actif');
 	$('#slideMiniature0').addClass('actif');
 	$('#prevSlide').css('display', 'none');
 	$('#nextSlide').css('display', 'block');
 	$('#prevMiniature').css('display', 'none');
 	$('#nextMiniature').css('display', 'block');
 	
 	slide=0;
 	slideMin=0;
 	
 }
 
 
 
 /**
* -----------------------------------------------------------------------------------
* Full scree
* -----------------------------------------------------------------------------------
*/


function fullscreen(idAbstract, slide){

		if($('#fullScreen').size() == 0){ //ajout de la modal
			
			
			diapo0 = slide.substring(slide.lastIndexOf('/')+1, slide.length)
			Diapo = diapo0.replace('Diapositive', '').replace('.PNG', '')
			
			$('body').append('<div id="fullScreen"></div>');
			showView('fullScreen', baseUrl+'/index/slide', {'abstract':idAbstract, 'diapo':Diapo, 'full':true}, function(){initFullScreen(Diapo)});
			
		}

}

function initFullScreen(diapo){
	$('#content').remove();
	$('#slide').attr('id', 'slideFullScreen');
	
	/*Suppression du content*/
	$('#listeMiniature').remove(); 
	$('#infoAbstract').css('display', 'none'); 
	
	$('#fullScreen').children('h3').remove(); 
	$('#fullScreen').children('p').remove(); 
	
	if(diapo == 1)$('#prevSlide').css('display', 'none'); 
	
	/*Hauteur*/
	var height = $(document).height()-60
	$('#slideFullScreen').attr('height', height); 
	$('#slideView').height($(document).height());
	$('#slideView').css('margin-bottom', '30');
	
	slide = slide -1;
	
	$('#fullScreen').append('<a id="closefullscreen" onclick="closeFullScreen();return false;"><span>Close</span></a>');
}


function closeFullScreen(){

	if($('#fullScreen').size() > 0){ //ajout de la modal
		
		$('#page').append('<div id="content"></div>');
		
		/*Diapo en cours*/
		slide = $('#slideFullScreen').attr('src');
		src = slide.substring(slide.lastIndexOf('/')+1, slide.length)
		Diapo = src.replace('Diapositive', '').replace('.PNG', '')
	

		
		showView('content', baseUrl+'/index/slide', {'abstract':idAbstract, 'diapo':Diapo, 'full':false} , function(){$('#fullScreen').remove();addNote(baseUrl, idAbstract, 'slide'); return false;});
	}	
}




 