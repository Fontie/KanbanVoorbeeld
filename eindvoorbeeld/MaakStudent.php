<?php
include_once "./DAL/StudentsDB.php";

$db = new StudentsDB();

if($_POST)
{
    $db->createStudent(($_POST['Naam']),($_POST['Achternaam']),($_POST['Klas']));
}

?>

<!DOCTYPE html>
<html>
    <head>
        <h1>Maak Student</h1>
    </head>
    <body>
        <form action="index.php" method="post">
            <table>
                <tr>
                    <td>Naam</td>
                    <td><input type="text" name="Naam"></td>
                </tr>
                <tr>
                    <td>Achternaam</td>
                    <td><input type="text" name="Achternaam"></td>
                </tr>
                <tr>
                    <td>Klas</td>
                    <td><input type="text" name="Klas"></td>
                </tr>
                <tr>
                    <td><input href="index.php" type="submit" value="Sla student op"></td>
                </tr>
            </table>
        </form>
    </body>
</html>
