<?php


define ('PUBLIC_KEY','6Le9YfISAAAAAORzLHWLvqzbqBflXppPJ0Viom50');
define ('PRIVATE_KEY','6Le9YfISAAAAAM4tTPvaKDY64QmynijKZTuuiuNa');

//====================================================================================================
//Define the ENVIRONMENT
define ('ENVIRONMENT', 'live');
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
		
	case "http://www.core4enterprise.starfi.sh":
		define('DOMAIN','2_Enterprise');
		break;
	default:
		define('DOMAIN', '1_Website');
}

//====================================================================================================
//CORE CONNECTION
// used client side
define('HTTP_ACCESS_CORE','http://StarfishCore_v4');
//---------------------------
// used server side
define('FILE_ACCESS_CORE','StarfishCore_V4');
//====================================================================================================
#for database connection
define ('DATABASE_NAME', 'clefsdor_123');
define ('DATABASE_HOSTNAME', 'localhost');
define ('DATABASE_USERNAME', 'clefsdor');
define ('DATABASE_PASSWORD', 'b*6Ha72ba-');
#end

?>