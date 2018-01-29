var Newsletters = Backbone.View.extend({
    "el": "#content",
    "events": {
        "click .remove-newsletter": "removeNewsletter",
        "change #per-page": "setPerPage"
    },
    render: function() {
        this.$('#per-page').val(this.$('#per-page').attr('data-value'));
    },
    removeNewsletter: function(ev) {
        var url = $(ev.target).attr('href');
        modalDialog('Подтверждение', 'Вы действительно хотите удалить рассылку?', function () {
            window.location.href = url;
        });
        return false;
    },
    setPerPage: function(ev) {
        window.location.href = $(ev.target).attr('data-url') + '&perPage=' + $(ev.target).val();
    }
});

$(function(){
    var N = new Newsletters();
    N.render();
});