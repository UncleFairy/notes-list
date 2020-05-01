<?php require_once "notes.php" ?>
<?php 
$dat_file="counter.dat"; // Файл счетчика
// Открывем файл счетчика и считываем текущий счет
// в переменную $count
$f=fopen($dat_file,"r");
$count=fgets($f,100);
fclose($f);

$count= trim(preg_replace('/\s\s+/', ' ', $count));;// Удаляем символ конца строки

$count++; // Увеличиваем счетчик
// Записываем данные обратно в файл
$f=fopen($dat_file,"w");
fputs($f,"$count ");
fclose($f);
 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./styles.css">
	<title>Document</title>
</head>
<body>
<form action="form.php" method="post">
	<p><label for="first-name">First name: </label></p>
	<input required id="first-name" name="firstName" type="text">
	<p><label for="last-name">Last name: </label></p>
	<input required id="last-name" name="lastName" type="text">
	<p><label for="patronymic">Patronymic: </label></p>
	<input required id="patronymic" name="patronymic" type="text">
	<p><label for="email">E-mail: </label></p>
	<input required id="email" name="email" type="email">
	<p><label for="message">Message: </label></p>
	<textarea required id="message" name="message" cols="30" rows="10"></textarea>
	<p><label for="submit"></label></p>
	<input type="submit" id="submit">
</form>
<div style="margin-bottom: 10px; text-align: center;">
  <span>Number of visits to the site:</span>
  <span id="counter"><?= $count ?></span>
</div>
<div id="clock"></div>
<?php $data = getNotes(); ?>
<?php /** @var User[] $data */ ?>
<?php if($data): ?>
	<table border="1">
		<thead>
		<tr>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Patronymic</td>
			<td>E-mail</td>
			<td>Message</td>
			<td>Date</td>
		</tr>
		</thead>
		<tbody>
		<?php foreach($data as $item): ?>
			<tr>
				<td><?= $item->getFirstName() ?></td>
				<td><?= $item->getLastName() ?></td>
				<td><?= $item->getPatronymic() ?></td>
				<td><?= $item->getEmail() ?></td>
				<td><?= $item->getMessage() ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
<script>
var myVar = setInterval(function() {
  myTimer();
}, 1000);

function myTimer() {
  var d = new Date();
  document.getElementById("clock").innerHTML = d;
}
</script>
</body>
</html>
