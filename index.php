<?php
 
class TenantLogin {

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
    // print all tenants in database
  #  $stmt = $this->db->prepare('SELECT id, firstname, surname, password, email, tel FROM user_tenant');
  #  $stmt->execute();
  #  $stmt->bind_result($id, $firstname, $surname, $password, $email, $tel);
  #  while($stmt->fetch()) {
  #    echo "$firstname";
  #  }
  #  $stmt->close();

    // Check for required parameters
    if (isset($_POST["firstname"]) && isset($_POST["surname"]) && isset($_POST["password"])) {

      // Put parameters into local variables
      $firstname = $_POST["firstname"];
      $surname = $_POST["surname"];
      $password = $_POST["password"];
      
      if ($firstname == 'Rachel' && $surname == 'Mills' && $password == 'Colchester') {
        echo '{"success":1}';
        } 
        //else {
  //        echo '{"success":0, error_message":"Username and/or password is invalid."}';
  //        }
      // Look up code in database
 //     $user_id = 0;
 //     $stmt = $this->db->prepare('SELECT id, firstname, surname, password FROM user_landlord WHERE firstname=? AND surname=? and password=?');
 //     $stmt->bind_param("sss", $firstname1, $surname1, $password1);
 //     $stmt->execute();
//	  $stmt->bind_result($id, $firstname1, $surname1, $password1);
      
  //    while ($stmt->fetch()) {
  //      echo "what";
//	    printf("id is %d\n %s\n %s\n %s\n", $id, $firstname1, $surname1, $password1);
//	    printf("%s\n %s\n %s\n", $firstname, $surname, $password);
 //       break;
  //    }
   //   $stmt->close();
      
      // Log message if user not found
      if ($id) {
        return false;
      }
    }
  }
}
 
// This is the first thing that gets called when this page is loaded
// Creates a new instance of the TenantLogin class and calls the login method
$login = new TenantLogin;
$login->login();

?>
