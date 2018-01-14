$(document).ready( function() {
    $("#mbir, #fbir").datepicker({
        dateFormat:"dd.mm.yy",
        firstDay: 1,
        dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
        monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октярь','Ноябрь','Декабрь'],
        onClose: function(str,obj) {
            if (str.indexOf('.') == -1) {
                var st = str.substr(0, 2) + "." + str.substr(2, 2) + "." + str.substr(4)
                $(this).datepicker("setDate", st)
            }
        } 
    }); 
   /* 
    $("#mfam").autocomplete({
        minLenght: 2,
        source: '/json/helpers/cuple/',
        response: function(event, ui) {
            if (ui.content.length == 0) {
                clean_form(1);
            }
        },
        select: function(event, ui) {
            if (ui.item.male) {
                $("#mfam").val(ui.item.male.fam);
                $("#mnam").val(ui.item.male.name);
                $("#mbir").val(ui.item.male.birth);
                $("#dancer1").attr("title", ui.item.male.id);
                if (ui.item.male.klass.st) {$("#mkst").val(ui.item.male.klass.st.id);}
                if (ui.item.male.klass.la) {$("#mkla").val(ui.item.male.klass.la.id);}
                if (ui.item.male.klass.mn) {$("#mkmn").val(ui.item.male.klass.mn.id);}
                if (ui.item.male.razr.st) {$("#mrst").val(ui.item.male.razr.st.id);}
                if (ui.item.male.razr.la) {$("#mrla").val(ui.item.male.razr.la.id);}
                if (ui.item.male.razr.mn) {$("#mrmn").val(ui.item.male.razr.mn.id);}
                $("#ffam").val(ui.item.female.fam);
                $("#fnam").val(ui.item.female.name);
                $("#fbir").val(ui.item.female.birth);
                $("#dancer2").attr("title", ui.item.female.id);
                if (ui.item.female.klass.st) {$("#fkst").val(ui.item.female.klass.st.id);}
                if (ui.item.female.klass.la) {$("#fkla").val(ui.item.female.klass.la.id);}
                if (ui.item.female.klass.mn) {$("#fkmn").val(ui.item.female.klass.mn.id);}
                if (ui.item.female.razr.st) {$("#frst").val(ui.item.female.razr.st.id);}
                if (ui.item.female.razr.la) {$("#frla").val(ui.item.female.razr.la.id);}
                if (ui.item.female.razr.mn) {$("#frmn").val(ui.item.female.razr.mn.id);}
                if (ui.item.stk1) {
                    $("#stk1").val(ui.item.stk1.name);
                    $("#city1").val(ui.item.stk1.city.name);
                    $("#country1").val(ui.item.stk1.city.country.name);
                    $("#idstk1").attr("title",ui.item.stk1.id);
                    $("#idcity1").attr("title",ui.item.stk1.city.id);
                    $("#idcountry1").attr("title",ui.item.stk1.city.country.id);
                }
                else {
                    $("#stk1").val('');
                    $("#city1").val('');
                    $("#country1").val('');
                    $("#idstk1").attr("title",0);
                    $("#idcity1").attr("title",0);
                    $("#idcountry1").attr("title",0);
                }
                if (ui.item.stk2) {
                    $("#stk2").val(ui.item.stk2.name);
                    $("#city2").val(ui.item.stk2.city.name);
                    $("#country2").val(ui.item.stk2.city.country.name);
                    $("#idstk2").attr("title",ui.item.stk1.id);
                    $("#idcity2").attr("title",ui.item.stk1.city.id);
                    $("#idcountry2").attr("title",ui.item.stk1.city.country.id);
                }
                else {
                    $("#stk2").val('');
                    $("#city2").val('');
                    $("#country2").val('');
                    $("#idstk2").attr("title",0);
                    $("#idcity2").attr("title",0);
                    $("#idcountry2").attr("title",0);
                }
                if (ui.item.coaches.st) {
                    $("#coach1").val(ui.item.coaches.st[0]);
                    $("#coach2").val(ui.item.coaches.st[1]);
                }
                if (ui.item.coaches.la) {
                    $("#coach3").val(ui.item.coaches.la[0]);
                    $("#coach4").val(ui.item.coaches.la[1]);
                }
            }
            else {
                $("#mfam").val(ui.item.fam);
                $("#mnam").val(ui.item.name);
                $("#mbir").val(ui.item.birth);
                if (ui.item.klass.st) {$("#mkst").val(ui.item.klass.st.id);}
                if (ui.item.klass.la) {$("#mkla").val(ui.item.klass.la.id);}
                if (ui.item.klass.mn) {$("#mkmn").val(ui.item.klass.mn.id);}
                if (ui.item.razr.st) {$("#mrst").val(ui.item.razr.st.id);}
                if (ui.item.razr.la) {$("#mrla").val(ui.item.razr.la.id);}
                if (ui.item.razr.mn) {$("#mrmn").val(ui.item.razr.mn.id);}
            }
            return false;
        }
    });
    */
    /*$("#mnam").autocomplete({
        minLenght: 2,
        source: '/json/helpers/names/1/'
    });
    
    $("#ffam").autocomplete({
        minLenght: 2,
        source: '/json/helpers/dancer/2/',
        select: function(event, ui) {
            $("#ffam").val(ui.item.fam);
            $("#fnam").val(ui.item.name);
            $("#fbir").val(ui.item.birth);
            $("#dancer2").attr("title", ui.item.id);
            if (ui.item.klass.st) {$("#fkst").val(ui.item.klass.st.id);}
            if (ui.item.klass.la) {$("#fkla").val(ui.item.klass.la.id);}
            if (ui.item.klass.mn) {$("#fkmn").val(ui.item.klass.mn.id);}
            if (ui.item.razr.st) {$("#frst").val(ui.item.razr.st.id);}
            if (ui.item.razr.la) {$("#frla").val(ui.item.razr.la.id);}
            if (ui.item.razr.mn) {$("#frmn").val(ui.item.razr.mn.id);}
            return false;
        }
    });

    $("#fnam").autocomplete({
        minLenght: 2,
        source: '/json/helpers/names/2/'
    });
    
    $("#stk1, #stk2").autocomplete({
        minLenght: 2,
        source: '/json/helpers/club/',
        select: function(event, ui) {
            var prefix = $(this).attr('id').substr(3, 1);
            $("#stk" + prefix).val(ui.item.name);
            $("#city" + prefix).val(ui.item.city.name);
            $("#country" + prefix).val(ui.item.city.country.name);
            return false;
        }
    });
    
    $("#city1, #city2").autocomplete({
        minLenght: 2,
        source: '/json/helpers/city/',
        select: function(event, ui) {
            var perfix = $(this).attr('id').substr(4, 1)
            $("#city" + perfix).val(ui.item.name);
            $("#country" + perfix).val(ui.item.country.name);
            return false;
        }
    });
    
    $("#country1, #country2").autocomplete({
        minLenght: 2,
        source: '/json/helpers/country/'
    });
    
    $("input[name*='coach']").autocomplete({
        minLenght: 2,
        source: '/json/helpers/coach/'
    });*/
    
    $("#curgroup").change(function(){
        var dat = $("#grprog" + $(this).val()).val();
        $("#st").css('display', prog_visible('St', dat));
        $("#la").css('display', prog_visible('La', dat));
        $("#stla").css('display', prog_visible('StLa', dat));
        $("#mn").css('display', prog_visible('Mn', dat));
        refresh_stat();
        refresh_reglist();
    });
    
    $("#st, #la, #stla, #mn").click( function() { 
        if (check_full()) send_form(this); 
        return false; 
    });
    $("#curgroup").change();
    $("#download").click(function() {
        $.get('/registration/json/download/', function(data) { alert('Успешно завершено'); }, 'json');
    });
    
    $("#finishpred").click(function() {
        $.get('/registration/json/finishpred/', function(data) { alert('Успешно завершено'); }, 'json');
    });
    
    $("#predv").click(function() { 
        if ($("#predv").prop('checked')) $("#predvb").addClass("predvar"); else $("#predvb").removeClass("predvar");
    });
    
    $("#editinfo a").click(function() {
        $("#cupleid").val('0');
        $(".editmode").removeClass("editmode");
    });
    
    $("#newcuple").click(function() {
        clean_form(1);
        $("#number").val('').focus();
        return false;
    });
    
    $("#dancer1, #dancer2").click(function(e) {
        var id = $(this).attr("title");
        $.get('/json/dancerinfo/'+id+'/', function(data){//1006
            if (data.status) {
                $("#dancerinfo").html("");
                $("<h1>").text(data.data.label).appendTo("#dancerinfo");
                var ul = $("<ul/>");
                $.each(data.data.lst, function(idx, el) {
                    $("<li/>", {"class" : el.type}).text(el.date+" "+el.val).appendTo(ul);
                });
                ul.appendTo("#dancerinfo");
            }
            else {
                $("#dancerinfo").html("");
                $("<div>", {"class" : "error"}).text(data.message).appendTo("#dancerinfo");
            }
        }, 'json');
        $("#dancerinfo").dialog("open");
        e.preventDefault();
    });
    
    $("#dancerinfo").dialog({
        autoOpen: false,
        width:1200,
        height:700
    });
	
	
	
	
	
	
	
	
	



	
	
	
	
	
	
});

