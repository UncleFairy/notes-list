<?php

require_once "config.php";

function getNotes() {
	/** @var SQLite3 $db */
	global $db;

	if(DATA_SOURCE == 'database') {
		$query = $db->query("SELECT * from users");

		while($row = $query->fetchArray(SQLITE3_ASSOC)) {
			$data[] = $row;
		}
	} else if(DATA_SOURCE == 'file') {
		$data = json_decode(file_get_contents("local_database.json"), true);
	}

	$returnData = [];

	if(isset($data) && $data) {
		foreach($data as $item) {
			$returnData[$item['id']] = (new User)->unserialize($item['serialized']);
		}
	}

	return $returnData;
}

