
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>
			<tr>
				<td width="30%">ID</td>
				<td><input type="text" name="mv_id" disabled="disable" class="text" value="<?php echo set_value('mv_id'); ?>"/></td>
				<input type="hidden" name="mv_id" value="<?php echo set_value('mv_id',$this->form_data->mv_id); ?>"/>
			</tr>
			<tr>
				<td valign="top">Title<span style="color:red;">*</span></td>
				<td><input type="text" name="mv_title" class="text" value="<?php echo set_value('mv_title',$this->form_data->mv_title); ?>"/>
<?php echo form_error('mv_title'); ?>
				</td>
			</tr>
            <tr>
                <td valign="top">Actor<span style="color:red;">*</span></td>
                <td>   <?php echo form_dropdown('mv_actor', $select_options_actor, $this->form_data->mv_actor);  ?>
                </td>
             </tr>
            <tr>
                <td valign="top">Director<span style="color:red;">*</span></td>
                <td>    <?php echo form_dropdown('mv_director', $select_options_director, $this->form_data->mv_director);  ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Music Director<span style="color:red;">*</span></td>
                <td>   <?php echo form_dropdown('mv_music_director', $select_options_music_director, $this->form_data->mv_music_director);  ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Producer<span style="color:red;">*</span></td>
                <td><input type="text" name="mv_producer" class="text" value="<?php echo set_value('mv_producer',$this->form_data->mv_producer); ?>"/>
                    <?php echo form_error('mv_producer'); ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Cinematographer<span style="color:red;">*</span></td>
                <td><input type="text" name="mv_cinematographer" class="text" value="<?php echo set_value('mv_cinematographer',$this->form_data->mv_cinematographer); ?>"/>
                    <?php echo form_error('mv_cinematographer'); ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Editor<span style="color:red;">*</span></td>
                <td><input type="text" name="mv_editor" class="text" value="<?php echo set_value('mv_editor',$this->form_data->mv_editor); ?>"/>
                    <?php echo form_error('mv_editor'); ?>
                </td>
            </tr>

            <tr>
                <td valign="top">Release Year<span style="color:red;">*</span></td>
                <td><input type="text" name="mv_release_year" class="text" value="<?php echo set_value('mv_release_year',$this->form_data->mv_release_year); ?>"/>
                    <?php echo form_error('mv_release_year'); ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Language<span style="color:red;">*</span></td>
                <td><input type="text" name="mv_language" class="text" value="<?php echo set_value('mv_language',$this->form_data->mv_language); ?>"/>
                    <?php echo form_error('mv_language'); ?>
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
