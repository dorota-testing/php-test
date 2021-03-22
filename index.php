<?php
require './src/ProcessCsv.php';

use Src\ProcessCsv;

$objProcessCsv = new ProcessCsv();
$arrPeople = $objProcessCsv->processCsvFile('src/csv_files/examples.csv');
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <title>Starter Template · Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="starter-template.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">List of homeowners</a>
  </nav>

  <main role="main" class="container">
    <div class="bs-component">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">First Name</th>
            <th scope="col">Initial</th>
            <th scope="col">Last Name</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach($arrPeople as $person){ ?>
          <tr>
            <td><?=$person['title']?></td>
            <td><?=$person['first_name']?></td>
            <td><?=$person['initial']?></td>
            <td><?=$person['last_name']?></td>
          </tr>
          <?php } ?>  
        </tbody>
      </table>
    </div><!-- /example -->

  </main><!-- /.container -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

</html>