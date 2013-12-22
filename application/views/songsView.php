
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><?php echo $songs->so_id; ?></td>
			</tr>
			<tr>
				<td valign="top">Song Title</td>
				<td><?php echo $songs->so_title; ?></td>
			</tr>
            <tr>
                <td valign="top">Song Movie</td>
                <td><?php echo $songs->so_movie; ?></td>
            </tr>
			<tr>
				<td valign="top">Singer 1</td>
				<td><?php echo form_dropdown('so_singer1', $select_options_singer, $songs->so_singer1);  ?></td>
			</tr>
            <tr>
                <td valign="top">Singer2</td>
                <td><?php echo form_dropdown('so_singer2', $select_options_singer, $songs->so_singer2);  ?></td>
            </tr>
            <tr>
                <td valign="top">Lyricist</td>
                <td><?php echo form_dropdown('so_lyrics', $select_options_lyricist, $songs->so_lyrics);  ?></td>
            </tr>

            <tr>
                <td valign="top">Language</td>
                <td><?php echo $songs->so_language; ?></td>
            </tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
