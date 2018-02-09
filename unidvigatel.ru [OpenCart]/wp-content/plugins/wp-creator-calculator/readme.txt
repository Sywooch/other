=== wp-creator-calculator ===
Contributors: ZetRider
Donate link: http://www.zetrider.ru/donate
Tags: calculator, forms, create
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: 3.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The new version of the plugin for WordPress, which allows you to create flexible forms of the calculator.

== Description ==

<strong>The main changes are:</strong><br>
* Completely rewritten algorithm formula<br>
* Simplified administration panel<br>
* Added AJAX calculations<br>
* Added ability to send letters to the calculations<br>
* Fixed all the shortcomings and errors of previous versions<br>
* Changed the principle of Checkbox<br>
* Added default values in order to avoid the error "Division by zero"<br>
* Stores the selected values in the form after the calculation<br>
* Added field jQuery<br>
* Added a calculator widget<br>
* Remove extra fields: Sorting (now just a mouse sort, Drag and Drop), CSS (each block, and so there is a unique class)<br>
* Changed the structure of the tables in the database<br>

! New version of the database plugin is not compatible with previous versions of the plugin <3.0.
The new version of the plugin you can view data from a legacy database.

All the settings for each individual calculator.

<strong>The principle of the calculator:</strong><br>
field1 + (3 * field (field 2 + field 4))<br>
<strong>literally:</strong><br>
(id1 (a sign next to the field)) (id3 sign in front of the field after the field sign) (sign in front of the field id2 sign next to the field) (id4 signs next to the field)<br>

<strong>Analysis of the calculator menu:</strong>

<strong>Text Box:</strong><br>
Title - The text that appears above the block<br>
Text - any text can use HTML, thus allowing you to take any form of calculator design.<br>
You can also display the values from $_SESSION directly in the text using the code [session id = "ID_CALC"] ID_ROW or sum calc [/session]. About the sessions more in $ _SESSION.<br>

<strong>The SELECT list</strong><br>
Title - The text that appears above the list<br>
Signs up - here it is necessary to specify the arithmetic sign, which will set the action to the drop-down list.<br>
Signs of post - here it is necessary to specify the arithmetic sign, which will set the action when the drop-down list.<br>
List - to form a drop-down list, you must arrange the data according to certain rules. For example - [price]:name;[500]:Installation of windows;[0]:null;<br>

<strong>Checkbox</strong><br>
Title - The text that appears on the checkbox<br>
Signs up - here it is necessary to specify the arithmetic sign, which will set the action to the checkbox.<br>
Signs of post - here it is necessary to specify the arithmetic sign, which will set the action after the checkbox.<br>
The default value - if the checkbox is not selected, the default value which it is assigned. It is assumed for the use of formulas with multiplication and division, to avoid errors in the calculation.<br>
Price of the field - the value of the field, selecting the checkbox will be substituted the price.<br>
p.s. In contrast to the checkboxes in the previous version removed the function list building, as this caused many problems in the calculations. Now, to consistently build several checkboxes in a row, you could use CSS to place them as you want. More information about the structure of the CSS below.<br>

<strong>Radio buttons</strong><br>
Title - The text that appears above the unit Radio Buttons<br>
Signs up - here it is necessary to specify the arithmetic sign, which will set the action to block Radio buttons.<br>
Signs of post - here it is necessary to specify the arithmetic sign, which will set the action after a block of Radio buttons.<br>
List - to create a list of Radio buttons, you need to arrange the data according to certain rules! For example - [price]:name;[500]:Installation of windows;[0]:null;<br>
p.s. Checked placed on the first on the list of Radio button<br>

<strong>A text box</strong><br>
Title - The text that appears over<br>
Signs up - here it is necessary to specify the arithmetic sign, which will set the action to the text field.<br>
Signs of post - here it is necessary to specify the arithmetic sign, which will set the action after the text field.<br>
The default value - if the field does not hammered, what the default value assigned to it. It is assumed for the use of formulas with multiplication and division, to avoid errors in the calculation.<br>
Price of the field - the value of the field. The data entered by the user, will be multiplied or divided (depending on what you specify in the "action with the data") at this price.<br>
The action with the data - given the arithmetic is substituted to a sign between the data entered by the user (or the default value of the floor) and the price field.<br>
p.s. Note that the user can still enter 0, and if you will stand up to this division, an error occurs. To avoid it, well thought out formula.<br>

