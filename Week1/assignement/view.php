<?php

require_once "pdo.php";

session_start();

$firstName = "";
$lastName = "";
$email = "";
$headline = "";
$summary = "";

if(!isset($_GET["profile_id"]))
{
	$_SESSION["error"] = "Missing profile_id";
	header("Location: index.php");
	return;
}
else
{
	if($_GET["profile_id"] == "")
	{
		$_SESSION["error"] = "Could not load profile";
		header("Location: index.php");
		return;
	}

	$sql = "SELECT first_name, last_name, email, headline, summary FROM profile WHERE profile_id = " . $_GET["profile_id"];
	$stmt = $pdo -> query($sql);

	if($stmt -> rowCount() == 0)
	{
		$_SESSION["error"] = "Could not load profile";
		header("Location: index.php");
		return;
	}
	else
	{
		$row = $stmt -> fetch(PDO::FETCH_ASSOC);
		$firstName = $row["first_name"];
		$lastName = $row["last_name"];
		$email = $row["email"];
		$headline = $row["headline"];
		$summary = $row["summary"];
	}
}

?>

<!DOCTYPE html>

<html lang = "en">

	<head>
		<meta charset = "utf-8">
		<title>Noumi Kouotou Nahum Asaph - View </title>
		<?php require_once "bootstrap.php" ?>
	</head>

	<body>
		<div class = "container">
			<h1>Profile information</h1>
			<p>
				First Name : <?php echo($firstName . "\n"); ?>
			</p>
			<p>
				Last Name : <?php echo($lastName . "\n"); ?>
			</p>
			<p>
				Email : <?php echo($email . "\n"); ?>
			</p>
			<p>
				Headline : <?php echo("<br>" . $headline . "\n"); ?>
			</p>
			<p>
				Summary : <?php echo("<br>" . $summary . "\n"); ?>
			</p>
			<a href="index.php">Done</a>
		</div>
	</body>

</html>