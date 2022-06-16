<?php
    include_once "./DAL/StudentsDB.php";
    $db = new StudentsDB();
?>
<?php
if($_POST)
{
    $db->UpdateStudent(($_GET['id']), ($_POST['FirstName']),($_POST['LastName']),($_POST['Klas']));
    echo "Student Updated!";
}
?>

<!DOCTYPE html>
    <html>
        <head>
            <title>Update Studenten</title>
        </head>
        <h1>Update Student</h1>

        <form action="" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
        <?php
            $rows = $db->selectStudent($_GET['id']);
            foreach($rows as $row)
            {
                echo"
                        <td>First Name</td>
                        <td><input type='text' value = $row[FirstName] name='FirstName' class='form-control' /></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input name='LastName' value = $row[LastName] class='form-control'></input></td>
                    </tr>
                    <tr>
                        <td>Klas</td>
                        <td><input type='text' value = $row[Klas] name='Klas' class='form-control' /></td>
                    </tr>
                    " ;
            }
            
        ?>
        <tr>
            <td>
                <input type='submit' value='Update' href='index.php'/>
                    <a href='index.php' class='btn btn-danger'>Back to students</a>
            </td>
        </tr>

    </table>
</form>
    </html>