<?php
// index.php - Shoppix LFI CTF (educational lab)
// WARNING: intentionally insecure - only run in a local lab

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Shoppix - Media Preview</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <header class="topbar">
    <div class="brand">Shoppix</div>
    <nav>
      <a href="/">Home</a>
      <a href="/?page=about.php">About</a>
      <a href="/?page=info.php">Info</a>
      <a href="upload.php">Upload</a>
    </nav>
  </header>

  <main class="card">
    <h1>Shoppix Content Preview</h1>
    <p class="lead">
      This is a demo CTF site. Two preview features below intentionally use <code>include()</code> insecurely.
      Use this in a local lab only.
    </p>

    <section class="box">
      <h2>Simple include LFI</h2>
      <p>Fetch a page by filename (e.g. <code>?page=home.php</code>)</p>
      <form method="get" action="/">
        <label>page (filename)</label>
        <input type="text" name="page" placeholder="home.php">
        <button type="submit">Load page</button>
      </form>

      <div class="output">
      <?php
      if (isset($_GET['page'])) {
          $p = $_GET['page'];
          echo "<div class='included-box'><strong>Including:</strong> " . htmlspecialchars($p) . "</div>";
          @include __DIR__ . '/pages/' . $p;
      }
      ?>
      </div>
    </section>

    <footer class="note">
      <p>CTF lab: practice LFI discovery and defenses. Always act ethically and stay in-scope.</p>
    </footer>
  </main>
</body>
</html>
