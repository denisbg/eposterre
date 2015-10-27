<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1); 

// mise en place des répertoires et chargement des classes
set_include_path('.' . PATH_SEPARATOR . '/Zend/'
    . PATH_SEPARATOR . '/ZendX/'
    . PATH_SEPARATOR  . './library'
    . PATH_SEPARATOR  . './application/models/'
    . PATH_SEPARATOR . get_include_path());

define ( 'APPLICATION_PATH', realpath ( dirname ( __FILE__ ) ) );

//autoload des classes
require_once APPLICATION_PATH . '/library/Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->setFallbackAutoloader(true);

ini_set('session.save_path',APPLICATION_PATH .'/data/session');

$namespace = Zend_Auth_Storage_Session::NAMESPACE_DEFAULT . '_EposterESMINT';
$auth = Zend_Auth::getInstance(); 
$auth->setStorage(new Zend_Auth_Storage_Session($namespace));

$config = new Zend_Config_Ini('./application/configs/config.ini');

/**
 *  mise en place de la BDD
 */

try {	
	
    $registry = Zend_Registry::getInstance();
    $registry->set('config', $config);

    $db = Zend_Db::factory($config->database->db);
    $db->query("SET NAMES UTF8");
    Zend_Db_Table::setDefaultAdapter($db);

    Zend_Registry::set('dbAdapter', $db);
	
} catch (Zend_Db_Adapter_Exception $e) {
    echo $e->getMessage();
}

/* Zend_Translate*/
$session = new Zend_Session_Namespace('lang', true);
Zend_Registry::set('session', $session);

// On récupère la session du site.
$session = Zend_Registry::get('session');
// On définit la langue par défaut sur le site.
$lang = $config->lang->language;
$locale = new Zend_Locale($lang);
// On enregistre cette langue dans notre registre.
Zend_Registry::set('Zend_Locale', $locale);
// Si la langue existe en session, on récupère la session, sinon on prend la valeur par défaut.
if(!isset($session->lang)){
	$session->lang = $locale;
}
$langLocale = isset($session->lang) ? $session->lang : $locale;
// On lance l'objet de traduction en lui passant les fichiers de langues
$translate = new Zend_Translate('array', APPLICATION_PATH . '/languages/'.$langLocale.'/'.$langLocale.'.php', $langLocale);
// On lui passe la langue courante du site
$translate->setLocale($langLocale);
// Important pour utiliser le helper.
Zend_Registry::set('Zend_Translate', $translate);





//Zend_Registry::set('Zend_Translate', $translate);



Zend_Layout::startMvc(array('layoutPath' => APPLICATION_PATH . '/application/layouts'));
Zend_Layout::getMvcInstance()->getView()->doctype('XHTML1_STRICT');

// setup controller
$frontController = Zend_Controller_Front::getInstance();
$frontController->setDefaultControllerName('index')
         		->setDefaultAction('index');
$frontController->throwExceptions(true);
$frontController->setControllerDirectory('./application/controllers');


// run!
$frontController->dispatch();
