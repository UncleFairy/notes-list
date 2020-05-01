<?php
/**
 * Redirect to index.php, after script finishing
 */
header("Location: /");

require_once "config.php";

/** @var SQLite3 $db */
global $db;
/**
 * Check if all required inputs were field
 */
if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['patronymic']) && isset($_POST['email']) && isset($_POST['message'])) {
	$user = new User();
	$user->setFirstName($_POST['firstName'])
		->setLastName($_POST['lastName'])
		->setPatronymic($_POST['patronymic'])
		->setEmail($_POST['email'])
		->setMessage($_POST['message'])
		->setDate(time());
	/**
	 * Store serialized objects, because it's the simplest way to store objects in relational database.
	 * Creating Object-Relational Mapper (ORM) is more difficult and requires much time.
	 * Using getters to store get needed data and put it to sql query is a piece of "hard code".
	 */
	if(DATA_SOURCE == "database") {
		$db->query("INSERT INTO users (serialized) values ('{$user->serialize()}')");
	} else if(DATA_SOURCE == "file") {
		/**
		 * Store json-formatted data, because it's easier to read
		 */
		$current_json = json_decode(file_get_contents("local_database.json"), true);
		$current_json[] = [
			'id'         => isset($current_json) ? count($current_json) : 0,
			'serialized' => $user->serialize()
		];
		file_put_contents("local_database.json", json_encode($current_json));
	}
}
