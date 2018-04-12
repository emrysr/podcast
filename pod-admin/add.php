<?php
	require('../settings/db.php');
	include("auth.php");

if(isset($_POST["addnewep"])){
  $ep_title = $_POST["episodeTitle"];
  $ep_desc = $_POST["episodeDiscription"];
  $ep_date = date("Y-m-d");
  $ep_duration = $_POST["timeInput"];
  $ep_mixcloud = $_POST["mixcloudInput"];

  $query_enq = "INSERT INTO pod_list (title, description, duration, mixcloud_url, date) VALUES ('$ep_title', '$ep_desc', '$ep_duration', '$ep_mixcloud', '$ep_date')"; 
  if ($db->query($query_enq) === TRUE) {
    $last_id = $db->insert_id;
    header("Location:edit.php?pe=$last_id");
  } else {
    echo "Error: " . $query_enq . "<br>" . mysqli_error($db);
  }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="The place where all of DJ Raveon's podcasts can be found.">
<meta name="author" content="Arfon Davis">

<title>DJ Raveon's Podcast Show</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="../css/offcanvas.css" rel="stylesheet">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
</head>
<body class="bg-light">
<?php 
  $i = 1;
?>
<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
  <a class="navbar-brand" href="#">DJ Raveon's Podcast Show</a>
  <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>
<div class="nav-scroller bg-white box-shadow">
  <nav class="nav nav-underline">
    <a class="nav-link" href="index.php"><i class="fa fa-caret-left"></i> Back</a>
  </nav>
</div>
<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 rounded" style="background: url('../image/banner-bg.jpg') repeat-x;">
    <img class="mr-3" src="../image/dj-raveon-txt-full200.png" alt="" width="48" height="48">
  </div>
  <div class="my-3 p-3 bg-white rounded box-shadow">
    <h6 class="border-bottom border-gray pb-2 mb-0">Add New Episode</h6>
    <div class="text-muted pt-3">
      <form action="" method="post" name="newepisode">
        <div class="form-label-group">
          <label for="episodeTitle">Episode Title</label>
          <input type="text" id="episodeTitle" class="form-control form-control-lg" name="episodeTitle" placeholder="Title #123" required autofocus>
        </div>
        <div class="form-group pt-2 mb-2">
          <label for="episodeDiscription">Episode Description</label>
          <textarea class="form-control" id="episodeDiscription" name="episodeDiscription" rows="3" placeholder="What will be in this episode?" required></textarea>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-label-group">
              <label for="timeInput">Duration</label>
              <input type="text" id="timeInput" class="form-control form-control-lg" name="timeInput" placeholder="1:00" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-label-group">
              <label for="mixcloudInput">Mixcloud</label>
              <input type="text" id="mixcloudInput" class="form-control form-control-lg" name="mixcloudInput" placeholder="http://mixcloud.com">
            </div>
          </div>
          <div class="col-12 pt-3">
            <button class="btn btn-dark" name="addnewep" type="submit">Add Tracks</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?php $db->close(); ?>
</body>
</html>