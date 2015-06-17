<?

define ('PUBLIC_KEY','6Le9YfISAAAAAORzLHWLvqzbqBflXppPJ0Viom50');
define ('PRIVATE_KEY','6Le9YfISAAAAAM4tTPvaKDY64QmynijKZTuuiuNa');

//====================================================================================================
//Define the ENVIRONMENT
define ('ENVIRONMENT', 'staging');
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
	case "starfish.es":
	case "starfish.ph":
	case "starfish.co.uk":
		define('DOMAIN','1_Website');
		break;
		
	case "aviorcms.starfi.sh":
		define('DOMAIN','2_Enterprise');
		break;
	default:
		define('DOMAIN','1_Website');
		break;
}


//====================================================================================================
//CORE CONNECTION
// used client side
define('HTTP_ACCESS_CORE','http://starfi.sh/StarfishCore_V4');
//---------------------------
// used server side
define('FILE_ACCESS_CORE','StarfishCore_V4');
//====================================================================================================
#for database connection
define ('DATABASE_NAME', 'db177138_avior');
define ('DATABASE_HOSTNAME', 'internal-db.s177138.gridserver.com');
define ('DATABASE_USERNAME', 'db177138_admin');
define ('DATABASE_PASSWORD', 'fZbD,NLA%t*z');

#end

?>