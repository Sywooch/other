
EasySocial.require()
.library( 'sparkline' )
.done(function($)
{
	$( '[data-category-gravity-chart]' ).sparkline( 'html',
		{ 
			width				: '100%',
			height				: '120px',
			lineWidth			: 3,
			lineColor 			: "#4a8fcf",
			fillColor			: "#d8e8f7",
			highlightLineColor	: "#4a8fcf",
			maxSpotColor		: "#D44950",
			minSpotColor		: "#D44950",
			highlightSpotColor	: "#D44950",
			spotRadius			: 4,
			chartRangeMin 		: 0,
			drawNormalOnTop		: true,
			tooltipFormatter : function( sparkline , options, field )
			{
				return '<span style="color: ' + field.color + '">&#9679;</span> <strong>' + field.y + '</strong> <?php echo JText::_( 'COM_EASYSOCIAL_GROUPS_GROUP_CREATED' ); ?>';
			}
		});
});