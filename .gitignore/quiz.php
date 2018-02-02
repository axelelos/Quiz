<!-- quiz.php -->
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Namnlöst dokument</title>
</head>
<body>
    <h1>Quiz</h1>
    <?php
    if (isset($_POST['quiz']))
        $qnr = $_POST['quiz'];
    else
        header("Location:choosequiz.php");
    
    $qantal = 0;
    $aantal = 0;
    include ('dbconnection.php');

    $sql = "SELECT * FROM quiz WHERE id=?";
    $stmt = $dbconn->prepare($sql);
    $data = array($qnr);
    $stmt->execute($data);

    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    $quizname = $res["name"];
    ?>
    <h2><?php echo $quizname ?></h2>
    <form method="post" action="results.php"> <!-- sätt in en sida här -->
        <table>
            <?php

            $sql = "SELECT * FROM frågor WHERE quizid=?";
            $stmt = $dbconn->prepare($sql);
            $data = array($qnr);
            $stmt->execute($data);

            while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $q = $res["fråga"];
                $qid = $res["id"];
                $aantal=0;
                $qantal++;
                ?>
                <tr><td colspan="2"><h3><?php echo $q ?></h3></td></tr>
                <?php
                $sql1 = "SELECT * FROM svar WHERE quizid=?";
                $stmt1 = $dbconn->prepare($sql1);
                $data1 = array($qnr);
                $stmt1->execute($data1);

                while ($res1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                    if($res1["frågaid"]==$qid){
                        $aantal++;
                        $a = $res1["rättsvar"];
                        $b = $res1["felsvar1"];
                        $c = $res1["felsvar2"];
                        $id = $res1["id"];
                        ?>
                        <tr><td><input type="radio" name=<?php echo $qid ?> value=<?php echo $id ?>></td><td><?php echo $a ?></td></tr>
                        <tr><td><input type="radio" name=<?php echo $qid ?> value=<?php echo $id ?>></td><td><?php echo $b ?></td></tr>
                        <tr><td><input type="radio" name=<?php echo $qid ?> value=<?php echo $id ?>></td><td><?php echo $c ?></td></tr>
                        <?php
                    }
                }
            }
            $dbconn = null;
            ?>
            <input type="hidden" name="qantal" value=<?php echo $qantal?>>
            <input type="hidden" name="aantal" value=<?php echo $aantal?>>
            <input type="hidden" name="qnr" value=<?php echo $qnr?>>
        <tr><td></td><td><br><button type="submit">Se resultat</button></td></table>
    </form>
</body>
</html>
