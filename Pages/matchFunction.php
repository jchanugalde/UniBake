<?php include "db.php"?>
<?php

  function showAllMatches (){
      global $connection;
      $query = "select * from matches";

      $result = mysqli_query($connection, $query);
      if(!$result) {
          die('Query FAILED' . mysqli_error());
      }
      // match on (time - a) +
      while($row = mysqli_fetch_assoc($userData)){
        $name = $row['name'];
        //$imgSrc = $row['imgSrc'];
        $their_userID = $row['their_userID'];
        $categoriesMatched = $row['categoriesMatched'];
        $timeFrame = $row['timeFrame'];
        $phone = $row['phone'];
        //name1
         //you matched on ?? catagories
         echo "<pre>
                <div class=\"container\">
                  <div class=\"match\">
                    <ul>
                      <img src="$imgSrc" stlye="float:left">
                      <li>$Name</li>
                        <li class="username">$their_userID</li>
                      <li> You matched on $categoriesMatched categories </li>
                      <li> You can both meet at $timeFrame </li>
                      <li> $phone </li>
                    </ul>
                  </div>
                </div>
              </pre>";
      }
    }
 ?>
<!--matches: my.userID, their.userID, 'their.userIMG', categoriesMatched, timeFrame, their.phone  -->
