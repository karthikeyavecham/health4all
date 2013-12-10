<table>
<tr>
<th>From Admit Date</th>
<th>To Admit Date</th>
<th>Ear</th>
<th>Outcome</th>
<th>Want Contact Details?</th>
</tr>
<tr>
<td style="vertical-align:top;"><input type="text" name="from_date" id="vdatepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("jS M Y"); ?>'></td>
<td style="vertical-align:top;"><input type="text" name="to_date" id="datepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("jS M Y"); ?>'></td>
<td style="vertical-align:top;">
<select name="ear">
<option value='' select="selected">--ALL--</option>
<option value='Left'>Left</option>
<option value='Right'>Right</option>
</td>
<td style="vertical-align:top;">
<select name="outcome">
<option value='' select="selected">--ALL--</option>
<option value='Positive'>Positive</option>
<option value='Negative'>Negative</option>
</td>
<td>
<input type="radio" name="contact" value="yes">Yes
<input type="radio" name="contact" value="no" checked>No
</td>
</tr>
</table>
<input type="submit" name="submit">

