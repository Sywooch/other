
    $(document).ready(function() {

        $('.sect13123').css('display','none');
        $('.toggle').css('display','none');
        $('.ul_active').css('display','block');
        calc();

        $('.click_toggle').each(function(i){//
            $(this).click(function(){
                $(this).toggleClass("click_toggle_active");
                $('.toggle').eq(i).slideToggle();
            });
        });

        /* 	$('.column input:radio').click(function(){//обработка радиобатонов
         $('.column input:radio').each(function(i){
         var checked = this.checked;
         $(this).parents('ul:first').children('.chk').eq(i).children('ul').css('display',checked ? 'block':'none');

         if (!checked){
         $('.sect13123').children('li').children('label').children(':checkbox').each(function(i){
         this.checked = false;
         });
         }

         });
         }); */

        //$('.section').parent('label').css('font-family','pt_sansbold');

        $('.section').click(function(){//обработка радиобатонов
            $(this).parents(".li_sect").toggleClass("toggle-active");
            $('.section').each(function(i){

                var checked = this.checked;
                $('.sect13123').eq(i).css('display',checked ? 'block':'none');

                if (!checked){
                    $('.sect13123').eq(i).children('li').children('label').children(':checkbox').each(function(i){
                        this.checked = false;
                    });
                }

            });
        });

        (function($) {$(function(){//переключение табов
            $('ul.tbs').on('click', 'li:not(.current)', function() {
                $(this).addClass('current').siblings().removeClass('current')
                    .parents('div.sect').find('div.bx').eq($(this).index()).fadeIn(150).addClass("visible").siblings('div.bx').hide().removeClass('visible');
            })
        })
        })(jQuery)

        //alert($('ul.tbs li').size());

        $('ul.tbs li').click(function(){
            if ($(this).index() == 0){
                $(this).addClass('first_tab');
            } else {
                $(this).siblings().first().removeClass('first_tab');
            }
        });


        function calc(){
            res = 0;
            summ = 0;
            name = ""; title = "";
            price = ""; sect=""; ssect = ""; totextarea="";
            $('div.visible input:checkbox:checked, div.visible input:radio:checked').each(function(){
                arr = $(this).prop("name").split("*");
                type = $(this).prop("type");
                //alert(type);
                if (type == "radio"){
                    arr = $(this).val().split("*");
                    summ = arr[2];
                }else{
                    summ = $(this).val();
                }

                title = arr[0];
                name = arr[1];

                if(sect==""){price +="<span>" + title + "</span><table>"; totextarea +=title+ ':\n';}
                if((sect!="")&&(sect!=title)){price += "</table><span>" + title + "</span><table>";
                    totextarea +='\n'+ title+ ':\n';
                }
                res = +res + +summ;
                if (summ == 0) summ ="";
                price +='<tr><td width="175">' + name + '</td><td><strong>' + summ + '</strong></td></tr>'
                totextarea += '\t >'+ name+ '\n';
                sect = title;
            });
            price = price + "</table>";
            $("div.done-summ p").text(res + " руб.");
            $(".table-summ").html(price);
        }


        $('.column input:checkbox,.column input:radio,.tbs').click(function(){//расчет итога 
            calc();
        });



        $('.print').click(function(){//печать
            q = $('#config').html();

            var win = window.open();
            self.focus();
            win.document.open();
            win.document.write('<html><head>');
            //win.document.write('<link rel="stylesheet" type="text/css" href="/css/main.css" />');
            win.document.write('<style>');

            win.document.write('.right-conf {width: 270px; border-radius: 5px; background: #eff3f5; padding: 10px 5px 7px 10px;}');
            win.document.write('.table-summ tr { border-bottom: 1px dashed #97a4ac;}');
            win.document.write('.table-summ td {padding: 5px 5px 3px 0; font-size: 13px; }');
            win.document.write("span {display: inline; font-family: 'pt_sansbold'; padding-bottom: 5px; }");

            win.document.write("p {font-size: 17px; padding-bottom: 10px; font-family: 'pt_sansbold';}");
            win.document.write('.done-summ { overflow: hidden; color: #9a0023; font-family: "pt_sansbold"; font-size: 20px; background: #d9e2e9; border-radius: 5px; padding: 8px 5px 5px 10px; margin: 5px 15px 10px 0;}');
            win.document.write('.done-summ span{float: left;}');
            win.document.write('.done-summ p{float: right; padding: 0 !important; font-size: 20px;}');

            win.document.write('</style></head>');
            win.document.write('<body><div class="conf-container"><div id="config" class="window">');
            win.document.write('<div class="right-conf"><p>Расчет стоимости услуг</p>');
            win.document.write(price);
            win.document.write('<div class="done-summ"><span>Итого:</span>');
            win.document.write('<p>' + res + 'руб.</p>');
            win.document.write('</div></div></div></div></body></html>');
            win.document.close();
            win.print();
            win.close();/**/

        });


        $('.right-conf a.order').click(function(){//при заказе вствлять в <<комментарии>> заказы
            $('#order textarea').html(totextarea);
        });


        /*----Фиксированное меню----*/
        $.fn.stickyfloat = function(options, lockBottom) {
            var $obj 				= this;
            var parentPaddingTop 	= parseInt($obj.parent().css('padding-top'));
            var startOffset 		= $obj.parent().offset().top;
            var opts 				= $.extend({ startOffset: startOffset, offsetY: parentPaddingTop, duration: 200, lockBottom:true }, options);

            $obj.css({ position: 'absolute' });

            if(opts.lockBottom){
                var bottomPos = $obj.parent().height() - $obj.height() + parentPaddingTop;
                if( bottomPos < 0 )
                    bottomPos = 0;
            }

            $(window).scroll(function () {
                $obj.stop();

                var pastStartOffset			= $(document).scrollTop() > opts.startOffset;
                var objFartherThanTopPos	= $obj.offset().top > startOffset;
                var objBiggerThanWindow 	= $obj.outerHeight() < $(window).height();

                if( (pastStartOffset || objFartherThanTopPos) && objBiggerThanWindow ){
                    var newpos = ($(document).scrollTop() -startOffset + opts.offsetY );
                    if ( newpos > bottomPos )
                        newpos = bottomPos;
                    if ( $(document).scrollTop() < opts.startOffset )
                        newpos = parentPaddingTop;

                    $obj.animate({ top: newpos }, opts.duration );
                }
            });
        };





    });

