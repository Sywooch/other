var TopmenuView = Backbone.View.extend({
    "el": ".topmenu",
    "events": {
        "click .ot_globall_settings .cacheClean": "cacheClean"
    },
    cacheClean: function(ev){
        $.post('index.php?cmd=CacheSettings&do=cacheClean',
            {},
            function (data){
                if (! data.error) {
                    showMessage(data.message);
                } else {
                    showError(data.message);
                }
            }, 'json'
        );
    }
});

$(function(){
    var Topmenu = new TopmenuView();
});
