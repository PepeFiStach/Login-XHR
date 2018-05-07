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