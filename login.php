<?php
    session_start();

    if (isset($_SESSION['loggedIN'])) {
        header('Location: hidden.php');
        exit();
    }

    if (isset($_POST['login'])) {
        $connection = new mysqli('localhost', 'root', '', 'miPhone');

        $email = $connection->real_escape_string($_POST['emailPHP']);
        $password = $connection->real_escape_string($_POST['passwordPHP']);

        $date = $connection->query("SELECT id FROM users 
        WHERE email='$email' AND password='$password'");

        if ($date->num_rows > 0) {
            $_SESSION['loggedIN'] = '1';
            $_SESSION['email'] = $email;
            exit('success');
        } else {
            exit('failled');
        }
    }
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LOGIN FORM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <form method="POST" action="login.php" id='inputform'>
        <input type="text" id="email" placeholder="email"></input>
        <input type="password" id="password" placeholder="password"></input>
        <input type="button" id="submit_btn" value="submit"></input>
    </form>

    <p id="response"></p>
    <script type="text/javascript">
    console.log('s');
        const btn = document.getElementById('submit_btn');
        btn.addEventListener('click', function () {
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            const url = 'login.php';

            const xhr = new XMLHttpRequest();
            xhr.open('POST', url);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (xhr.status === 200) {
                    window.location = 'hidden.php';
                    document.getElementById('response').html = xhr.responseText;
                } else if (xhr.status !== 200) {
                    alert('Request failde, status is now ' + xhr.status);
                }
            }

            let data = 'login=' + 1 + '&emailPHP=' + email + '&passwordPHP=' + password;
            xhr.send(encodeURI(data));
        }, false);
    </script>
</body>
</html>