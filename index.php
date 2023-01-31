
<?php

if(isset($_POST['button']) && isset($_FILES['attachment']))
{
	$from_email		 = 'care@file.doclocker.in'; //from mail, sender email address
	$recipient_email = 'pandeyvus@gmail.com'; //recipient email address
	
//Load POST data from HTML form
//$sender_name = $_POST["sender_name"]; //sender name
// 	$reply_to_email = $_POST["sender_email"];
//sender email, it will be used in "reply-to" header
  $subject	 = 	 $_FILES['attachment']['name'];//subject for the email
	$message	 = 'Congratulation..'; //body of the email

	/*Always remember to validate the form fields like this
	if(strlen($sender_name)<1)
	{
		die('Name is too short or empty!');
	}
	*/
	//Get uploaded file data using $_FILES array
	$tmp_name = $_FILES['attachment']['tmp_name']; // get the temporary file name of the file on the server
	$name	 = $_FILES['attachment']['name']; // get the name of the file
	$size	 = $_FILES['attachment']['size']; // get size of the file for size validation
	$type	 = $_FILES['attachment']['type']; // get type of the file
	$error	 = $_FILES['attachment']['error']; // get the error (if any)

	//validate form field for attaching the file
	if($error > 0)
	{
		die('Upload error or No files uploaded');
	}

	//read from the uploaded file & base64_encode content
	$handle = fopen($tmp_name, "r"); // set the file handle only for reading the file
	$content = fread($handle, $size); // reading the file
	fclose($handle);				 // close upon completion

	$encoded_content = chunk_split(base64_encode($content));
	$boundary = md5("random"); // define boundary with a md5 hashed value

	//header
	$headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
	$headers .= "From:".$from_email."\r\n"; // Sender Email
	// $headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email address to reach back
	$headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
	$headers .= "boundary = $boundary\r\n"; //Defining the Boundary
		
	//plain text
	$body = "--$boundary\r\n";
	$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
	$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
	$body .= chunk_split(base64_encode($message));
		
	//attachment
	$body .= "--$boundary\r\n";
	$body .="Content-Type: $type; name=".$name."\r\n";
	$body .="Content-Disposition: attachment; filename=".$name."\r\n";
	$body .="Content-Transfer-Encoding: base64\r\n";
	$body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n";
	$body .= $encoded_content; // Attaching the encoded file with email
	
	$sentMailResult = mail($recipient_email, $subject, $body, $headers);

	if($sentMailResult){
	   echo "<div class='alert alert-success font-weight-bold ' role='alert'>
    File uploaded successfully!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
         <span aria-hidden='true'>×</span>
     </button>

  </div>";
		// unlink($name); // delete the file after attachment sent.
	}
	else{
		die("Sorry but the email could not be sent.
					Please go back and try again!");
	}
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<style>
    <style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
width: 10%;
  height: 30px;
  background-color: #04AA6D;
  text-align: center;
  line-height: 30px;
  color: white;
}
#myBar2{
    color:white;
    padding: 3px;
    margin: 3px;
}
#io{
    background-color: transparent;
    border:none;
    top:100;
}
.custom-file-upload {
  border: 1px solid #ccc;
    display: inline-block;
    padding: 14px  4px 7px 17px;
    cursor: pointer;
    width: 256px;
    max-height: 100px;
    border-radius: 5px;
    background-color: coral;
    font-style: revert;
    font-weight: 700;
    letter-spacing: 1;
    text-transform: capitalize;
    margin-top:50%;
      } 
      .custom-file-upload  img{
        vertical-align: middle;
    border-style: none;
    border-radius: 6px;
    position: relative;
    width: 262px;
    left: -20px;
    top: -82px;
    box-shadow: 0px 0px 32px -10px rgba(40,25,250,1);
      }
      #virat{
        cursor: pointer;
    padding: -25px;
    font-size: xxx-large;
    text-transform: capitalize;
    font-weight: 500;
    margin-top: 52px;
    display:none;
    }
     
</style>
    </style>
<body>
 <!-- <form action="mail.php" method="post" enctype="multipart/form-data">
    <input type="email" name="text" placeholder="enrer yout name">
    <br>
    <input type="text" name="paas" placeholder="enter you dtai;s ">
    <br>
    <inpuzt type="file" name="file">
    <br>
    <input type="text" name="comments" placeholder="enter eyour comnts">
    <button onclick="" name="submit">send</button>
 </form> -->

 
 <form action="" method="post" enctype="multipart/form-data">
 <div class="card  p-3" style="width: 18rem;
    margin: auto;
    top: 70;
    border: nonr;
    border: none;">
 
 <form enctype="multipart/form-data" method="POST" action="" style="width: 500px;">
			<!--<div class="form-group">-->
			<!--	<input class="form-control" type="text" name="sender_name" placeholder="Your Name" required/>-->
			<!--</div>-->
			<!--<div class="form-group">-->
			<!--	<input class="form-control" type="text" name="sender_email" placeholder="Recipient's Email Address" required/>-->
			<!--</div>-->
			<!--<div class="form-group">-->
				<!--<input class="form-control" type="text" name="subject" placeholder="Subject"/>-->
			<!--</div>-->
			<!--<div class="form-group">-->
			<!--	<textarea class="form-control" name="message" placeholder="Message"></textarea>-->
			<!--</div>-->
  
  <label for="file-upload" class="custom-file-upload">
  <img src="io.jpg"onclick="hide()" alt="">
  </label>
  <input type="file" name="attachment"   id="file-upload"  style="display:none;">
  
 
 
  
  <button onclick="move()" id="virat" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" name="button" >send<i class="fas fa-paper-plane ml-3"></i></button>
    </div>
</form>  


  


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo mod
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="io">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
<!-- mondal content -->
      <div class="modal-body">
      <div id="myProgress">
     <div id="myBar">10%</div>
     </div>
     <div id="myBar2">Uploading Please wait..</div>
      </div>

      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<script>

var i = 0;
function move() {
  if (i == 0) {
    i = 1;
    var elem = document.getElementById("myBar");
    var width = 10;
    var id = setInterval(frame, 145);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        i = 0;
        document.getElementById('myBar2').innerHTML='Please wait.... file is being uploading <img src="spiner.gif" <img src="Spinner-1s-200px (1).gif" style="width: 43px;">';

      } else {
        width++;
        elem.style.width = width + "%";
        elem.innerHTML = width  + "%";
      }
    }
  }
}
function hide(){
  document.getElementById("virat").style.display = "block";
}
</script>

<script src="https://kit.fontawesome.com/c95b268abe.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>


