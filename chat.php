<?php
session_start();

$user = $_SESSION['user_name'];

if (!isset($user)){
    header ('Location: index');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to chat</title>
    <link rel="stylesheet" href="style/chat_style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<header>
    <h1>Main room</h1>
    <div class="flash-container">
    <?php
    if (isset($_SESSION['flash'])):
        if ($_SESSION['flash']['type'] != 'success'):?>
            <div class="flash-error">
                <p class="message"><?php echo $_SESSION['flash']['error']; ?></p>
            </div>
        <?php else:?>
            <div class="flash-success">
                <p class="message"><?php echo $_SESSION['flash']['error']; ?></p>
            </div>
        <?php endif; ?>
        <?php unset($_SESSION['flash']); endif; ?>
    </div>
    <div class="dropdown">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
            Settings
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Action</a> //later there will be implemented username change
			<form id="myForm" method="post" action="php/images.php" enctype="multipart/form-data">
            <a class="dropdown-item" onclick="document.getElementById('fileInput').click()">Change profile picture</a>
            <input id="fileInput" name="uploaded" type="file" style="display:none" onchange="handleFileSelect(event)"/></form>
            <form action="php/logout.php" method="POST">
                <button type="submit" class="dropdown-item text" name="logout">Logout</button>
            </form>
        </div>
    </div>
</header>
<main>
    <div class="message-box">

    </div>

    <form action="" class="typing-area" enctype="multipart/form-data">
        <input type="text" class="message-field" placeholder="Type your message...">
        <button><i class="fas fa-paper-plane"></i></button>
        <button class="gif" onclick="change()">GIF</button>
    </form>

    <div class="gif-search">
        <input type="text" id="search-input" placeholder="Enter keywords">
        <div id="gif-container"></div>
        <button id="close-button" class="close-button">&times;</button>
    </div>

    </body>
</main>
<footer>
    <p>Copyright © 2023 - All rights reserved</p>
</footer>
<script>
function handleFileSelect(event) {
  // submit the form when a file is selected
  document.getElementById("myForm").submit();
}
</script>
<script src="js_scripts/tenor.js"></script>
<script src="js_scripts/chat.js"></script>
</body>
</html>