function prog_visible(prog, data) {
    var idx = -1;
    var val = '0';
    if (prog == 'St') idx = 0;
    if (prog == 'La') idx = 1;
    if (prog == 'Mn') idx = 2;
    if (prog == 'StLa' ) {
        var v1 = data.substr(0,1);
        var v2 = data.substr(1,1);
        data += (v1 == '1' && v2 == '1') ? '1' : '0';
        idx = 3;
    }
    val = data.substr(idx, 1);
    return (val == '1') ? 'inline-block' : 'none';
}
function clean_form(mode) {
    if (mode == 0 ) $("#mfam").val('');
    $("#dancer1").attr("title", 0);
    $("#dancer1").attr("title", 0);
    $("#mnam").val('');
    $("#mbir").val('');
    $("#mkst").val(0);
    $("#mkla").val(0);
    $("#mkmn").val(0);
    $("#mrst").val(0);
    $("#mrla").val(0);
    $("#mrmn").val(0);
    $("#ffam").val('');
    $("#fnam").val('');
    $("#fbir").val('');
    $("#fkst").val(0);
    $("#fkla").val(0);
    $("#fkmn").val(0);
    $("#frst").val(0);
    $("#frla").val(0);
    $("#frmn").val(0);
    $("#stk1").val('');
    $("#city1").val('');
    $("#country1").val('');
    $("#stk2").val('');
    $("#city2").val('');
    $("#country2").val('');
    $("#coach1").val('');
    $("#coach2").val('');
    $("#coach3").val('');
    $("#coach4").val('');
    $("#cupleid").val('0');
}

