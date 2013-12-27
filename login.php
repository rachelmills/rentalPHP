<?php
 
class Login {

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

  function login() {

    // Check for required parameters
    if (isset($_POST["email"]) && isset($_POST["password"])) {

      // Put parameters into local variables
      $email = $_POST["email"];
      $password = $_POST["password"];

      if ($_POST["user"] == 'landlord') {
        $stmt = $this->db->prepare('SELECT id FROM user_landlord WHERE email=? AND password=?');
      }  
      else if ($_POST["user"] == 'tenant') {
        $stmt = $this->db->prepare('SELECT id FROM user_tenant WHERE email=? AND password=?');
      }
        
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
	    $stmt->bind_result($id);
	   	  
	  $i = 0;
	  $id_array = array();
	  while ($stmt->fetch()) {
	    array_push($id_array, $id);
      	}
  	  $stmt->close();
  	  
  	  if (count($id_array) == 1) {
  	    echo '{"success":1}';
  	    } else {
  	    echo '{"success":0, error_message":"Email and/or password is invalid."}';
  	    }
    }
  }
}
 
// This is the first thing that gets called when this page is loaded
// Creates a new instance of the TenantLogin class and calls the login method
$login = new Login;
$login->login();

?>
