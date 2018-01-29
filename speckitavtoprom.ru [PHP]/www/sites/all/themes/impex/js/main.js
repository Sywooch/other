var blag_hr = hr + 14; /* Вычисляем часовой пояс Благовещенска относительно часового пояса сервер - GMT - 4 + 14 = GMT +10 */
if (blag_hr > 23) {
	blag_hr = blag_hr - 24;
	}
	
var ny_hr = hr + 0; /* Вычисляем часовой пояс Нью-Йорка относительно часового пояса сервер - GMT - 4 + 0 = GMT -4 (Летнее время) */
if (ny_hr > 23) {
	ny_hr = ny_hr - 24;
	}
	
var pekin_hr = hr + 12; /* Вычисляем часовой пояс Пекина относительно часового пояса сервер - GMT - 4 + 12 = GMT +8 */
if (pekin_hr > 23) {
	pekin_hr = pekin_hr - 24;
	}

// ожидаем загрузку
window.onload = function(){
  // рисуем часы
  clock();
  // через каждую секунду
  // часы перерисовываются
  setInterval(clock, 1000);
}

function clock() {

  sec = sec+1;
  if (sec>59) {
    min = min+1;
    sec = 0;
    }
  if (min>59) {
    blag_hr = blag_hr+1;
    ny_hr = ny_hr+1;
    pekin_hr = pekin_hr+1;
    min = 0;
    }
  
  if (blag_hr>23) {
    blag_hr = 0;
    }
  
  if (ny_hr>23) {
    ny_hr = 0;
    }
  
  if (pekin_hr>23) {
    pekin_hr = 0;
    }


/*---  Часы "Благовещенск"  ---*/
 
  // получаем контекст canvas
  var ctx_blago = document
  .getElementById("clock_blago")
  .getContext("2d")
 
  // сохраняем состояние
  ctx_blago.save();
  // инициализируем холст
  ctx_blago.clearRect(0,0,60,60);
  // рисуя в точке 0,0 фактически
  // рисуем в точке 75,75
  ctx_blago.translate(30,30);
  // при рисовании линии в 100px
  // фактически рисуем линию в 40px
  ctx_blago.scale(0.2,0.2);
  // начинаем вращать с 12:00
  ctx_blago.rotate(-Math.PI/2);
 
  // инициализируем свойства рисунка
  // контуры рисуем серым
  ctx_blago.strokeStyle = "#a0a0a0";
  // заливка тоже черная
  ctx_blago.fillStyle = "#b6b6b6";
  // ширина линии 4px
  ctx_blago.lineWidth = 4;
  // будем рисовать по кругу
  ctx_blago.lineCap = "round";

  // сохраняем состояние
  ctx_blago.save();
  // рисуем внешнюю окружность
  // шириной 12px
  ctx_blago.lineWidth = 12;
  // синим цветом
  ctx_blago.strokeStyle = "#7e7e7e";
  ctx_blago.fillStyle = "#e0e0e0";
  ctx_blago.beginPath();
  // рисуем окружность, отступающую
  // от центра на 137px
  ctx_blago.arc(0,0,137,0,Math.PI*2,true);
  ctx_blago.fill();
  ctx_blago.stroke();
  ctx_blago.restore();
 
  // начинаем рисовать часовые метки
  // сохраняем предыдущее состояние
  ctx_blago.save();
  ctx_blago.beginPath();
  // для каждого часа
  for(var i = 0; i < 12; i++) {
    // поворачиваем на 1/12
    ctx_blago.rotate(Math.PI/6);
    // перемещаем курсор
    ctx_blago.moveTo(100,0);
    // рисуем черточку 15px
    ctx_blago.lineTo(115,0);
  }
  ctx_blago.stroke();
  ctx_blago.restore();
 
  // сохраняем состояние
  ctx_blago.save();
  // начинаем рисовать секундную стрелку
  // вращаем холст на текущую позицию
  ctx_blago.rotate(sec * Math.PI/30);
  // контур и заливка красного цвета
  ctx_blago.strokeStyle = "#D40000";
  ctx_blago.fillStyle = "#D40000";
  // ширина линии 3px
  ctx_blago.lineWidth = 3;
  ctx_blago.beginPath();
  // двигаем курсор
  ctx_blago.moveTo(0,0);
  // рисуем линию
  ctx_blago.lineTo(115,0);
  ctx_blago.stroke();
  ctx_blago.restore();
 
  // сохраняем состояние
  ctx_blago.save();
  // начинаем рисовать минутную стрелку
  // вращаем холст на текущую позицию
  ctx_blago.strokeStyle = "#8b8b8b";
  ctx_blago.rotate((Math.PI/30)*min +
             (Math.PI/1800)*sec);
  // ширина линии 5px
  ctx_blago.lineWidth = 5;
  ctx_blago.beginPath();
  // двигаем курсор
  ctx_blago.moveTo(0,0);
  // рисуем линию
  ctx_blago.lineTo(87,0);
  ctx_blago.stroke();
  ctx_blago.restore();

  // сохраняем состояние
  ctx_blago.save();
  // начинаем рисовать часовую стрелку
  // вращаем холст на текущую позицию
  ctx_blago.strokeStyle = "black";
  ctx_blago.rotate((Math.PI/6)*blag_hr +
             (Math.PI/360)*min +
             (Math.PI/21600)*sec);
  // устанавливаем ширину линии 9px
  ctx_blago.lineWidth = 11;
 
  ctx_blago.beginPath();
  // сдвигаем курсор несколько назад
  // стобы было похоже на стрелку
  ctx_blago.moveTo(0,0);
  // рисуем линию почти до часовых меток
  ctx_blago.lineTo(57,0);
  ctx_blago.stroke();
  ctx_blago.restore();

  // сохраняем состояние
  ctx_blago.save();
  // рисуем внешнюю окружность
  // шириной 12px
  ctx_blago.lineWidth = 1;
  // синим цветом
  ctx_blago.fillStyle = "black";
  ctx_blago.beginPath();
  // рисуем окружность, отступающую
  // от центра на 137px
  ctx_blago.arc(0,0,12,0,Math.PI*2,true);
  ctx_blago.fill();
  ctx_blago.restore();
 
  ctx_blago.restore();




/*---  Часы "Нью-Йорк"  ---*/
 
  // получаем контекст canvas
  var ctx_ny = document
  .getElementById("clock_ny")
  .getContext("2d")
 
  // сохраняем состояние
  ctx_ny.save();
  // инициализируем холст
  ctx_ny.clearRect(0,0,60,60);
  // рисуя в точке 0,0 фактически
  // рисуем в точке 75,75
  ctx_ny.translate(30,30);
  // при рисовании линии в 100px
  // фактически рисуем линию в 40px
  ctx_ny.scale(0.2,0.2);
  // начинаем вращать с 12:00
  ctx_ny.rotate(-Math.PI/2);
 
  // инициализируем свойства рисунка
  // контуры рисуем серым
  ctx_ny.strokeStyle = "#a0a0a0";
  // заливка тоже черная
  ctx_ny.fillStyle = "#b6b6b6";
  // ширина линии 4px
  ctx_ny.lineWidth = 4;
  // будем рисовать по кругу
  ctx_ny.lineCap = "round";

  // сохраняем состояние
  ctx_ny.save();
  // рисуем внешнюю окружность
  // шириной 12px
  ctx_ny.lineWidth = 12;
  // синим цветом
  ctx_ny.strokeStyle = "#7e7e7e";
  ctx_ny.fillStyle = "#e0e0e0";
  ctx_ny.beginPath();
  // рисуем окружность, отступающую
  // от центра на 137px
  ctx_ny.arc(0,0,137,0,Math.PI*2,true);
  ctx_ny.fill();
  ctx_ny.stroke();
  ctx_ny.restore();
 
  // начинаем рисовать часовые метки
  // сохраняем предыдущее состояние
  ctx_ny.save();
  ctx_ny.beginPath();
  // для каждого часа
  for(var i = 0; i < 12; i++) {
    // поворачиваем на 1/12
    ctx_ny.rotate(Math.PI/6);
    // перемещаем курсор
    ctx_ny.moveTo(100,0);
    // рисуем черточку 15px
    ctx_ny.lineTo(115,0);
  }
  ctx_ny.stroke();
  ctx_ny.restore();
 
  // сохраняем состояние
  ctx_ny.save();
  // начинаем рисовать секундную стрелку
  // вращаем холст на текущую позицию
  ctx_ny.rotate(sec * Math.PI/30);
  // контур и заливка красного цвета
  ctx_ny.strokeStyle = "#D40000";
  ctx_ny.fillStyle = "#D40000";
  // ширина линии 3px
  ctx_ny.lineWidth = 3;
  ctx_ny.beginPath();
  // двигаем курсор
  ctx_ny.moveTo(0,0);
  // рисуем линию
  ctx_ny.lineTo(115,0);
  ctx_ny.stroke();
  ctx_ny.restore();
 
  // сохраняем состояние
  ctx_ny.save();
  // начинаем рисовать минутную стрелку
  // вращаем холст на текущую позицию
  ctx_ny.strokeStyle = "#8b8b8b";
  ctx_ny.rotate((Math.PI/30)*min +
             (Math.PI/1800)*sec);
  // ширина линии 5px
  ctx_ny.lineWidth = 5;
  ctx_ny.beginPath();
  // двигаем курсор
  ctx_ny.moveTo(0,0);
  // рисуем линию
  ctx_ny.lineTo(87,0);
  ctx_ny.stroke();
  ctx_ny.restore();

  // сохраняем состояние
  ctx_ny.save();
  // начинаем рисовать часовую стрелку
  // вращаем холст на текущую позицию
  ctx_ny.strokeStyle = "black";
  ctx_ny.rotate((Math.PI/6)*ny_hr +
             (Math.PI/360)*min +
             (Math.PI/21600)*sec);
  // устанавливаем ширину линии 9px
  ctx_ny.lineWidth = 11;
 
  ctx_ny.beginPath();
  // сдвигаем курсор несколько назад
  // стобы было похоже на стрелку
  ctx_ny.moveTo(0,0);
  // рисуем линию почти до часовых меток
  ctx_ny.lineTo(57,0);
  ctx_ny.stroke();
  ctx_ny.restore();

  // сохраняем состояние
  ctx_ny.save();
  // рисуем внешнюю окружность
  // шириной 12px
  ctx_ny.lineWidth = 1;
  // синим цветом
  ctx_ny.fillStyle = "black";
  ctx_ny.beginPath();
  // рисуем окружность, отступающую
  // от центра на 137px
  ctx_ny.arc(0,0,12,0,Math.PI*2,true);
  ctx_ny.fill();
  ctx_ny.restore();
 
  ctx_ny.restore();




/*---  Часы "Пекин"  ---*/
 
  // получаем контекст canvas
  var ctx_pekin = document
  .getElementById("clock_pekin")
  .getContext("2d")
 
  // сохраняем состояние
  ctx_pekin.save();
  // инициализируем холст
  ctx_pekin.clearRect(0,0,60,60);
  // рисуя в точке 0,0 фактически
  // рисуем в точке 75,75
  ctx_pekin.translate(30,30);
  // при рисовании линии в 100px
  // фактически рисуем линию в 40px
  ctx_pekin.scale(0.2,0.2);
  // начинаем вращать с 12:00
  ctx_pekin.rotate(-Math.PI/2);
 
  // инициализируем свойства рисунка
  // контуры рисуем серым
  ctx_pekin.strokeStyle = "#a0a0a0";
  // заливка тоже черная
  ctx_pekin.fillStyle = "#b6b6b6";
  // ширина линии 4px
  ctx_pekin.lineWidth = 4;
  // будем рисовать по кругу
  ctx_pekin.lineCap = "round";

  // сохраняем состояние
  ctx_pekin.save();
  // рисуем внешнюю окружность
  // шириной 12px
  ctx_pekin.lineWidth = 12;
  // синим цветом
  ctx_pekin.strokeStyle = "#7e7e7e";
  ctx_pekin.fillStyle = "#e0e0e0";
  ctx_pekin.beginPath();
  // рисуем окружность, отступающую
  // от центра на 137px
  ctx_pekin.arc(0,0,137,0,Math.PI*2,true);
  ctx_pekin.fill();
  ctx_pekin.stroke();
  ctx_pekin.restore();
 
  // начинаем рисовать часовые метки
  // сохраняем предыдущее состояние
  ctx_pekin.save();
  ctx_pekin.beginPath();
  // для каждого часа
  for(var i = 0; i < 12; i++) {
    // поворачиваем на 1/12
    ctx_pekin.rotate(Math.PI/6);
    // перемещаем курсор
    ctx_pekin.moveTo(100,0);
    // рисуем черточку 15px
    ctx_pekin.lineTo(115,0);
  }
  ctx_pekin.stroke();
  ctx_pekin.restore();
 
  // сохраняем состояние
  ctx_pekin.save();
  // начинаем рисовать секундную стрелку
  // вращаем холст на текущую позицию
  ctx_pekin.rotate(sec * Math.PI/30);
  // контур и заливка красного цвета
  ctx_pekin.strokeStyle = "#D40000";
  ctx_pekin.fillStyle = "#D40000";
  // ширина линии 3px
  ctx_pekin.lineWidth = 3;
  ctx_pekin.beginPath();
  // двигаем курсор
  ctx_pekin.moveTo(0,0);
  // рисуем линию
  ctx_pekin.lineTo(115,0);
  ctx_pekin.stroke();
  ctx_pekin.restore();
 
  // сохраняем состояние
  ctx_pekin.save();
  // начинаем рисовать минутную стрелку
  // вращаем холст на текущую позицию
  ctx_pekin.strokeStyle = "#8b8b8b";
  ctx_pekin.rotate((Math.PI/30)*min +
             (Math.PI/1800)*sec);
  // ширина линии 5px
  ctx_pekin.lineWidth = 5;
  ctx_pekin.beginPath();
  // двигаем курсор
  ctx_pekin.moveTo(0,0);
  // рисуем линию
  ctx_pekin.lineTo(87,0);
  ctx_pekin.stroke();
  ctx_pekin.restore();

  // сохраняем состояние
  ctx_pekin.save();
  // начинаем рисовать часовую стрелку
  // вращаем холст на текущую позицию
  ctx_pekin.strokeStyle = "black";
  ctx_pekin.rotate((Math.PI/6)*pekin_hr +
             (Math.PI/360)*min +
             (Math.PI/21600)*sec);
  // устанавливаем ширину линии 9px
  ctx_pekin.lineWidth = 11;
 
  ctx_pekin.beginPath();
  // сдвигаем курсор несколько назад
  // стобы было похоже на стрелку
  ctx_pekin.moveTo(0,0);
  // рисуем линию почти до часовых меток
  ctx_pekin.lineTo(57,0);
  ctx_pekin.stroke();
  ctx_pekin.restore();

  // сохраняем состояние
  ctx_pekin.save();
  // рисуем внешнюю окружность
  // шириной 12px
  ctx_pekin.lineWidth = 1;
  // синим цветом
  ctx_pekin.fillStyle = "black";
  ctx_pekin.beginPath();
  // рисуем окружность, отступающую
  // от центра на 137px
  ctx_pekin.arc(0,0,12,0,Math.PI*2,true);
  ctx_pekin.fill();
  ctx_pekin.restore();
 
  ctx_pekin.restore();

}

