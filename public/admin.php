<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
require_once __DIR__ . '/../src/OrderManager.php';

$orders = OrderManager::getCustomCharmOrders();
$stats = OrderManager::getStats();
?>
<!DOCTYPE html>
<html>
<head><title>Charm Builder Admin</title></head>
<body>
  <h1>Charm Builder Admin</h1>
  <div>
    <strong>Total Orders:</strong> <?= $stats['total_orders'] ?><br>
    <strong>Total Revenue:</strong> $<?= $stats['total_revenue'] ?><br>
    <strong>Average Price:</strong> $<?= $stats['avg_price'] ?><br>
  </div>
  <h2>Recent Orders</h2>
  <table border="1" cellpadding="5">
    <tr><th>ID</th><th>Date</th><th>Customer</th><th>Charms</th><th>Price</th></tr>
    <?php foreach ($orders as $order): ?>
      <tr>
        <td><?= $order['id'] ?></td>
        <td><?= $order['date'] ?></td>
        <td><?= $order['customer'] ?></td>
        <td><?= implode(', ', $order['charms']) ?></td>
        <td>$<?= $order['price'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html> 