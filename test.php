<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гра екстрасенс</title>
</head>
<body>
        <form method="POST" action="index.php">
            
            <?php
                session_start();
                //session_unset();
                if (isset($_SESSION["ahswers"])) {
                    $answers = json_decode($_SESSION["answers"]);
                } else {
                    $answers = [
                        ["Ти екстрасенс", "Спробуй ще", "Сьогодні не твій день"],
                    ];
                }
                
                if (isset($_POST['newGame'])) {
                    header("refresh: 0;");
                    
                }
                if (isset($_POST['password'])) { 
                    $password = $_POST['password'];
                } else {
                    $password = rand(1, 10);
                }
                array_push ($answers);

            
                
                if ($_POST){
                    $try = $_POST['try'];
                   
                    if(isset($_POST['Game'])) {
                        $choose = $_POST['choose'];
                        for ($i=0; $i < count($try); $i++) {
                            if ($password == $_POST['choose']){
                                echo ("<p>".$answers[$i][0]."</p>");
                                } else if ($password != $choose)  {
                                    echo ("<p>".$answers[$i][1]."</p>");
                                    array_push($answers);
                                } if (count($try) == 2) {
                                  echo "<p>Залишилась 1 спроба</p>";
                                } else if (count($try) == 3 && $password != $choose ) {
                                    echo ("<p>".$answers[$i][3]."</p>");
                                }
                                
                            }
                    }  
                }      
                        
                        echo("<p>");
                            echo ("<select name = 'choose'>");
                                for ($i = 1; $i <= 10; $i++){
                                    echo ("<option value='".$i."'>".$i."</option>");
                                    
                                }
                            echo ("<select>");
                        echo("</p>");

                        $_SESSION["answers"] = json_encode($answers);
                                    
                    ?>       
                
                
                        
            <input type='hidden' name='password' value="<?php echo($password); ?>">
            <p><button class="button" type="submit" name="newGame">Start new game</button></p>
            <input type="submit" name="Game" value="Game" />

        </form> 
    
</body>
</html>