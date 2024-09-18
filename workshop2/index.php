<?php
  $name = @$_REQUEST['name'];
  $lastName = @$_REQUEST['lastname'];
  $celphonenumber = @$_REQUEST['celphonenumber'];
  $email = @$_REQUEST['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario</title>
</head>
<body>

<form action="save.php" method="POST"> 
  <div class="form-group">
    <label for="">Nombre</label>
    <input type="text" class="form-control" name="name" id=""  placeholder="Your name">
    <input type="text" class="form-control" name="lastname" id="" value="<?php echo $lastName; ?>"  placeholder="Your last name">
    <input type="text" class="form-control" name="celphonenumber" id="" value="<?php echo $celphonenumber; ?>"  placeholder="Your cell phone number"> 
    <input type="email" class="form-control" name="email" id="" value="<?php echo $email; ?>"  placeholder="Your email">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>
