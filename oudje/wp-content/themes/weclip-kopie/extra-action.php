<?php
require_once($_SERVER['DOCUMENT_ROOT']."/wp-config.php");
session_start();

global $wpdb;


/*if(isset($_REQUEST['extra'])){*/
unset($_SESSION['e_name']);
unset($_SESSION['e_company']);
unset($_SESSION['e_email']);
unset($_SESSION['e_telephone']);
unset($_SESSION['e_aantel']);
unset($_SESSION['e_services1']);
unset($_SESSION['e_services2']);
unset($_SESSION['e_services3']);
unset($_SESSION['e_services4']);
unset($_SESSION['e_services5']);
unset($_SESSION['e_services6']);
unset($_SESSION['e_services7']);
unset($_SESSION['e_services']);
unset($_SESSION['e_description']);
/*header("location:".get_site_url()."/extra/");
}*/

if(isset($_REQUEST['submit'])){

$uploads = wp_upload_dir();

 if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 1048600)) // less than 1MB
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    if (file_exists($uploads['basedir'] . "/extra/" . $_FILES["file"]["name"]))
      {
      echo "<script>
		var a = alert('File Allaredy Exist.');
		window.location.href = 'http://bposerviceslabs.com/weclip/extra/';
	</script>";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $uploads['basedir'] . "/extra/" . $_FILES["file"]["name"]);
      }
    }
  }

$name = $_POST['e_name']; 
$company = $_POST['e_company']; 
$email = $_POST['e_email']; 
$telephone = $_POST['e_telephone']; 
$aantel = $_POST['e_aantel'];
$kwaliteitverbeteren = $_POST['e_services1'];
$retoucheren = $_POST['e_services2'];
$kleurvervanger = $_POST['e_services3'];
$kleurcorrigeren = $_POST['e_services4'];
$fotografie = $_POST['e_services5'];
$fotografie_360 = $_POST['e_services6'];
$anders_nl = $_POST['e_services7'];
$diensten12 = $_POST['e_services'];
$description = $_POST['e_description'];

$_SESSION['e_name'] = $_POST['e_name']; 
$_SESSION['e_company'] = $_POST['e_company']; 
$_SESSION['e_email'] = $_POST['e_email']; 
$_SESSION['e_telephone'] = $_POST['e_telephone']; 
$_SESSION['e_aantel'] = $_POST['e_aantel'];
$_SESSION['e_services1'] = $_POST['e_services1'];
$_SESSION['e_services2'] = $_POST['e_services2'];
$_SESSION['e_services3'] = $_POST['e_services3'];
$_SESSION['e_services4'] = $_POST['e_services4'];
$_SESSION['e_services5'] = $_POST['e_services5'];
$_SESSION['e_services6'] = $_POST['e_services6'];
$_SESSION['e_services7'] = $_POST['e_services7'];
$_SESSION['e_services'] = $_POST['e_services'];
$_SESSION['e_description'] = $_POST['e_description'];

$image = $_FILES["file"]["name"];

$diensten = $kwaliteitverbeteren . "," . $retoucheren . "," . $kleurvervanger . "," . $kleurcorrigeren . "," . $fotografie . "," . $fotografie_360 . "," . $anders_nl;

$extra = array('name'=>$name,'company'=>$company,'email'=>$email,'telephone'=>$telephone,'aantel'=>$aantel,'diensten'=>$diensten,'ohter_diensten'=>$diensten12,'description'=>$description,'image'=>$image);
$wpdb->insert('extra',$extra);

/* send mail */

$admin_email = get_option('admin_email');
$headers1 = 'From: Weclip<'. get_option('admin_email') .'>';

/* Customer receive */
$subject1 = "Uw aanvraag via weclip.nl" ;
$message1 =  "Bedankt voor uw aanvraag via WeClip.nl

Wij hebben de volgende gegevens van u ontvangen:

NAAM: " . $name . "
BEDRIJFSNAAM: " . $company . "
E-MAILADRES: " . $email . "
TELEFOONNUMMER: " . $telephone . "
DIENSTEN: " . $kwaliteitverbeteren . "," . $retoucheren . "," . $kleurvervanger . "," . $kleurcorrigeren . "," . $fotografie . "," . $fotografie_360 . "," . $anders_nl . "
OVERIGE DIENSTEN: " . $diensten12 ."
AANTAL: " . $aantel . "
BESTANDEN: " . $image . "
TOELICHTING: " . $description . "

Wij zullen z.s.m. contact met u opnemen.

Met vriendelijke groet,

WeClip";

/* Clinent Receive */
$subject12 = "POP een nieuwe aanvraag via WeClip.nl" ;
$message12 =  "Er is een aanvraag binnen gekomen voor extra diensten via http://www.weclip.nl/extra/

Dit zijn de gegevens:

NAAM: " . $name . "
BEDRIJFSNAAM: " . $company . "
E-MAILADRES: " . $email . "
TELEFOONNUMMER: " . $telephone . "
DIENSTEN: " . $kwaliteitverbeteren . "," . $retoucheren . "," . $kleurvervanger . "," . $kleurcorrigeren . "," . $fotografie . "," . $fotografie_360 . "," . $anders_nl . "
OVERIGE DIENSTEN: " . $diensten12 ."
AANTAL: " . $aantel . "
BESTANDEN: " . $image . "
TOELICHTING: " . $description;


mail($email, $subject1, $message1, $headers1);
mail($admin_email, $subject12, $message12, $headers1); 

unset($_SESSION['e_name']);
unset($_SESSION['e_company']);
unset($_SESSION['e_email']);
unset($_SESSION['e_telephone']);
unset($_SESSION['e_aantel']);
unset($_SESSION['e_services1']);
unset($_SESSION['e_services2']);
unset($_SESSION['e_services3']);
unset($_SESSION['e_services4']);
unset($_SESSION['e_services5']);
unset($_SESSION['e_services6']);
unset($_SESSION['e_services7']);
unset($_SESSION['e_services']);
unset($_SESSION['e_description']);
header("location:".get_site_url()."/thank-you-contact/");
}
?>
