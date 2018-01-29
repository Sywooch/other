$(function(){
    $('body').append('<img style="display: none;" src="/lib/users_visits_info/user_visit.php?' +
        'action=' + action +
        '&referrer='+encodeURI(document.URL)+'" />');
});