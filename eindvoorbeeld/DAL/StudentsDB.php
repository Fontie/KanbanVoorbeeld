<?php
    class StudentsDB 
    {
        const DSN = "mysql:host=localhost;dbname=WIP";
        const USER = "root";
        const PASSWD = "";
           
        //Haal alle leerlingen op
        function selectAllStudent(){		
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            $statement = $pdo->prepare("SELECT * FROM RealStudents;");  
            
            $statement->execute(); 
            
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return $rows;
        }

        //Haal specifieke student op
        function selectStudent($studentId)
        {
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            $statement = $pdo->prepare("SELECT * FROM RealStudents WHERE Student_id = :Student_id;");  
            
            $statement->bindValue(":Student_id", $studentId, PDO::PARAM_INT);

            $statement->execute(); 
            
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            return $rows;
        }

        //Verwijder student
        function deleteStudent($studentId)
        {
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            $statement = $pdo->prepare("DELETE FROM RealStudents WHERE Student_id = :Student_id;");  
            
            $statement->bindValue(":Student_id", $studentId, PDO::PARAM_INT);

            $statement->execute(); 
        }

        //Maak student aan
        function createStudent($StudentFirstName, $StudentLastName, $StudentKlas)
        {
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            $statement = $pdo->prepare("INSERT INTO RealStudents(Naam, Achternaam, Klas) VALUES(:FirstName, :LastName, :Klas);");  
            
            $statement->bindValue(":FirstName", $StudentFirstName, PDO::PARAM_STR);
            $statement->bindValue(":LastName", $StudentLastName, PDO::PARAM_STR);
            $statement->bindValue(":Klas", $StudentKlas, PDO::PARAM_STR);        

            $statement->execute();
        }

        //Update Student
        function updateStudent($id, $FirstName, $LastName, $Klas)
        {
            $pdo = new PDO(self::DSN, self::USER, self::PASSWD);

            $statement = $pdo->prepare("UPDATE RealStudents SET FirstName = :FirstName, LastName = :LastName, Klas = :Klas WHERE Student_id = :Student_id");

            $statement->bindValue(":Student_id", $id, PDO::PARAM_INT);
            $statement->bindValue(":FirstName", $FirstName, PDO::PARAM_STR);
            $statement->bindValue(":LastName", $LastName, PDO::PARAM_STR);
            $statement->bindValue(":Klas", $Klas, PDO::PARAM_STR);

            $statement->execute();
        }
    }

?>
