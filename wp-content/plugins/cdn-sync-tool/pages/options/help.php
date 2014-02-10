<div class="cst-help">
	<p>Feel free to send an email to the support team using the form provided below.</p>
	
	<?php if (isset($GLOBALS['emailSent']) && $GLOBALS['emailSent'] == true) { ?>
		<p>Sent</p>
	<?php } else { ?>
		<form method="post" action="" id="cst-emailhelp">
			<table>
				<tr>
					<th scope="row">Name</th>
					<td><input type="text" name="email[name]" /></td>
				</tr>
				<tr>
					<th scope="row">Email</th>
					<td><input type="text" name="email[email]" /></td>
				</tr>
				<tr>
					<th scope="row">Contact Reason</th>
					<td>
						<select name="email[reason]">
							<option value="Bug">Bug</option>
							<option value="Suggestion">Suggestion</option>
							<option value="Moving to CatN">Moving to CatN</option>
							<option value="You guys rock">You guys rock</option>
							<option value="You guys are the suck!!!">You guys are the suck!!!</option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row" valign="top">Message</th>
					<td><textarea cols="70" rows="5" name="email[message]"></textarea></td>
				</tr>
			</table>
			<p class="submit"><input type="submit" value="Send" class="button-primary" id="submitbutton" /></p>
		</form>
	<?php } ?>
</div>
