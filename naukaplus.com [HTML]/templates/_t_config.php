<?

/***************************************************************************
*  Ядро системы и разделы сайта                                            *
*  Конфиг темплейтов                                                       *
*  Version: 3.0                                                            *
*  Copyright: «Web Otdel»                                                  *
***************************************************************************/

/***************************************************************************
*  Служебная часть. Инициализация меню. Не менять!                        */
$_menu = array();
/* Все, что расположено ниже, может меняться контент-менеджером.           *
***************************************************************************/


/*
 * Основное динамическое меню с названием static
 *
 * Элементы меню
 * begin - начало блока
 * active - обычный пункт меню (ссылка)
 * inactive - текущий пункт меню (когда посетитель находится на этой странице)
 * now - родительский пункт меню текущего документа
 * delimiter - разделитель между пунктами меню
 * megadelimiter - глобальный разделитель, любой HTML-код
 * end - конец блока
 *
 * Допустимые переменные
 * {TITLE} - название документа (пункта меню)
 * {ALIAS} - ссылка на документ
 * {SBODY} - анонс документа
 * {AUTHOR} - автор документа
 * {DOCUMENTDATE(d F Y)} - дата в любом формате, поддерживаемом встроенной в PHP функцией date()
 * {COUNTCHILDS} - количество подразделов документа
 */
$_menu['static']['begin']      = <<<EOF
		<table border="0" cellpadding="0" cellspacing="0" width="100%" id="menu-bg">
			<tr id="tr_3">

EOF;
$_menu['static']['active']     = <<<EOF
				<td><img alt="" src="/style/menu-br-right.gif" width="1" height="32"></td>
				<td id="menu-bg-over">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td><img alt="" src="/style{ALIAS}menu-btn.gif" width="30" height="30"></td>
							<td class="td_1"></td>
							<td><span>{TITLE}</span></td>
						</tr>
					</table>
				</td>
				<td><img alt="" src="/style/menu-br-left.gif" width="1" height="32"></td>

EOF;
$_menu['static']['inactive']   = <<<EOF
				<td><img alt="" src="/style/menu-br-right.gif" width="1" height="32"></td>
				<td onMouseOver="this.id='menu-bg-over';" onMouseOut="this.id='';" onclick="document.location='{ALIAS}';">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td><img alt="" src="/style{ALIAS}menu-btn.gif" width="30" height="30"></td>
							<td class="td_1"></td>
							<td><a href="{ALIAS}">{TITLE}</a></td>
						</tr>
					</table>
				</td>
				<td><img alt="" src="/style/menu-br-left.gif" width="1" height="32"></td>

EOF;
$_menu['static']['now']        = <<<EOF
				<td><img alt="" src="/style/menu-br-right.gif" width="1" height="32"></td>
				<td id="menu-bg-over" onclick="document.location='{ALIAS}';">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td><img alt="" src="/style{ALIAS}menu-btn.gif" width="30" height="30"></td>
							<td class="td_1"></td>
							<td><a href="{ALIAS}">{TITLE}</a></td>
						</tr>
					</table>
				</td>
				<td><img alt="" src="/style/menu-br-left.gif" width="1" height="32"></td>

EOF;
$_menu['static']['delimiter']  = <<<EOF

EOF;
$_menu['static']['end']        = <<<EOF
			</tr>
		</table>

EOF;

/*
 * Дерево подразделов текущего документа, основанное на меню static
 * Элементы - аналогично основному меню
 * Допустимые переменные - аналогично основному меню
 */
$_child_menu['static']['begin']      = <<<EOF
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td class="td_4"><table border="0" cellpadding="0" cellspacing="0" width="10"><tr><td></td></tr></table></td>
							<td class="title"><h1></h1></td>
						</tr>
						<tr>
							<td><table border="0" cellpadding="0" cellspacing="0" height="10"><tr><td></td></tr></table></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>
<ul id="navigation">

EOF;
$_child_menu['static']['active']     = <<<EOF
<li class="li">{TITLE}</li>

EOF;
$_child_menu['static']['inactive']   = <<<EOF
<li class="li"><a href="{ALIAS}">{TITLE}</a></li>

EOF;
$_child_menu['static']['now']        = <<<EOF
<li class="li"><a href="{ALIAS}">{TITLE}</a></li>

EOF;
$_child_menu['static']['delimiter']  = <<<EOF

EOF;
$_child_menu['static']['end']        = <<<EOF
		</ul>
							</td>
						</tr>
					</table>

EOF;

/*
 * Дерево соседних разделов текущего документа, основанное на меню static
 * Элементы - аналогично основному меню
 * Допустимые переменные - аналогично основному меню
 */
