<?php

require "db.php";

if (!isset($_SESSION)) {
	session_start();
}

try {

	$conn = new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}


if (!empty($_SESSION['user']) && !empty($_SESSION['user_name'])) {
	$_SESSION['user'] = TRUE;
	$_SESSION['user_name'] = $_SESSION['user_name'];
	$_SESSION['user_type'] = $_SESSION['user_type'];

	$user_name = $uphone = $_SESSION['user_name'];
	$user_type = $_SESSION['user_type'];
} else {
	$_SESSION['user'] = FALSE;
	$_SESSION['user_name'] = $user_name = "";
	$_SESSION['user_type'] = $user_type = "";
}
if (isset($_SESSION["doneerror"])) {
	unset($_SESSION["doneerror"]);
}

//CHECK INPUTS
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//CHECK AMOUNT INPUTS
function only_num($nums)
{

	$chg = preg_replace("/[^0-9.]/", "", $nums);
	return $chg;
}


//FETCH ALL DATA
function getALL($selectdb, $selectwhere, $selectorder)
{
	global $conn;

	$sp = "SELECT * FROM " . $selectdb;

	if (!empty($selectwhere)) {
		$sp .= " WHERE " . $selectwhere;
	}

	if (!empty($selectorder)) {
		$sp .= " ORDER BY " . $selectorder;
	}

	$statement = $conn->prepare($sp);
	// $statement->execute();
	$result = $statement->fetchAll();

	return $result;
}

//FETCH ALL DATA
function ALL($selectdb, $selectwhere, $selectorder)
{
	global $conn;

	$sp = "SELECT * FROM " . $selectdb;

	if (!empty($selectwhere)) {
		$sp .= " WHERE " . $selectwhere;
	}

	if (!empty($selectorder)) {
		$sp .= " ORDER BY " . $selectorder;
	}

	$statement = $conn->prepare($sp);
	$statement->execute();
	$result = $statement->fetchAll();

	return $result;
}


//FETCH SINGLE DATA
function getOne($selectdb, $selectwhere, $selectinfo)
{
	global $conn;

	$sp = "SELECT * FROM " . $selectdb;

	if (!empty($selectwhere)) {
		$sp .= " WHERE " . $selectwhere;
	}


	$statement = $conn->prepare($sp);
	$statement->execute();
	$result = $statement->fetch();

	if (!empty($result[$selectinfo])) {
		return $result[$selectinfo];
	} else {
		return "";
	}
}

function gtCount($selectdb, $selectwhere, $id = 'id')
{
	global $conn;


	$sp = "SELECT count($id) FROM " . $selectdb . "  ";

	if (!empty($selectwhere)) {
		$sp .= "WHERE  " . $selectwhere;
	}


	$statement = $conn->prepare($sp);
	$count = 0;

	if (!empty($statement)) {

		$statement->execute();

		$count = $statement->fetchColumn();
	}

	return $count;
}

function formatAmount(string|int|float  $amount, int $decimalPoint = 0)
{
	$suffix = '';
	// convert the amount input to numeric
	$amount = (float)$amount;
	$original = $amount;
	if ($amount >= 1000000000) {
		$amount = $amount / 1000000000;
		$suffix = 'b';
	} elseif ($amount >= 1000000) {
		$amount = $amount / 1000000;
		$suffix = 'm';
	} elseif ($amount >= 1000) {
		$amount = $amount / 1000;
		$suffix = 'k';
	} elseif (empty($amount) || !is_numeric($amount)) {
		$amount = 0;
	}
	return ['full' => number_format($amount, $decimalPoint) . $suffix, 'numberOnly' => number_format($amount, $decimalPoint), 'suffixOnly' => $suffix, 'noFormat' => $original];
}

//FETCH ALL DATA
function paginate(string $selectdb, string $selectwhere, int $page = 1, int $no_of_rows = 20)
{
	global $conn;

	// Calculate the starting row for the current page
	$start = ($page - 1) * $no_of_rows;

	$sp = "SELECT * FROM " . $selectdb;

	if (!empty($selectwhere)) {
		$sp .= " WHERE " . $selectwhere;
	}

	// Add LIMIT and OFFSET clauses for pagination
	$sp .= " LIMIT $no_of_rows OFFSET $start";

	try {
		$statement = $conn->prepare($sp);
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	} catch (PDOException $e) {
		die("Error: " . $e->getMessage());
		// You might want to handle the error in a more graceful way
	}
}

function textLimit($string, $limit = 20)
{
	$string = strip_tags($string);
	if (strlen($string) > $limit) {

		// truncate string
		$stringCut = substr($string, 0, $limit);
		$endPoint = strrpos($stringCut, ' ');

		//if the string doesn't contain any space then it will cut without word basis.
		$string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
		$string .= '...';
	}
	return $string;
}// Limit string with ... at the end of the string.