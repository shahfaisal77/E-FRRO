require 'db_connect.php'; // Include the file with the database connection
require '../vendor/autoload.php'; // Include Composer's autoloader
require_once '../vendor/setasign/fpdf/fpdf.php';
require_once '../vendor/setasign/fpdi/src/autoload.php';
require_once '../vendor/tecnickcom/tcpdf/tcpdf.php'; // Include TCPDF library

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use setasign\Fpdi\Fpdi;
