<?php

/**
 * @package		Retina.Site
 * @subpackage	com_contact
 * 
 * 
 */
defined('_REXEC') or die;

/* marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<?php if (($this->params->get('address_check') > 0) &&  ($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
	<div class="contact-address">
	<?php if ($this->params->get('address_check') > 0) : ?>
		<span class="<?php echo $this->params->get('marker_class'); ?>" >
			<?php echo $this->params->get('marker_address'); ?>
		</span>
		<address>
	<?php endif; ?>
	<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
		<span class="contact-street">
			<?php echo nl2br($this->contact->address); ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
		<span class="contact-suburb">
			<?php echo $this->contact->suburb; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->state && $this->params->get('show_state')) : ?>
		<span class="contact-state">
			<?php echo $this->contact->state; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
		<span class="contact-postcode">
			<?php echo $this->contact->postcode; ?>
		</span>
	<?php endif; ?>
	<?php if ($this->contact->country && $this->params->get('show_country')) : ?>
		<span class="contact-country">
			<?php echo $this->contact->country; ?>
		</span>
	<?php endif; ?>
<?php endif; ?>

<?php if ($this->params->get('address_check') > 0) : ?>
	</address>
	</div>
<?php endif; ?>

<?php //if($this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') ) : ?>
	<div  class="contact-contactinfo" style="text-align:left !important;  width:670px !important;">
	<p ><span style="line-height: 1.3em;"><strong>Телефоны:</strong></span></p>
	<p ><span style="line-height: 1.3em;">Факс: (4162)770-870,</span></p>
	<p ><span style="line-height: 1.3em;">Руководитель Леоненко Руслан Иванович: 8-914-550-11-42,</span></p>
	<p ><span style="line-height: 1.3em;">Ведущий специалист Гулевич Елена: 8-914-564-69-29, (4162)770-870.</span></p>
	</br>
	<p ><span style="line-height: 1.3em;"><strong>E-mail:</strong> <a href="mailto:770870@str28.ru">770870@str28.ru</a></span></p>
	</br>
	<p ><span style="line-height: 1.3em;"><strong>Адрес офиса:</strong> г. Благовещенск, ул. Тенистая, 127, оф. 504,</span></p>
	<p ><span style="line-height: 1.3em;"><strong>Адрес погрузочной площадки:</strong> г. Благовещенск, ул. Мухина, 110А/2.</span></p>
	<!--
<?php //endif; ?>
<?php //if ($this->contact->email_to && $this->params->get('show_email')) : ?>
	<p>
		<span class="<?php //echo $this->params->get('marker_class'); ?>" >
			<?php //echo $this->params->get('marker_email'); ?>
		</span>
		<span class="contact-emailto">
			<?php //echo $this->contact->email_to; ?>
		</span>
	</p>
<?php //endif; ?>

<?php //if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
	<p>
		<span class="<?php //echo $this->params->get('marker_class'); ?>" >
			<?php// echo $this->params->get('marker_telephone'); ?>
		</span>
		<span class="contact-telephone">
			<?php //echo nl2br($this->contact->telephone); ?>
		</span>
	</p>
<?php// endif; ?>
<?php// if ($this->contact->fax && $this->params->get('show_fax')) : ?>
	<p>
		<span class="<?php// echo $this->params->get('marker_class'); ?>" >
			<?php //echo $this->params->get('marker_fax'); ?>
		</span>
		<span class="contact-fax">
		<?php// echo nl2br($this->contact->fax); ?>
		</span>
	</p>
<?php //endif; ?>
<?php //if ($this->contact->mobile && $this->params->get('show_mobile')) :?>
	<p>
		<span class="<?php// echo $this->params->get('marker_class'); ?>" >
			<?php// echo $this->params->get('marker_mobile'); ?>
		</span>
		<span class="contact-mobile">
			<?php// echo nl2br($this->contact->mobile); ?>
		</span>
	</p>
<?php //endif; ?>
<?php //if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
	<p>
		<span class="<?php //echo $this->params->get('marker_class'); ?>" >
		</span>
		<span class="contact-webpage">
			<a href="<?php// echo $this->contact->webpage; ?>" target="_blank">
			<?php //echo $this->contact->webpage; ?></a>
		</span>
	</p>
<?php //endif; ?>
<?php //if($this->params->get('show_email') || $this->params->get('show_telephone')||$this->params->get('show_fax')||$this->params->get('show_mobile')|| $this->params->get('show_webpage') ) : ?>
-->
	</div>
	<!--
<?php //endif; ?>-->
<div style="width:670px; height:20px; "></div>
<p></p>
<h1 style="color:#555 !important; font-size:1.1em !important; font-weight:bold !important; border-bottom:0px black solid; ">Карта</h1>
<!--блок с картой-->
<div id="myMapId" style="width:670px; height:500px; background-color:transparent; "></div>

<!--блок с картой-->
<div style="width:670px; height:20px; "></div>
<p></p>