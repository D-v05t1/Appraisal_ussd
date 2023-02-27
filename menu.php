<?php
include_once __DIR__."/config/config.php";
require_once __DIR__ . '/vendor/autoload.php'; // Path to Africa's Talking SDK
use AfricasTalking\SDK\AfricasTalking;

// Set your credentials

$username = 'sandbox';
$apiKey = 'c9429a7f0320a3364ba80b7ac09145ef8e2015d36bea42de42872facb9724328';

// Create an instance of the SDK
$AT = new AfricasTalking($username, $apiKey);
class Menu{
private $phoneNumber;

public function __construct($phone){
$this->phoneNumber=$phone;
}

public function firstScreen(){
echo $response="CON Welcome to staff PAS.\n Fill or view your appraisal report?\n ";
echo $response1="1:Register\n";
echo $response2="2:Fill report\n";
echo $response3="3:View report\n";
echo $response4="4:Exit\n";
}

public function register($text){

    $level=count($text);

    $response="CON Please enter your First Name";
  
        if($level==1){
            echo $response="CON Please enter your First Name";
        }

        elseif($level==2){
            echo  $response="CON Please enter your Last Name";
        }
        
        elseif($level==3){
            echo  $response="CON Please enter your Email Address";
        }
         
        elseif($level==4){
            echo  $response="CON Please enter your Department";
        }
    
        elseif($level==5){
            echo  $response="CON Please enter your Designation";
        }

        elseif($level==6){
           
            $db = new mysqli("localhost","root","","appraisal");
           $fname=$text[1];
           $lname=$text[2];
           $email=$text[3];
           $department=$text[4];
           $designation=$text[5];

            
            /*$sqlsmt5=("INSERT INTO `employees` (first_name, last_name, email,department,designation, phone_no)
            VALUES ('$fname', '$lname', '$email', '$department', '$designation', '$this->phoneNumber')");*/
            $sqlsmt5 = "INSERT INTO `employees` (first_name, last_name, email, department, designation, phone_no)
            VALUES ('$fname', '$lname', '$email', '$department', '$designation', '$this->phoneNumber')";

            $execute=mysqli_query($db,$sqlsmt5);
            echo  $response="END Thank you for registering\n THANKS";
            
        }}
   
   public function fillreport($text){
    $level=count($text);
    $response="CON Please enter Department Objectives";


        if($level==1){
            echo  $response="CON Please enter your First Objective";
        }
        
        elseif($level==2){
            echo  $response="CON Please enter your Second Objective";
        }

        elseif($level==3){
            echo $response="CON Please enter your Third objective";
        }
         
         elseif($level==4){
            echo  $response="CON In the range of 1-5 Please rate your Perfomance on the following\n";
            echo  $response=" Integrity";
        }
        
        elseif($level==5){
            echo  $response="CON In the range of 1-5 Please rate your Perfomance on the following\n";
            echo  $response=" Public Participation";
        }
        
        elseif($level==6){
            echo  $response="CON In the range of 1-5 Please rate your Perfomance on the following\n";
            echo  $response="Public Transparency Accountability";
        }
        
        elseif($level==7){
            echo  $response="CON In the range of 1-5 Please rate your Perfomance on the following\n";
            echo  $response=" Confidentiliaty";
        }

        elseif($level==8){
           
            $db = new mysqli("localhost","root","","appraisal");
           $objective1=$text[1];
           $objective2=$text[2];
           $objective3=$text[3];
           $integrity=$text[4];
           $public=$text[5];
           $transparency=$text[6];
           $confidentiality=$text[7];
           

             $sqlsmt3=("INSERT INTO `data` (objective1, objective2, objective3, integrity, public, transparency, confidentiality, phone_no)

             VALUES ('$objective1', '$objective2','$objective3', '$integrity', '$public', '$transparency', '$confidentiality', '$this->phoneNumber')");
             
            $execute=mysqli_query($db,$sqlsmt3);
            echo  $response="END Thank you for filling appraisal report\n THANKS";
            
        }
   

}

public function viewreport($text){
    $level=count($text);
    $response="CON Sent your report to your messages";

    if ($level==1) { 
       /* $conn = new mysqli("127.0.0.1","root","","appraisal");
     
        $sql = "SELECT * FROM data WHERE phone_no='".$this->phoneNumber."'";
        $result = $conn->query($sql);
       
        if ($result->num_rows > 0) {
            // Get the user data
            $row = $result->fetch_assoc();
            $fname = $row["first_name"]; 
            $lname = $row["last_name"]; 
            $email = $row["email"]; 
            $department = $row["department"]; 
            $designation = $row["designation"]; 
            $objective1 = $row["objective1"]; 
            $objective2 = $row["objective2"]; 
            $objective3 = $row["objective3"]; 
            $integrity = $row["integrity"]; 
            $public = $row["public"]; 
            $transparency = $row["transparency"]; 
            $confidentiality = $row["confidentiality"]; 

            // Generate the report
            $report = "Employee Name: $fname $lname\nEmail: $email\nDepartment: $department\nDesignation: $designation\n\n";
            $report .= "Objective 1: $objective1\nObjective 2: $objective2\nObjective 3: $objective3\n\n";
            $report .= "Integrity: $integrity/5\nPublic Participation: $public/5\nPublic Transparency Accountability: $transparency/5\nConfidentiliaty: $confidentiality/5\n";
*/
            // Send the report via SMS
            $sms = $AT->sms();
            $sms->send([
                'to'      => $this->phoneNumber,
                'message' => "good morning",
                'from' => 'Mmust'
            ]);

            echo $response;
            exit;
       /* }
    

    echo $response;*/
}
/*public function viewreport($text){
    $level=count($text);
    $response="CON sent your report to your messages";
    
    if ($level==1) {
    $conn = new mysqli("localhost","root","","appraisal");
    $sql = "SELECT * FROM data WHERE phone_no='".$this->phoneNumber."'"; // Use the phone number stored in $this->phoneNumber
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Get the user data
        $row = $result->fetch_assoc();
        // Generate the report message
        $message = "Appraisal Report:\n";
        $message .= "Objective 1: ".$row["objective1"]."\n";
        $message .= "Objective 2: ".$row["objective2"]."\n";
        $message .= "Objective 3: ".$row["objective3"]."\n";
        $message .= "Integrity: ".$row["integrity"]."\n";
        $message .= "Public Participation: ".$row["public"]."\n";
        $message .= "Public Transparency Accountability: ".$row["transparency"]."\n";
        $message .= "Confidentiality: ".$row["confidentiality"]."\n";
        // Send the message via SMS
        $sms = $AT->sms();
        $sms->send([
            'to' => $this->phoneNumber,
            'message' => $message,
        ]);
        echo "END Report sent to your phone\n";
    } else {
        echo "END No report found for this phone number\n";
    }}
}*/
}}

    ?>

        