//var jQ = jQuery.noConflict();

function delconfirm2(id, text)
{
    jQ('#popupc22').show();
    jQ('#tovname22').html(text);
    jQ('#confirmb22').click(function(){
        jQ('#popupc22').hide();
        jQ('.float_basket').html('');
        jQ('.float_basket').hide();
        location.href='/del_float_basket/?id='+id;
        /*
        jQ.ajax({url: "/del_float_basket/?id="+id,
            success: function(data) {
                alert(data);
            }
        });
        */
    });
};

jQ(document).ready(function()
{
 jQ('.basket_but').after('<div class="float_basket"></div>');
 jQ('.basket_but').after('<div style="position:fixed;top:0px;left:0px;width:100%;height:100%;display:none;z-index:10000" id="popupc22"><table width="100%" height="100%"><tr height="100%" style="vertical-align:middle;"><td style="vertical-align:middle;margin-left:auto;margin-right:auto;"><center>  <div style="width:400px;-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;border:4px solid #0d621e;background-color:#d6e8da;padding:20px">    <center>    <br>    <h2>Вы действительно желаете удалить "<span id="tovname22"></span>" из корзины?</h2><br>    <img onclick="jQ(\'#popupc22\').hide();jQ(\'.float_basket\').hide();" src="/img/buttonCancel.gif" style="cursor:pointer">    &nbsp;&nbsp;&nbsp;    <img onclick="" src="/img/deleteButton.gif" style="cursor:pointer" id="confirmb22">    </center>    <br clear="all">  </div></center></table></div>');
 jQ('.basket_but').mouseenter(function()
 {
  if (!jQ('.float_basket')) return;
  if(document.all)
  {
      jQ('.float_basket').show();
      jQ('.float_basket').css('margin-top', '30px');
  } else {
    if (jQ('.float_basket').css('display') != 'block')
    {
      jQ('.float_basket').animate({height: 'toggle', display: 'block' }, 200, function() {});
    }
  }
  if (jQ('.float_basket').html() == '')
  {
    jQ('.float_basket').html('<center><img src="/i/ajax-loader-transparent.gif"></center>');
    jQ.ajax({
        url: "/get_float_basket",
        success: function(data) {
            if (data != -1)
            {
                jQ('.float_basket').html(data);
            } else {
                jQ('.float_basket').remove();
            }
        }
    });
  };
 });
 jQ('.float_basket').mouseleave(function()
 {
    if(document.all)
    {
        jQ('.float_basket').hide();
    } else {
        setTimeout("if (jQ('#popupc22').css('display') != 'block') jQ('.float_basket').animate({height: 'toggle', display: 'none' }, 200, function() {});", 50);
    }
 });

 jQ('.block_1').each(function() {
        jQ(this).qtip({
            content: {
                text:  jQ(this).next('.textComment')
            },
            show: 'mouseover',solo: true,
        position: {
                target: false,
                adjust: { mouse: false, screen: false, resize: true },
                corner: {target: 'leftTop', tooltip: 'bottomRight'},
                adjust: {
                 y: 15 }
            },
            tip: true,
            style: {
                width: 240,
              padding: 0,
                margin: 0,
                name: 'light'
            },
            hide: {when: 'mouseout', fixed: true}
        });
    });
  jQ('.block_3').each(function() {
        jQ(this).qtip({
            content: {
                text:  jQ(this).next('.textComment')
            },
            show: 'mouseover',solo: true,
        position: {
                target: false,
                adjust: { mouse: false, screen: false, resize: true },
                corner: {target: 'leftTop', tooltip: 'bottomRight'},
                adjust: {
                 y: 15 }
            },
            tip: true,
            style: {
                width: 240,
              padding: 0,
                margin: 0,
                name: 'light'
            },
            hide: {when: 'mouseout', fixed: true}
        });
    });
      jQ('.block_2').each(function() {
        jQ(this).qtip({
            content: {
                text:  jQ(this).next('.textComment')
            },
            show: 'mouseover',solo: true,
        position: {
                target: false,
                adjust: { mouse: false, screen: false, resize: true },
                corner: {target: 'leftTop', tooltip: 'bottomRight'},
        adjust: {
                 y: 35 }
            },
            tip: true,
            style: {
                width: 240,
              padding: 0,
                margin: 0,
                name: 'light'
            },
            hide: {when: 'mouseout', fixed: true}
        });
    });
jQ(".secondMenu").css("display","none");
jQ(".downMenu").hover(
    function () {
       jQ(this).next("div").animate({opacity: "show"}, "60");
     jQ(this).addClass("menuHover");
    },
    function () {
  var   link = jQ(this);
   jQ(this).next("div").hover(
      function () {
         jQ(this).css("display","block");
         link.addClass("menuHover");
        },
      function () {
        jQ(this).css("display","none");
          link.removeClass("menuHover");
        }
      );
    jQ(this).next("div").css("display","none");
  jQ(this).removeClass("menuHover");
  });

  jQ(".showDetail").click(function() {
      if(jQ(this).hasClass("closeQ")) {
      jQ(this).addClass("openQ").removeClass("closeQ");
      jQ(this).next().hide();
  } 
  else   
    if(jQ(this).hasClass("openQ")) {
        jQ(this).addClass("closeQ").removeClass("openQ"); 
        jQ(this).next().show();
  };
  return false;
});

jQ(".niceCheck").mousedown(
function() {
     changeCheck(jQ(this));
});

jQ(".niceCheck").each(
function() {
    changeCheckStart(jQ(this));
});

function changeCheck(el)
{
 var el = el,
     input = el.find("input").eq(0);
 el.css("background-position", "0 0");
 input.attr("checked", true);
 el.parent(".variantOrder").addClass("selectRadio");

 if(el.hasClass("firstCheck")) {
     jQ('#oShopName').hide();
     var el_2 = jQ(".secondCheck"),
         input_2 = el_2.find("input").eq(0);
     el_2.css("background-position", "0 -26px");
     input_2.attr("checked", false);
     el_2.parent(".variantOrder").removeClass("selectRadio");
 }
 else {
     jQ('#oShopName').show();
     var el_2 = jQ(".firstCheck"),
         input_2 = el_2.find("input").eq(0);
     el_2.css("background-position","0 -26px");
     input_2.attr("checked", false);
     el_2.parent(".variantOrder").removeClass("selectRadio");
 };
 return true;
}

function changeCheckStart(el) {
 var el = el,
     input = el.find("input").eq(0);
    if(input.attr("checked")) {
        el.css("background-position", "0 0");
        el.parent(".variantOrder").addClass("selectRadio");
    }
    else {
        el.parent(".variantOrder").removeClass("selectRadio");
        el.css("background-position", "0 -26px");
    };
 return true;
};
 });

