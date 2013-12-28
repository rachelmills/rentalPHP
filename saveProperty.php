<?php
 
class Property {

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

  function saveProperty() {

    // Check for required parameters
  //  if (isset($_POST["email"]) && isset($_POST["password"])) {

      // Put parameters into local variables
      $propertyType = $_POST["propertyType"];      
      $landlordId = 1;
      $numberBeds = 2;
      $numberBathroomcs = 1;
      $numberCarSpaces = 1;
      $petsAllowed = 0;

      $stmt = $this->db->prepare('INSERT INTO property(propertyId, landlordId, propertyType, numberBeds, numberBathrooms, numberCarSpaces, petsAllowed) VALUES (null, ?, ?, ?, ?, ?, ?)');
        
      
        $stmt->bind_param("isiiii", $landlordId, $propertyType, $numberBeds, $numberBathroomcs, $numberCarSpaces, $petsAllowed);
        $success = $stmt->execute();
        if ($this->db->commit()) {
  		    echo '{"success":1}';
  	      } else {
  		    echo '{"success":0, error_message":"Registration not successful."}';
  	      }
          $stmt->close();
	   	  
	  
  	  
  	  
    //}
  }
}
 
// This is the first thing that gets called when this page is loaded
// Creates a new instance of the TenantLogin class and calls the login method
$property = new Property;
$property->saveProperty();

?>
