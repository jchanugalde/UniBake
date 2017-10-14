<!DOCTYPE html>
<?php
//Pass in their preference lists
//List2 should be an associative array with the userID and their preference list
// function compare($list1, $list2){
//     //Hashmap of users to the amount of matches they have
//     $users = array();
//     for($i=0; $i<count($list1); $i++){
//         //The counter that says how many matches they have
//         $counter =0;
//         for($j=0; $j<count($list2); $j++){
//             if($list1[$i] = $list2[$i]){
//             $counter++;
//             }   
//     }
//     array_push($userID, $counter)
//     }

    function compare2($list1, $list2){
    //Hashmap of users to the amount of matches they have
    $counter =0;
    for($i=0; $i<count($list1); $i++){
        //The counter that says how many matches they have

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
                $prepared = $db-> prepare("WITH FindSchool as (select schoolID from LogIn NATURAL JOIN Attends where (Attends.userID = :inputUserID)),
									FindStudents as (select * from LogIn NATURAL JOIN FindSchool NATURAL JOIN Attends where (Attends.schoolID = FindSchool.schoolID))
									select userID from BakeRequest NATURAL JOIN FindStudents where (:inputStartTime >= startTime OR :inputEndTime <= endTime)");
                //Bind the parameters for SQL Injection
                $prepared->bindParam(':inputStartTime', $_POST['startTime']);
                $prepared->bindParam(':inputEndTime', $_POST['endTime']);
                $prepared->bindParam(':inputUserID', $_POST['userID']);
                $result=$prepared->execute();

                $matched = array();

                foreach($result as $tuple){
                    //$data = array($tuple);
                    $otherPerson = $tuple['userID'];

                    //Get the preference categories
                    $userData1 = $db->query("select category from RequestCategory where (userID = $otherPerson)");
                    $userData2 = $db->query("select category from RequestCategory where (userID = :inputUserID");
                    //Store the number of similar categories
                    $similar = compare2($userData1, $userData2);
                    //Add the user and their similar categories to the array
                    matched_push($otherPerson, $similar);

                }
                //Sort the matches from high to low
                $finalArr = arsort($matched);
                $_POST['result'] = $finalArr;
                //Print out these results
                //Close the db
                $db=null;

    }catch(PDOException $e){
                die('Exception : '.$e->getMessage()); //die will quit the script immediate
              }
              //Find the students at the same school
header("Location: matched.php");

</html>