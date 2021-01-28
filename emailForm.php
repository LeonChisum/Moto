<?php 
$messageSent = false;

if(isset($_POST['submit']) && $_POST['email'] != '') {

    if ( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
          // submitting form
    $email = $_POST['email'];

    $mailTo = "testwebsitemoto@gmail.com";
    $headers = "From: ".$email;
    $subject = "Moto Pre-Order";
    $txt = "You have recieved a new inquiry for a pre-order!";

    $mailSuccess = mail($mailTo, $subject, $txt, $headers);
    $messageSent = true;
    }

}

$email = $_POST['email'];

if(!empty($email)) {
    #code...

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "root";
    $dbName = "testmoto";

    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if(mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'.mysqli_connect_error());
    } else {
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT = "INSERT Into register (email) values (?)";

        //prepare statment for SQL
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    
    //# of rows returned if email is found
    $rnum = $stmt->num_rows();
    
    if($rnum == 0){
        $stmt->close();
        
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        echo "You've Been Successfully Added To Our Email List";
    } else {
        echo "This Email Is Already On Our List!";
    }

    $stmt->close();
    $conn->close();
    }
    
} else {
    echo "Email field required";
    die();
}

?>