$(document).ready(function(){

    /* Исчезающий текст в форме вопроса */

    $("#edit-submitted-name").focus(function() {
       if(this.value=='Ваше имя') this.value='';
    });

    $("#edit-submitted-name").blur(function() {
    if(!this.value) this.value='Ваше имя';
    });

    $("#edit-submitted-e-mail").focus(function() {
       if(this.value=='Ваш e-mail') this.value='';
    });

    $("#edit-submitted-e-mail").blur(function() {
    if(!this.value) this.value='Ваш e-mail';
    });

    $("#edit-submitted-tel").focus(function() {
       if(this.value=='Ваш номер телефона') this.value='';
    });

    $("#edit-submitted-tel").blur(function() {
    if(!this.value) this.value='Ваш номер телефона';
    });

    $("#edit-submitted-text").focus(function() {
       if(this.value=='Текст сообщения') this.value='';
    });

    $("#edit-submitted-text").blur(function() {
    if(!this.value) this.value='Текст сообщения';
    });

    $("#edit-captcha-response").focus(function() {
       if(this.value=='Код') this.value='';
    });

    $("#edit-captcha-response").blur(function() {
    if(!this.value) this.value='Код';
    });

    $("#edit-captcha-response").each(function() {
	  if(!this.value) this.value='Код';
	  });

    /* Вертикальная зебра у таблиц, а также выборка первого и последнего стобца */
    $("td:nth-child(1)").addClass('first_col');
    $("td:nth-child(odd)").addClass('odd_col');     
    $("td:nth-child(2n)").addClass('even_col');
    $("td:last-child").addClass('last_col');
	
	/* Устанавливаю метрику */
	$("#edit-submit").click(function(){
		if($("#edit-submitted-e-mail").val() != "" && $("#edit-submitted-e-mail").val() != "Ваш e-mail"){
			yaCounter17070097.reachGoal('FEEDBACK');
		}
	});

});
