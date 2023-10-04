<div id="container">
	<h1>Welcome to Page One!</h1>
	<div id="body">
		<p>Page One</p>	
		<h1>Products</h1>
		<div id="pickles" style="float:left;">		
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="kdt">
			<thead>
				<tr>
					<th width="10%">ID</th>
					<th width="30%">Name</th>
					<th width="45%">Description</th>
					<th width="20%">Price</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="5" class="dataTables_empty">Loading data from server</td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Description</th>
					<th>Price</th>
				</tr>
			</tfoot>
		</table>
		<br/>		
		</div>
		<div style="clear:left; margin-left:18em;">
			<form name="newproduct" action="http://localhost/citest/index.php/main/productform" method="post" style="float:left;">
				<input type="hidden" name="dbAction" value="Add" />
				<input type="submit" value="Add New Product" />
				
			</form>
			<form name="product" action="http://localhost/citest/index.php/main/productform" onsubmit="return validateForm()" method="post">
				<input type="hidden" name="dbAction" value="Edit" />
				<input type="hidden" id="fID" name="ID" />
				<input type="hidden" id="fname" name="fname" />
				<input type="hidden" id="fdesc" />
				<input type="hidden" id="fprice" />
				<button type="submit">Edit Selected Product</button>
			</form>
		</div>
	</div>
</div>

