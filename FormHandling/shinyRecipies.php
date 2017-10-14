<?php
session_start();
if(!isset($_SESSION['userID'])){
echo"Please Log In to use this feature";
header("Location: TestLogIn.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

  <title>Make Request Page</title>
  <!-- Include the navbar file -->
<br>
</head>
<style>
  body {
    background-color: #cc0000;
  }
  img {
    height: 150px;
    width: 150px;
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
  /** {
   border: 1px dashed #0000FF;
  }*/

</style>
<body>
  <div class="container">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.html">Cook4Two</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="index.html">Home</a></li>
          <li  class="active"><a href="matches.html">My Matches</a></li>
          <li><a href="recipes.html">Recipes</a></li>
          <li><a href="bio.html">My Bio</a></li>
          <li><a href="LogOut.php" style="margin-left:800px">Logout</a></li>
        </ul>
      </div>
    </nav>
  </div>
  <br>
<h1> Which recipe would you like to bake with your partner?</h1>

<?php
//find the school that the student belongs to
try{
    if(isset($_POST['pairID'])){
    // echo $_POST['pairID']." Username found in form <br />";
    // Set session variables
    $_SESSION['pairUser'] = $_POST['pairID'];
    // echo "This is the e-mail".$_POST['email'];
    // echo $_SESSION["pairUser"]." stored in session <br />";
}

                //$_SESSION['pairUser'] = $_POST['pairID'];

                $db = new PDO('sqlite:./../Database/unibake.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Should probably check to see how many distinct categories they have before we do this

                //Get the other user via their e-mail
                //$user = $db->prepare()
                //Get the two people we need to pair
                $recipe1 = $db->prepare("Select distinct filePath from Category NATURAL JOIN RequestCategory where (userID = :inputID or userID = :pairedID)");
                //$recipe1->bindParam(':inputUserID', $_COOKIE['userID']);
                $recipe1->bindParam(':inputID', $_SESSION['userID']);
                $recipe1->bindParam(':pairedID', $_SESSION['pairUser']);

                //$recipe1->bindParam(':pairedID', $_POST['pairID']);
                $recipe1->execute();

                //Start a session variable with the 2nd user to get its data down the line

                /*
                //Categories 1
                "SELECT * FROM RequestCategory WHERE (userID = inputUserID);"
                //Categories 2
                "SELECT * FROM RequestCategory WHERE (userID = pairID);"
                //Mutual categories
                "SELECT * FROM Categories1 NATURAL JOIN Categories2;"
                //Counting compatibility
                "SELECT count(filePath) FROM Category WHERE (category IN Categories1 AND category IN Categories2 GROUP BY filePath;"
                */
                //This returns each recipe and the count of categories it has mutual to the two users
                $categoryCount = $db->prepare(
                "WITH Categories1 AS (SELECT userID as user1, category FROM RequestCategory WHERE (user1 = :inputUserID)),
                Categories2 AS (SELECT userID as user2, category FROM RequestCategory WHERE (user2 = :pairedID)),
                MutualCategories as (SELECT DISTINCT category FROM Categories1 NATURAL JOIN Categories2),
                MutualRecipes as (SELECT * FROM Category WHERE (category in MutualCategories))
                SELECT filePath, count(filePath) FROM MutualRecipes GROUP BY filePath");
                $categoryCount->bindParam(':inputUserID', $_SESSION['userID']);
                $categoryCount->bindParam(':pairedID', $_POST['pairID']);
                $categoryCount->execute();

                //Now to do something with this shit
                $count1 = $categoryCount->fetchAll();

                foreach($categoryCount as $tuple){
                    list($recipe, $fileExtension) = explode(".", $tuple['filePath']);
                    echo "This is an option: ".$recipe."<br/>";
                    echo "Compatibility with your baking duo: ".($tuple['count'] / 3)."<br/>";
                    echo "<a href='thankYou.php?filePath=$tuple[filePath]'> Bake </a><br/>";
                }
                // $recipe2 = $db->prepare("Select distinct filePath from Category NATURAL JOIN RequestCategory where (userID = :inputUserID);");
                // $recipe2->bindParam(':inputUserID', $_COOKIE['userID']);
                // $recipe2->execute();

                // $recipe3 = $db->prepare("Select distinct filePath from Category NATURAL JOIN RequestCategory where (userID = :inputUserID);");
                // $recipe3->bindParam(':inputUserID', $_COOKIE['userID']);
                // $recipe3->execute();
                    //$result = $db->query($stmt);
                $result1 = $recipe1->fetchAll();
                // $result2 = $recipe2->fetchAll();
                // $result3 = $recipe3->fetchAll();

                foreach($result1 as $tuple){

                    //Tokenize filePath
                    list($recipe, $fileExtension) = explode(".", $tuple['filePath']);
                    //Provide link (download? Need to supply php to that)
                    //echo "This is the other user with session".$_SESSION['pairUser']." Blah <br/>";
                    //echo "This is the other user with post".$_POST['pairID']." Blah <br/>";
                    //print_r($_SESSION['pairUser']);

                    echo "</div>
                      <div class=\"container\">
                        <div class=\"options-box\">
                            <div class=\"row\">
                              <div class=\"col-md-6\">
                                   <ul styles=\"display: text-align\">
                                     <li>This is an option: ".$recipe."</li>

                                   </ul>
                              </div>
                              <div class=\"col-md-6\">
                                  <img src=\"../AvatarImgs/homer.jpg\">

                                  <li> <a href='thankYou.php?filePath=$tuple[filePath]'> Click here to download instructions </a></li>
                              </div>
                           </div>

                        </div>";
                    //echo "This is an option".$tuple['filePath']."<br/>";
                }


                // foreach($result2 as $tuple2){
                //     echo $tuple2['filePath'];
                // }
                //         foreach($result3 as $tuple3){
                //     echo $tuple3['filePath'];
                // }

                //Delete their bake requests

                $db=null;

    }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
              //Find the students at the same school
//header("Location: matched.php");
?>

</html>
