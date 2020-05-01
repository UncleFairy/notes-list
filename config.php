<?php
require_once "User.php";
/**
 * To change data storage, just switch "DATA_SOURCE" constant between "database" (SQLite3) and "file" (JSON)
 */
define("DATA_SOURCE", "file");
if(DATA_SOURCE == "database") {
	$db = new SQLite3("local_database.sqlite3");
	$db->query("CREATE TABLE IF NOT EXISTS users(
	        id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	        serialized TEXT
	)");

	/**
	 * Visitors table. IP address is unique, that's why we'll count unique visitors
	 */
	$db->query("CREATE TABLE IF NOT EXISTS visitors(
    	id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    	ip VARCHAR(15) NOT NULL UNIQUE
	)");
} else if(DATA_SOURCE == 'file') {
	if(!file_exists("local_database.json")) {
		fclose(fopen("local_database.json", "w+"));
	}
	if(!file_exists("visitors.json")) {
		fclose(fopen("visitors.json", "w+"));
	}
}
