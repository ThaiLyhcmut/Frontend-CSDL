<?php

// Thiết lập header để nhận và trả về dữ liệu JSON
header('Content-Type: application/json');

// Lấy phương thức HTTP (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Lấy đường dẫn URL
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

// Đảm bảo yêu cầu đúng với cấu trúc
if (count($request) > 0) {
    $resource = array_shift($request);
}

// Phân tích đường dẫn và gọi hàm tương ứng
switch ($method) {
    case 'GET':
        if ($resource === 'user') {
            include 'api/user.php';
            getUser($request);
        } elseif ($resource === 'product') {
            include 'api/product.php';
            getProduct($request);
        } else {
            echo json_encode(['message' => 'Resource not found']);
        }
        break;

    case 'POST':
        if ($resource === 'user') {
            include 'api/user.php';
            createUser($_POST);
        } elseif ($resource === 'product') {
            include 'api/product.php';
            createProduct($_POST);
        } else {
            echo json_encode(['message' => 'Resource not found']);
        }
        break;

    // Các phương thức PUT và DELETE có thể được thêm vào sau nếu cần
    default:
        echo json_encode(['message' => 'Method Not Allowed']);
        break;
}
