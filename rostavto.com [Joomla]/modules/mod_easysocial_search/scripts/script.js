
EasySocial
.require()
.script( 'site/search/toolbar' )
.done(function($){


	$( '[data-mod-search]' ).implement( EasySocial.Controller.Search.Toolbar );

	// $( '[data-mod-search]' ).implement(
	// 	EasySocial.Controller.Mod.Search,
	// 	{
	// 		// Properties
	// 		items		: null,

	// 		// Elements
	// 		"{searchInput}"		: "[data-nav-search-input]",
	// 		"{seachDropdown}"	: "[data-nav-search-dropdown]",
	// 		"{searchResult}"	: "li.navSearchItem",

	// 		view :
	// 		{
	// 			loadingContent 	: "site/loading/small"
	// 		}
	// 		// Override options here.
	// 	}, function( self ){
	// 		return {

	// 			init : function() {

	// 				// $(document).on("click.toolbar.search", function(event){

	// 				// 	var target = event.target;

	// 				// 	if (target==self.element[0] ||
	// 				// 		$(target).parents(self.element.data("directSelector")).length > 0) {
	// 				// 		return;
	// 				// 	}

	// 				// 	self.seachDropdown().hide();
	// 				// });

	// 				console.log( 'hello this is a mod search');
	// 			}

	// 		}
	// });

});
