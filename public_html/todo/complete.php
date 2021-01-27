<?php
header('Content-type: application/json; charset= utf8');

include('../../db.php');

try {
    $pdo = new PDO(
        "mysql:host=$db[host];dbname=$db[dbname];port=$db[port];charset=$db[charset]",
        $db['username'],
        $db['password']
    );
} catch (PDOException $e) {
    echo "Database connection failed.";
    exit;
}

$sql = 'SELECT iscomplete FROM todos WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
$statement->execute();
$todo = $statement->fetch(PDO::FETCH_ASSOC);

$sql = 'UPDATE todos SET iscomplete =:iscomplete WHERE id =:id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':iscomplete', !$todo['iscomplete'], PDO::PARAM_INT);
$statement->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
$result = $statement->execute();

if ($result) {
    echo json_encode(['id'=>$_POST['id'],'iscomplete'=>!$todo['iscomplete']]);
} else {
    echo 'error';
}
