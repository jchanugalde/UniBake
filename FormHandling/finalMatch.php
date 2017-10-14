<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
<!-- Put in the stylesheet -->

  <title>Make Request Page</title>
  <!-- Include the navbar file -->
  <?php include 'navbar.php'; ?>
</head>
<style>

</style>
<body>
<h1> Here are your matches!</h1>
<p>
<!-- <?php
    //for($i=0; $i<count($matched); $i++){
      //  echo "How about this one?".$matched['userID'][$i];
    //}
?> -->
</p>


<?php
    session_start();

    function compare2($list1, $list2){
    //Hashmap of users to the amount of matches they have
    $counter =0;
    for($i=0; $i<sizeof($list1); $i++){
        //The counter that says how many matches they have
            //if($list1['category'][$i] == $list2['category'][$i]){
        if($list1[$i] == $list2[$i]){

            $counter++;
            }   
    }
return $counter;
    }

//find the school that the student belongs to 
try{
                $db = new PDO('sqlite:./../Database/unibake.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Need a dropdown 
                //This is the query that filters out feasible users that could be possible matches

                //First do the insert queries
                echo "This is category1".$_POST['category1'];
                echo "This is category2".$_POST['category2'];
                echo "This is category3".$_POST['category3'];

                $prepared1 = $db->prepare("Insert into RequestCategory (userID, category) VALUES (:userID, :category1) ");
                $prepared1->bindParam(':userID', $_COOKIE['userID']);
                $prepared1->bindParam(':category1', $_POST['category1']);
                $prepared1->execute();

                $prepared2 = $db->prepare("Insert into RequestCategory (userID, category) VALUES (:userID, :category2) ");
                $prepared2->bindParam(':category2', $_POST['category2']);
                $prepared2->bindParam(':userID', $_COOKIE['userID']);
                $prepared2->execute();


                $prepared3 = $db->prepare("Insert into RequestCategory (userID, category) VALUES (:userID, :category3) ");
                $prepared3->bindParam(':category3', $_POST['category3']);
                $prepared3->bindParam(':userID', $_COOKIE['userID']);
                $prepared3->execute();



                $prepared = $db->prepare("WITH FindSchool as (select schoolID from LogIn NATURAL JOIN Attends where (Attends.userID = :inputUserID)),
									FindStudents as (select * from LogIn NATURAL JOIN FindSchool NATURAL JOIN Attends where (Attends.schoolID = FindSchool.schoolID))
									select userID from BakeRequest NATURAL JOIN FindStudents where (:inputStartTime <= endTime AND :inputEndTime >= startTime AND userID != :inputUserID)");
                //Bind the parameters for SQL Injection
                //$prepared->bindParam(':inputUserID', $_POST['userValue']);
                $prepared->bindParam(':inputUserID', $_COOKIE['userID']);
                $prepared->bindParam(':inputEndTime', $_POST['endTime']);
                $prepared->bindParam(':inputStartTime', $_POST['startTime']);
                //$result=$prepared->execute();
                $prepared->execute();

                //$result = $prepared->fetch(PDO::FETCH_ASSOC);
                //$prepared->bind_result($user);
                //$result = $prepared->fetch(PDO::FETCH_ASSOC);
                $matched = array();
                $result = $prepared->fetchAll();
                // echo "This is start time".$_POST['startTime'];
                // echo "This is end time".$_POST['endTime'];

                // echo "This is the user".$_POST['userValue'];
                // echo "This is the user".$_COOKIE['userID'];


                // echo "This is the result";
                // print_r($result);
                // foreach($result as $tuple){
                //     echo "Printint in the loop";
                //     print $tuple['userID'];

                // }
                // while($myrow = $result->fetch_assoc()){
                // $otherPerson = $myrow['userID'];


                //     $userData1 = $db->query("select category from RequestCategory where (userID = $otherPerson)");
                //     $prepared2 = $db->prepare("select category from RequestCategory where (userID = :inputUserID");
                //     $prepared2->bindParam(':inputUserID', $_POST['userID']);
                //     $otherUser = $prepared2->execute();

                //     //$userData2 = $db->query("select category from RequestCategory where (userID = :inputUserID");
                //     //Store the number of similar categories
                //     $similar = compare2($userData1, $otherUser);
                //     //Add the user and their similar categories to the array
                //     $matched[$otherPerson] = $similar;
                //     //array_push($matched, '$otherPerson'=>'$similar');

                // }


                foreach($result as $tuple){
                    //$data = array($tuple);
                    //$otherPerson = $tuple['userID'];
                    $otherPerson = $tuple['userID'];
                    //echo "This is the tuple[0]".$tuple[0];
                    //Get the preference categories
                    echo "This is the other person \r\n".$otherPerson;
                    $userData1 = $db->prepare("select category from RequestCategory where (userID = $otherPerson)");
                    $userData1->execute();
                    $getCategory = $db->prepare("select category from RequestCategory where (userID = :mainUser)");
                    $getCategory->bindParam(':mainUser', $_COOKIE['userID']);
                    //$otherUser = $prepared2->execute();
                    $getCategory->execute();
                    $results1 = $getCategory->fetchAll();
                    $results2 = $userData1->fetchAll();
                    //echo "These are the results \r\n";
                    //echo nl2br("These are the results \n");

                    //print_r($results1);
                    //print "This is a new line \r\n ";
                    //echo nl2br("In between results.\n.");

                    //echo "This is in between the results";
                    //print_r($results2);

                    //$userData2 = $db->query("select category from RequestCategory where (userID = :inputUserID");
                    //Store the number of similar categories
                    //$similar = compare2($userData1, $otherUser);
                    $similar = compare2($results2, $results1);

                    //Add the user and their similar categories to the array
                    $matched[$otherPerson] = $similar;
                    //array_push($matched, '$otherPerson'=>'$similar');
                    print "This is a new line";
                    echo"This is matched";
                    print_r($matched);

                }

                //Sort the matches from high to low

                //$finalArr = arsort($matched);
                $finalArr = asort($matched);
                // Should be doing a for each loop to go through each user in the list
                //Want to printout their matches too not just how many they have 
                //This is break statement in php
                echo nl2br("Another one.\n.");

                 foreach($matched as $key=>$value){
                    echo "Here is the information for the user you could be paired with";

                    $pair = $db->prepare("Select email, name, phone from Login NATURAL JOIN UserLogin where (userID = $key)");
                    $pair->execute();
                    //$result = $db->query($stmt);
                    $result = $pair->fetch();
                    echo "This is the result"."<br/>";
                    //print_r($result);
                    // while($row = $result->fetchAll()){
                    //     echo "email: ". $row['email']." Name: ". $row['name']. "Phone :". $row['phone']."<br>";
                    // }
                    //add what criteria they matched on 
                    echo "Their email ".$result['email']."<br/>";
                    echo "Their name ".$result['name']."<br/>";
                    echo "Their phone ".$result['phone']."<br/>";

                    echo "This is the other user {$key} => to how many matches you have in common {$value}";
                    echo nl2br("\n");
                    //echo "This is the other way".$matched['userID'];

                 }
                 // foreach($matched as $element){
                 //    echo "This is the match you get".$element['userID'];
                 //    echo nl2br("Another one.\n.");
                 //    //echo "This is the other way".$matched['userID'];

                 // }
    //              for($i=0; $i<sizeof($matched); $i++){
    //     echo "How about this one?".$matched[$i]."\r\n";

    // }

                echo "This is the final array";
                print_r($finalArr);
                $_SESSION['result'] = $finalArr;
                $_SESSION['answer'] = $result;
                //$_POST['result'] = $finalArr;
                //$finalArr = $_POST['result'];
                //Print out these results
                //Close the db
                $db=null;

    }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
              //Find the students at the same school
//header("Location: matched.php");
?>


</html>