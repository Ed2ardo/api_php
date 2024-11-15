<?php
include_once('./controllers/AuthController.php');

// Define los endpoints para el servicio web de autenticación.

$authController = new AuthController();

$data = json_decode(file_get_contents("php://input"));
// valida y registra los usaurios en la bbdd
if (!empty($data->username) && !empty($data->password)) {
    $result = $authController->register($data->username, $data->password);
    echo json_encode(array("message" => $result ? "Registration successful." : "Registration failed."));
} else {
    echo json_encode(array("message" => "Invalid input."));
}
