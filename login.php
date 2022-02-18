<?php include 'header.php'; ?>
<div id=logbox>
    <div id="login">
        <form>
            <div id="user">
                <label>Username</label><br>
                <input type="text" name="username" placeholder="Enter Username"><br>
            </div>
            <div id="pass">
                <label>Password</label><br>
                <input type="password" name="password" placeholder="Enter Password"><br>
            </div>
            <input type="submit" name="send" id="btsend"><br>
        </form>
        <div id="forgot">
            <a href="register.php"><button id="forgot1">Forget Password?</button></a>
        </div>
    </div>
</div>

</body>

</html>