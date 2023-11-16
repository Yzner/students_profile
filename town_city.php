<?php
include_once("db.php"); // Include the Database class file

class TownCity {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM town_city";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle errors (log or display)
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function create($data) {
        try {
            // Code to create a new user in the database
            $sql = "INSERT INTO town_city(id,name) 
            VALUES(:id, :name);";
            $stmt = $this->db->getConnection()->prepare($sql);
            // Bind values to placeholders
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':name', $data['name']);
            // Execute the INSERT query
            $stmt->execute();

            // Check if the insert was successful
            return $stmt->rowCount() > 0;

        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
        
    }

    public function read($id) {
        try {
            $connection = $this->db->getConnection();

            $sql = "SELECT * FROM town_city WHERE id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // Fetch the student data as an associative array
            $towndata = $stmt->fetch(PDO::FETCH_ASSOC);

            return $towndata;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function update($id, $data) {
        try {
            $sql = "UPDATE town_city SET
                    id = :id,
                    name = :name
                    WHERE id = :id";

            $stmt = $this->db->getConnection()->prepare($sql);
            // Bind parameters
            $stmt->bindValue(':id', $data['id']);
            $stmt->bindValue(':name', $data['name']);

            // Execute the query
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }


    public function delete($id) {
        try {
            $sql = "DELETE FROM town_city WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // Check if any rows were affected (record deleted)
            if ($stmt->rowCount() > 0) {
                return true; // Record deleted successfully
            } else {
                return false; // No records were deleted (student_id not found)
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
}




// class TownCity {
//     private $db;

//     public function __construct($db) {
//         $this->db = $db;
//     }

//     public function create($data) {
//         try {
//             // Code to create a new user in the database
//             $sql = "INSERT INTO town_city(id,name) 
//             VALUES(:id, :name);";
//             $stmt = $this->db->getConnection()->prepare($sql);
//             // Bind values to placeholders
//             $stmt->bindParam(':id', $data['id']);
//             $stmt->bindParam(':name', $data['name']);
//             // Execute the INSERT query
//             $stmt->execute();

//             // Check if the insert was successful
//             return $stmt->rowCount() > 0;

//         } catch (PDOException $e) {
//             // Handle any potential errors here
//             echo "Error: " . $e->getMessage();
//             throw $e; // Re-throw the exception for higher-level handling
//         }
        
//     }

//     public function read($id) {
//         try {
//             $connection = $this->db->getConnection();

//             $sql = "SELECT * FROM town_city WHERE id = :id";
//             $stmt = $connection->prepare($sql);
//             $stmt->bindValue(':id', $id);
//             $stmt->execute();

//             // Fetch the student data as an associative array
//             $towndata = $stmt->fetch(PDO::FETCH_ASSOC);

//             return $towndata;
//         } catch (PDOException $e) {
//             echo "Error: " . $e->getMessage();
//             throw $e; // Re-throw the exception for higher-level handling
//         }
//     }

//     public function update($id, $data) {
//         try {
//             $sql = "UPDATE town_city SET
//                     id = :id,
//                     name = :name
//                     WHERE id = :id";

//             $stmt = $this->db->getConnection()->prepare($sql);
//             // Bind parameters
//             $stmt->bindValue(':id', $data['id']);
//             $stmt->bindValue(':name', $data['name']);

//             // Execute the query
//             $stmt->execute();

//             return $stmt->rowCount() > 0;
//         } catch (PDOException $e) {
//             echo "Error: " . $e->getMessage();
//             throw $e; // Re-throw the exception for higher-level handling
//         }
//     }


//     public function delete($id) {
//         try {
//             $sql = "DELETE FROM town_city WHERE id = :id";
//             $stmt = $this->db->getConnection()->prepare($sql);
//             $stmt->bindValue(':id', $id);
//             $stmt->execute();

//             // Check if any rows were affected (record deleted)
//             if ($stmt->rowCount() > 0) {
//                 return true; // Record deleted successfully
//             } else {
//                 return false; // No records were deleted (student_id not found)
//             }
//         } catch (PDOException $e) {
//             echo "Error: " . $e->getMessage();
//             throw $e; // Re-throw the exception for higher-level handling
//         }
//     }
// }
?>
