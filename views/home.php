<?php
$bothsemister = false;
$semisteravailable = "None";

$semisters = $connection->query("SELECT * FROM marks WHERE student_id=" . $user['id']);
$semistercount = 0;
while ($row = $semisters->fetch_array()) {
  if ($row['final_exam'] != "" || $row['sup_exam'] != "") {
    $semisteravailable = $row['semister'];
    $semistercount += 1;
  }
}
if ($semisteravailable > 1) {
  $bothsemister = true;
}
?>

<main class="container">
  <h4> Welcome back <span class="text-capitalize info-color"> <?php echo $user['fname'] . " " . $user['mname'] ?></span></h4>
  <h4 class="text-capitalize"><?php echo $_SESSION['role_name']; ?> Dashboard</h4>
  <div class=" row gap-1">
    <?php if ($_SESSION['role'] == STUDENT && $semisteravailable != "None") : ?>
      <div class="card col-md-5 col-sm-5 col-lg-4 col-xl-3">
        <div class="card-body">
          <h5 class="card-title">Examination Results</h5>
          <p class="card-text">Results are available for <?php echo $bothsemister ? "BOTH" : $semisteravailable ?> semister </p>
          <div class="card-actions"><a href="index.php?route=/pages/marks/showresults&name=Students Result&departments=<?=$user['department_id']?>&courses=<?=$user['course_id']?>&students=<?=$user['id']?>&semister=&from=<?= $_GET['from'] ?>&fromname=<?= $_GET['fromname'] ?>" class="btn btn-success">View</a></div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</main>