// простой чек на валидность введенной суммы
function checkPrice(a)
{
 var reg = /^\d+[\.\,]?\d{0,2}$/; 
 if(a.length && !reg.test(a)) return false;
 return true; 
};
//проверка на число
function checkInt(a)
{
 var reg = /^\d+$/; 
 if(a.length && !reg.test(a)) return false;
 return true; 
};

// пересчет в другую валюту
// b - сумма в исходной валюте (здесь - юань), 
// c - собственно курс
function _countCurrency(b, c)
{
 var tmp = 0;
 if(c) {
     tmp = b /c;
     tmp = tmp > 0 ? number_format(tmp) : 0;
 };
 return tmp;
};

/*
before — произвольные символы, которые будут вставлены перед числом (по-умолчание ничего)
after — произвольные символы, которые будут вставлены после числа (по-умолчание ничего)
decimals — число символов после запятой (точки :) (по-умолчанию 2)
dec_point — разделитель между целой и дробной частями числа (по-умолчанию «.»)
thousands_sep — разделитель тысяч в целой части числа (по-умолчанию « »)
*/
function number_format(_number, _cfg){
  function obj_merge(obj_first, obj_second){
    var obj_return = {};
    for (key in obj_first){
      if (typeof obj_second[key] !== 'undefined') obj_return[key] = obj_second[key];
      else obj_return[key] = obj_first[key];
      }
    return obj_return;
  }
  function thousands_sep(_num, _sep){
    if (_num.length <= 3) return _num;
    var _count = _num.length;
    var _num_parser = '';
    var _count_digits = 0;
    for (var _p = (_count - 1); _p >= 0; _p--){
      var _num_digit = _num.substr(_p, 1);
      if (_count_digits % 3 == 0 && _count_digits != 0 && !isNaN(parseFloat(_num_digit))) _num_parser = _sep + _num_parser;
      _num_parser = _num_digit + _num_parser;
      _count_digits++;
      }
    return _num_parser;
  }
  if (typeof _number !== 'number'){
    _number = parseFloat(_number);
    if (isNaN(_number)) return false;
  }
  var _cfg_default = {before: '', after: '', decimals: 2, dec_point: '.', thousands_sep: ' '};
  if (_cfg && typeof _cfg === 'object'){
    _cfg = obj_merge(_cfg_default, _cfg);
  }
  else _cfg = _cfg_default;
  _number = _number.toFixed(_cfg.decimals);
  if(_number.indexOf('.') != -1){
    var _number_arr = _number.split('.');
    var _number = 0;
    // убрать нули  и разделитель если они не нужны
    if(parseInt(_number_arr[1]) > 0) {
       _number = thousands_sep(_number_arr[0], _cfg.thousands_sep) + _cfg.dec_point + _number_arr[1];
    }
    else {
        _number = thousands_sep(_number_arr[0], _cfg.thousands_sep)
    };   
  }
  else var _number = thousands_sep(_number, _cfg.thousands_sep);
  return _cfg.before + _number + _cfg.after;
};