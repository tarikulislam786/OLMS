<?php
// The class.messages.php has been added only for account/besittercomplete.php file to show message after updating & redirecting to the page.
// PHP Successful update message is not working after redirecting so message been displayed from connect.php
//------------------------------------------------------------------------------
// A session is required for the messages to work
//------------------------------------------------------------------------------
if( !session_id() ) session_start();
//------------------------------------------------------------------------------
// Include the Messages class and instantiate it
//------------------------------------------------------------------------------
require_once('class.messages.php');
$msg = new Messages();

?>
<?php
/**
 * Created by PhpStorm.
 * User: tarik
 * Date: 6/28/15
 * Time: 4:52 AM
 */
// Connection data (server_address, database, name, poassword)
$hostdb = 'localhost';
$namedb = 'olms';
$userdb = 'root';
$passdb = '';
//$row_limit = 5;
// Connect and create the PDO object
$conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
$conn->exec("SET CHARACTER SET utf8");// Sets encoding UTF-8
// added for Specifying the specific error
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set Errorhandling to Exception
//$item_per_page 		= 3; //item to display per page

// PHP Successful update mesage triggered for account/besitterComplete.php file
if ( isset($_GET['success']) == 1 )
{
    $msg->add('s', 'Data Saved Successfully.');
}elseif ( isset($_GET['success-update']) == 1 )
{
    $msg->add('s', 'Data Updated Successfully.');
}elseif( isset($_GET['credential-error']) == 1 )
{
    $msg->add('e', 'username or password is incorrect.');
}elseif( isset($_GET['unauthorized-access']) == 1 )
{
    $msg->add('e', 'Unauthorized Access.');
}elseif( isset($_GET['book-issue-available-1']) == 1 )
{
    $msg->add('w', 'You are permitted to issue 1 more book');
}elseif( isset($_GET['book-issue-available-2']) == 1 )
{
    $msg->add('w', 'You are permitted to issue 2 more book');
}elseif( isset($_GET['book-issue-available-no']) == 1 )
{
    $msg->add('w', 'Please Return 3 books you already issued');
}elseif( isset($_GET['book-issue-first']) == 1 )
{
    $msg->add('w', 'Issue a book first.');
}elseif( isset($_GET['duplicate']) == 1 )
{
    $msg->add('w', 'you\'r not permitted to issue same book twice');
}elseif( isset($_GET['penalty']) == 1 )
{
    $msg->add('w', 'You haven\'t paid the late charge yet.');
}elseif( isset($_GET['penalty']) == 1 )
{
    $msg->add('w', 'You haven\'t paid the late charge yet.');
}
elseif( isset($_GET['stocklimited']) && !empty($_GET['stocklimited']) )
{
    $msg->add('w', 'Book with isbn '.$_GET['stocklimited'].' is not available in the stock.');
}elseif( isset($_GET['fkeyconstraint']) && !empty($_GET['fkeyconstraint']) )
{
    $msg->add('w', 'User can\'t be deleted since he has not returned book yet.');
}
// for pagination

?>