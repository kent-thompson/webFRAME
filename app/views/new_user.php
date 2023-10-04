<div class="col-center">
	<div class="spborder">
	<h5>New User</h5>
	<form id="nufrm" action="/user/createuser" method="POST">
		<div class="form-group">	
			<label for="uname"><b>Username</b></label><br/>
			<input class="form-control" placeholder="Enter Username" name="uname" autofocus required>
		</div>
		<div class="form-group">	
			<label for="fname"><b>First Name</b></label><br/>
			<input class="form-control" placeholder="Enter First Name" name="fname" autofocus required>
		</div>
		<div class="form-group">	
			<label for="lname"><b>Last Name</b></label><br/>
			<input class="form-control" placeholder="Enter Last Name" name="lname" autofocus required>
		</div>
		<div class="form-group">	
			<label for="email"><b>Email</b></label><br/>
			<input class="form-control" placeholder="Enter Email" name="email" autofocus required>
		</div>
		<div class="form-group">	
            <label for="bdate"><b>Birthdate</b></label><br/>
            <input type="date" class="form-control" placeholder="Enter Birthdate" id='bdate' name="bdate" value='' autofocus required>
		</div>
		<div class="form-group">
			<label for="psw"><b>Password</b></label><br/>
			<input type="password" class="form-control" placeholder="Enter Password" name="psw" required>
		</div>
		<p>Press <i>Create New User</i> to proceed. The account should be created. You must then <b>login into that account</b> from the main menu. Thank you.</p>
		<button type="submit" class="btn btn-primary">Create New User</button>
		<button type="button" class="btn btn-primary" onclick="history.back()">Back</button>
	</form>
	</div>
    <p></p>
</div>