$_adjacent_menu['static']['begin']      = <<<EOF
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td class="td_4"><table border="0" cellpadding="0" cellspacing="0" width="10"><tr><td></td></tr></table></td>
							<td class="title"><h1></h1></td>
						</tr>
						<tr>
							<td><table border="0" cellpadding="0" cellspacing="0" height="10"><tr><td></td></tr></table></td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>
<ul id="navigation">

EOF;
$_adjacent_menu['static']['active']     = <<<EOF
<li class="li">{TITLE}</li>

EOF;
$_adjacent_menu['static']['inactive']   = <<<EOF
<li class="li"><a href="{ALIAS}">{TITLE}</a></li>

EOF;
$_adjacent_menu['static']['now']        = <<<EOF
<li class="li"><a href="{ALIAS}">{TITLE}</a></li>

EOF;
$_adjacent_menu['static']['delimiter']  = <<<EOF

EOF;
$_adjacent_menu['static']['end']        = <<<EOF
		</ul>
							</td>
						</tr>
					</table>

EOF;


/*
 * Пример!
 * Меню с названием menu2
 * Элементы - аналогично основному меню
 * Допустимые переменные - аналогично основному меню
 */
$_menu['menu2']['begin']                 = <<<EOF
<table border=0 cellspacing=0 cellpadding=0 width=100% align=center><tr valign=top><td width=50%><ul>
EOF;
$_menu['menu2']['active']                = <<<EOF
<li>{TITLE}</li>
EOF;
$_menu['menu2']['inactive']              = <<<EOF
<li><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menu['menu2']['now']                   = <<<EOF
<li><a class=now href={ALIAS}>{TITLE}</a></li>
EOF;
$_menu['menu2']['delimiter']             = <<<EOF

EOF;
$_menu['menu2']['megadelimiter']['50%']  = <<<EOF
</ul></td><td width=50%><ul>
EOF;
$_menu['menu2']['end']                   = <<<EOF
</td></tr></table></ul>
EOF;


/*
 * Пример!
 * Дерево подразделов текущего документа, основанное на меню static (только с подразделами)
 * Элементы - аналогично основному меню
 * Допустимые переменные - аналогично основному меню
 */
$_child_menu_with_childs['static']['begin']      = <<<EOF
<ul>
EOF;
$_child_menu_with_childs['static']['active']     = <<<EOF

EOF;
$_child_menu_with_childs['static']['inactive']   = <<<EOF
<li><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_child_menu_with_childs['static']['now']        = <<<EOF

EOF;
$_child_menu_with_childs['static']['delimiter']  = <<<EOF

EOF;
$_child_menu_with_childs['static']['end']        = <<<EOF
</ul>
EOF;

/*
 * Пример!
 * Дерево подразделов текущего документа, основанное на меню static (без подразделов)
 * Элементы - аналогично основному меню
 * Допустимые переменные - аналогично основному меню
 */
$_child_menu_without_childs['static']['begin']      = <<<EOF
<ul>
EOF;
$_child_menu_without_childs['static']['active']     = <<<EOF

EOF;
$_child_menu_without_childs['static']['inactive']   = <<<EOF
<li><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_child_menu_without_childs['static']['now']        = <<<EOF

EOF;
$_child_menu_without_childs['static']['delimiter']  = <<<EOF

EOF;
$_child_menu_without_childs['static']['end']        = <<<EOF
</ul>
EOF;


/*
 * Пример!
 * Основное меню static в виде раскрывающегося дерева документов
 * Элементы - аналогично основному меню (megadelimiter только для 1-го уровня)
 * Допустимые переменные - аналогично основному меню
 * Для каждого уровня элементы меню могут оформляться отдельно
 * Оформление нижних уровней наследует верхние
 * Элемент depth - глубина раскрытия меню (при значении 0 меню будет раскрываться до последнего уровня)
 *
 * Уровень 1
 */
$_menutree['static']['begin']['1']            = <<<EOF
<ul>
EOF;
$_menutree['static']['active']['1']           = <<<EOF
<li type=circle>{TITLE}</li>
EOF;
$_menutree['static']['inactive']['1']         = <<<EOF
<li type=circle><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menutree['static']['now']['1']              = <<<EOF
<li type=circle><a class=now href={ALIAS}>{TITLE}</a></li>
EOF;
$_menutree['static']['delimiter']['1']        = <<<EOF

EOF;
$_menutree['static']['end']['1']              = <<<EOF
</ul>
EOF;
$_menutree['static']['megadelimiter']['50%']  = <<<EOF

EOF;
$_menutree['static']['depth']                 = 0;
/*
 * Уровень 2
 */
