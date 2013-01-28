<?
//takes php array and returns string in JSON format (aka js literal array) ex: ["this", "is", "json"]
function arrayToJson($phpArray) {
	$numElements = count($phpArray);
	$jsonString = "[";
	$i = 0;
	foreach ($phpArray as $element) {
		if(++$i === $numElements) {
	    	$jsonString.="\"".$element."\"";
	  	}
		else $jsonString.="\"".$element."\", ";
	}
	$jsonString.="]";	
	return $jsonString;
}

//takes unique fields from db table and returns raw array
function rowsToArray ($DBH, $field, $table) {
		
	//array to return
	$returnArray = array();
	
	//query
	$query = "SELECT DISTINCT($field) FROM $table";
	$sql = $DBH->prepare($query);
	$sql->execute();
	$rows = $sql->fetchAll();
	
	//push each string into returnArray; disregards empty string
	foreach ($rows as $row) {
		if ($row[$field]!="") array_push($returnArray, $row[$field]);
	}
	
	//return the array
	return $returnArray;
}
?>