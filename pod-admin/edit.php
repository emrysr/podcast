<?php
	require('../settings/db.php');
	include("auth.php");
  if(isset($_GET['pe'])){
    $sql = "SELECT * FROM pod_list WHERE id = ".$_GET['pe'];
    if(!$result = $db->query($sql)){
      die('There was an error running the query [' . $db->error . ']');
    }
  }
  if(isset($_POST['deltrack'])){
    $trackid = $_POST['trackID'];
    $id = $_GET['pe'];
    $query_del = "DELETE FROM podcasts_tracks WHERE tracks_id=$trackid";
    if ($db->query($query_del) === TRUE) {
      header("Location:edit.php?pe=$id&tracks=del");
    } else {
      echo "Error: " . $query_del . "<br>" . mysqli_error($db);
    }
  }
  if(isset($_POST['newtrack'])){
    $id = $_GET['pe'];
    $query_enq = "INSERT INTO podcasts_tracks (track_artist, track_title, podcast_id) VALUES ('', '', $id)"; 
    if ($db->query($query_enq) === TRUE) {
      header("Location:edit.php?pe=$id#tracks");
    } else {
      echo "Error: " . $query_enq . "<br>" . mysqli_error($db);
    }
  }
  if(isset($_POST['editep'])){
    $id = $_GET['pe'];
    $ep_title = filter_var($_POST["episodeTitle"], FILTER_SANITIZE_STRING);;
    $ep_desc = str_replace("'", "&#39;", $_POST["episodeDiscription"]);
    $ep_date = $_POST["dateInput"];
    $ep_duration = $_POST["timeInput"];
    $ep_mixcloud = $_POST["mixcloudInput"];

    $update_enq = "UPDATE pod_list SET title='$ep_title', description='$ep_desc', duration='$ep_duration', mixcloud_url='$ep_mixcloud', date='$ep_date' WHERE id=$id";

    if ($db->query($update_enq) === TRUE) {
      header("Location:edit.php?pe=$id&updated");
    } else {
      echo "Error: " . $update_enq . "<br>" . mysqli_error($db);
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
<?php if(isset($_GET['updated'])){?>
<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
  <i class="far fa-thumbs-up mr-3"></i>Title, Description, Date, Duration and Mixcloud link <strong>updated</strong><i class="far fa-thumbs-up ml-3"></i>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php }?>
<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 rounded" style="background: url('../image/banner-bg.jpg') repeat-x;">
    <img class="mr-3" src="../image/dj-raveon-txt-full200.png" alt="" width="48" height="48">
  </div>
  <?php 
    while($row = $result->fetch_assoc()){
  ?>
  <div class="my-3 p-3 bg-white rounded box-shadow">
    <h6 class="border-bottom border-gray pb-2 mb-0">Edit <?php echo $row['title'];?></h6>
    <div class="text-muted pt-3">
      <form action="" method="post" name="editepisode">
        <div class="form-label-group">
          <label for="episodeTitle">Episode Title</label>
          <input type="text" id="episodeTitle" class="form-control form-control-lg" name="episodeTitle" placeholder="" required value="<?php echo $row['title'];?>">
        </div>
        <div class="form-group pt-2 mb-2">
          <label for="episodeDiscription">Episode Description</label>
          <textarea class="form-control" id="episodeDiscription" rows="3" placeholder="" name="episodeDiscription" required><?php echo $row['description'];?></textarea>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-label-group">
              <label for="dateInput">Date</label>
              <input type="text" id="dateInput" class="form-control form-control-lg" name="dateInput" placeholder="" required value="<?php echo $row['date'];?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-label-group">
              <label for="timeInput">Duration</label>
              <input type="text" id="timeInput" class="form-control form-control-lg" name="timeInput" placeholder="" required value="<?php echo $row['duration'];?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-label-group">
              <label for="mixcloudInput">Mixcloud</label>
              <input type="text" id="mixcloudInput" class="form-control form-control-lg" name="mixcloudInput" placeholder="" value="<?php echo $row['mixcloud_url'];?>">
            </div>
          </div>
          <div class="col-12 pt-3">
            <h5 id="tracks">Track Listings</h5>
          </div>
          <?php if(isset($_GET['tracks']) && $_GET['tracks'] == 'del'){?>
          <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
              <i class="far fa-thumbs-up mr-3"></i>Track <strong>removed</strong><i class="far fa-thumbs-up ml-3"></i>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <?php }?>
          <?php
            $tracks = "SELECT * FROM podcasts_tracks WHERE podcast_id = ".$_GET['pe'];
            if(!$track_result = $db->query($tracks)){
              die('There was an error running the query [' . $db->error . ']');
            }
            $i=1;
            while($trackrow = $track_result->fetch_assoc()){
          ?>
          <div class="col-md-6">
            <div class="form-label-group">
              <input type="text" id="artistInput<?php echo $i?>" class="form-control form-control-lg" name="artistInput<?php echo $i?>" placeholder="" value="<?php echo $trackrow['track_artist']?>">
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-label-group">
              <input type="text" id="trackInput<?php echo $i?>" class="form-control form-control-lg" name="trackInput<?php echo $i?>" placeholder="" value="<?php echo $trackrow['track_title']?>">
            </div>
          </div>
          <div class="col-md-1">
            <button class="btn btn-danger" name="deltrack" type="submit"><i class="fas fa-minus-circle"></i></button>
            <input type="hidden" value="<?php echo $trackrow['tracks_id']?>" name="trackID">
          </div>
          <?php
            $i++;
            }
          ?>
          <div class="col-12 pt-3">
            <button class="btn btn-outline-success btn-sm float-right" name="newtrack" type="submit"><i class="fa fa-plus"></i></button>
            <button class="btn btn-dark" name="editep" type="submit">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php } ?>
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