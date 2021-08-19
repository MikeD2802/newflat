<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Lamp Stack CRUD</title>
  </head>
  <body>
    <div style="width: 50%; padding-top: 5%;" class="container">
      <?php require_once 'processing.php'; ?>

      <?php 
        if(isset($_SESSION['message'])):
      ?>

      <div class="alert alert-<?=$_SESSION['msg_type']?>">
          <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
      </div>
      <?php
        endif
      ?>
      <?php
        $mysqli = mysqli_connect('localhost', 'root', 'root', 'lamplogin') or die(mysqli_connect_error($mysqli));
        $result = mysqli_query($mysqli, "SELECT * FROM data") or die($mysqli->error);
      ?>

      <div class="row justify-content-center">
        <table class="table">
          <thead>
            <tr>
              <th>Email</th>
              <th>Username</th>
              <th colspan="2">Manage</th>
            </tr>
          </thead>
      <?php
        // db assoc array - looping to get all db entries
        while($row = $result->fetch_assoc()): 
      ?>
          <tr>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td>
              <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
              <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
        </table>
      </div>
    </div>

    <div style="width: 50%; padding-top: 20%;" class="container">
      <form action="processing.php" method="POST">
        <div class="mb-3">
          <h1>LAMP Stack Register Form</h1>
          <label for="email" class="form-label">Email address</label>
          <input name="email" type="email" class="form-control" aria-describedby="emailHelp">
          <div class="form-text">Please enter valid email address</div>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input name="username" type="text" class="form-control" aria-describedby="emailHelp">
          <div class="form-text">4-100 characters</div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input name="password" type="password" class="form-control">
          <div class="form-text">8-20 characters</div>
        </div>
        <!-- <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> -->
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>
    </div>
  </body>
</html>

