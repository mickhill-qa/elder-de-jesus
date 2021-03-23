/******************************************************************************************************************************
COMMING SOON PAGE
*******************************************************************************************************************************/
(function($) {
    /**
    * Set your date here  (YEAR, MONTH (0 for January/11 for December), DAY, HOUR, MINUTE, SECOND)
    * according to the GMT+0 Timezone
    **/
    var launch = new Date('2017/05/18 16:30:00');

    /**
    * The script
    **/
    var message = $('#message');
    var years = $('#years');
    var months = $('#months');
    var days = $('#days');
    var hours = $('#hours');
    var minutes = $('#minutes');
    var seconds = $('#seconds');

    /**
    * Diferenca entre datas
    **/
    function dateDiff(dateInit, dateEnd) {
        var y1 = dateEnd.getFullYear();
        var m1 = dateEnd.getMonth();
        var d1 = dateEnd.getDate();
        var y2 = dateInit.getFullYear()
        var m2 = dateInit.getMonth()
        var d2 = dateInit.getDate();
        if (d1 < d2) {
            m1--;
            d1 += DaysInMonth(y2, m2);
        }

        if (m1 < m2) {
            y1--;
            m1 += 12;
        }

        return [y1 - y2, m1 - m2, d1 - d2];
    }

    /**
    * The msg
    **/
    var month = new Array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
    var dateMsg = launch.getDate() + ' de ' + month[launch.getMonth()] + ' de ' + launch.getUTCFullYear() + ' as ' + launch.getHours()+'h'+(launch.getHours()>1?'s':'');

    
    setDate();
    function setDate(){
        var now = new Date();
        if( launch < now ){ 
            // Cronometro
            var s = -launch.getTimezoneOffset()*60 + (now.getTime() - launch.getTime())/1000;
            var d = Math.floor(s/86400);
            
            var dife = dateDiff(launch, now);
            var d_html = dife[2];
            var m = dife[1];
            var y = dife[0];
                        
            years.html('<h1>'+y+'</h1><p>Ano'+(y>1?'s':''),'</p>');
            months.html('<h1>'+m+'</h1><p>'+(m>1?'Meses':'Mês'),'</p>');

            days.html('<h1>'+d_html+'</h1><p>Dia'+(d_html>1?'s':''),'</p>');
            s -= d*86400;

            var h = Math.floor(s/3600);
            hours.html('<h1>'+h+'</h1><p>Hora'+(h>1?'s':''),'</p>');
            s -= h*3600;

            var m = Math.floor(s/60);
            minutes.html('<h1>'+m+'</h1><p>Minuto'+(m>1?'s':''),'</p>');

            s = Math.floor(s-m*60);
            seconds.html('<h1>'+s+'</h1><p>Segundo'+(s>1?'s':''),'</p>');
            setTimeout(setDate, 1000);

            message.html('Finalizei minha missão no dia '+dateMsg+'.<br />Já fazem:');
        }
        else{ 
            years.css("display","none");
            months.css("display","none");

            // Contador Regressivo
            var s = -now.getTimezoneOffset()*60 + (launch.getTime() - now.getTime())/1000;
            var d = Math.floor(s/86400);
            days.html('<h1>'+d+'</h1><p>Dia'+(d>1?'s':''),'</p>');
            s -= d*86400;

            var h = Math.floor(s/3600);
            hours.html('<h1>'+h+'</h1><p>Hora'+(h>1?'s':''),'</p>');
            s -= h*3600;

            var m = Math.floor(s/60);
            minutes.html('<h1>'+m+'</h1><p>Minuto'+(m>1?'s':''),'</p>');

            s = Math.floor(s-m*60);
            seconds.html('<h1>'+s+'</h1><p>Segundo'+(s>1?'s':''),'</p>');
            setTimeout(setDate, 1000);

            message.html('Previsão para a volta para casa é de '+dateMsg+'.<br />Faltam:');
        }
    }
})(jQuery);
/******************************************************************************************************************************
ANIMATIONS
*******************************************************************************************************************************/
(function($) {
    "use strict";
    var isMobile = false;
    if (navigator.userAgent.match(/Android/i) || 
        navigator.userAgent.match(/webOS/i) ||
        navigator.userAgent.match(/iPhone/i) || 
        navigator.userAgent.match(/iPad/i)|| 
        navigator.userAgent.match(/iPod/i) || 
        navigator.userAgent.match(/BlackBerry/i)) {                 
        isMobile = true;            
    }
    if (isMobile == true) {
        $('body').removeClass('nomobile');
        $('.animated').removeClass('animated');
    }
    $(function() {
        if (isMobile == false) {
            $('*[data-animated]').addClass('animated');
        }
        function animated_contents() {
            $(".animated:appeared").each(function (i) {
                var $this    = $(this),
                    animated = $(this).data('animated');

                setTimeout(function () {
                    $this.addClass(animated);
                }, 50 * i);
            });
        }
        animated_contents();
        $(window).scroll(function () {
            animated_contents();
        });
    });
})(jQuery);
/******************************************************************************************************************************
SLIDER
*******************************************************************************************************************************/
(function($) {
    "use strict";
    $("body.nomobile #slider").revolution(
    {
            delay:9000,
            startheight:450,
            startwidth:890,

            thumbWidth:100,
            thumbHeight:50,
            thumbAmount:5,

            onHoverStop:"on",
            hideThumbs:200,
            navigationType:"bullet",
            navigationStyle:"round",
            navigationArrows:"none",

            touchenabled:"on",

            navOffsetHorizontal:0,
            navOffsetVertical:80,
            shadow:undefined,
            fullWidth:"on",
            fullScreen:"on"
    });
})(jQuery);
/******************************************************************************************************************************
BOOTSTRAP
*******************************************************************************************************************************/
(function($) {
    "use strict";
        $('[data-rel=tooltip]').tooltip();
        $(".alert").alert();
})(jQuery);
/******************************************************************************************************************************
PROGRESS BAR
*******************************************************************************************************************************/
(function($) {
    "use strict";
    $("a.btn-progress").click(function(){
        $('#bar-container').slideToggle(); 
    });
})(jQuery);
