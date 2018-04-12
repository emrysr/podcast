<?php
	include ('db.php');
	if(isset($_POST['post'])){		
		$post = addslashes($_POST['post']);
		mysqli_query($db,"insert into newsletter (email, datesignup) values ('$post', NOW())") or die(mysqli_error());
	}
?>		
<?php
	if(isset($_POST['res'])){
	?>
	<?php
		$query=mysqli_query($db,"select * from newsletter order by datesignup desc") or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
	?>	
		<div>
			Date: <?php echo date('M-d-Y h:i A',strtotime($row['datesignup'])); ?> <br>
			Post: <?php echo $row['email']; ?>
		</div>
		<br>
	<?php
		}
	}	
?>