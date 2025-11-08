<?php
header('Content-Type: application/json');

// Database connection
$db = new mysqli('localhost', 'root', '', 'hospital_db');
if ($db->connect_error) {
    echo json_encode([
        'success' => false,
        'title' => 'Connection Error',
        'message' => 'Database connection failed. Please try again later.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/></svg>'
    ]);
    exit;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = filter_var($_POST['full_name'] ?? '', FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'] ?? '', FILTER_SANITIZE_STRING);
    $department = filter_var($_POST['department'] ?? '', FILTER_SANITIZE_STRING);
    $date = filter_var($_POST['preferred_date'] ?? '', FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'] ?? '', FILTER_SANITIZE_STRING);

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($department) || empty($date)) {
        echo json_encode([
            'success' => false,
            'title' => 'Validation Error',
            'message' => 'Please fill all required fields',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/></svg>'
        ]);
        exit;
    }

    // Prepare and execute query
    $stmt = $db->prepare("INSERT INTO appointments (full_name, email, phone, department, preferred_date, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $department, $date, $message);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'title' => 'Appointment Scheduled',
            'message' => 'Your appointment request has been received. Our team will contact you shortly to confirm the details.',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/></svg>'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'title' => 'Processing Error',
            'message' => 'Error processing appointment. Please try again.',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16"><path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/></svg>'
        ]);
    }

    $stmt->close();
    $db->close();
}
?>