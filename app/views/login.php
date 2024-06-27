<div class="col-center">    
    <div class="spborder">
    <h5>KTC Login</h5>
        <form id='lform' action="" method="POST">
            <div class="form-group">
                <label for="uname"><b>Username</b></label><br>
                <input type="text" placeholder="Enter Username" id="uname" name="uname" autofocus required>
            </div>
            <div class="form-group">
                <label for="psw"><b>Password</b></label><br>
                <input type="password" placeholder="Enter Password" id="psw" name="psw" required>
            </div>
            <div class="form-group">
                <button id="lbtn" type="button" class="btn btn-primary" onclick="doAuth()">Login</button><br><br>
                <input type="checkbox" checked="checked" name="remember" disabled> Remember Me</input><br>
                <a class="psw" href="#">Forgot Password?</a>
            </div>
        </form>
    </div>
    <p></p>
</div>
<form id='jform' action="/home/indexAuth" method="POST"><input type="hidden" id="jwt" name="jwt"></form>

<script>
async function doAuth() {

    const res = await fetch( location.origin + '/api/user/login', {
    method: 'POST',
    headers: {'Content-type': 'application/x-www-form-urlencoded'},
    body:   $('#lform').serialize() 
//    body: new URLSearchParams({
//         'uname': $('#uname').val(),
//         'psw': $('#psw').val(),
//         })
     });
    if (res.status >= 200 && res.status <= 299) {
        const token = await res.text();
        if( token ) {
            sessionStorage.setItem( 'ktc_token', token );
            $('#jwt').val(token);
            $('#jform').submit();
        } else {
            // Handle errors
            console.log(res.status, res.statusText);
        }
    }
}
</script>
<p></p>
</body>
</html>
