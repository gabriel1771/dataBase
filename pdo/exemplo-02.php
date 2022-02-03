<?php



$conn = new PDO("sqlsrv:DataBase=dbphp7;Server=LAPTOP-I5F1UOQG;ConnectionPooling=0", "sa", "root");

$stmt = $conn->prepare("SELECT * FROM tb_usuarios ORDER BY deslogin");

$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $row) {
    foreach ($row as $key => $value) {
        echo "<strong>" .$key ."<strong>" .": " .$value ."<br>";
    }

    echo "============================================= <br>";
    
}

//var_dump($result);


?>