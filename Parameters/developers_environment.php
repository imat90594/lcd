<?

define ('PUBLIC_KEY','6Le9YfISAAAAAORzLHWLvqzbqBflXppPJ0Viom50');
define ('PRIVATE_KEY','6Le9YfISAAAAAM4tTPvaKDY64QmynijKZTuuiuNa');



//====================================================================================================
//Define the ENVIRONMENT
define ('ENVIRONMENT', 'devel');


//====================================================================================================
//Define the LANGUAGE 
//Comment out this whole block if the website is not Multidomain AND multilingual
switch ($_SERVER['SERVER_NAME'])
{
	case "starfish.es":
		define('LANGUAGE','es');
		break;
	case "starfish.ph":
		define('LANGUAGE','ph');
		break;
	case "starfish.co.uk":
		define('LANGUAGE','uk');
		break;
	
}

//====================================================================================================
//Define the DOMAIN
//this is used so that Starfish Enterprise can reference the main website
//i.e. one domain can reference another domain

define('PRIMARY_DOMAIN','1_Website');
define('SECONDARY_DOMAIN','2_Enteprise');

switch ($_SERVER['SERVER_NAME'])
{
	case "lcdcms":
		define('DOMAIN','2_Enterprise');
		break;
	
	default:
		define('DOMAIN','1_Website');
}

//====================================================================================================
//actually, this is can be configured in httpd.conf
//the default folder is this one, and it stores ALL logs from ALL projects
//so this is NOT RECOMMENDED
define('ERROR_LOG_FILE','C:/xampp/apache/logs/error.log');

//====================================================================================================
//CORE CONNECTION
// used client side
define('HTTP_ACCESS_CORE','StarfishCore_V4');
//---------------------------
// used server side
define('FILE_ACCESS_CORE','StarfishCore_V4');
//====================================================================================================
#for database connection
define ('DATABASE_NAME', 'lcd');
define ('DATABASE_HOSTNAME', 'localhost');
define ('DATABASE_USERNAME', 'root');
define ('DATABASE_PASSWORD', '');
#end

?>