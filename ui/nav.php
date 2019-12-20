<?php
    if(session_id() == '' || !isset($_SESSION)){session_start();}
?>

<nav>
    <h1 class="title">Form Approval System</h1>
    <h1 class="profile"><?php if(isset($_SESSION["user_id"])) echo "<a href='database/logout.php'>Logout</a>"; ?></h1>
    <h1 class="profile"><?php if(isset($_SESSION["user_id"])) echo $_SESSION["name"]; ?></h1>
</nav>

<ul>
    <li><a href="index.php">Home page</a></li>
</ul>