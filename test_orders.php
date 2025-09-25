<?php

$baseUrl = 'http://localhost:8000';

// Get CSRF token, without it test will fail
echo "=== STEP 1: GET CSRF TOKEN ===\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . '/login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_HEADER, true);

$response = curl_exec($ch);
curl_close($ch);

// Extract CSRF token
preg_match('/name="_token" value="([^"]+)"/', $response, $matches);
$csrfToken = isset($matches[1]) ? $matches[1] : '';

echo "CSRF Token: $csrfToken\n";

// Step 2: Login with CSRF token
echo "\n=== STEP 2: LOGIN ===\n";
$loginData = [
    'email' => 'john@example.com',
    'password' => 'password123',
    '_token' => $csrfToken
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . '/login');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($loginData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Login response code: $httpCode\n";

// Step 3: Get all orders
echo "\n=== STEP 3: GET ALL ORDERS ===\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $baseUrl . '/admin/orders');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "Get orders response code: $httpCode\n";
echo "Response: " . $response . "\n";

// Parse the response to get order ID
$ordersData = json_decode($response, true);
if (isset($ordersData['data']) && count($ordersData['data']) > 0) {
    $orderId = $ordersData['data'][0]['id'];
    echo "Found order ID: $orderId\n";
    
    // Step 4: Edit order
    echo "\n=== STEP 4: EDIT ORDER ===\n";
    $editData = [
        'status' => 'processing',
        'total_amount' => 700.00,
        'order_items' => [
            [
                'product_id' => 1,
                'product_name' => 'test',
                'quantity' => 6,
                'price' => 116.67
            ]
        ]
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseUrl . "/admin/orders/$orderId");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($editData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "Edit order response code: $httpCode\n";
    echo "Response: " . $response . "\n";
    
    // Step 5: Verify the edit by getting orders again
    echo "\n=== STEP 5: VERIFY EDIT ===\n";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseUrl . '/admin/orders');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "Verify edit response code: $httpCode\n";
    echo "Response: " . $response . "\n";
    
    // Step 6: Delete order
    echo "\n=== STEP 6: DELETE ORDER ===\n";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseUrl . "/admin/orders/$orderId");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "Delete order response code: $httpCode\n";
    echo "Response: " . $response . "\n";
    
    // Step 7: Verify deletion
    echo "\n=== STEP 7: VERIFY DELETION ===\n";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseUrl . '/admin/orders');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "Verify deletion response code: $httpCode\n";
    echo "Response: " . $response . "\n";
    
} else {
    echo "No orders found to test with!\n";
}

// Clean up
if (file_exists('cookies.txt')) {
    unlink('cookies.txt');
}

echo "\n=== TEST COMPLETED ===\n";
