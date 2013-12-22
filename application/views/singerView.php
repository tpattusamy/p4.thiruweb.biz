
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><?php echo $singer->s_id; ?></td>
			</tr>
			<tr>
				<td valign="top">Name</td>
				<td><?php echo $singer->s_name; ?></td>
			</tr>
			<tr>
				<td valign="top">Date of birth (dd-mm-yyyy)</td>
				<td><?php echo date('d-m-Y',strtotime($singer->s_date_of_birth)); ?></td>
			</tr>
            <tr>
                <td valign="top">Place of Birth</td>
                <td><?php echo $singer->s_place_of_birth; ?></td>
            </tr>
            <tr>
                <td valign="top">First Song</td>
                <td><?php echo $singer->s_first_song; ?></td>
            </tr>
            <tr>
                <td valign="top">Language</td>
                <td><?php echo $singer->s_language; ?></td>
            </tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
