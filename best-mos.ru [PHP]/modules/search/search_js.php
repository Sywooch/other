<?php

$_search_js = <<<EOF

<script>
        // при наличии фокуса убираем надпись из поля ввода
        function event_onclick( type )
        {
                var searchinput = document.getElementById('search_word');

                if( searchinput.value == '' && type)
                {
                        searchinput.value = 'Поиск...';
                }
                else if( searchinput.value == 'Поиск...' && !type )
                {
                        searchinput.value = '';
                }
        }

        // при отправики формы проверяем вводимые данные
        function event_SubmitClick( search_form )
        {
                var f = document.getElementById( search_form );
                f.submit();
        }

</script>

EOF;


$_search_js_on_module = <<<EOF

<script>
        // при наличии фокуса убираем надпись из поля ввода
        function event_onclick( type )
        {
                var searchinput = document.getElementById('search_word');

                if( searchinput.value == '' && type)
                {
                        searchinput.value = '{SEARCHWORD}';
                }
                else if( searchinput.value == '{SEARCHWORD}' && !type )
                {
                        searchinput.value = '';
                }
        }

        // при отправики формы проверяем вводимые данные
        function event_SubmitClick( search_form )
        {
                var f = document.getElementById( search_form );
                f.submit();
        }

</script>

EOF;

?>