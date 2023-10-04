<!-- <div class="container-fluid text-center"> -->
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
                <button id="lbtn" class="btn btn-primary" onclick="auth()">Login</button><br><br>
                <input type="checkbox" checked="checked" name="remember" disabled> Remember Me</input><br>
                <a class="psw" href="#">Forgot Password?</a>
            </div>
        </form>
	</div>
    <p></p>
</div>
<form id='jform' action="/home/indexAuth" method="POST"><input type="hidden" id="jwt" name="jwt"></form>
<script>
var gBasepath = null;

function auth() {
	var gBasepath = gGetBasepath();
	$.ajax({
  		url: gBasepath + '/api/user/login',
        //crossDomain: true,
		type:'POST',
		data: { 'uname':$('#uname').val(), 'psw':$('#psw').val() }
	})
    .done( function( data, textStatus, jQxhr ) {
        var retval = jQxhr.getResponseHeader( 'Authorization' );
        var token = retval.split(' ');
        if( token[1] ) {
            sessionStorage.setItem( 'ktc_token', token[1] );
            $('#jwt').val(token[1]);
            $('#jform').submit();   // needed to set browser url - redirect
        }
    })
    .fail( function( jqXhr, textStatus, errorThrown ) {
		console.log( errorThrown );
		alert( textStatus + ", " + errorThrown )
	});
}

/*
$(function(){
  $('#psw').keypress(function(e) {
    if(e.which == 13) {
		$('#lbtn').focus();
		$('#lbtn').click();
    }
  });
});
*/
</script>
<p></p>
</body>
</html>
