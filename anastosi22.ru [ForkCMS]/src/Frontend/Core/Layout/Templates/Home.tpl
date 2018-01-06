{include:Core/Layout/Templates/Head.tpl}

<body class="{$LANGUAGE}" itemscope itemtype="http://schema.org/WebPage">

	{include:Core/Layout/Templates/Cookies.tpl}

<div id="container">
<section>
			{* Main position *}
			{iteration:positionMain}
				{option:positionMain.blockIsHTML}
					<section class="mod">
						<div class="inner">
							<div class="bd content">
								{$positionMain.blockContent}
							</div>
						</div>
					</section>
				{/option:positionMain.blockIsHTML}
				{option:!positionMain.blockIsHTML}
					{$positionMain.blockContent}
				{/option:!positionMain.blockIsHTML}
			{/iteration:positionMain}
</section>

		<footer>
			{include:Core/Layout/Templates/Footer.tpl}
		</footer>
	</div>
	{* General Javascript *}
	{iteration:jsFiles}
	<script src="{$jsFiles.file}"></script>
	{/iteration:jsFiles}
	{* Site wide HTML *}
	{$siteHTMLFooter}
</body>
</html>
