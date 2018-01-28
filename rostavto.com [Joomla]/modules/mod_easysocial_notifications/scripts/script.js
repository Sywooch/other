EasySocial.module("notifications/popbox", function($){

	this.resolve(function(popbox)
	{

		return {
			content: EasySocial.ajax( "site/controllers/notifications/getSystemItems",
			{
				layout	: "popbox.notifications"
			}),
			id: "fd",
			component: "es",
			type: "notifications",
			position: "bottom"
		};
	});
});

EasySocial.module("conversations/popbox", function($){

	this.resolve(function(popbox)
	{
		return {
			content: EasySocial.ajax( "site/controllers/notifications/getConversationItems",
			{
				layout	: "popbox.conversations"
			}),
			id: "fd",
			component: "es",
			type: "notifications",
			position: "bottom"
		};
	});
});

EasySocial.module("friends/popbox", function($){

	this.resolve(function(popbox){

		return {
			content: EasySocial.ajax( "site/controllers/notifications/friendsRequests",
			{
				layout	: "popbox.friends"
			}),
			id: "fd",
			component: "es",
			type: "notifications",
			position: "bottom"
		};
	});
});
