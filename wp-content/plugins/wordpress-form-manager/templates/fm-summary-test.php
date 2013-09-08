<?php
/*
Template Name: Form Manager Test
Template Description: The default template for e-mail notifications and summaries
Template Type: email, summary

//////////////////////////////////////////////////////////////////////////////////////////

Below are the functions that can be used within a summary template:

fm_summary_the_title() - the title of the form
fm_summary_have_items() - works like have_posts() for wordpress themes.  Returns 'true' if there are more items left in the form.
fm_summary_the_item() - works like the_item() for wordpress themes.  Initializes the current form item.
fm_summary_the_label() - label of the current form item
fm_summary_the_type() - type of the current form item (text, textarea, checkbox, custom_list, note, separator, recaptcha, file)
fm_summary_has_data() - returns true if the form element is a data element (as opposed to a separator, note, etc.)
fm_summary_the_value() - submitted value of the current form item
fm_summary_the_timestamp() - timestamp for the current submission
fm_summary_the_user() - the login name for the current user.  If no user is logged in, this returns an empty string.
fm_summary_the_IP() - the IP address of the user who submitted the form.
fm_summary_the_nickname() - the current item's nickname
fm_summary_the_parent() - post ID where the form was submitted from

fm_summary_get_item_label($nickname) - get an item's label by nickname
fm_summary_get_item_value($nickname) - get an item's value by nickname

*NOTE: 'Summary' templates can also be used for e-mails.  Notice that under 'Template Type', both 'email' and 'summary' are listed.  If you want to make a template for e-mail notifications only, then you should only put 'email' under 'Template Type'.

//////////////////////////////////////////////////////////////////////////////////////////

*/
?>
<?php /* The code below displays each form element, in order, along with the submitted data. */ ?>
<ul id="fm-summary">
<?php echo "<hr />"; ?>
<?php while(fm_summary_have_items()): fm_summary_the_item(); ?>
	<?php switch(fm_summary_the_type()){
		case 'separator': ?><hr /><?php break;
		default:
		if(fm_summary_has_data() && (fm_summary_the_nickname() != "miraclename") ): ?>
		<li<?php if(fm_summary_the_nickname() != "" ) echo " input type=hidden id=\"fm-item-".fm_summary_the_nickname()."-hidden\" value=\"".fm_summary_the_value()."\" id=\"fm-item-".fm_summary_the_nickname()."\"</br>";?><strong><?php echo fm_summary_the_value();?></strong></li>

		<?php apply_filters('excerpt_more', fm_summary_the_value()); apply_filters('the_excerpt', fm_summary_the_value()); ?>
	<?php endif;
		} // end switch ?>
<?php endwhile; ?>
<?php /* The user's first and last name, if there is a logged in user */ ?>
<?php 
$userName = fm_summary_the_user(); 
if(trim($userName) != ""){
	$userData = get_userdatabylogin($userName);
	if ( $userData->first_name != "" || $userData->last_name != "" )
	echo "<hr />Tracked By: <strong>".$userData->first_name . " ".$userData->last_name."</strong><br />";
}
?>
</ul>
