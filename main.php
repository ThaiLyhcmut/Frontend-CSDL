<?php

// Bao gồm tệp chứa lớp envLoaderService
require_once 'config/envLoaderService.php';
require_once 'config/database.php';
require_once 'config/header.php';
require_once 'config/setResposHandler.php';


function isDirectSubclass($childClass, $parentClass) {
  $parent = get_parent_class($childClass);
  return $parent === $parentClass;
}
// Tải các biến môi trường từ tệp .env
envLoaderService::loadEnv();
// Lấy giá trị của biến môi trường DB_HOST
$DB_HOST = envLoaderService::getEnv("DB_HOST");
$DB_NAME = envLoaderService::getEnv("DB_NAME");
$DB_USER = envLoaderService::getEnv("DB_USER");
$DB_PASS = envLoaderService::getEnv("DB_PASS");

// Lấy thể hiện duy nhất của lớp Database
$db = Database::getInstance($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
// Lấy kết nối
$conn = $db->getConnection();
// echo "I love {$DB_HOST}!";
// Tạo mảng dữ liệu
$response = array(
    'message' => 'Hello, World!'
);

// Chuyển mảng thành chuỗi JSON và in ra
echo json_encode($response);
?>
