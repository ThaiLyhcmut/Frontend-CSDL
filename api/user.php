<?php

// Ví dụ với dữ liệu tĩnh, bạn có thể thay đổi thành kết nối cơ sở dữ liệu
$users = [
    1 => ['id' => 1, 'name' => 'John Doe'],
    2 => ['id' => 2, 'name' => 'Jane Doe']
];

// Lấy thông tin người dùng
function getUser($request) {
    global $users;
    if (count($request) == 1) {
        $id = $request[0];
        if (isset($users[$id])) {
            echo json_encode($users[$id]);
        } else {
            echo json_encode(['message' => 'User not found']);
        }
    } else {
        echo json_encode($users);  // Trả về tất cả người dùng
    }
}

// Tạo người dùng mới
function createUser($data) {
    global $users;
    $newId = count($users) + 1;
    $users[$newId] = ['id' => $newId, 'name' => $data['name']];
    echo json_encode(['message' => 'User created', 'user' => $users[$newId]]);
}
