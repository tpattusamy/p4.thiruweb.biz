
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><?php echo $lyricist->l_id; ?></td>
			</tr>
			<tr>
				<td valign="top">Name</td>
				<td><?php echo $lyricist->l_name; ?></td>
			</tr>
			<tr>
				<td valign="top">Date of birth (dd-mm-yyyy)</td>
				<td><?php echo date('d-m-Y',strtotime($lyricist->l_date_of_birth)); ?></td>
			</tr>
            <tr>
                <td valign="top">Place of Birth</td>
                <td><?php echo $lyricist->l_place_of_birth; ?></td>
            </tr>
            <tr>
                <td valign="top">First Song</td>
                <td><?php echo $lyricist->l_first_song; ?></td>
            </tr>
            <tr>
                <td valign="top">Language</td>
                <td><?php echo $lyricist->l_language; ?></td>
            </tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
