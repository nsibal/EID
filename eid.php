
<?php
session_start();

$message = "";
$error = "";
$valdiv = "none";
$checkEmailBtn = "block";
$registerBtn = "none";
$gender;

if (isset($_POST['checkEmail'])) {
    
    /*echo "<script>$('#register').modal('show');</script>";*/
    
    /*echo "<script>$('#register').modal({'backdrop': 'static'});</script>";*/
    /*$gender = $_POST['gender'];*/
    global $gender;
	
	$_SESSION["uniqid"] = uniqid("EID");
	
	require 'PHPMailer-master/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	
	$mail->isSMTP();
	$mail->IsHTML(true);
	$mail->SMTPSecure = 'ssl';
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	
	$mail->Username = 'noreply.teameid@gmail.com';
	$mail->Password = 'teameid1';
	
	$mail->setFrom('noreply.teameid@gmail.com', 'Team EID');
	$mail->addAddress($_POST['email']);
	
	$mail->Subject = 'Validate your email address @ EID';
	$mail->Body = 'Greetings!<br><br>Please validate this email address at EID to continue by entering the following unique ID<br><br>Unique ID: <b>' . $_SESSION["uniqid"] . '</b><br><br><br><br><br><br>Regards,<br><br>Team EID';
	
	//send the message, check for errors
	if (!$mail->send()) {
		//$dom = new DOMDocument();
		//$dom->validateOnParse = true;
		$message = "ERROR: " . $mail->ErrorInfo;
		//echo "showUniqueID();";
		//echo "<script> showUniqueID(); </script>";
		//echo "<script>".$dom->getElementById("val-div").".style.display:\"block\";</script>";
		//echo "<script>document.getElementById(\"val-div\").show();</script>";
		//echo "<script>alert(\"Helo\");</script>";
	} else {
		$message = "A unique ID has been sent to your email address. Please enter the ID and click Validate";
		$valdiv = "block";
        $checkEmailBtn = "none";
		//echo "<script>".$dom->getElementById("val-div").".show();</script>";
	}
} elseif (isset($_POST['validate'])) {
	if ($_POST['uniqID'] == $_SESSION['uniqid']) {
		/*$error = "";*/
		$valdiv = "none";
        $registerBtn = "block";
        $checkEmailBtn = "none";
	} else {
		$error = "Not matched";
        $valdiv = "block";
        $registerBtn = "none";
        $checkEmailBtn = "block";
	}
} elseif (isset($_POST['register-btn'])) {
    
    
    /*foreach (glob("/Applications/XAMPP/xamppfiles/lib/php/fonts/*.php") as $filename) {
        include $filename;
    }*/
    
    
    require('fpdf181/fpdf.php');
    /*require('/Applications/XAMPP/xamppfiles/lib/php/fpdf.php');
    require('fpdf181/fonts/helveticab.php');
    require('/Applications/XAMPP/xamppfiles/lib/php/fonts/helveticab.php');*/
    
    /*$include_path = '.:/Applications/XAMPP/xamppfiles/lib/php';
    require('fpdf181/fpdf.php');*/
    
    $eid = uniqid("EID-",true);
    
    class PDF extends FPDF {
        function Header() {
            $this->Image('resources/img/1024px-Ashoka_Chakra.svg.png',0,0,12,0,'PNG');
            $this->SetTextColor(0,0,136);
            /*$this->SetDrawColor(136,0,0);*/
            $this->SetFont('Helvetica','B',10);
            $this->Cell(10);
            $this->Cell(0,-7,'GOVERNMENT OF INDIA',0,1,'C');
            $this->Line(0,13,85.60,13);
            $this->Ln(4);
        }
        function Footer() {
            global $eid;
            $this->SetDrawColor(136,0,0);
            $this->SetLineWidth(0.5);
            $this->Line(0,47,85.60,47);
            $this->SetY(-3);
            $this->SetTextColor(136,0,0);
            $this->SetFont('Helvetica','B',8);
            $this->Cell(0,0,$eid,0,1,'C');
        }
    }
    
    /*$pdf = new FPDF();*/
    //Credit Card size PDF
    $pdf = new PDF('L','mm',array(85.60,53.98));
    $pdf->AddPage();
    $pdf->Image($_POST['picture'],2,15,30,0,'JPG');
    $pdf->SetFont('Helvetica','',11);
    $pdf->Text(34,20,$_POST['firstname'].' '.$_POST['lastname']);
    $pdf->Text(34,25,$_POST['dob']);
    $pdf->Text(34,30,$_POST['gender']);
    $pdf->Text(34,35,$_POST['phone']);
    $pdf->Text(34,40,$_POST['email']);
    
    $pdf->AddPage();
    $pdf->SetFont('Helvetica','B',9);
    $pdf->Text(2,18,'Father\'s Name:');
    $pdf->SetFont('Helvetica','',9);
    $pdf->Text(27,18,'Mr. '.$_POST['father']);
    $pdf->SetFont('Helvetica','B',9);
    $pdf->Text(2,22,'Address:');
    $pdf->SetFont('Helvetica','',9);
    $pdf->SetXY(2,26);
    $pdf->Cell(0,0,$_POST['address'],0,'L');
    $pdf->SetFont('Helvetica','B',7);
    $pdf->Text(2,35,'Aadhaar Card: ');
    $pdf->SetFont('Helvetica','',7);
    $pdf->Text(20,35,$_POST['aadhaar']);
    $pdf->SetFont('Helvetica','B',7);
    $pdf->Text(40,35,'Driving License: ');
    $pdf->SetFont('Helvetica','',7);
    $pdf->Text(61,35,$_POST['drivlc']);
    $pdf->SetFont('Helvetica','B',7);
    $pdf->Text(2,40,'PAN Card: ');
    $pdf->SetFont('Helvetica','',7);
    $pdf->Text(20,40,$_POST['pan']);
    $pdf->SetFont('Helvetica','B',7);
    $pdf->Text(40,40,'Voter ID Card: ');
    $pdf->SetFont('Helvetica','',7);
    $pdf->Text(61,40,$_POST['voter']);
    $pdf->Output();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>EID | Government Of India</title>
    <link rel="icon" type="image/png" href="resources/img/1024px-Ashoka_Chakra.svg.png">
    <script src="resources/js/jquery-3.1.1.js"></script>
    <script src="resources/js/bootstrap.min.js"></script>
    <script src="resources/js/bootstrap-datepicker.min.js"></script>
    <script src="resources/js/main.js"></script>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="resources/css/normalize.css">-->
    <link rel="stylesheet" href="resources/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="resources/css/main.css">
    <meta name="theme-color" content="#90CAF9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <script>
       /*Loading the date picker*/
 $(document).ready(function(){
    $('.datepicker-me').datepicker({
    format: 'MM dd, yyyy',
    weekStart: '1',
    startDate: '-100y',
    endDate: '-18y',
    autoclose: true
});
});
        
        /*$(function(){
            $('#register-form').submit(function(e){
                    e.preventDefault();
                
                $form = $(this);
                
                $.post('checkEmail.php', $(this).serialize() function(data){
                    
                }); 
                
            });
        });
        */
        /*$(document).on('click','#checkEmail',function(e){
            e.preventDefault();
            $.ajax({
            url:'checkEmail.php',
                data: $('#register-form').serialize(),
                type: 'POST',
                dataType: 'json',
            success:function(data){ 
                console.log(data);
            }
        });
        });*/
        
        /*$(document).ready(function(){
            $('#checkEmail').click(function(){
               $('#register').modal({
                   backdrop: 'static';
               }); 
            });
        });*/
        
        /*function openRegister() {
            $('#register').modal({
                show: true;
            });
        }*/
        
        

    </script>
</head>
<body>
  
    <div class="header2"></div>
    
    <section id="eid">
        <div class="container"> <!--style="min-height: 100%; height: 100%;"-->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="heading">EID</h1>
                </div>
            </div>
          
            <!-- Button trigger modal -->
          
            <!--<div class="row text-center" id="main-buttons" style="border: 2px black solid;">
              <div class="col-sm-4">
                <div class="main-buttons">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Update
                    </button>   
                </div>
              </div>
              <div class="col-sm-4">
                 <div class="main-buttons">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Register
                    </button> 
                 </div>
              </div>
              <div class="col-sm-4">
                  <div class="main-buttons">
                      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Download
                      </button>
                  </div>                
              </div>
            </div>-->
            <!--<div class="row" id="main-buttons" style="border: 2px black solid;">
              <div class="col-md-12">
                  <div class="main-buttons">
                      Applying for a credit card or a bank loan or even just a prepaid mobile connection has become tough due to the various steps of verification, done by the government officials to be able to provide the stated facilities to the layman. The verification steps comprise of verifying different documents, getting the attested copies of the same by a gazetted officer and the person himself and a lot more. This leads to a pile of papers in the offices for that one person and is kept for hundreds of years.
                      <br>
                      Therefore, we intend to provide banks, organisations and common people a way to simplify the process of document application and verification. We have named the all in one information container, the <b>'EID'</b>. 
                  </div>
              </div>
          </div>-->
          
          <div class="row text-center" id="main-buttons-wrapper">
              <div class="col-xs-12 col-sm-12 col-md-4 col-md-4 main-buttons">
                  <input type="button" class="btn btn-primary btn-lg btn-block" value="Register" data-toggle="modal" data-target="#register"/>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-4 col-md-4 main-buttons">
                  <input type="button" class="btn btn-primary btn-lg btn-block" value="Update" data-toggle="modal" data-target="#update"/>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-4 col-md-4 main-buttons">
                  <input type="button" class="btn btn-primary btn-lg btn-block" value="Download" data-toggle="modal" data-target="#download"/>
              </div>
          </div>
          
        </div>
    </section>
        


<!-- Modal -->
<form action="" class="form-horizontal" method="post" role="form" id="register-form">
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Register for a new EID</h4>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
           <!--<form action="index.html" class="form-horizontal" method="post" role="form">-->
             
             <div class="form-group">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-element">
                     <label class="btn btn-lg btn-file btn-danger btn-block">Upload Picture<input type="file" style="display:none;" accept=".jpg,.png" required name="picture" id="picture" value="<?php if (isset($_POST['picture'])) echo $_POST['picture'];?>"/></label>
                 </div>
             </div>
              
              <div class="form-group">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-element">
                      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" autocomplete="off" required pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed." value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname'];?>"/>
                  </div>
                  
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-element">
                      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required autocomplete="off" pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed." value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname'];?>"/>
                  </div>
                  
              </div>
              
              <div class="form-group">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-element">
                  
                        <!--<div class="input-group date" data-provide="datepicker">
    <input type="text" class="form-control">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div>-->
                 
                 <div class="input-group date datepicker-me" data-provide="datepicker">
  <input type="text" class="form-control" autocomplete="off" required placeholder="Date Of Birth" name="dob" id="dob" value="<?php if (isset($_POST['dob'])) echo $_POST['dob'];?>"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
</div>
                  
                      <!--<input type="date" class="form-control" value="Date Of Birth" max="31/12/1997" required/>-->
                  
                  </div>
                  
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-element">
                  
                      
                      
                      <select name="gender" id="gender" class="form-control" required>
                         <?php $gender = $_POST['gender']; ?>
                          <option value="" disabled selected>Gender</option>
                          <option value="Male" <?php if($gender == 'Male'): ?> selected="selected"<?php endif; ?>>Male</option>
                          <option value="Female" <?php if($gender == 'Female'): ?> selected="selected"<?php endif; ?>>Female</option>
                          <option value="Other" <?php if($gender == 'Other'): ?> selected="selected"<?php endif; ?>>Other</option>
                      </select>
                      
                  </div>
                  
              </div>
              
              <div class="form-group">
                  
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-element">
                      <input type="text" class="form-control" id="father" name="father" placeholder="Father's Name" required autocomplete="off" pattern="[A-Za-z\s]+" title="Only alphabets and spaces allowed." value="<?php if (isset($_POST['father'])) echo $_POST['father'];?>"/>
                  </div>
                  
              </div>
              
              <div class="form-group">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-element">
                  <textarea name="address" id="address" class="form-control" rows="3" placeholder="Residential Address" required autocomplete="off" wrap="soft" style="resize: none;"><?php if (isset($_POST['address'])) echo $_POST['address'];?></textarea>
                  </div>
              </div>
              
              <div class="form-group">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-element">
                 <input type="tel" class="form-control" placeholder="Phone Number" required autocomplete="off" name="phone" id="phone" pattern="[\+]\d{12}" title="Format should be + and 12 digits. No space or special character allowed." value="<?php if (isset($_POST['phone'])) echo $_POST['phone'];?>">
                  </div>
               </div>
              
              <div class="form-group">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-element">
                      <input type="text" class="form-control" id="aadhaar" name="aadhaar" placeholder="Aadhaar Card" autocomplete="off" required pattern="\d{4}[\s]\d{4}[\s]\d{4}" title="Format should be XXXX XXXX XXXX where X should be only a digit." value="<?php if (isset($_POST['aadhaar'])) echo $_POST['aadhaar'];?>"/>
                  </div>
                  
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-element">
                      <input type="text" class="form-control" id="drivlc" name="drivlc" placeholder="Driving License" required autocomplete="off" pattern="[A-Z]{2}[\-]\d{13}" title="Format should be YY-XXXXXXXXXXXXX where Y should be an uppercase letter and X should be a digit." value="<?php if (isset($_POST['drivlc'])) echo $_POST['drivlc'];?>"/>
                  </div>
                  
              </div>
              
              <div class="form-group">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-element">
                      <input type="text" class="form-control" id="pan" name="pan" placeholder="PAN Card" autocomplete="off" required pattern="[A-Z0-9]{10}" title="10 characters allow which should be a combination of uppercase letter and digits." value="<?php if (isset($_POST['pan'])) echo $_POST['pan'];?>"/>
                  </div>
                  
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-element">
                      <input type="text" class="form-control" id="voter" name="voter" placeholder="Voter ID Card" required autocomplete="off" pattern="[A-Z0-9]{10}" title="10 characters allow which should be a combination of uppercase letter and digits." value="<?php if (isset($_POST['voter'])) echo $_POST['voter'];?>"/>
                  </div>
                  
              </div>
              
              <!--<div class="form-group">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-element">
                      <input type="submit" value="Go">
                  </div>
              </div>-->
              
              <div class="form-group">
                  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 form-element">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autocomplete="off" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>"/>
                  </div>
                  
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 form-element">
                      <input type="submit" class="btn btn-warning btn-block" id="checkEmail" name="checkEmail" value= "Check Email" style="display: <?php echo $checkEmailBtn; ?>;"/>
                  </div>
                  
                  
              </div>
              <span style="margin-bottom: 5%;"><?php echo $message; ?></span>
               
               <div class="form-group" style="display: <? echo $valdiv; ?>;">
                  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 form-element">
                      <input type="text" class="form-control" id="uniqID" name="uniqID" placeholder="Unique ID" autocomplete="off" value="<?php if (isset($_POST['uniqID'])) echo $_POST['uniqID'];?>"/>
                  </div>
                  
                  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 form-element">
                      <input type="submit" class="btn btn-success btn-block" id="validate" name="validate" value="Validate"/>
                  </div>
                  
                  
                  
              </div>
               <span style="margin-bottom: 5%;"><?php echo $error; ?></span>
               
           
       </div>
      </div>
      <div class="modal-footer">
       
       
       <input type="submit" class="btn btn-primary btn-lg" value="Register" name="register-btn" id="register-btn" style="display: <?php echo $registerBtn; ?> ; float: right;">
       <!--<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel" id="cancel"/>-->
        <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Register</button>-->
      </div>
    </div>
  </div>
</div>
  </form>
   
   <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update your EID</h4>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
           Update
       </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Update</button>-->
       <input type="button" class="btn btn-primary btn-lg" value="Update" id="update-btn">
       <!--<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel" id="cancel"/>-->
      </div>
    </div>
  </div>
</div>
   
   <div class="modal fade" id="download" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Download your EID</h4>
      </div>
      <div class="modal-body">
       <div class="container-fluid">
           Download
        </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Download</button>-->
        <!--<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel" id="cancel"/>-->
       <input type="button" class="btn btn-primary btn-lg" value="Download" id="download-btn">
      </div>
    </div>
  </div>
</div>
    
    
    

</body>
</html>