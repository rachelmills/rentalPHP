<?php
 
class Register {

  private $db;
  
  // Constructor - open DB connection
  function __construct() {
    $this->db = new mysqli('localhost', 'test', 'test', 'renteasy');
    $this->db->autocommit(FALSE);
  } 
 
  // Destructor - close DB connection
  function __destruct() {
    $this->db->close();
  }


  function register() {

    // Check for required parameters
    if (isset($_POST["password"]) && isset($_POST["firstname"]) && isset($_POST["surname"]) 
        && isset($_POST["tel"]) && isset($_POST["email"])) {

      // Put parameters into local variables
      $password = $_POST["password"];
      $firstname = $_POST["firstname"];
      $surname = $_POST["surname"];
      $tel = $_POST["tel"];
      $email = $_POST["email"];

      if ($_POST["user"] == 'landlord') {
        $stmt = $this->db->prepare('SELECT id FROM user_landlord WHERE email=?');
        $stmt->bind_param("s", $email);
        $stmt->execute();
	    $stmt->bind_result($id);
	    $stmt->fetch();
		$stmt->close();

	    if (!empty($id)) {
	      echo '{"success":0, error_message":"Email address already registered."}';
	    } else {
	      $stmt = $this->db->prepare('INSERT INTO user_landlord(id, firstname, surname, password, email, tel) VALUES (null, ?, ?, ?, ?, ?)');
	      $stmt->bind_param("sssss", $firstname, $surname, $password, $email, $tel);
          $success = $stmt->execute();
          if ($this->db->commit()) {
  		    echo '{"success":1}';
  	      } else {
  		    echo '{"success":0, error_message":"Registration not successful."}';
  	      }
          $stmt->close();
	    }
      } else if ($_POST["user"] == 'tenant') {
        $stmt = $this->db->prepare('SELECT id FROM user_tenant WHERE email=?');
        $stmt->bind_param("s", $email);
        $stmt->execute();
	    $stmt->bind_result($id);
	    $stmt->fetch();
		$stmt->close();

	    if (!empty($id)) {
	      echo '{"success":0, error_message":"Email address already registered."}';
	    } else {
	      $stmt = $this->db->prepare('INSERT INTO user_tenant(id, firstname, surname, password, email, tel) VALUES (null, ?, ?, ?, ?, ?)');
	      $stmt->bind_param("sssss", $firstname, $surname, $password, $email, $tel);
          $success = $stmt->execute();
          if ($this->db->commit()) {
  		    echo '{"success":1}';
  	      } else {
  		    echo '{"success":0, error_message":"Registration not successful."}';
  	      }
          $stmt->close();
	    }
      }  
    }
  }  
}
 
// This is the first thing that gets called when this page is loaded
// Creates a new instance of the Register class and calls the register method
$register = new Register;
$register->register();

?>