<strong>A hidden field</strong><br>
Signs up - here it is necessary to specify the arithmetic sign, which will set the action in front of a hidden field.<br>
Signs of post - here it is necessary to specify the arithmetic sign, which will set the action after a hidden field.<br>
Price of the field - the value of the field.<br>

<strong>$_SESSION Field</strong><br>
Signs up - here it is necessary to specify the arithmetic sign, which will set the action to the $_SESSION field.<br>
The sign post - here it is necessary to specify the arithmetic sign, which will set the action after the $_SESSION field.<br>
The default value - if the specified session is empty you will be taken this value.<br>
ID calculator - from what the calculator is necessary to take data. More information about the structure of the $_SESSION array below.<br>
ID field or the sum - of which ID fields to receive data, or specify a sum, to get the final calculation of the cost calculator.<br>

<strong>jQuery Field</strong><br>
This copies the data field is entered by the user in the text box. In the event keyUp. This field is hidden (input hidden).<br>
Signs up - here it is necessary to specify the arithmetic sign, which will set the action to the jQuery field.<br>
The sign post - here it is necessary to specify the arithmetic sign, which will set the action after the jQuery field.<br>
The default value - if the field does not hammered, what the default value assigned to it. It is assumed for the use of formulas with multiplication and division, to avoid errors in the calculation.<br>
ID field - from which the text field to copy the data.<br>

<strong>Setting Design</strong><br>
You can choose a ready to use designs calculator<br>
A. No design - an empty css<br>
Two. Skeleton - no images, but with ordered blocks<br>
Three. Minimalism - Simple design that can go to any site layout.<br>
All topics are in the plugin/theme<br>
In the plugin directory is a file example.css, which collects all the styles for the calculator, send e-mail, and a widget.<br>

<strong>Setting up mail</strong><br>
A new feature in the calculator (decided to add to the numerous requests). So far in testing, but it works.<br>
If you enable this feature in the settings, then after calculating the visitor will be asked to send an e-mail from his personal details: Name, Phone, Email, Comment, The amount of calculation.<br>
All messages, text messages, and the names of fields you can change the way you want.<br>
The following setting:<br>
Enable sending emails? - Yes or No<br>
Topic - The text to be specified in the letter sent to the topic. By adding the data subject: Your subject line + from name<br>
The text of the letter - sent a letter in the text, go after the user data<br>
Text before sending the form - the text to display before the data entry form<br>
Successful transmission of a message - text to be displayed after a successful sending of the letter<br>
At what E-Mail to send an email - indicate the email, the default data from the blog admin_email<br>
First Name Last Name Field, Golf pin E-Mail, telephone number field, field comments - both are called data fields appear before the data input by the user. If you want to hide a field, leave it blank.<br>

<strong>Filtering data before sending it:</strong><br>
Error: Do not enter a name - the error is displayed if the name passed in is null<br>
Error: The long name - the error is displayed if the name is more than 100 characters<br>
Error: Not entered Email - displayed an error if not entered e-mail<br>
Error: Invalid Email - error displayed if entered not email (standard validation)<br>
Error: Invalid phone - the error is displayed if the phone contains invalid characters, valid - (numbers, spaces, dashes, parentheses)<br>
Error: The long phone - an error is displayed when the phone is more than 35 characters<br>
Error: Long comment - displayed an error if the comment exceeds 2500 characters<br>

<strong>Setting up the calculator</strong> (a calculator for each individual, except for some fields)<br>
The name of the button the calculation - the data is supplied in the text of the button value calculation<br>
The text before the sum - display text before calculating the sum of<br>
Text after the amount - the amount of text displayed after the calculation<br>
Enable AJAX calculator? - Makes it possible to calculate, without page reloading<br>
Action form - address of the page where the user is redirected after clicking the calculation<br>
Remember the selected data in the form - allowing you to store the data entered or selected by the user in the form when you click calculate<br>

