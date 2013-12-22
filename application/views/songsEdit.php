
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><input type="text" name="so_id" disabled="disable" class="text" value="<?php echo set_value('so_id'); ?>"/></td>
				<input type="hidden" name="so_id" value="<?php echo set_value('so_id',$this->form_data->so_id); ?>"/>
			</tr>
			<tr>
				<td valign="top">Title<span style="color:red;">*</span></td>
				<td><input type="text" name="so_title" class="text" value="<?php echo set_value('so_title',$this->form_data->so_title); ?>"/>
<?php echo form_error('so_title'); ?>
				</td>
			</tr>
            <tr>
                <td valign="top">Movie<span style="color:red;">*</span></td>
                <td><input type="text" name="so_movie" class="text" value="<?php echo set_value('so_movie',$this->form_data->so_movie); ?>"/>
                    <?php echo form_error('so_movie'); ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Singer 1<span style="color:red;">*</span></td>
                <td>   <?php echo form_dropdown('so_singer1', $select_options_singer, $this->form_data->so_singer1);  ?>
                </td>
             </tr>
            <tr>
                <td valign="top">Singer 2<span style="color:red;">*</span></td>
                <td>    <?php echo form_dropdown('so_singer2', $select_options_singer, $this->form_data->so_singer2);  ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Lyricist<span style="color:red;">*</span></td>
                <td>   <?php echo form_dropdown('so_lyrics', $select_options_lyricist, $this->form_data->so_lyrics);  ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Language<span style="color:red;">*</span></td>
                <td><input type="text" name="so_language" class="text" value="<?php echo set_value('so_language',$this->form_data->so_language); ?>"/>
                    <?php echo form_error('so_language'); ?>
                </td>
            </tr>

			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		</div>
		</form>
		<br />
		<?php echo $link_back; ?>
