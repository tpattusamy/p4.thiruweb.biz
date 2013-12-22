
		<h1><?php echo $title; ?></h1>
		<?php echo $message; ?>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>
			<tr>
				<td width="30%">a_id</td>
				<td><input type="text" name="a_id" disabled="disable" class="text" value="<?php echo set_value('a_id'); ?>"/></td>
				<input type="hidden" name="a_id" value="<?php echo set_value('a_id',$this->form_data->a_id); ?>"/>
			</tr>
			<tr>
				<td valign="top">Name<span style="color:red;">*</span></td>
				<td><input type="text" name="a_name" class="text" value="<?php echo set_value('a_name',$this->form_data->a_name); ?>"/>
<?php echo form_error('a_name'); ?>
				</td>
			</tr>
			
			<tr>
				<td valign="top">Date of birth (dd-mm-yyyy)<span style="color:red;">*</span></td>
				<td><input type="text" name="a_date_of_birth" onclick="displayDatePicker('a_date_of_birth');" class="text" value="<?php echo set_value('a_date_of_birth',$this->form_data->a_date_of_birth); ?>"/>
				<a href="javascript:void(0);" onclick="displayDatePicker('a_date_of_birth');"><img src="<?php echo base_url(); ?>res/css/images/calendar.png" alt="calendar" border="0"></a>
<?php echo form_error('a_date_of_birth'); ?></td>
				</td>
			</tr>
            <tr>
                <td valign="top">Place of Birth<span style="color:red;">*</span></td>
                <td><input type="text" name="a_place_of_birth" class="text" value="<?php echo set_value('a_place_of_birth',$this->form_data->a_place_of_birth); ?>"/>
                    <?php echo form_error('a_place_of_birth'); ?>
                </td>
            </tr>
            <tr>
                <td valign="top">First Movie<span style="color:red;">*</span></td>
                <td><input type="text" name="a_first_movie" class="text" value="<?php echo set_value('a_first_movie',$this->form_data->a_first_movie); ?>"/>
                    <?php echo form_error('a_first_movie'); ?>
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
