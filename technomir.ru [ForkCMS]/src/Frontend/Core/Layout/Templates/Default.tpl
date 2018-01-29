{include:Core/Layout/Templates/Head.tpl}

<body class="{$LANGUAGE} horizontal-layout" itemscope itemtype="http://schema.org/WebPage">
	{include:Core/Layout/Templates/Cookies.tpl}
<header>
	<div id="logo">
		<a href="/" title="Мир технологий - мир ваших идей"><span><img src="/images/technomir.png" /></span></a></div>
</header>
	<div id="container">
	
	{* Main position *}
		{iteration:positionMain}
			{option:positionMain.blockIsHTML}
				{$positionMain.blockContent}
				{/option:positionMain.blockIsHTML}
				{option:!positionMain.blockIsHTML}
					{$positionMain.blockContent}
				{/option:!positionMain.blockIsHTML}
			{/iteration:positionMain}
	

		<footer>
			{include:Core/Layout/Templates/Footer.tpl}
		</footer>
	</div>


	{* Site wide HTML *}
	{$siteHTMLFooter}
</body>
</html>
