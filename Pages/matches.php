<!DOCTYPE html>
<?php
//do we know this user?
if (isset($_COOKIE["userID"]))
{
 $userName = $_COOKIE["userID"]; //get the value of the cookie from browser
 logUserIn($userName);
}
else
{
 //don't know this person (or cookie expired)
}
?>
<html lang="en">
<head>

  <meta charset="utf-8">
  <!-- Latest compiled and minified CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

  <title>Matches Page</title>
</head>
<style>
body {
  background-color: #cc0000;
}
.options-box {
  background: #ff0000;
  border: 1px solid #2e2e1f;
  border-radius: 3px;
  height: 100%;
  line-height: 35px;
  padding: 10px 10px 30px 10px;
  text-align: left;
  /*width: 340px;*/
  /*width: 90%;*/
  margin-top: 50px;
  /*margin-left: 50px;*/
}
.container {
  height: 100%;
  position: relative;
}
</style>

<body slyle="color:#b3000">

  <div class="container">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.html">Cook4Two</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="index.html">Home</a></li>
          <li  class="active"><a href="matches.html">My Matches</a></li>
          <li><a href="recipies.html">Recipies</a></li>
          <li><a href="bio.html">My Bio</a></li>
          <li>
            <div class="row" style="margin-left:200px; margin-top:10px;">
              <form class="form-inline" action="loginBar.php" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="pwd" placeholder="Password">
                </div>
                <div class="checkbox">
                  <label><input type="checkbox"> Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <div class="options-box">
      <pre>
              <h3>The array of matches will be entered here</h3>
              <?php
              //Get the values from the request form and submit the query
              try{
                $db = new PDO('sqlite:./../Database/unibake.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Need a dropdown 
                $prepared = $db-> prepare("Select * from BakeRequest where (userStartTime >= startTime AND userEndTime <= endTime)");
                $prepared->bindParam(':userStartTime', $_POST[startTime]);
                $prepared->bindParam(':userEndTime', $_POST[endTime]);
                $result = $prepared->execute();
                //Query - Select * from BakeRequest where startTime >= $_POST[startTime] AND endTime <= $_POST[endTime]
                foreach($result as $tuple){
                  
                  print_r($tuple);
                }

                $db=null;

              }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
              ?>
 
      </pre>
    </div>
  </div>
  <!-- <div class="container">
  </div> -->

</body>
<!-- <script>
  console.log(<? echo json_encode($username); ?>);
</script> -->
</html>
