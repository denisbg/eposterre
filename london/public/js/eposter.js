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

function sendEmail(conteneur, baseUrl, idAbstract){
	overlay(conteneur, baseUrl);
	
	showView('modal', baseUrl+'/index/mailer', {abstract:idAbstract});
}

function checkFormMail(baseUrl, idAbstract, type){
	if($('#subject').val() != '' && $('#message').val() != ''){
		showViewPost('modal', baseUrl+'/index/mailer', {'abstract':idAbstract, 'name':$('#name').val(), 'mail':$('#mail').val(), 'subject':$('#subject').val(), 'message':$('#message').val()})
	}else{
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

function addComment(conteneur, baseUrl, idAbstract){
	overlay(conteneur, baseUrl);
	showView('modal', baseUrl+'/index/commenter', {abstract:idAbstract});
}


function checkFormComment(baseUrl, idAbstract){
	if($('#name').val() != '' && $('#comment').val() != ''){
		showViewPost('modal', baseUrl+'/index/commenter', {'abstract':idAbstract, 'name':$('#name').val(), 'comment':$('#comment').val()})
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

/**
* -----------------------------------------------------------------------------------
* Notation
* -----------------------------------------------------------------------------------
*/
function addNote(baseUrl, idAbstract){
	$(document).ready(function(){
	
		$("#stars-wrapper2").stars({
			inputType: "select",
			oneVoteOnly: true,
			callback: function(ui, type, value){
			
        		sendAjaxRequest(baseUrl+'/index/noter', {'abstract':idAbstract, 'note':value}); //sauvegarde de la note
        			
        		/*Message de sauvegarde de la note*/
        		//$("#ratingScore").html("Rating saved! ("+value+")").stop().css("opacity", 1).fadeIn(30);
         		//setTimeout(function(){ $("#ratingScore").fadeOut(1000) }, 1000);
        	}
		});

	
	});
}



 