Connect jQuery - this setting affects all calculators, if you are still not connected to the site Jquery library, select this option as Yes. The default is enabled. The connection is by using the wp_enqueue_script("jquery") chereh action init<br>
Start the $_SESSION - this setting affects all calculators, if your site is not running session, this function will start to function session_start(); action by init.<br>

In the same menu you can delete permanently calculator and all of its field<br>

<strong>Paragraphs calculator:</strong><br>
The top field displays the selected settings from the menu<br>

<strong>Paragraph added fields:</strong><br>
Displays which fields have been added in the selected calculator.<br>
Displayed their names and ID<br>
To edit the appropriate field, click the plus sign next to it, open its settings<br>
To reverse the field, click the required check box, and then hold the mouse button, drag to the right place.<br>

<strong>Paragraph Text formula:</strong><br>
Displays the ID added to the fields and their arithmetic values before and after.<br>
This section makes it easy to find errors in your formula.<br>

<strong>Preview of Paragraph calculator:</strong><br>
Displays the form of a calculator, which you have created.<br>
Also in this section, if not AJAX enabled calculation shows the data and the $_SESSION array sorted by the keys (for sorting), which receives a calculator, and inserts data into eval();<br>

<strong>The structure of the CSS</strong><br>
&lt;style&gt;<br>
// ID-calc - ID calculator<br>
// ID-row - field identifier<br>
<br>
// Calculator Class <br>
<br>
// wpcc, wpcc_ID-calc <br>
.wpcc {}<br>
<br>
// wpcc_form, wpcc_ID-calc <br>
.wpcc_form {}<br>
<br>
// wpcc_description, wpcc_description_ID-row <br>
.wpcc_description {}<br>
<br>
// wpcc_text, wpcc_text_ID-row <br>
.wpcc_text {}<br>
<br>
// wpcc_select, wpcc_select_ID-row <br>
.wpcc_select {}<br>
<br>
// wpcc_checkbox, wpcc_checkbox_ID-row <br>
.wpcc_checkbox {}<br>
<br>
// wpcc_radio, wpcc_radio_ID-row <br>
.wpcc_radio {}<br>
<br>
// wpcc_inputtext, wpcc_inputtext_ID-row <br>
.wpcc_inputtext {}<br>
<br>
// wpcc_submit, wpcc_submit_ID-calc <br>
.wpcc_submit {}<br>
<br>
// wpcc_result_block, wpcc_result_block_ID-calc <br>
.wpcc_result_block {}<br>
<br>
// wpcc_result, wpcc_result_ID-calc <br>
.wpcc_result {}<br>
<br>
// Mail Class <br>
<br>
// wpcc_mail_info, wpcc_mail_info_ID-calc <br>
.wpcc_mail_info {}<br>
<br>
// wpcc_mail, wpcc_mail_ID-calc <br>
.wpcc_mail {}<br>
<br>
// wpcc_mail_form, wpcc_mail_form_ID-calc <br>
.wpcc_mail_form {}<br>
<br>
// wpcc_mail_sum, wpcc_mail_sum_ID-calc <br>
.wpcc_mail_sum {}<br>
<br>
// wpcc_mail_text <br>
.wpcc_mail_text {}<br>
<br>
// wpcc_mail_row <br>
.wpcc_mail_row {}<br>
<br>
// wpcc_mail_author <br>
.wpcc_mail_author {}<br>
<br>
// wpcc_mail_email <br>
.wpcc_mail_email {}<br>
<br>
// wpcc_mail_phone <br>
.wpcc_mail_phone {}<br>
<br>
/* wpcc_mail_textarea <br>
.wpcc_mail_textarea {}<br>
<br>
// wpcc_mail_send <br>
.wpcc_mail_send {}<br>
<br>
/* Widget class */<br>
.wpcc_widget {}, .wpcc_widget_ID-calc {}<br>
&lt;/style&gt;

