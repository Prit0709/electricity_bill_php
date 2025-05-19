<?php
header("Content-Type: application/json");
require "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$name = $data["name"];
$email = $data["email"];
$address = $data["address"];
$units = intval($data["units"]);

// Calculate bill
$amount = 0;
$u = $units;

if ($u <= 50) {
    $amount = $u * 3.50;
} else if ($u <= 150) {
    $amount = (50 * 3.50) + ($u - 50) * 4.00;
} else if ($u <= 250) {
    $amount = (50 * 3.50) + (100 * 4.00) + ($u - 150) * 5.20;
} else {
    $amount = (50 * 3.50) + (100 * 4.00) + (100 * 5.20) + ($u - 250) * 6.50;
}

// Insert consumer
$sql = "INSERT INTO Consumer (name, email, address) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $address);
$stmt->execute();
$consumer_id = $stmt->insert_id;

// Insert bill
$sql2 = "INSERT INTO Billing (consumer_id, units, amount) VALUES (?, ?, ?)";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("iid", $consumer_id, $units, $amount);
$stmt2->execute();

echo json_encode([
    "message" => "Bill calculated and saved successfully",
    "units" => $units,
    "amount" => number_format($amount, 2),
    "consumer_id" => $consumer_id
]);
?>
