
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>
			<tr>
				<td width="30%">s_id</td>
				<td><input type="text" name="s_id" disabled="disable" class="text" value="<?php echo set_value('s_id'); ?>"/></td>
				<input type="hidden" name="s_id" value="<?php echo set_value('s_id',$this->form_data->s_id); ?>"/>
			</tr>
			<tr>
				<td valign="top">Name<span style="color:red;">*</span></td>
				<td><input type="text" name="s_name" class="text" value="<?php echo set_value('s_name',$this->form_data->s_name); ?>"/>
<?php echo form_error('s_name'); ?>
				</td>
			</tr>
			
			<tr>
				<td valign="top">Date of birth (dd-mm-yyyy)<span style="color:red;">*</span></td>
				<td><input type="text" name="s_date_of_birth" onclick="displayDatePicker('s_date_of_birth');" class="text" value="<?php echo set_value('s_date_of_birth',$this->form_data->s_date_of_birth); ?>"/>
				<a href="javascript:void(0);" onclick="displayDatePicker('s_date_of_birth');"><img src="<?php echo base_url(); ?>res/css/images/calendar.png" alt="calendar" border="0"></a>
<?php echo form_error('s_date_of_birth'); ?></td>
				</td>
			</tr>
            <tr>
                <td valign="top">Place of Birth<span style="color:red;">*</span></td>
                <td><input type="text" name="s_place_of_birth" class="text" value="<?php echo set_value('s_place_of_birth',$this->form_data->s_place_of_birth); ?>"/>
                    <?php echo form_error('s_place_of_birth'); ?>
                </td>
            </tr>
            <tr>
                <td valign="top">First Movie<span style="color:red;">*</span></td>
                <td><input type="text" name="s_first_song" class="text" value="<?php echo set_value('s_first_song',$this->form_data->s_first_song); ?>"/>
                    <?php echo form_error('s_first_song'); ?>
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
