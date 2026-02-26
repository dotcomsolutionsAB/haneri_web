<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: application/json");

// Config values
$config = include("configs/ship_config.php");
$token = $config['delhivery_token'];

// Request input
$input = json_decode(file_get_contents("php://input"), true);

// Log request
file_put_contents("deliveryone-request-log.txt", date('Y-m-d H:i:s') . "\n" . print_r($input, true) . "\n\n", FILE_APPEND);

// Validate
if (!$input || !isset($input['order_id'], $input['user'], $input['address'], $input['amount'])) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid input"]);
    exit;
}

// Sample hardcoded pickup location
$pickup_location = [
    "add" => "Unit No 7, Plot No 71E to T, GOVERNMENT INDUSTRIAL ESTATE, Behind Garuda Petrol Pump, Charkop, KANDIVALI WEST, Mumbai, Maharashtra",
    "country" => "India",
    "pin" => "400067",
    "phone" => "7774855283",
    "city" => "Mumbai",
    "name" => "BRILLARE SURFACE",
    "state" => "Maharastra"
];

// Extract dynamic input
$orderId = $input['order_id'];
$user = $input['user'];
$shipping_address = $input['address'];
$amount = $input['amount'];

// Extract pin
preg_match('/(\d{6})/', $shipping_address, $matches);
$pin = $matches[1] ?? '797001';

// Build shipment
$shipment = [
    "country" => "India",
    "city" => "Kohima",
    "seller_add" => "",
    "cod_amount" => "0",
    "return_phone" => "7774855283",
    "seller_inv_date" => "",
    "seller_name" => "",
    "pin" => $pin,
    "seller_inv" => "",
    "state" => "Nagaland",
    "return_name" => "Unit No 7,GOVERNMENT INDUSTRIAL ESTATE",
    "order" => $orderId,
    "add" => $shipping_address,
    "payment_mode" => "Prepaid",
    "quantity" => "1",
    "return_add" => $pickup_location['add'],
    "seller_cst" => "",
    "seller_tin" => "",
    "phone" => $user['phone'],
    "total_amount" => (string)$amount,
    "name" => $user['name'],
    "return_country" => "India",
    "return_city" => $pickup_location['city'],
    "return_state" => $pickup_location['state'],
    "return_pin" => $pickup_location['pin']
];

// Final payload
$payload = [
    "pickup_location" => $pickup_location,
    "shipments" => [$shipment]
];

// Format as required
$postData = http_build_query([
    "format" => "json",
    "data" => json_encode($payload)
]);

// Delhivery API endpoint
$apiUrl = "https://staging-express.delhivery.com/api/cmu/create.json"; // For testing
// $apiUrl = "https://track.delhivery.com/api/cmu/create.json"; // For production

$headers = [
    "Content-Type: application/x-www-form-urlencoded",
    "Authorization: Token $token"
];

// Send request
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Log response
file_put_contents("deliveryone-response-log.txt", date('Y-m-d H:i:s') . "\n" . $response . "\n\n", FILE_APPEND);

// Curl error
if (curl_errno($ch)) {
    $error = curl_error($ch);
    file_put_contents("deliveryone-response-log.txt", "cURL ERROR: $error\n", FILE_APPEND);
    http_response_code(500);
    echo json_encode(["error" => $error]);
    curl_close($ch);
    exit;
}

curl_close($ch);
http_response_code($httpCode);
echo $response;
exit;
?>
