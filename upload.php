<?php

$uploadDir = __DIR__ . '/uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $originalName = $_FILES['image']['name'];
    $tmpPath      = $_FILES['image']['tmp_name'];
    $error        = $_FILES['image']['error'];

    if ($error !== UPLOAD_ERR_OK) {
        $message = "Upload error (code: $error)";
    } else {
        if (preg_match('/\.(png|jpe?g)$/i', $originalName)) {
            $target = $uploadDir . basename($originalName);

            if (move_uploaded_file($tmpPath, $target)) {
                $message = "✅ Uploaded as: " . htmlspecialchars(basename($originalName));
            } else {
                $message = "Failed to move uploaded file.";
            }
        } else {
            $message = "Only .png, .jpg and .jpeg filenames are accepted (naive check).";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Shoppix — Upload (CTF)</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body { 
      background: #0b0b0d; color: #e6e6e6; font-family: 'Montserrat', sans-serif; margin:0; display:flex; align-items:center; justify-content:center; padding:40px;
    }
    .card { width:480px; background:#1e1e1e; padding:28px; border-radius:12px; box-shadow:0 8px 30px rgba(0,0,0,0.6); }
    h1 { color:#03a9f4; margin:0 0 8px 0; text-align:center; }
    p.lead { color:#bfc7cc; margin:8px 0 18px 0; font-size:14px; text-align:center; }
    label{ display:block; color:#9aa0a6; margin:6px 0; font-size:13px }
    input[type=file] { color:#ddd; margin-bottom:12px; }
    button { background:#03a9f4; border:none; padding:10px 18px; border-radius:8px; color:#fff; font-weight:700; cursor:pointer; }
    .msg { margin-top:14px; padding:10px; border-radius:8px; background:#0b0b0b; color:#cfd8dc; font-size:13px; }
    .warning { color:#ffb86b; font-size:12px; margin-top:8px; }
  </style>
</head>
<body>

  <div class="card">
    <h1>Shoppix Upload (CTF)</h1>
    <p class="lead">Upload images. This endpoint only checks filename extensions and saves the file to <code>/uploads</code>.</p>

    <form method="post" enctype="multipart/form-data">
      <label for="image">Choose file (allowed extensions: .png .jpg .jpeg)</label>
      <input type="file" name="image" id="image" required />
      <div style="text-align:center;"><button type="submit">Upload</button></div>
    </form>

    <?php if ($message): ?>
      <div class="msg"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <p class="warning">
      <strong>Note:</strong> This is purposely weak validation for CTF/learning. The server trusts the original filename and stores it directly.
    </p>
  </div>

</body>
</html>