function refresh_stat() {
    $.get('/registration/json/stat/', function(data) {
        $("#stat").html(data);
        $(".daywrapper h6").click(function(){
            $(this).next().toggleClass('visible');
        });
        $("#refreshstat").on('click', refresh_stat);
    });
}

function refresh_reglist() {
    $.get('/registration/json/reglist/' + $("#curgroup").val() + '/', function(data) { 
        $("#list").html(data);
        $("#list .getcuple").on('click', getcuple);
        $("#refreshreglist").on('click', refresh_reglist);
        $("a.sdelete").click(function(){ 
            if (window.confirm('Вы действительно хотите удалить этот элемент')) {
                $.get($(this).attr('href'), function(data) {
                    if (!data.status) alert(data.message);
                    refresh_reglist();
                    refresh_stat();
                }, 'json');
            }
            return false;
        });
        $("a.toggle").click(function(){
            $.get($(this).attr('href'), function(data) {
                if (!data.status) alert(data.message);
                refresh_reglist();
                refresh_stat();
            }, 'json');
            return false;
        });
    });
}

function getcuple(sender) {
    $.get($(sender.currentTarget).attr('href'), function(data) {
        if (data.status) {
            var inf = data.data;
            $("#number").val(inf.num);
            $("#dancer1").attr("title", inf.man.id);
            $("#dancer2").attr("title", inf.lady.id);
            $("#mfam").val(inf.man.fam);
            $("#mnam").val(inf.man.name);
            $("#mbir").val(inf.man.birth);
            $("#mkst").val(inf.man.klass.st.id);
            $("#mkla").val(inf.man.klass.la.id);
            $("#mkmn").val(inf.man.klass.mn.id);
            $("#mrst").val(inf.man.razr.st.id);
            $("#mrla").val(inf.man.razr.la.id);
            $("#mrmn").val(inf.man.razr.mn.id);
            $("#ffam").val(inf.lady.fam);
            $("#fnam").val(inf.lady.name);
            $("#fbir").val(inf.lady.birth);
            $("#fkst").val(inf.lady.klass.st.id);
            $("#fkla").val(inf.lady.klass.la.id);
            $("#fkmn").val(inf.lady.klass.mn.id);
            $("#frst").val(inf.lady.razr.st.id);
            $("#frla").val(inf.lady.razr.la.id);
            $("#frmn").val(inf.lady.razr.mn.id);
            $("#stk1").val(inf.stk1.name);
            $("#city1").val(inf.stk1.city.name);
            $("#country1").val(inf.stk1.city.country.name);
            $("#stk2").val(inf.stk2.name);
            $("#city2").val(inf.stk2.city.name);
            $("#country2").val(inf.stk2.city.country.name);
            $("#coach1").val(inf.coaches[0].name);
            $("#coach2").val(inf.coaches[1].name);
            $("#coach3").val(inf.coaches[2].name);
            $("#coach4").val(inf.coaches[3].name);
            $("#cupleid").val(inf.cupleid);
            $(".editmode").removeClass("editmode");
            $(sender.currentTarget).parent().parent().addClass("editmode");
            $("#editinfo").addClass("editmode");
        }
    }, 'json');
    return false;
}

