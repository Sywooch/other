<?php

$_search_js = <<<EOF

<script>
        // ��� ������� ������ ������� ������� �� ���� �����
        function event_onclick( type )
        {
                var searchinput = document.getElementById('search_word');

                if( searchinput.value == '' && type)
                {
                        searchinput.value = '�����...';
                }
                else if( searchinput.value == '�����...' && !type )
                {
                        searchinput.value = '';
                }
        }

        // ��� ��������� ����� ��������� �������� ������
        function event_SubmitClick( search_form )
        {
                var f = document.getElementById( search_form );
                f.submit();
        }

</script>

EOF;


$_search_js_on_module = <<<EOF

<script>
        // ��� ������� ������ ������� ������� �� ���� �����
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

        // ��� ��������� ����� ��������� �������� ������
        function event_SubmitClick( search_form )
        {
                var f = document.getElementById( search_form );
                f.submit();
        }

</script>

EOF;

?>