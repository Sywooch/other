<?xml version="1.0"?>

<!--
##################################################
##################################################

Easybasket Skin
===============
Title:		Teeny
Author:	Nigel Alderton
Date:		2011-03-15
-->

<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:output method="xml" omit-xml-declaration="yes"/>

<!--	###########################################
	ROOT TEMPLATE
	###########################################	-->
    <xsl:template match="items">
		<span class="tab">
			<span class="total">&#163;<xsl:value-of select="format-number(@total, '###,##0.00')"/></span>
			<span class="quantity"><xsl:value-of select="@quantity"/></span>
		</span>
	</xsl:template>	

</xsl:transform>