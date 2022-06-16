<?php
    include_once "./DAL/StudentsDB.php";
    $db = new StudentsDB();
?>

<!DOCTYPE html>
    <html>
        <head>
            <h1>All Students</h1>
            <link rel="stylesheet" href="css/styleStudent.css">
        </head>
    <body>
        <table>
            <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Klass Name</td>
                <td>Actions</td>
            </tr>
            <?php
                $rows = $db->selectAllStudent();           
                foreach($rows as $row)
                {
                    $id = $row['Student_id'];
                    

                    echo "
                        <tr>
                            <td>$row[Naam]</td>
                            <td>$row[Achternaam]</td>
                            <td> $row[Klas]</td>
                            <td><button><a href='UpdateStudent.php?id=$id'>Update</button></td>
                            <td><button><a href='DeleteStudent.php?id=$id'>Delete</button></td>
                        </tr>
                    ";
                }
            ?>
        </table>
        

        <a href="MaakStudent.php">create new student</a>
    </body>
    </html>