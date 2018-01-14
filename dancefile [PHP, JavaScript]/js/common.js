$(document).ready(function() {
    $("a.delete").click(function(){ return window.confirm('Вы действительно хотите удалить этот элемент'); });
});