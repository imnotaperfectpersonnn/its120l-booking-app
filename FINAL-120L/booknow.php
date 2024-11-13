<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $dateTime = $_POST["dateTime"];
    $serviceType = $_POST["serviceType"];
    $allergies = $_POST["allergies"] ?? "";
    $notes = $_POST["notes"] ?? "";

    $bookingData = [
        "fullName" => $fullName,
        "email" => $email,
        "phoneNumber" => $phoneNumber,
        "appointmentDateTime" => $dateTime,
        "serviceType" => $serviceType,
        "allergies" => $allergies,
        "notes" => $notes
    ];

    $jsonFilePath = 'booknow.json';

    // Read existing data, or initialize an empty array if the file doesn't exist
    $jsonData = file_exists($jsonFilePath) ? json_decode(file_get_contents($jsonFilePath), true) : [];

    // Add the new booking data to the array
    $jsonData[] = $bookingData;

    // Encode the updated data and write it back to the file
    $newJsonData = json_encode($jsonData, JSON_PRETTY_PRINT);
    if (file_put_contents($jsonFilePath, $newJsonData)) {
        header("Location: BookSum.html");
        exit();
    } else {
        echo "Error: Failed to save booking data.";
    }
}

?>