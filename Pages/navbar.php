<!DOCTYPE html>
<head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    /*background-color: #333;*/
}

li {
    display: inline;
    /*float: left;*/
}
</style>
</head>

<body>

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
          <!-- check if the cookie is set, if not then display -->
<!--           <?php
          if (isset($_COOKIE["userID"])){
            $userID = $_COOKIE["userID"];

          }
          ?> -->
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
</body>
<html>