<?php
    include_once "./DAL/StudentsDB.php";
    $db = new StudentsDB();

    if(!empty($_GET['id']))
    {
        $db->deleteStudent($_GET['id']);
    }

    header("Location: index.php");
?>
