
		<h1><?php echo $title; ?></h1>
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><?php echo $movie->mv_id; ?></td>
			</tr>
			<tr>
				<td valign="top">Title</td>
				<td><?php echo $movie->mv_title; ?></td>
			</tr>
			<tr>
				<td valign="top">Actor</td>
				<td><?php echo form_dropdown('mv_actor', $select_options_actor, $movie->mv_actor);  ?></td>
			</tr>
            <tr>
                <td valign="top">Director</td>
                <td><?php echo form_dropdown('mv_director', $select_options_director, $movie->mv_director);  ?></td>
            </tr>
            <tr>
                <td valign="top">Music Director</td>
                <td><?php echo form_dropdown('mv_music_director', $select_options_music_director, $movie->mv_music_director);  ?></td>
            </tr>
            <tr>
                <td valign="top">Producer</td>
                <td><?php echo $movie->mv_producer; ?></td>
            </tr>
            <tr>
                <td valign="top">Cinematographer</td>
                <td><?php echo $movie->mv_cinematographer; ?></td>
            </tr>
            <tr>
                <td valign="top">Editor</td>
                <td><?php echo $movie->mv_editor; ?></td>
            </tr>
            <tr>
                <td valign="top">Release Year</td>
                <td><?php echo $movie->mv_release_year; ?></td>
            </tr>
            <tr>
                <td valign="top">Language</td>
                <td><?php echo $movie->mv_language; ?></td>
            </tr>
		</table>
		</div>
		<br />
		<?php echo $link_back; ?>
