
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><?php echo $actor->a_id; ?></td>
			</tr>
			<tr>
				<td valign="top">Name</td>
				<td><?php echo $actor->a_name; ?></td>
			</tr>
			<tr>
				<td valign="top">Date of birth (dd-mm-yyyy)</td>
				<td><?php echo date('d-m-Y',strtotime($actor->a_date_of_birth)); ?></td>
			</tr>
            <tr>
                <td valign="top">Place of Birth</td>
                <td><?php echo $actor->a_place_of_birth; ?></td>
            </tr>
            <tr>
                <td valign="top">First Movie</td>
                <td><?php echo $actor->a_first_movie; ?></td>
            </tr>
            <tr>
                <td valign="top">Language</td>
                <td><?php echo $actor->a_language; ?></td>
            </tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