function clearerrors() {
    $(".error").removeClass('error');
    $(".errortext").removeClass('errortext');
    var el = "enumber,emfam,emnam,embir,effam,efnam,efbir,estk1,estk2,ecity1,ecity2,ecountry1,ecountry2,ecoach1,ecoach2,ecoach3,ecoach4,emkst,emkla,emkmn,emrst,emrla,emrmn,efkst,efkla,efkmn,efrst,efrla,efrmn,etotal".split(',');
    for(var i = 0; i < el.length; i++ ) {
        $("#" + el[i]).text('');
    }
    $("#confirmb").css("display", "none");
}

function check_full () {
    //Проверяем полность данных перед отправкой заодно и валидность части элементов (типа даты)
    clearerrors();
    //Номер
    var num = $("#number").val();
    if (!parseInt(num)) add_error("number", "Неправильный номер");
    var str = $("#mfam").val();
    if (!$.trim(str)) add_error("mfam", "Заполнить!");
    str = $("#mnam").val();
    if (!$.trim(str)) add_error("mnam", "Заполнить!");
    str = $("#ffam").val();
    if (!$.trim(str)) add_error("ffam", "Заполнить!");
    str = $("#fnam").val();
    if (!$.trim(str)) add_error("fnam", "Заполнить!");
    var date = $("#mbir").val();
    if (!date.toDate()) add_error("mbir", "Неверно!");
    date = $("#fbir").val();
    if (!date.toDate()) add_error("fbir", "Неверно!");
    var stk1 = $.trim($("#stk1").val());
    var stk2 = $.trim($("#stk2").val());
    var city1 = $.trim($("#city1").val());
    var city2 = $.trim($("#city2").val());
    var country1 = $.trim($("#country1").val());
    var country2 = $.trim($("#country2").val());
    if (!stk1) add_error("stk1", "Заполнить!");
    if (stk1) {
        if (!city1) add_error("city1", "Заполнить!");
        if (!country1) add_error("country1", "Заполнить!");
    }
    if (stk2) {
        if (!city2) add_error("city2", "Заполнить!");
        if (!country2) add_error("country2", "Заполнить!");
    }
    return $(".error").length == 0;
}

function add_error(element, text) {
    $("#e" + element).append(text);
    $("#e" + element).addClass("errortext");
    $("#" + element).addClass("error");
}

function send_form(sender) {
    var formdata = {
        number : $("#number").val(),
        program : sender.id,
        group : $("#curgroup").val(),
        male : {
            fam : $("#mfam").val(),
            nam : $("#mnam").val(),
            bir : $("#mbir").val(),
            kst : $("#mkst").val(),
            kla : $("#mkla").val(),
            kmn : $("#mkmn").val(),
            rst : $("#mrst").val(),
            rla : $("#mrla").val(),
            rmn : $("#mrmn").val()
        },
        female : {
            fam : $("#ffam").val(),
            nam : $("#fnam").val(),
            bir : $("#fbir").val(),
            kst : $("#fkst").val(),
            kla : $("#fkla").val(),
            kmn : $("#fkmn").val(),
            rst : $("#frst").val(),
            rla : $("#frla").val(),
            rmn : $("#frmn").val()
        },
        stk1 : {
            name : $("#stk1").val(),
            city : $("#city1").val(),
            country : $("#country1").val()
        },
        stk2 : {
            name : $("#stk2").val(),
            city : $("#city2").val(),
            country : $("#country2").val()
        },
        coaches : [$("#coach1").val(), $("#coach2").val(), $("#coach3").val(), $("#coach4").val()],
        force : $("#confirm").prop('checked'),
        cupleid : $("#cupleid").val(),
        predv : $("#predv").prop('checked')
    }
    $.ajax( {
        type : 'POST',
        url : "/registration/json/sendcuple/",
        dataType : 'json',
        data : { csrfmiddlewaretoken : $('input[name=csrfmiddlewaretoken]').val(), data : $.toJSON(formdata) },
        success : function (data) {
            if (!data.status) {
                for (i = 0; i < data.error.fields.length; i++) 
                    add_error(data.error.fields[i], data.error.message[i]);
                $("#confirmb").css("display", "inline");
                $("#confirmb").addClass("errortext");
                $("#confirm").prop('checked', false);
            }
            else {
                $("#confirm").prop('checked', false);
                refresh_stat();
                clearerrors();
                refresh_reglist();
                clean_form(0);
                $("#number").val(parseInt($("#number").val()) + 1).focus().select();
                $(".editmode").removeClass("editmode");
            }
        }
    });
    return false
}

