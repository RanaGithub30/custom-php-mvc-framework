<?php
include(dirname(__DIR__) . '/commons/header.php');
?>
<h2>Register Form</h2>

<form action="/register/action" method="post">
<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Register</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <span class="psw">Existing User? <a href="/">Login</a></span>
    </div>
</form>

<?php
include(dirname(__DIR__) . '/commons/footer.php');
?>