<xsl:transform version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:exsl="http://exslt.org/common"
  extension-element-prefixes="exsl">	
  
    <xsl:variable name="folder" select="'../wp-content/plugins/easy_wp_install/easybasket/'"/>
	
	<xsl:template match="root">
		<div class="wrap">
			
			<form method="post" action="">
				<xsl:apply-templates/>
				<input type="submit" class="submit" value="Save settings" style="padding:0.5em;" />
			</form>
		</div>
	</xsl:template>
	
	<xsl:template match="paypal">
		<div id="paypal">
			<xsl:variable name="currency-code">
				<cc>USD</cc><cc>AUD</cc><cc>CAD</cc><cc>CHF</cc><cc>CZK</cc><cc>DKK</cc><cc>EUR</cc>
				<cc>HKD</cc><cc>HUF</cc><cc>ILS</cc><cc>JPY</cc><cc>MXN</cc><cc>NOK</cc><cc>NZD</cc>
				<cc>PLN</cc><cc>SEK</cc><cc>SGD</cc><cc>GBP</cc>
			</xsl:variable>
			<fieldset id="fieldset">
				<legend><a href="https://www.paypal.com" alt="Paypal"><img style="padding:0.8em;" src="{$folder}welcome/pp.png"/></a></legend>
				<table>
					<tr>
						<td class="left" style="padding:0.2em;" width="180">Enable</td>
						<td class="middle" style="padding:0.2em;">
							<input type="checkbox" name="paypal-enable" value="checked">
								<xsl:if test="@enable = 'yes'">
									<xsl:attribute name="checked">checked</xsl:attribute>
								</xsl:if>
							</input>
						</td>
						<td class="help" style="padding:0.2em;">Enable Paypal Checkout.</td>
					</tr>
					<tr>
						<td class="left" style="padding:0.2em;">Sandbox</td>
						<td class="middle" style="padding:0.2em;">
							<input type="checkbox" name="paypal-sandbox" value="checked">
								<xsl:if test="@sandbox = 'yes'">
									<xsl:attribute name="checked">checked</xsl:attribute>
								</xsl:if>
							</input>
						</td>
						<td class="help" style="padding:0.2em;">Enable if you are using the Sandbox testing enviroment.</td>
					</tr>
					<tr>
						<td class="left" style="padding:0.2em;">Business Email</td>
						<td class="middle" style="padding:0.2em;"><input type="text" name="business" value="{business}" size="30"/></td>
						<td class="help" style="padding:0.2em;">Add your Paypal email address.</td>
					</tr>
					<tr>
						<td class="left" style="padding:0.2em;">Currency Code</td> 
						<td class="middle" style="padding:0.2em;">
							<select name="currency-code">
								<xsl:variable name="currency" select="currency-code"/>
								<xsl:for-each select="exsl:node-set($currency-code)/*">
									<option>
										<xsl:if test=". = $currency">
											<xsl:attribute name="selected">
												<xsl:value-of select="$currency"/>
											</xsl:attribute>
										</xsl:if>
										<xsl:value-of select="."/>
									</option>
								</xsl:for-each>
							</select>
						</td>
						<td class="help" style="padding:0.2em;">Select your Currency Code.</td>
					</tr>
					<tr>
						<td class="left" style="padding:0.2em;">Enable IPN</td>
						<td class="middle" style="padding:0.2em;">
							<input type="checkbox" name="ipn-enable" value="checked">
								<xsl:if test="@ipn = 'yes'">
									<xsl:attribute name="checked">checked</xsl:attribute>
								</xsl:if>
							</input>
						</td>
						<td class="help" style="padding:0.2em;">Enable Paypal Instant Payment Notification.</td>
					</tr>
					<tr>
						<td class="left" style="padding:0.2em;">IPN URL</td>
						<td class="middle" style="padding:0.2em;"><input type="text" name="ipn-url" value="{ipn-url}" size="30"/></td>
						<td class="help" style="padding:0.2em;">Add your Paypal IPN address, eg. http://www.abc.com/easybasket/</td>
					</tr>
				</table>
			</fieldset>
			<hr/>
		</div>
	</xsl:template>
	
	<xsl:template match="google">
		<xsl:variable name="currency-code">
			<cc>USD</cc><cc>GBP</cc>
		</xsl:variable>
		<fieldset>
			<legend><a href="http://checkout.google.com" alt="Google Checkout"><img style="padding:0.8em;" src="{$folder}welcome/gc.png"/></a></legend>
			<table>	
				<tr>
					<td class="left" style="padding:0.2em;" width="180">Enable</td>
					<td class="middle" style="padding:0.2em;">
						<input name="google-enable" value="checked" type="checkbox">
							<xsl:if test="@enable = 'yes'">
								<xsl:attribute name="checked">yes</xsl:attribute>
							</xsl:if>
						</input>
					</td>
					<td class="help" style="padding:0.2em;">Enable Google Checkout.</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">Sandbox</td>
					<td class="middle" style="padding:0.2em;">
						<input name="google-sandbox" value="checked" type="checkbox">
							<xsl:if test="@sandbox = 'yes'">
								<xsl:attribute name="checked">yes</xsl:attribute>
							</xsl:if>
						</input>
					</td>
					<td class="help" style="padding:0.2em;">Enable if you are using the Sandbox testing enviroment.</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">Merchant-ID</td> 
					<td class="middle" style="padding:0.2em;"><input type="text" name="merchant-id" value="{merchant-id}" size="30"/></td>
					<td class="help" style="padding:0.2em;">Add your Merchant ID.</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">Merchant-Key</td> 	
					<td class="middle" style="padding:0.2em;"><input type="text" name="merchant-key" value="{merchant-key}" size="30"/></td>
					<td class="help" style="padding:0.2em;">Add your Merchant Key.</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">Mail Method</td> 
					<td class="middle" style="padding:0.2em;"><input type="text" name="shipping-name" value="{shipping-name}" size="30"/></td>
					<td class="help" style="padding:0.2em;">Set your mail method (i.e Royal Mail, UPS).</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">Currency Code</td> 
					<td class="middle" style="padding:0.2em;">
						<select name="currency">
							<xsl:variable name="currency" select="currency"/>
							<xsl:for-each select="exsl:node-set($currency-code)/*">
								<option>
									<xsl:if test=". = $currency">
										<xsl:attribute name="selected">
											<xsl:value-of select="$currency"/>
										</xsl:attribute>
									</xsl:if>
									<xsl:value-of select="."/>
								</option>
							</xsl:for-each>
						</select>
					</td>
					<td class="help" style="padding:0.2em;">Select your Currency Code.</td>
				</tr>
			</table>
		</fieldset>
		<hr/>
	</xsl:template>

	<xsl:template match="form">
		<fieldset>
			<legend><h2>Form Names</h2></legend>
			<table>
				<tr>
					<td class="left" style="padding:0.2em;" width="180">ID</td> 	
					<td class="middle" style="padding:0.2em;"><input type="text" name="id" value="{maps/id}" size="30"/></td>
					<td class="help" colspan="2" style="padding:0.2em;">Map your alias here, or use the default value "id"</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">Title</td> 	
					<td class="middle" style="padding:0.2em;"><input type="text" name="title" value="{maps/title}" size="30"/></td>
					<td class="help" colspan="2" style="padding:0.2em;">Map your alias here, or use the default value "title"</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">Description</td> 	
					<td class="middle" style="padding:0.2em;"><input type="text" name="description" value="{maps/description}" size="30"/></td>
					<td class="help" colspan="2" style="padding:0.2em;">Map your alias here, or use the default value "description"</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">Price</td> 	
					<td class="middle" style="padding:0.2em;"><input type="text" name="price" value="{maps/price}" size="30"/></td>
					<td class="help" colspan="2" style="padding:0.2em;">Map your alias here, or use the default value "price"</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">Image</td> 	
					<td class="middle" style="padding:0.2em;"><input type="text" name="image" value="{maps/image}" size="30"/></td>
					<td class="help" colspan="2" style="padding:0.2em;">Map your alias here, or use the default value "image"</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">URL</td> 	
					<td class="middle" style="padding:0.2em;"><input type="text" name="url" value="{maps/url}" size="30"/></td>
					<td class="help" colspan="2" style="padding:0.2em;">Map your alias here, or use the default value "url"</td>
				</tr>
			</table>
		</fieldset>
		<hr/>
		<fieldset>
			<legend><img width="150px" height="80px" src="{$folder}welcome/postage.png"/></legend>
			<table>
				<tr>
					<td class="left" style="padding:0.2em;" width="180">Per Item Cost</td> 	
					<td class="middle" style="padding:0.2em;"><input type="text" name="per-item" value="{postage/per-item}" size="30"/></td>
					<td class="help" colspan="2" style="padding:0.2em;">Postage cost for each item added to basket.</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">First Item Cost</td> 	
					<td class="middle" style="padding:0.2em;"><input type="text" name="first-item" value="{postage/first-item}" size="30"/></td>
					<td class="help" colspan="2" style="padding:0.2em;">Postage cost for first item added to basket.</td>
				</tr>
				<tr>
					<td class="left" style="padding:0.2em;">Additional Items Cost</td> 
					<td class="middle" style="padding:0.2em;"><input type="text" name="extra-items" value="{postage/extra-items}" size="30"/></td>
					<td class="help" colspan="2" style="padding:0.2em;">Postage cost for each additional item added to basket.</td>
				</tr>
			</table>
		</fieldset>
		<hr/>
		<fieldset>
			<legend><h2>Options</h2></legend>
			<table id="optiontable" style="padding:0.2em;">
				<xsl:apply-templates select="options"/>	
			</table>
			<table id="add" style="padding:0.2em;">
				<tr><td class="left"></td><td class="middle">Add Option</td><td><img class="add-link" src="{$folder}welcome/plus.png" width="24" height="24"/></td></tr>
			</table>
		</fieldset>
		
	</xsl:template>

	<xsl:template match="option">
		<tr>
			<td class="left" style="padding:0.2em; text-transform:capitalize;" width="180"><xsl:value-of select="local-name()"/></td> 
			<td class="middle" style="padding:0.2em;">
				<input type="text" name="option" value="{.}" size="30"/>
			</td>
			<td style="padding:0.2em;">
				<img class="remove-link" src="{$folder}welcome/del.png" width="24" height="24"/>
			</td>
			<td></td>
		</tr>
	</xsl:template>
</xsl:transform>