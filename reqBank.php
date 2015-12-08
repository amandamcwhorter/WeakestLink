<?php include 'Database.php';

if($_POST['action'] == 'RESET_BANK') {
	mysqli_query($conn, "UPDATE amount set bankAmount=0.00 where ID=1");
} else {
	$linkTotal = $_POST['linkTotal'];
	$rset = mysqli_query($conn, "SELECT * FROM amount where ID=1");
	$row = mysqli_fetch_assoc($rset);
	$amount = $row['bankAmount'];
	$totalAmount = $amount + $linkTotal;

	mysqli_query($conn, "UPDATE amount set bankAmount=".$totalAmount." where ID=1");

	echo $linkTotal;
}
?>