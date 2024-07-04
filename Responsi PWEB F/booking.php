<?php
include 'config.php';

// Ambil data dari formulir
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$room_type = $_POST['room-type'];
$check_in = $_POST['check-in'];
$check_out = $_POST['check-out'];

// Simpan data ke tabel reservations
$sql = "INSERT INTO reservations (name, email, phone, room_type, check_in, check_out)
VALUES ('$name', '$email', '$phone', '$room_type', '$check_in', '$check_out')";

if ($conn->query($sql) === TRUE) {
    // Kurangi jumlah kamar yang tersedia
    $update_sql = "UPDATE rooms SET available = available - 1 WHERE room_type = '$room_type' AND available > 0";
    $conn->query($update_sql);

    // Simpan data ke file .txt
    $file = fopen("reservations.txt", "a");
    if ($file) {
        fwrite($file, "Name: $name\nEmail: $email\nPhone: $phone\nRoom Type: $room_type\nCheck-in: $check_in\nCheck-out: $check_out\n\n");
        fclose($file);
    } else {
        echo "Error: Unable to open file for writing.";
        exit;
    }

    // HTML dengan CSS internal
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Booking Details</title>
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background: rgba(0, 0, 0, 0.5);
            }
            .booking-details-container {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                height: auto;
                width: 80%;
                max-width: 600px;
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                text-align: center;
                margin-top: 20px;
            }
            .booking-details-container h2 {
                color: #333;
                margin-bottom: 20px;
                font-family: 'Playfair Display', serif;
            }
            .booking-details-table {
                border-collapse: collapse;
                width: 100%;
                background-color: #fff;
                border-radius: 10px;
                overflow: hidden;
                margin-top: 20px;
            }
            .booking-details-table th,
            .booking-details-table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            .booking-details-table th {
                background-color: #4CAF50;
                color: white;
            }
            .booking-details-table tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            .booking-details-table tr:hover {
                background-color: #ddd;
            }
        </style>
    </head>
    <body>
        <div class='booking-details-container'>
            <h2>Booking Details</h2>
            <table class='booking-details-table'>
                <tr><th>Name</th><td>" . $name . "</td></tr>
                <tr><th>Email</th><td>" . $email . "</td></tr>
                <tr><th>Phone</th><td>" . $phone . "</td></tr>
                <tr><th>Room Type</th><td>" . $room_type . "</td></tr>
                <tr><th>Check-in</th><td>" . $check_in . "</td></tr>
                <tr><th>Check-out</th><td>" . $check_out . "</td></tr>
            </table>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = 'index.html';
            }, 5000); // 5 detik
        </script>
    </body>
    </html>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
