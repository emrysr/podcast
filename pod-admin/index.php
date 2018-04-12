<?php
	require('../settings/db.php');
	include("auth.php");

  $sql = "SELECT * FROM pod_list";
  if(!$result = $db->query($sql)){
      die('There was an error running the query [' . $db->error . ']');
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
    <a class="nav-link" href="add.php">Add new</a>
  </nav>
</div>
<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 rounded" style="background: url('../image/banner-bg.jpg') repeat-x;">
    <img class="mr-3" src="../image/dj-raveon-txt-full200.png" alt="" width="48" height="48">
  </div>
  <div class="my-3 p-3 bg-white rounded box-shadow">
    <h6 class="border-bottom border-gray pb-2 mb-0">Podcast <span class="badge badge-pill bg-light align-text-bottom"><?php echo $result->num_rows ?></span></h6>
    <?php 
    while($row = $result->fetch_assoc()){
    ?>
      <div class='media text-muted pt-3'>
        <img src='../image/podcast-logo-itunes.jpg' alt="podcast image" title="<?php echo $row['title'];?>" class='mr-2 rounded' width='80'>
        <p class='media-body pb-3 mb-0 small lh-125 border-bottom border-gray'><strong class='d-block text-gray-dark'><?php echo $row['title'];?></strong> <?php echo $row['description'];?>
          <small class='d-block text-left mt-3'>
            <i class='fa fa-clock mr-1'></i><span class="text-dark"><?php echo substr($row['duration'], 0, -3);?></span>
            <i class='fa fa-calendar ml-3 mr-1'></i><span class="text-dark"><?php echo $row['date'];?></span>
            <?php if($row['mixcloud_url'] != '' ){?>
            <a href="<?php echo $row['mixcloud_url'];?>" target="_blank" title="Mixcloud" class="text-dark"><i class='fab fa-mixcloud ml-3 mr-1'></i>Mixcloud</a>
            <?php }?>
            <a href='#' data-toggle='modal' data-target='#tracksModal' class="text-dark"><i class='fa fa-list ml-3 mr-1'></i>Track Listings</a>
            <a href="edit.php?pe=<?php echo $row['id']?>" title="Edit Episode" class="text-dark"><i class="far fa-edit ml-3 mr-1"></i>Edit Episode</a>
          </small>
        </p>
      </div>
      <?php
      $tracks = "SELECT tracks.*, pod.title FROM podcasts_tracks as tracks, pod_list as pod WHERE tracks.podcast_id = ".$row['id'];
      if(!$tracks_pod_title = $db->query($tracks)){
        die('There was an erro running the query [' . $db->error . ']');
      }
      $rowttitle = $tracks_pod_title->fetch_assoc();
      if(!$track_result = $db->query($tracks)){
        die('There was an error running the query [' . $db->error . ']');
      }
    }
    ?>
  </div>
</main>
<footer id="newsletter" class="footer">
	<div class="container text-muted">
		<small>&copy;<?php echo date('Y'); ?></small>
	</div>
</footer>
<div class="modal fade" id="tracksModal" tabindex="-1" role="dialog" aria-labelledby="tracksModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tracksModalTitle">Track Listing for <?php echo $rowttitle['title']?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Artist</th>
              <th scope="col">Track</th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $i=1;
            while($rowt = $track_result->fetch_assoc()){
              echo "
            <tr>
              <th scope='row'>".$i."</th>
              <td>".$rowt['track_artist']."</td>
              <td>".$rowt['track_title']."</td>
            </tr>
            ";
            $i++;
            }
          ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/holder.min.js"></script>
<script src="js/offcanvas.js"></script>
<?php $db->close(); ?>
</body>
</html>