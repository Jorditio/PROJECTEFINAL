<?php include 'header.php'; ?>
<div id=logbox>
    <div id="register">
        <form>
            <div id="nameuser">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Enter your Name">
            </div>
            <div id="pass">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password">
                <label>Repeat Password</label>
                <input type="password" name="repassword" placeholder="Enter Password">
            </div>
            <div id="newuser">
                <label>Username</label>
                <input type="text" name="newusername" placeholder="Enter Username">
            </div>
            <div id="mail">
                <label>Mail</label>
                <input type="text" name="mail" placeholder="Enter your email">
            </div>
            <input type="submit" name="send" id="btsend"><br>
        </form>
        <div id="tolog">
            <label>Already have an account?<a href="login.php"><button id="login">LOG IN</button></a></label>
        </div>
    </div>
</div>
</body>
</html>