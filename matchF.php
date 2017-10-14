<!DOCTYPE html>
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
    padding: 10px 10px 10px 10px;
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
  .matchContainer {
    background: #ff0000;
    border: 1px solid #2e2e1f;
    border-radius: 3px;
    height: 100%;
    line-height: 35px;
    padding: 10px 30px 10px 10px;
    text-align: left;
    /*width: 340px;*/
    /*width: 90%;*/
    margin: auto;
    /*margin-left: 50px;*/
  }
  .row{
    background-color: #FAEBD7;
    width: 95%;
    position: center;
    padding: 10px 10px 10px 10px;
    /*padding-left: 200px;*/
    margin: auto;
  }
  .col-md-6 {
    border: 1px solid #2e2e1f;
    border-radius: 2px;
  }
  * {
   border: 1px dashed #0000FF;
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
        </ul>
      </div>
    </nav>
  </div>
    <div class="container">
      <div class="options-box">
          <div class="row">
            <div class="col-md-6">
                 <ul>
                   <li>Name</li>
                   <li>$their_userID</li>
                   <li> You matched on $categoriesMatched categories </li>
                   <li> You can both meet at $timeFrame </li>
                   <li> $phone </li>
                 </ul>
            </div>
            <div class="col-md-6">
              <ul>
                <li>Recipies you can make:</li>
                <li>Banana bread</li>
                <li>Banana bread</li>
              </ul>
            </div>
         </div>

      </div>
      <div class="options-box">
        <pre>
                <h3>The array of matches will be entered here</h3>
        </pre>
      </div>
    <div class="options-box">
      <pre>
              <h3>The array of matches wilhhl be entered here</h3>

      </pre>
    </div>
    <!-- outer for each -->
  </div>
  <!-- <div class="container">
  </div> -->

</body>

</html>
