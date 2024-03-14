<?php

// Assuming you have already established a database connection

try {
    $pdo = new PDO("mysql:host=localhost;dbname=dms_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Prepare and execute the SQL query
$sql = "SELECT pl.id AS product_list_id, 
        p.name AS product_name, 
        p.code AS product_code, 
        p.supplier_code, 
        p.barcode, 
        p.image, 
        p.models, 
        u.name AS unit_name, 
        b.brand_name, 
        c.category_name, 
        pl.dealer, 
        pl.wholesale, 
        pl.srp
        FROM price_list pl
        INNER JOIN product p ON pl.product_id = p.id
        LEFT JOIN unit u ON p.unit_id = u.id
        LEFT JOIN brand b ON p.brand_id = b.id
        LEFT JOIN category c ON p.category_id = c.id";


$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Display the data in a table
foreach ($rows as $row) {
    echo "<div class='col-6 col-md-3 mb-4'>";
    echo "<div class='p-3 position-relative product-hover'>";
    echo "<div style='height: 200px; width: auto'>";
    echo "<img style='object-fit: cover; width: 100%; height: 100%' src='../uploads/{$row['image']}' alt=''>";
    echo "<button data-bs-toggle='modal' data-bs-target='#staticBackdrop' class='btn position-absolute bottom-0 end-0 mb-3 me-3 rounded-5 btn-primary'>";
    echo "<svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-cart-plus-fill' viewBox='0 0 16 16'>";
    echo "<path d='M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0'/>";
    echo "</svg>";
    echo "</button>";
    echo "</div>";
    echo "<div>";
    echo "<h6>{$row['product_name']}</h6>";
    echo "<p class='m-0' style='font-size: 12px'>{$row['models']}</p>";
    echo "<p class='m-0' style='font-size: 12px'>Category: {$row['category_name']}</p>"; // Display category name
    echo "<p class='m-0' style='font-size: 12px'>Brand: {$row['brand_name']}</p>"; // Display brand name
    echo "<p class='m-0' style='font-size: 12px'>Unit: {$row['unit_name']}</p>"; // Display unit name
    echo "<h6 class='fw-bolder'>PHP {$row['srp']} | 0pcs</h6>"; // Display SRP with quantity
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

?>
