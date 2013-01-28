<?
/*
 * This script is triggered when user starts typing into category field
 * on form.  It returns all existing field entries that begin with entered text.
 * script is reference like this:
 * $( ".selector" ).autocomplete({ source: "sourc.php" });
 */

require_once('.functions.php');

$user_input = $_GET['term'];

//queries db for distinct strings
require_once('.db-login-info.php');
$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

$field = "category";
$table = "link";

//get php_array of fields
$php_array = rowsToArray($DBH, $field, $table);

//filter array based on existing term (aka what's been typed)
$temp_array = array();
foreach ($php_array as $element) {
	if (substr($element, 0, strlen($user_input)) === $user_input) {
		array_push($temp_array, $element);
	}
	$php_array = $temp_array;
}

//get json array
$json_str = arrayToJson($php_array); 

//return json array to form for autocomplete
echo $json_str;
?>