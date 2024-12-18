<?php

// Ví dụ dữ liệu tĩnh cho sản phẩm
$products = [
    1 => ['id' => 1, 'name' => 'Product 1', 'price' => 10],
    2 => ['id' => 2, 'name' => 'Product 2', 'price' => 20]
];

// Lấy thông tin sản phẩm
function getProduct($request) {
    global $products;
    if (count($request) == 1) {
        $id = $request[0];
        if (isset($products[$id])) {
            echo json_encode($products[$id]);
        } else {
            echo json_encode(['message' => 'Product not found']);
        }
    } else {
        echo json_encode($products);  // Trả về tất cả sản phẩm
    }
}

// Tạo sản phẩm mới
function createProduct($data) {
    global $products;
    $newId = count($products) + 1;
    $products[$newId] = ['id' => $newId, 'name' => $data['name'], 'price' => $data['price']];
    echo json_encode(['message' => 'Product created', 'product' => $products[$newId]]);
}
