<?php
include_once('./controllers/AuthController.php');

$authController = new AuthController();

$data = json_decode(file_get_contents("php://input"));
// valida que venga información, en caso contrario indica que es invalido.
// si el username y la password coincide con la bbdd, da el mensaje de verificación.
if (!empty($data->username) && !empty($data->password)) {
    $result = $authController->login($data->username, $data->password);
    echo json_encode(array("message" => $result ? "Authentication successful." : "Authentication failed."));
} else {
    echo json_encode(array("message" => "Invalid input."));
}