$_menutree['static']['begin']['2']            = <<<EOF
<ul>
EOF;
$_menutree['static']['active']['2']           = <<<EOF
<li type=disc>{TITLE}</li>
EOF;
$_menutree['static']['inactive']['2']         = <<<EOF
<li type=disc><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menutree['static']['now']['2']              = <<<EOF

EOF;
$_menutree['static']['delimiter']['2']        = <<<EOF

EOF;
$_menutree['static']['end']['2']              = <<<EOF
</ul>
EOF;
/*
 * Уровень 3
 */
$_menutree['static']['begin']['3']            = <<<EOF
<ul>
EOF;
$_menutree['static']['active']['3']           = <<<EOF
<li type=square>{TITLE}</li>
EOF;
$_menutree['static']['inactive']['3']         = <<<EOF
<li type=square><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menutree['static']['now']['3']              = <<<EOF

EOF;
$_menutree['static']['delimiter']['3']        = <<<EOF

EOF;
$_menutree['static']['end']['3']              = <<<EOF
</ul>
EOF;


/*
 * Пример!
 * Основное меню static в виде уже раскрытого дерева документов
 * Элементы - аналогично основному меню (megadelimiter только для 1-го уровня)
 * Допустимые переменные - аналогично основному меню
 * Для каждого уровня элементы меню могут оформляться отдельно
 * Оформление нижних уровней наследует верхние
 * Элемент depth - глубина раскрытия меню (при значении 0 меню будет раскрываться до последнего уровня)
 *
 * Уровень 1
 */
$_menuexpanded['static']['begin'][1]              = <<<EOF
<ul>
EOF;
$_menuexpanded['static']['active'][1]             = <<<EOF
<li type=circle>{TITLE}</li>
EOF;
$_menuexpanded['static']['inactive'][1]           = <<<EOF
<li type=circle><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menuexpanded['static']['now'][1]                = <<<EOF
<li type=circle><a class=now href={ALIAS}>{TITLE}</a></li>
EOF;
$_menuexpanded['static']['delimiter'][1]          = <<<EOF

EOF;
$_menuexpanded['static']['end'][1]                = <<<EOF
</ul>
EOF;
$_menuexpanded['static']['megadelimiter']['50%']  = <<<EOF

EOF;
$_menuexpanded['static']['depth']                 = 0;
/*
 * Уровень 2
 */
$_menuexpanded['static']['begin'][2]              = <<<EOF
<ul>
EOF;
$_menuexpanded['static']['active'][2]             = <<<EOF
<li type=disc>{TITLE}</li>
EOF;
$_menuexpanded['static']['inactive'][2]           = <<<EOF
<li type=disc><a href={ALIAS}>{TITLE}</a></li>
EOF;
$_menuexpanded['static']['now'][2]                = <<<EOF

EOF;
$_menuexpanded['static']['delimiter'][2]          = <<<EOF

EOF;
$_menuexpanded['static']['end'][2]                = <<<EOF
</ul>
EOF;


/*
 * Навигация
 *
 * Элементы навигации (выводятся в следующем, жестко заданном порядке)
 * startnavi - переход напрямую к выбранной странице на javascript
 * pages_all - общее количество страниц
 * page_start - первая страница
 * page_previous - предыдущая страница
 * page_current - текущая страница
 * page_link - обычная страница (ссылка)
 * page_next - следующая страница
 * page_end - последняя страница
 *
 * Допустимые переменные (порядок и соответствие элементам навигации не должно меняться)
 * {UB}, {TP}, {PP}, {TYPE} - переменные перехода к выбранной страницы на javascript
 * {PAGES} - число, обозначающее общее количество страниц
 * {BASE_URL}{END} и {BASE_URL}{END}{NUM} - ссылка на страницу
 * {PAGE} - номер страницы
 */
$_pagenaviagation['startnavi']      = "";
$_pagenaviagation['pages_all']      = "";
$_pagenaviagation['page_start']     = '';
$_pagenaviagation['page_previous']  = '
<span class="sort_lnk"><a class="sortarr" href={BASE_URL}{END}{NUM}>&lt;</a></span>';
$_pagenaviagation['page_current']   = '
<span class="sort_cur">{PAGE}</span>';
$_pagenaviagation['page_link']      = '
<span class="sort_lnk"><a class="sort" href={BASE_URL}{END}{NUM}>{PAGE}</a>';
$_pagenaviagation['page_next']      = '
<span class="sort_lnk"><a class="sortarr" href={BASE_URL}{END}{NUM}>&gt;</a></span>';
$_pagenaviagation['page_end']       = '';

?>