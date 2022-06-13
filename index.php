<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гра екстрасенс</title>
</head>
<body>
<form action="index.php" method="POST">
            <?php ini_set('display_errors', 1);
                if (isset($_POST['newGame'])) { //start new game
                    header("refresh: 0;");   
                }
    
                



                if($_POST){
                    $hidNum = 2;
                    $win = $_POST["win"];
                    $number = $_POST["number"];
                    $num2 = $_POST["password"];
                }else{
                    $hidNum = 1;
                    $win = 0;
                    $number = 1;
                    $num2 = 0;
                    echo("<h4>Guess the number from 1 to 10</h4>");
                    echo("<h4>You have 3 attempts</h4>");
                }

                if($hidNum == 1){
                    $password = rand(1, 10);
                    $try = 1;
                    $tryEcho = 0;
                    $answers = [];
                    
                }else{
                    $password = $_POST["password"];
                    $try = $_POST["try"] + 1;
                    $tryEcho = $_POST["try"];
                
                    $answers = $_POST["answers"];
                    $answers = json_decode($answers);
                }
                
                
                if($tryEcho < 3){
                    if($number != $num2){
                        if(isset($_POST["run"])){
                            $hidNum = 2;
                            if ($number < $num2){
                                echo "hiding number is big.";
                            }   
                            if ($number > $num2){
                                echo "hiding number is small.";
                            } 
                            if($_POST["number"] == $_POST["password"]){
                                echo("<h4>You are win</h4>");
                                $win = 1;
                            }else{
                                echo("<h4>You didn't guess the number!</h4>");
                                if($tryEcho < 3){
                                    $try_z = 3 - $tryEcho;
                                    echo("<h4>try again</h4>");
                                    echo("<h4>Attempts: $try_z</h4>");
                                    
                                }
                                
                                array_push($answers, $_POST["number"]);
                                
                            }
                        }
                        

                        
                        echo("<p>");  
                            echo("<select name='number'>");
                                for($i = 1; $i <= 10; $i++){
                                    $numb = 0;
                                    $r = 0;
                                    while($r <= count($answers)){
                                        if($i == $answers[$r]){
                                            $numb = 1;
                                            $j = count($answers) + 1;
                                        }
                                        $r++;
                                    }
                                    if($numb == 1){
                                        echo("<option value='$i' disabled>$i</option>");
                                    }else{
                                        echo("<option value='$i'>$i</option>");
                                    }
                                }
                                echo("</select>");
                        echo("</p>");
                    }else{
                        echo("<h3>You didn't guess the number!</h3>");
                        echo("<p>Number: $password</p>");
                    }
                    
                }else if($number != $num2){
                    echo("<h3>GAME OVER!</h3>");
                    echo("<h3>You didn't guess the number!</h3>");
                    echo("<p>Number is: $password</p>");

                }else if($number == $num2){
                    echo("<h3>You quess the number!</h3>");
                    echo("<p>Number is: $password</p>");
                }
                
                echo("<p>attempt $tryEcho з 3</p>");
                
                
                
                $answersEncode = json_encode($answers);
                
                echo("<input type='hidden' name='password' value='$password'>");
                echo("<input type='hidden' name='try' value='$try'>");
                echo("<input type='hidden' name='answers' value='$answersEncode'>");
                echo("<input type='hidden' name='win' value='$win'>");
                


            ?>
        <p><input type="<?php if($tryEcho > 2 || $number == $num2){echo("hidden");}else{echo("submit");} ?>" name="run" value="Make your choice!"></p>
        <p><button class="button" type="submit" name="newGame">Start new game</button></p>
    </form>
    
</body>
</html>