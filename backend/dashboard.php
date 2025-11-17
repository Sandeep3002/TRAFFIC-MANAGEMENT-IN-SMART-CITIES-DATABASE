<?php
// backend/dashboard.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../frontend/login.html');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet" href="../frontend/css/style.css">
</head>
<body>
  <header class="site-header">
    <div class="container">
      <h1>Welcome, <?php echo htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['username']); ?></h1>
      <nav><a href="../frontend/index.html">Home</a> | <a href="../frontend/about.html">About</a> | <a href="../frontend/complain.html">Complain</a></nav>
    </div>
  </header>
  <main class="container">
    <section>
      <h2>Dashboard</h2>
      <p>This is a protected page. Add your dashboard features here.</p>
      <p><a href="logout.php">Logout</a></p>
    </section>
  </main>
</body>
</html>
