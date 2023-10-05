    
<div class="col-center">
    <div class="top-txt"><b>User Form</b><br>
    <div id="maintext">
        <form id="uform" action="/user/updateUser" method="POST">
            <input type="hidden" id="jwt" name="jwt">            
            <label for="id">ID:</label><br>
            <input type="text" id="id" name="id" readonly><br>    
            <label for="fname">First name:</label><br>
            <input type="text" id="fname" name="fname"><br>
            <label for="lname">Last name:</label><br>
            <input type="text" id="lname" name="lname"><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="pwd">Password:</label><br>
            <input type="password" id="pwd" name="pwd"><br><br>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <p></p>
</div>
<script>
$('#uform').on('submit', function() {
    $('#jwt').val( sessionStorage.getItem('ktc_token') );
    return true;
});
</script>    
