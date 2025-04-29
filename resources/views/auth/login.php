<?php
include(dirname(__DIR__).'/commons/header.php');
?>
<h2>Login Form</h2>

<form action="" method="post">

    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <span class="psw">New User? <a href="/register">Register</a></span>
    </div>
</form>

<?php
include(dirname(__DIR__).'/commons/footer.php');
?>