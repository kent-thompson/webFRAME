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
            <!-- <div class="form-group"> -->
                <button id="lbtn" type="button" onclick="auth()">Login</button><br><br>
                <input type="checkbox" checked="checked" name="remember" disabled> Remember Me</input><br>
                <a class="psw" href="#">Forgot Password?</a>
            <!-- </div> -->
        </form>
    </div>
    <p></p>
</div>
<form id='jform' action="/home/indexAuth" method="POST"><input type="hidden" id="jwt" name="jwt"></form>

<script>
var gBasepath = null;
var gToken = null;

function auth() {
    doAuth();
}

async function doAuth() {

    // let p = await auth();
    // p.then((token) => {
    //  sessionStorage.setItem( 'ktc_token', token );
    //     ('#jwt').val(token);
    //     $('#jform').submit();
    // });

    //  await auth().then((token) => {
      //sessionStorage.setItem( 'ktc_token', token );
    //  console.log('in caling doAuth then');
    //     ('#jwt').val(token);
    //     $('#jform').submit();
    // console.log(token);
    // });

//var un  = $('#uname').val();
//ar up = $('#psw').val();

    const res = await fetch( location.origin + '/api/user/login', {
    method: 'POST',
    // headers: {
    //     "content-type": "multipart/form-data"
    //   },
    //   body: document.getElementById('lform')
    headers: {'Content-type': 'application/x-www-form-urlencoded'},
    //headers: { 'Content-type': 'application/json' },
//     headers: {
//     'Accept': 'application/json',
//     'Content-Type': 'application/json'
//   },    
    //body: JSON.stringify({ uname: 'kkkkkk', psw: 'kkkkkk' })
   // body: { 'uname':$('#uname').val(), 'psw':$('#psw').val() }
   body: new URLSearchParams({
        'uname': $('#uname').val(),
        'psw': $('#psw').val(),
    })
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

// async function auth() {
//     var gBasepath = '../api/user/login';
//     var jdata = { 'uname':$('#uname').val(), 'psw':$('#psw').val() };

//   return  new Promise((resolve, reject) => {
//      $.ajax({
//     type: 'POST',
//     url: gBasepath,
//     data: jdata,
//     dataType: 'json',
//     //headers: {'Access-Control-Allow-Origin': '*'},
//     //contentType: 'application/json',
//     timeout: 30000,
// }).done( function (token) {
//         console.log('in ajax then');
//     resolve(token);
//     // sessionStorage.setItem( 'ktc_token', token );
//     // $('#jwt').val(token);
//     // $('#jform').submit();
//  })
// .fail( function() {
//     alert( 'Ajax Error' );
//   });
// })
//}

</script>
<p></p>
</body>
</html>
