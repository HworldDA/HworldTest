<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
  <title>Confirmation</title>
</head>
<body>
<h1>Confirmation</h1>

<?php
$first_nameErr = $last_nameErr = $address1Err = $address2Err = $cityErr = $stateErr = $zipErr = $countryErr = "";
$first_name = $last_name = $address1 = $address2 = $city = $state = $zip = $country = "";
$if_error = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){

	if (empty($_POST["first_name"])) {
     $first_nameErr = "First name is required";
     $if_error = true;
   } else {
     $first_name = test_input($_POST["first_name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^([a-zA-Z]+)$/",$first_name)) {
       $first_nameErr = "Only letters are allowed";
       $if_error = true; 
     }
   }

   //$first_name = test_input($_POST["first_name"]);

   if (empty($_POST["last_name"])) {
     $last_nameErr = "Last name is required";
     $if_error = true;
   } else {
     $last_name = test_input($_POST["last_name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/[a-zA-z]+([ '-][a-zA-Z]+)*/",$last_name)) {
       $last_nameErr = "Only letters are allowed"; 
       $if_error = true;
     }
   }

   //$last_name = test_input($_POST["last_name"]);

   if (empty($_POST["address1"])) {
     $address1Err = "Address1 is required";
     $if_error = true;
   } else {
     $address1 = test_input($_POST["address1"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/\d+\s+([a-zA-Z]+$|[a-zA-Z]+\s[a-zA-Z]+$|[a-zA-Z]+\s[a-zA-Z]+\s[a-zA-Z]+\s*)/",$address1)) {
       $address1Err = "Lead with numerical address then street name"; 
       $if_error = true;
     }
   }

   //$address1 = test_input($_POST["address1"]);

   if (empty($_POST["address2"])) {
     $address2 = "";
   } else {
     $address2 = test_input($_POST["address2"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^(([a-zA-Z])\w+(\.|\s)+([0-9])+)$/",$address2)) {
       $address2Err = "Letters then numbers, ex: Apt. 32"; 
       $if_error = true;
     }
   }

   //$address2 = test_input($_POST["address2"]);

   if (empty($_POST["city"])) {
     $cityErr = "City is required";
     $if_error = true;
   } else {
     $city = test_input($_POST["city"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/",$city)) {
       $cityErr = "Only letters are allowed"; 
       $if_error = true;
     }
   }

   //$city = test_input($_POST["city"]);

   if (empty($_POST["state"])) {
     $stateErr = "State is required";
     $if_error = true;
   } else {
     $state = test_input($_POST["state"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^(?:A[LKSZRAEP]|C[AOT]|D[EC]|F[LM]|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEHINOPST]|N[CDEHJMVY]|O[HKR]|P[ARW]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])$/",$state)) {
       $stateErr = "Only 2 letter capitalized state code allowed"; 
       $if_error = true;
     }
   }

   //$state = test_input($_POST["state"]);

   if (empty($_POST["zip"])) {
     $zipErr = "Zip code is required";
     $if_error = true;
   } else {
     $zip = test_input($_POST["zip"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^([0-9]{5})$|^([0-9]{5}\-[0-9]{4})$/",$zip)) {
       $zipErr = "Only 5 digits or 9(xxxxx-xxxx)"; 
       $if_error = true;
     }
   }

   //$zip = test_input($_POST["zip"]);

   if (empty($_POST["country"])) {
     $countryErr = "Country is required";
     $if_error = true;
   } else {
     $country = test_input($_POST["country"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^US$/",$country)) {
       $countryErr = "Country must be US"; 
       $if_error = true;
     }
   }

   //$country = test_input($_POST["country"]);
}

function test_input($data) {//cleans up input data
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<?php 
if(!$if_error) //if no error insert into database
{
	require('dbconfig.inc');
	db_connect();
	$time = time();
	$time_insert = date("Y-m-d H:i:s", $time);

	$qryNews="INSERT INTO `Hworld` (`First_Name`, `Last_name`, `Address1`, `Address2`, `City`, `State`, `Zip_Code`, `Country`, `Date`) 
	VALUES ('$first_name', '$last_name', '$address1', '$address2', '$city', '$state', '$zip', '$country','$time_insert')
	ON DUPLICATE KEY UPDATE `ID` = `ID` + 1";
	$resSel=mysql_query($qryNews);

	echo "<br>";
	echo "Welcome " .$first_name;
	echo "<br>";
	echo "Your information has been added to our database.";
	echo "<br>";
	echo 'Return to registration <a href="registration.html">page</a>.';

	db_close();
}
else //print out error's and give link back to registration page
{
	echo "Your information has not been added to our database. Check fields for errors";
	echo "first name:".$first_name;
	echo "<br>";
	echo "first name error: ".$first_nameErr;
	echo "<br>";
	echo "last name: ".$last_name;
	echo "<br>";
	echo "last name error: ".$last_nameErr;
	echo "<br>";
	echo "address 1: ".$address1;
	echo "<br>";
	echo "address 1 error: ".$address1Err;
	echo "<br>";
	echo "address 2: ".$address2;
	echo "<br>";
	echo "address 2 error: ".$address2Err;
	echo "<br>";
	echo "city: ".$city;
	echo "<br>";
	echo "city error: ".$cityErr;
	echo "<br>";
	echo "state: ".$state;
	echo "<br>";
	echo "state error: ".$stateErr;
	echo "<br>";
	echo "zip code: ".$zip;
	echo "<br>";
	echo "city error: ".$zipErr;
	echo "<br>";
	echo "country: ".$country;
	echo "<br>";
	echo "country error: ".$countryErr;
	echo "<br>";
	echo 'Return to registration <a href="registration.html">page</a>.';
}
?>

</body>
</html>