<strong>Structure of HTML</strong><br>
&lt;!-- Calculator --&gt;<br>
&lt;div class=&quot;wpcc wpcc_1&quot;&gt;<br>
&lt;form method=&quot;POST&quot; action=&quot;&quot; class=&quot;wpcc_form_1&quot;&gt;<br>
<br>
&lt;div class=&quot;wpcc_description wpcc_description_2&quot;&gt; Title text field &lt;/ div&gt;<br>
&lt;div class=&quot;wpcc_text wpcc_text_2&quot;&gt; text in the text box, you must test session, 
and other gizmos &lt;/ div&gt;<br>
<br>
&lt;div class=&quot;wpcc_description wpcc_description_3&quot;&gt; drop-down list &lt;/ div&gt;<br>
&lt;select name=&quot;wpcc_structure[3]&quot; class=&quot;wpcc_select wpcc_select_3&quot;&gt;<br>
&lt;option value=&quot;100&quot; selected&gt; title1 &lt;/ option&gt;<br>
&lt;option value=&quot;200&quot;&gt; title2 &lt;/ option&gt;<br>
&lt;option value=&quot;300&quot;&gt; title3 &lt;/ option&gt;<br>
&lt;option value=&quot;400&quot;&gt; title4 &lt;/ option&gt;<br>
&lt;/ Select&gt;<br>
<br>
&lt;div class=&quot;wpcc_description wpcc_description_4&quot;&gt; checkbox &lt;/ div&gt;<br>
&lt;input type=&quot;checkbox&quot; name=&quot;wpcc_structure[4]&quot; value=&quot;100&quot; class=&quot;wpcc_checkbox 
wpcc_checkbox_4&quot;&gt;<br>
<br>
&lt;div class=&quot;wpcc_description wpcc_description_5&quot;&gt; Radio &lt;/ div&gt;<br>
&lt;label&gt; &lt;input type=&quot;radio&quot; name=&quot;wpcc_structure[5]&quot; value=&quot;100&quot; class=&quot;wpcc_radio 
wpcc_radio_5&quot; checked&gt; title1 &lt;/ label&gt;<br>
&lt;label&gt; &lt;input type=&quot;radio&quot; name=&quot;wpcc_structure[5]&quot; value=&quot;200&quot; class=&quot;wpcc_radio 
wpcc_radio_5&quot;&gt; title2 &lt;/ label&gt;<br>
<br>
&lt;div class=&quot;wpcc_description wpcc_description_6&quot;&gt; text field &lt;/ div&gt;<br>
&lt;input type=&quot;text&quot; name=&quot;wpcc_structure_inputtext[6]&quot; value=&quot;100&quot; class=&quot;wpcc_inputtext 
wpcc_inputtext_6&quot; id=&quot;wpcc_jq_6&quot;&gt;<br>
<br>
&lt;input type=&quot;hidden&quot; name=&quot;wpcc_structure[7]&quot; value=&quot;500&quot;&gt;<br>
<br>
&lt;input type=&quot;hidden&quot; name=&quot;wpcc_structure[8]&quot; value=&quot;&quot;&gt;<br>
<br>
&lt;script&gt; jQuery(document).ready(function($) {$(&quot;#wpcc_jq_6&quot;).keyup(function 
() {$ (&quot;#wpcc_jq_get_9&quot;).val($(this).val());});}); &lt;/ script&gt;<br>
&lt;input type=&quot;hidden&quot; id=&quot;wpcc_jq_get_9&quot; name=&quot;wpcc_structure[9]&quot; value=&quot;&quot;&gt;<br>
<br>
&lt;input type=&quot;hidden&quot; name=&quot;wpcc_structure_id&quot; value=&quot;3,4,5,7,8,9&quot;&gt;<br>
<br>
&lt;input type=&quot;submit&quot; value=&quot;Raschitat&quot; name=&quot;wpcc_calculate&quot; class=&quot;wpcc_submit 
wpcc_submit_1&quot;&gt;<br>
&lt;/ Form&gt;<br>
<br>
&lt;div class=&quot;wpcc_result_block wpcc_result_block_1&quot;&gt;<br>
&lt;div class=&quot;wpcc_result wpcc_result_1&quot;&gt; Result: 1006 rubles. &lt;/ div&gt;<br>
&lt;/ Div&gt;<br>
<br>
&lt;/ Div&gt;<br>
<br>
&lt;!-- Mail --&gt;<br>
&lt;div class=&quot;wpcc_mail_info wpcc_mail_info_1&quot; style=&quot;display:none;&quot;&gt; &lt;/ div&gt;<br>
&lt;div class=&quot;wpcc_mail wpcc_mail_1&quot;&gt;<br>
<br>
&lt;form method=&quot;post&quot; action=&quot;#wpcc_mail_ancor_1&quot; class=&quot;wpcc_mail_form 
wpcc_mail_form_1&quot;&gt;<br>
&lt;div class=&quot;wpcc_mail_sum&quot;&gt; Result: 23 255 rubles. &lt;/ div&gt;<br>
&lt;div class=&quot;wpcc_mail_text&quot;&gt; Send application administrator? &lt;/ div&gt;<br>
&lt;div class=&quot;wpcc_mail_row&quot;&gt; &lt;b&gt; Your First and Last Name &lt;/ b&gt; &lt;input type=&quot;text&quot; 
name=&quot;mail_author&quot; class=&quot;wpcc_mail_author&quot; value=&quot;&quot;&gt; &lt;/ div&gt;<br>
&lt;div class=&quot;wpcc_mail_row&quot;&gt; &lt;b&gt; Your E-Mail &lt;/ b&gt; &lt;input type=&quot;text&quot; name=&quot;mail_email&quot; 
class=&quot;wpcc_mail_email&quot; value=&quot;&quot;&gt; &lt;/ div&gt;<br>
&lt;div class=&quot;wpcc_mail_row&quot;&gt; &lt;b&gt; Your Phone &lt;/ b&gt; &lt;input type=&quot;text&quot; name=&quot;mail_phone&quot; 
class=&quot;wpcc_mail_phone&quot; value=&quot;&quot;&gt; &lt;/ div&gt;<br>
&lt;div class=&quot;wpcc_mail_row&quot;&gt; &lt;b&gt; your comment &lt;/ b&gt; &lt;textarea name=&quot;mail_text&quot; 
class=&quot;wpcc_mail_textarea&quot; maxlength=&quot;2500&quot;&gt; &lt;/ textarea&gt; &lt;/ div&gt;<br>
&lt;input type=&quot;hidden&quot; name=&quot;wpcc_mail_sum&quot; value=&quot;23255&quot;&gt;<br>
&lt;input type=&quot;hidden&quot; name=&quot;wpcc_mail_send_id&quot; value=&quot;1&quot;&gt;<br>
&lt;input type=&quot;submit&quot; name=&quot;wpcc_mail_send&quot; class=&quot;wpcc_mail_send 
wpcc_mail_send_1&quot; value=&quot;Otpravit&quot;&gt;<br>
&lt;/ Form&gt;<br>
<br>
&lt;/ Div&gt;<br>
<br>
&lt;!-- Widget --&gt;<br>
&lt;div class=&quot;wpcc_widget wpcc_widget_1&quot;&gt;<br>
&lt;!-- HTML structure of the calculator --&gt;<br>
&lt;/ Div&gt;

<strong>How to put a calculator on the site</strong><br>
The code for the files of your theme: &lt;? Php echo do_shortcode ('[wpcc id = &quot;X&quot;]');?&gt;<br><br>
Shortcode for pages and entries: [wpcalculator wpcc = &quot;X&quot;]<br><br>
where X - is the ID of the calculator, you want to display.<br>

<strong>The structure of the $ _SESSION</strong><br>
Before each calculation of the current $ _SESSION calculator removed - unset ($ _SESSION ['wpcc_'. $ Wpcc_id]);<br>
Array<br>
(<br>
     [wpcc_1] => Array // wpcc_ID calculator<br>
         (<br>
             [3] => 100 // 3 - id field<br>
             [5] => 100<br>
             [7] => 100<br>
             [8] => 22 509<br>
             [9] => 1<br>
             [4] => 100<br>
             [6] => 123 // that the user entered into the text field<br>
             [6_sum] => 223 // amount of text field<br>
             [sum] => 23133 // calculate the total amount<br>
         )<br>
<br>
)<br>

<strong>Array structure</strong><br>
Array<br>
(<br>
     [1] => 100 + // a sort ID, the sum of 100 + sign next to the field<br>
     [3] => 100 +<br>
     [4] => 100 +<br>
     [5] => (123 +100) + // text box 123 that brought the visitor, (+) with effect from the data, 100 price of the field<br>
     [6] => 100 +<br>
     [7] => 23255 +<br>
     [8] => 123<br>
)<br>

p.s. Sorry, this text is translated G Translator

== Installation ==

1. Download the plugin wp-creator-calculator.
2. Uploads folder wp-creator-calculator plug-in category /wp-content/plugins/
3. Activate the plugin
4. Select the admin panel WP Calculator
5. Customize to suit your needs

== Screenshots ==

1. Editing formulas and sort
2. Simple example of a calculator
3. Creating Forms

== Frequently Asked Questions ==

Free help is here - http://www.zetrider.ru

== Upgrade Notice ==

== 3.1 = 
* Display data from an older version of the plugin if the database exists.

= 3.0 =
* Completely rewritten algorithm formula;
* Simplified administration panel;
* Added AJAX calculations;
* Added ability to send letters to the calculations;
* Fixed all the shortcomings and errors of previous versions;
* Changed the principle of Checkbox;
* Added default values in order to avoid the error "Division by zero";
* Stores the selected values in the form after the calculation;
* Added field jQuery;
* Added a calculator widget;
* Remove extra fields: Sorting (now just a mouse sort, Drag and Drop), CSS (each block, and so there is a unique class);
* Changed the structure of the tables in the database;

= 2.5 =
* On one page you can place a few calculators;
* Added check for duplication of the same ban screening values;
* Added to the $ _SESSION array calculator, all values are stored in their session, and you can pull out and substituted in the calculation or text block;
* Added ability to display a list of available sessions;
* Added style for the calculator;
* Added ability to specify Action for each calculator; 

= 2.1 =
* Fixed checkboxes now work correctly. (!Attention! Added to the table action between the selected values);
* Ability to view the full calculation of the transmitted data. To display a shortcode to add a new parameter: [wpcalculator idcalc="ID" show_result="true"].

= 2.0 =
* With version 2.0 adds the ability to create more than 1 calculator on the site;
* Fixed minor issues;
* Optimized source code.

= 1.1 =
Simplified plugin code; 
The default language is English; 
Russian translation is present; 
In the setting adds the ability to specify the text after the final amount; 
Fixed minor issues.

== Changelog ==

= 3.1 =
* Display data from an older version of the plugin if the database exists;

= 3.0 =
* Completely rewritten algorithm formula;
* Simplified administration panel;
* Added AJAX calculations;
* Added ability to send letters to the calculations;
* Fixed all the shortcomings and errors of previous versions;
* Changed the principle of Checkbox;
* Added default values in order to avoid the error "Division by zero";
* Stores the selected values in the form after the calculation;
* Added field jQuery;
* Added a calculator widget;
* Remove extra fields: Sorting (now just a mouse sort, Drag and Drop), CSS (each block, and so there is a unique class);
* Changed the structure of the tables in the database;

= 2.5 =
* On one page you can place a few calculators;
* Added check for duplication of the same ban screening values;
* Added to the $ _SESSION array calculator, all values are stored in their session, and you can pull out and substituted in the calculation or text block;
* Added ability to display a list of available sessions;
* Added style for the calculator;
* Added ability to specify Action for each calculator; 

= 2.1 =
* Fixed checkboxes now work correctly. (!Attention! Added to the table action between the selected values);
* Ability to view the full calculation of the transmitted data. To display a shortcode to add a new parameter: [wpcalculator idcalc="ID" show_result="true"].

= 2.0 =
* With version 2.0 adds the ability to create more than 1 calculator on the site
* Fixed minor issues
* Optimized source code

= 1.1 =
* Simplified plugin code
* The default language is English
* Russian translation is present
* In the setting adds the ability to specify the text after the final amount
* Fixed minor issues

= 1.0 =
* Testing and creating plugins