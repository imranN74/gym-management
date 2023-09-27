<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="form.css?2">

    
    <title>Fitness Point-Login</title>

</head>
<body>

<form class="formlogin" action="action.php" method="post">
    <div>
       <center> <h2 style="font-weight:bold;">Fitness Point</h2></center>
    </div>
    <div class="form-group">
      <select style="background:transparent; border:2px solid" onchange="admin(this.value)" name="role" id="" class="form-control">
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>
  </div>
  <div class="form-group">
    <input type="number" name="mobile" autocomplete="off" class="form-control" placeholder="Mobile" id="mobile" required>
  </div>
  <div class="form-group" id='pwd' style='display:none;'>
    <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Password" id="password">
  </div>
  <button style="width:100%;" name="login" type="submit" class="btn btn-primary form-btn">Login</button>
</form>
</body>
</html>

<script>
    function admin(value){
      // alert(value);return false;
      if(value=='user'){
        $('#pwd').hide();
      }else{
        $('#pwd').show();
      }
    }
</script>