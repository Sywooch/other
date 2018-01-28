<div style="height:110px; width:290px; margin-left:100px; margin-top:140px; float:left">
<div style="height:110px; width:290px; margin-top:0px"><!--поиск-->
 <fieldset>
  <form  onsubmit="tmp(this.form);return false;">
   <table>
    <tbody>
	<tr style="width:100%">
	 
	 <td style="width:100%">
	 <input type="text" size="35" name="inputtext_id" id="inputtext_id" ><!--поле для ввод фразы-->
	 <select name="search_method" id="search_method" ><!--критерии поиска-->
	  <option value="0">фраза полностью</option>
	  <option value="1">вхождение всех слов</option>
	  <option value="2">наличие любого слова</option>
	 </select>
	 <input type="submit" value="поиск" onclick="tmp(this.form);return false;" >
	 </td>
	 </tr>
	 <tr>
	 <td style="color: #FFFFFF;">
	 <input name="vote_check" type="radio" value="1" onclick="click_radio2()" selected>по сайту
	 <input name="vote_check" id="vote_check2" type="radio" value="2" style="margin-left:10px" onclick="click_radio()">по странице
	 </td>
	 </tr>
	</tbody>
   </table>
  </form> 
 </fieldset>
</div><!--поиск-->

</div>