<h1>Log In to <?php echo SITE; ?></h1>
<form action="<?php echo WEBROOT; ?>action/login.php" method="post">
	<table class="recordtable">
		<tr>
			<th><label for="username">Username:</label></th>
			<td><input type="text" name="username" id="username" autofocus="autofocus" /></td>
		</tr>
		<tr>
			<th><label for="password">Password:</label></th>
			<td><input type="password" name="password" id="password" /></td>
		</tr>
		<tr>
			<th></th>
			<td><div class="button-group">
				<input type="submit" value="Login" class="button big primary" />
				<input type="submit" name="reset" class="button big danger" value="Reset Password" />
			</div></td>
		</tr>
	</table>
</form>