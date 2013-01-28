<?
/*
 * This script is triggered when user starts typing into category field
 * on form.  It returns all existing field entries that begin with entered text.
 * script is reference like this:
 * $( ".selector" ).autocomplete({ source: "sourc.php" });
 */

//be sure to include this file!
require_once('.functions.php');

//enter your login info into included file
require_once('.db-login-info.php');
$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

//enter db table and field name for query
$field = "";
$table = "";

//get text entered by user into autocomplete field
$user_input = $_GET['term'];

//get php_array of fields
$php_array = rowsToArray($DBH, $field, $table);

//filter array to only include elements that include $user_input
$temp_array = array();
foreach ($php_array as $element) {
	if (substr($element, 0, strlen($user_input)) === $user_input) {
		array_push($temp_array, $element);
	}
	$php_array = $temp_array;
}

//convert filtered array to json
$json_str = arrayToJson($php_array); 

//return json array to form for autocomplete
echo $json_str;
?>