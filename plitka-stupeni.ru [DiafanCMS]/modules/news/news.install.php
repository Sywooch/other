<?php
/**
 * Установка модуля "Новости"
 * 
 * @package    Diafan.CMS
 * @author     diafan.ru
 * @version    5.2
 * @license    http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2013 OOO «Диафан» (http://diafan.ru)
 */

if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(__FILE__))).'/includes/404.php';
}

$title = "Новости";

$db = array(
	"tables" => array(
		array(
			"name" => "news",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "TEXT NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"multilang" => true,
				),
				array(
					"name" => "map_no_show",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "changefreq",
					"type" => "ENUM( 'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never' ) NOT NULL",
				),
				array(
					"name" => "priority",
					"type" => "VARCHAR( 3 ) NOT NULL",
				),
				array(
					"name" => "created",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "date_start",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "date_finish",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "cat_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "site_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "keywords",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "descr",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "title_meta",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "anons",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "prior",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "timeedit",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "admin_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "access",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "theme",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "view",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY site_id (site_id)",
			),
		),
		array(
			"name" => "news_rel",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "rel_element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "news_category",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "name",
					"type" => "TEXT NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "act",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
					"multilang" => true,
				),
				array(
					"name" => "map_no_show",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "changefreq",
					"type" => "ENUM( 'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never' ) NOT NULL",
				),
				array(
					"name" => "priority",
					"type" => "VARCHAR( 3 ) NOT NULL",
				),
				array(
					"name" => "parent_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "count_children",
					"type" => "SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "site_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "keywords",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "descr",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "title_meta",
					"type" => "VARCHAR(250) NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "anons",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "text",
					"type" => "text NOT NULL DEFAULT ''",
					"multilang" => true,
				),
				array(
					"name" => "sort",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "timeedit",
					"type" => "INT(10) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "admin_id",
					"type" => " INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "access",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "theme",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "view",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "view_element",
					"type" => "VARCHAR(50) NOT NULL DEFAULT ''",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY parent_id (parent_id)",
				"KEY site_id (site_id)",
			),
		),
		array(
			"name" => "news_category_parents",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ",
				),
				array(
					"name" => "element_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "parent_id",
					"type" => "INT( 11 ) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM( '0', '1' ) NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
			),
		),
		array(
			"name" => "news_category_rel",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "cat_id",
					"type" => "INT(11) UNSIGNED NOT NULL DEFAULT '0'",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY cat_id (`cat_id`)",
			),
		),
		array(
			"name" => "news_counter",
			"fields" => array(
				array(
					"name" => "id",
					"type" => "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT",
				),
				array(
					"name" => "element_id",
					"type" => "INT(11) UNSIGNED NOT NULL",
				),
				array(
					"name" => "count_view",
					"type" => "SMALLINT(11) UNSIGNED NOT NULL",
				),
				array(
					"name" => "trash",
					"type" => "ENUM('0', '1') NOT NULL DEFAULT '0'",
				),
			),
			"keys" => array(
				"PRIMARY KEY (id)",
				"KEY element_id (`element_id`)",
			),
		),
	),
	"modules" => array(
		array(
			"name" => "news",
			"module_name" => "news",
			"admin" => true,
			"site" => true,
			"site_page" => true,
			"title" => $title,
		),
	),
	"adminsites" => array(
		array(
			"name" => "Новости",
			"rewrite" => "news",
			"group_id" => "1",
			"sort" => "3",
			"act" => true,
			"docs" => "http://cms.diafan.ru/moduli/novosti/",
			"children" => array(
				array(
					"name" => "Новости",
					"rewrite" => "news",
					"sort" => "5",
					"act" => true,
				),
				array(
					"name" => "Категории",
					"rewrite" => "news/category",
					"sort" => "6",
					"act" => true,
				),
				array(
					"name" => "Настройки",
					"rewrite" => "news/config",
					"sort" => "7",
					"act" => true,
				),
			)
		),
	),
	"sites" => array(
		array(
			"name" => array($title, 'News'),
			"act" => true,
			"sort" => 21,
			"module_name" => "news",
			"rewrite" => "news",
			"menu" => array(
				"cat_id" => 1,
				"sort" => 1,
			),
		),
	),
	"config" => array(
		array(
			"name" => "images",
			"value" => "1",
		),
		array(
			"name" => "count_list",
			"value" => "3",
		),
		array(
			"name" => "list_img",
			"value" => "1",
		),
		array(
			"name" => "use_animation",
			"value" => "1",
		),
		array(
			"name" => "format_date",
			"value" => "2",
		),
		array(
			"name" => "nastr",
			"value" => "10",
		),
		array(
			"name" => "rel_two_sided",
			"value" => "1",
		),
		array(
			"name" => "cat",
			"value" => "1",
		),
		array(
			"name" => "counter",
			"value" => "1",
		),
		array(
			"name" => "title_tpl",
			"value" => "%title %name, %category",
		),
		array(
			"name" => "keywords_tpl",
			"value" => "%keywords, %name",
		),
		array(
			"name" => "images_variations",
			"value" => serialize(array(0 => array('name' => 'medium', 'id' => 1), 1 => array('name' => 'large', 'id' => 3))),
		),
	),
);

$example = array(
	"UPDATE {site} SET
		".multilang(
			"textLANG='<p>Все самые последние новости нашего зоопарка здесь!</p>'",
			", textLANG='<p>All latest news of our zoo here!</p>'",
			""
		)
	."WHERE module_name='news'",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit
	) VALUES (
		1,
		".multilang("'Новый зверь',", "'New animal',", "'',")."
		".multilang("'1',")."
		'".(time() - 86400 * 10)."',
		MODULE_SITE_ID,
		2,
		".multilang("'Непонятный новый зверь прибыл к нам в зоопарк!',", "'Not clear new animal has arrived to us to a zoo!',", "'',")."
		".multilang(
			"'<p>Сегодня в нашем зоопарке прибавление. Под ворота зоопарка был подброшен зверек. Сотрудники до сих пор не могут понять к какому виду он может быть отнесен. Зверьку дали имя - Бугай. Пока ведется разбирательство в генетических корнях питомца, он будет жить с разными зверями. <br />\r\n<br />\r\nПредполагается, что попав в свою среду обитания, животное само определит к какому виду принадлежит. На данный момент Бугая обсмеяли ехидны, не приняли скунсы, а бурый мишка даже пнул зверька в животик.<br />\r\n<br />\r\nМы будем следить за судьбой нашего нового друга.</p>',",
			"'<p>Today in our zoo addition. Under zoo gate the small animal has been thrown. Employees cannot understand till now to what kind it can be carried. To a small animal have named - the Bull. While trial in genetic roots of the pupil is conducted, he will live with different animals.</p><p>It is supposed that having got to the inhabitancy, the animal itself will define to what kind belongs. At present the Bull are ridicule malicious, skunks, and a brown bear even have not accepted has kicked a small animal in a tummy.</p><p>We will watch destiny of our new friend.</p>',",
			"'',")."
		'".time()."'
	);",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit
	) VALUES (
		2,
		".multilang("'К нам приезжал кот из мультика!',", "'To us there came a cat from an animated cartoon!',", "'',")."
		".multilang("'1',")."
		'".(time() - 86400 * 9)."',
		MODULE_SITE_ID,
		2,
		".multilang(
			"'Кот из известнейшего мультфильма про приключения кота и песика приезжал к нам в зоопарк! Прямоходящий кот посетил все номера наших животных!',",
			"'The cat from the famous cartoon film about adventures of a cat and a dog came to us to a zoo! The orthograde cat has visited all numbers of our animals!',",
			"'',"
		)."
		".multilang(
			"'<p>Свой обход по зоопарку кот, который настоятельно просил всех называть его Одуванчик, начал с клетки с зайцами. За дружным чаепитием, кот незаметно подливал в свою чашечку неизвестный горячительный напиток. Поэтому уже после трех чашек самостоятельно выйти из клетки не смог и пел нецензурные песни, говоря что это гимн всех Одуванчиков.<br />\r\n<br />\r\nСмотрители зоопарка перенесли кота в загон лягушек. Лягушки, громко квакая, пытались оживить обмягшего Одуванчика, брызгая на него водой. Очнувшись, кот подумал что он опять на войне и начал бросаться лягушками в живущего по соседству с загоном бурого медведя. Медведь не был предупрежден о визите гостя в Зоопарк, поэтому узрев как мокрый кот кидается лягушками, начал тереть свои глаза, не веря в происходящее, и звать врача в свою клетку. И кто бы мог предположить, что Одуванчик по первой своей профессии Врач. Кот, не доконца протрезвев, решил что Медведь нуждается в лоботомии и попросил принести в клетку лобзик и пилу...  Испуганный медведь начал кричать и просить помощи. Именно благодаря бдительности медведя, кот был исключен из почетных посетителей зоопарка. <br />\r\n<br />\r\n </p>',",
			"'<p>The detour on a zoo the cat who prayed for all to name its Dandelion, has begun with a cage with hares. Behind amicable tea drinking, the cat imperceptibly added an unknown hot drink to the cup. Therefore already after three cups independently leave a cage could not and sang obscene songs, speaking that it is a hymn of all Dandelions.</p>
	<p>Inspectors of a zoo have transferred a cat to a shelter of frogs. Frogs, loudly croaking, tried to recover обмягшего the Dandelion, splashing on it water. Having regained consciousness, the cat has thought that it again in the war and has started to rush frogs in living on the neighbourhood with a shelter of a brown bear. The bear has not been warned about visit of the visitor to the Zoo, therefore having beheld as the wet cat rushes frogs, has started to rub the eyes, without trusting in an event, and to call the doctor in the cage. And who could assume that the Dandelion by the first trade the Doctor. Cat, not up to the end having sobered up, has solved that the Bear requires in psychosurgery and has asked to bring in a cage a fret saw and a saw... The Scared bear has started to shout and ask the help. Thanks to vigilance of a bear, the cat has been excluded from guests of honour of a zoo.</p>',",
			"'',"
		)."
		'".time()."'
	);",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit
	) VALUES (
		3,
		".multilang("'Всех с 10 января!',", "'All since January, 10th!',", "'',")."
		".multilang("'1',")."
		'".(time() - 86400 * 8)."',
		MODULE_SITE_ID,
		1,
		".multilang(
			"'Поздравляем всех наших посетителей с 10 января! Желаем успехов, здоровья и позитива!\r\nНаш зоопарк обещает радовать вас новыми животными, птицами и рыбками!',",
			"'We congratulate all our visitors with January, 10th! We wish successes, health and a positive! Our zoo promises to please you with new animals, birds and small fishes!',",
			"'',"
		)."
		".multilang(
			"'<p>10 января - день Забытого питомца. Мы добьемся сделать этот праздник общероссийским выходным днем, который будет начинаться минутой молчания по всем безвременно ушедшим от нас зверькам.<br />\r\n<br />\r\nМы активно боремся с браконьерами, а также занимаемся выводом новых видов животных, которые смогут сами за себя постоять и, может, однажды захватить власть. Среди наших проб - Мозгослон (умеет считать трехзначные цифры, но есть и минус: мозгослон, считая, громко икает и хаотично трубит), Пеликан Дилко (может запоминать много информации, но не умеет правильно ее преподнести, из-за чего конфузится и краснеет), Морж Баюн (быстро может плавать, но ненавидит воду).<br />\r\n<br />\r\nНадеемся, вы поможете нам в наших начинаниях и не оставите животных без внимания. Еще раз с праздником!!!</p>',",
			"'<p>On January, 10th - day of the Forgotten pupil. We will achieve to make this holiday the all-Russian day off which will begin minute of silence on all untimely deceased small animals from us.</p><p>We actively struggle with poachers, and also we are engaged in a conclusion of new kinds of animals which can stand for itself and, can, once seize power. Among our tests - Brainelephant (is able to consider three-value figures, but there is also a minus: brainelephant, considering, loudly hiccups and chaotically blows), Pelikan Dilko (can remember a lot of information, but is not able to present correctly it because of what embarrasses and reddens), the Walrus of Bajun (can quickly float, but hates water).</p><p>We hope, you will help us with our undertakings and will not disregard animals. Once again with a holiday!!!</p>',",
			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit
	) VALUES (
		4,
		".multilang("'Двоеухий заяц',", "'Dvoeuhy hare',", "'',")."
		".multilang("'1',")."
		'".(time() - 86400 * 7)."',
		MODULE_SITE_ID,
		1,
		".multilang(
			"'Да, у нормальных зайцев и так два уха! Но у этого зайца ухи растут не вдоль, а поперек головы!!! Странный заяц в нашем зоопарке с сегодняшнего дня!\r\n\r\n',",
			"'Yes, at normal hares and so two ears! But at this hare ухи grow not lengthways, and across a head!!! A strange hare in our zoo from now on!',",
			"'',"
		)."
		".multilang(
			"'<p>По словам очевидцев, заяц не понимает, почему все на него показывают пальцами, а кто-то еще и смеется. <br />\r\n<br />\r\nКогда зайцу показали &quot;нормальных зайцев&quot;, он начал истерично хохотать и говорить что они уродцы. Поэтому не удивительно, что сейчас заяц лежит в медпункте с переломами ножек и тех самых ушек. Наши зверьки не любят, когда над ними смеются.</p>',",
			"'<p>According to eyewitnesses, the hare does not understand, why all on it show fingers, and someone else and laughs.</p><p>When to a hare have shown &quot;normal hares&quot;, he has started to laugh loudly and speak hysterically that they уродцы. Therefore it is not surprising that now the hare lies in a first-aid post with crises of legs and those ears. Our small animals do not love, when at them laugh.</p>',",
			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit
	) VALUES (
		5,
		".multilang("'Гость из мезозоя',", "'The visitor from mesozoic',", "'',")."
		".multilang("'1',")."
		'".(time() - 86400 * 6)."',
		MODULE_SITE_ID,
		2,
		".multilang(
			"'Летающую лисицу-губы-ножницы к нам привез наш завхоз после поездки в Ново-Навозово и зверь сразу удачно влился в ряды наши зверей. При этом, летающая лисица-губы-ножницы очень нравится нашим посетителям детям.',",
			"'The flying fox-lips-scissors to us was brought by our supply manager after a trip in Is new-navozovo also an animal at once has successfully joined numbers our animals. Thus, the flying fox-lips-scissors very much is pleasant to our visitors to children.',",
			"'',"
		)."
		".multilang(
			"'<p>Если быть до конца откровенными, новый питомец насильно заставляет всех любить его и восхищаться. А если находятся люди, которые противятся ему, он вылетает ночью из зоопарка, подлетает к окошку обидчика. в темноте зажигает фонарик и светит им на свое лицо...жутко хохоча. Естественно после этого поклонников у зверя прибавляется. Наш вам совет: остерегайтесь его. И если что......БЕГИТЕ!!</p>',",
			"'<p>If to be up to the end frank, the new pupil violently forces all to love it and to admire. And if there are people who oppose to it, it takes off at night from a zoo, flies up to a window of the offender. In the dark lights a small lamp and shines it on the person... Terribly laughing loudly. Naturally after that admirers at an animal increases. Ours to you council: be careful of it. And сесли that...... RUN!!</p>',",
			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit
	) VALUES (
		6,
		".multilang("'Жирафий столбняк',", "'Zhirafy tetanus',", "'',")."
		".multilang("'1',")."
		'".(time() - 86400 * 5)."',
		MODULE_SITE_ID,
		2,
		".multilang(
			"'На нашего жирафа Степана напал столбняк. Несчастье произошло после того, как Степан съел три килограмма черной икры без хлеба, подаренной ему одним из наших посетителей.',",
			"'Stepan\'s our giraffe was attacked by a tetanus. The misfortune has occurred after Stepan has eaten three kgs of black caviar without the bread, presented to it one of our visitors.',",
			"''"
		)."
		".multilang(
			"'<p>Сторож Михалыч решил разобраться в этой истории. Как меланхолично-настроенный жираф смог поддаться искушению и вкусить дьявольскую, по мнению Михалыча, пищу? Видимо причина в жизненном пути жирафа. Родился он на берегах Нила, где было полно крокодилов и рыбы. Каждое утро начиналось у него с вида борьбы за жизнь между рыбами и крокодилами. Разумеется, победителем в этих битвах были не рыбы. Разложившиеся останки рыбы вместе с ее икрой попадали на берег, где Жираф их, давясь, вкушал, потому что кушать больше было нечего в тот год засухи. Жираф клялся себе, что больше никогда в жизни не будет есть икру. А тут такой факт...<br />\n<br />\nВидимо жирафа заставили это сделать? Но кто и зачем? Ответ был на поверхности. Всю жизнь за жирафом охотился браконьер. Он его приследовал с самого рождения, пытаясь убить. И когда мы забрали жирафа в наш зоопарк, смысл жизни для браконьера был потерян. И он решил жить по принципу, не убью - так наврежу. И, зная о не любви жирафа к икре, на все деньги купил ее и пришел в зоопарк... Под дулом пистолета жираф и не такое бы сделал. А так он отделался лишь психологическим расстройством. <br />\n<br />\nМы просим Вас, если вы увидите этого браконьера (фото расклеены на клетках нашего зоопарка) немедленно собщите Михалычу (найти его можно у слона в клетке, он там живет). Спасибо за сотрудничество. </p>',",
			"'<p>Watchman Mihalych has decided to understand this history. How the is melancholic-adjusted giraffe could give in to a temptation and taste devil, according to Mihalycha, food? Probably the reason in a course of life of a giraffe. He was born on coast of Nile where it was full of crocodiles and fish. Every morning began at it with a struggle kind for a life between fishes and crocodiles. Certainly, not fishes were the winner in these fights. The decayed remains of fish together with its caviar got on coast where their Giraffe, choking, tasted, because there was nothing to eat more that year droughts. The giraffe swore to itself that it is more in a life will never eat caviar. And here such fact...</p><p>Probably a giraffe have induced it to do? But who and what for? The answer was on a surface. All life the poacher hunted for a giraffe. It him приследовал since the birth, trying to kill. And when we have taken away a giraffe in our zoo, the meaning of the life for the poacher has been lost. And he has decided to live by a principle, I will not kill - so I will do much harm. And, knowing about not love of a giraffe to caviar, on all money has bought it and has come to a zoo... Under a barrel of a pistol the giraffe and not would make the such. And so it has got off with only psychological frustration.</p><p>We ask you if you see this poacher (a images are stuck on cages of our zoo) immediately собщите by Mihalychu (to find it it is possible at an elephant in a cage, he there lives). Thanks for cooperation.</p>',",
			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit
	) VALUES (
		7,
		".multilang("'Развернись на мне каток',", "'Develop on me a skating rink',", "'',")."
		".multilang("'1',")."
		'".(time() - 86400 * 4)."',
		MODULE_SITE_ID,
		2,
		".multilang(
			"'Сегодня в нашем зоопарке в районе клеток опоссумов работал асфальтоукладчик. Из под колес стремительного аппарата уклонились все звери, кроме черепахи Элеоноры.',",
			"'Today in our zoo around cages of opossums the asphalt spreader worked. From under wheels of the prompt device all animals, except a turtle of Eleonory have evaded.',",
			"'',"
		)."
		".multilang(
			"'<p>Но панцырь - это вещь... Элеонора даже не представляла, что ее, как она думала, бесполезный нарост на спине сохранит ее жизнь. Еще как только она родилась и увидела свое отражение в воде, она решила посвятить свою жизнь стиранию этого &quot;нароста&quot;. Для этого каждое утро терлась о шершавую кору дерева и камни своим понцирем. Путем невероятных услий за 100 лет панцирь стерся на 1 см.<br />\n<br />\nИ вот такая новость - будет работать странная машина в зоопарке.... Конечно за неделю до этого Элеонора выползла из своей клетки и направилась к месту предполагаемой работы укладчика.  А расстояние было не близкое - 15 метров. И на седьмые сутки пути без еды и воды она добралась таки до этого места и затаилась...<br />\n<br />\nКогда все звери побежали, чтобы не попасть под этот агрегат, Элеонора тихо шевеля губами читала псалмы и думала, что сейчас все кончится, что машина за одну минуту сделает то, что она пыталась сделать вот уже 100 лет. В мечтах она была уже без панциря, быстро бегала и прыгала по зоопарку. И вот Элеонора скрылась под катком...<br />\n<br />\nВсе бросились спасать черепаху, но когда каток уехал, все услышали черепашие чертыхания. Элеонора была расстроена, что ее план так сорвался. Но она поняла, что панцирь это не нарост, а ее защита. Теперь у нас в зоопарке одной злобной черепашкой больше. </p>',",
			"'<p>But testa is a thing... Eleonora at all did not represent that it as she thought, the useless outgrowth on a back will keep her life. Still as soon as she was born and has seen the reflexion in water, she has decided to devote the life to deleting of this &quot;outgrowth&quot;. For this purpose every morning rubbed about a rough bark of a tree and stones the testa. By improbable strains for 100 years the armour was erased on 1 see.</p><p>And here such news - will work the strange car in a zoo.... Certainly for a week before Eleonora has crept out of the cage and has gone to a place of prospective work of the stacker. And the distance was not close - 15 metres. And for the seventh days of a way without meal and water it has reached this place and has hidden...</p><p>When all animals have run not to get under this unit, Eleonora silently moving lips read psalms and thought that now all will come to an end that the car for one minute will make that she tried to make here 100 years. In dreams it was already without an armour, quickly ran and jumped on a zoo. And here Eleonora has disappeared under a skating rink...</p><p>All have rushed to rescue a turtle but when the skating rink has left, all have heard testudinate\'s action. Eleonora has been upset that its plan so has broken. But she has understood that an armour it not an outgrowth, and its protection. Now we in a zoo of one spiteful have more.</p>',",
			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,").multilang("actLANG,")."created, site_id, cat_id, ".multilang("anonsLANG,").multilang("textLANG,")."timeedit
	) VALUES (
		8,
		".multilang("'Начало весны',", "'The beginning of spring',", "'',")."
		".multilang("'1',")."
		'".(time() - 86400 * 3)."',
		MODULE_SITE_ID,
		1,
		".multilang(
			"'Сегодня с сосульки, свисающей с крыши домика бегемотика упала первая капля - весна пришла!',",
			"'Today from an icicle which are hanging down from a roof of a small house hippopotamus the first drop has fallen - the spring has come!',",
			"'',"
		)."
		".multilang(
			"'<p>И не важно, что бегемотик подумал, что это у него мозги вытекают (капелька упала на макушку и медленно скатывалась по морщинистой щеке). Бегемот подумал, что все... теперь он будет совсем глупый. Он вспомнил, как его мама бегемотиха говорила: &quot;Вот будешь зевать сильно, у тебя мозг вытечет&quot;. И вот - случилось!!!<br />\n<br />\n Расстроеный, он отчаянно метался по загону, когда все остальные радовались приходу весны. Но, имея богатый арсенал комплексов, бегемот думал, что все смеются над тем, что теперь он глуп. И это его злило. Когда он пытался сказать всем, что у него вытек мозг - раздавался смех, животные катались по земле и стучали лапками в приступе хохота. <br />\n<br />\nОстроумный воробей понял, почему бегемот подавлен. Он подлетел к нему и предложил в своем клювике, залетев через рот бегемота, вернуть ему его мозг. С тех пор они стали лучшими друзьями.<br />\n<br />\nВот так весной в нашем зоопарке зарождается дружба и светлые чувства. </p>',",
			"'<p>And it is not important that бегемотик has thought that it at it brains follow (a droplet has fallen to top and slowly rolled down on a wrinkled cheek). The hippopotamus has thought that all... Now it will be absolutely silly. He has recollected, how his mother бегемотиха spoke: &quot;you will yawn Here strongly, at you the brain will flow out&quot;. And here - happens!!!</p><p>Hopped-up, he desperately rushed about on a shelter when all the others rejoiced to arrival of spring. But, having a rich arsenal of complexes, the hippopotamus thought that all laugh that now it is silly. And it angered him. When he tried to tell everything that at it the brain has flowed out - the laughter was distributed, animals went for a drive by the ground and knocked pads in a laughter attack.</p><p>The witty sparrow has understood, why the hippopotamus is suppressed. It has flown up to it and has offered in the beak, having flown through a mouth of a hippopotamus, to return it its brain. Since then they became the best friends.</p><p>Here so in the spring in our zoo the friendship and pure feelings arises.</p>',",
			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit
	) VALUES (
		9,
		".multilang("'Кони скачут',", "'Horses skip',", "'',")."
		".multilang("'1',")."
		'".(time() - 86400 * 2)."',
		MODULE_SITE_ID,
		2,
		".multilang(
			"'Куда скачут кони? Кони скачут дружно в ряд поздравлять коров с международным женским днем!',",
			"'Where horses skip? Horses skip amicably abreast to congratulate cows on the international women\'s day!',",
			"'',"
		)."
		".multilang(
			"'<p>Но коровы у нас строптивые. Они очень обижаются, когда их назвают женщинами. Они говорят: &quot;Мы не женщины, мы - Тёлочки&quot;!<br />\n<br />\n Но тем не менее, этот день в нашем зоопарке всегда проходит в радужной атмосфере. Зайцы ходят к кроликам, опоссумы к сусликам, кони к коровам, змеи к хомячкам (правда они ходят пообедать, но это тоже внимание).... и только еж никуда не ходит. Он не любит этот праздник. И конечно, ведь хочется, чтобы его поздравили, но он мужик. А мечтал быть ежихой. Вот и сидит, горюет в этот светлый день. Зато на мужской праздник напивается и все крушит на своем пути, кричит: &quot;Я мужик! Дайте мне медведя! Я его завалю!!!&quot;<br />\n<br />\nДа, весело нам в Зоопарке из Бумаги. </p>',",
			"'<p>But cows at us obstinate. They very much take offence, when them назвают women. They speak: &quot;We not women, we are Tyolochki&quot;!</p><p>But nevertheless, this day in our zoo always passes in iridescent atmosphere. Hares go to rabbits, opossums to gophers, horses to cows, snakes to hamsters (the truth they go to have dinner, but it too attention).... And only the hedgehog does not go anywhere. He does not love this holiday. And it is final, after all it would be desirable, that him have congratulated, but it the muzhik. And dreamt to be woman. Here also sits, will grieve this light day. But for a man\'s holiday all gets drunk also destroys on the way, shouts: &quot;I the muzhik! Give me a bear! I will fill up it!!!&quot;</p><p>Yes, it is cheerful to us in the Zoo from the Paper.</p>',",
			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit
	) VALUES (
		10,
		".multilang("'Мышь выиграла олимпиаду',", "'The mouse has won the Olympic Games',", "'',")."
		".multilang("'1',")."
		'".(time() - 86400 * 1)."',
		MODULE_SITE_ID,
		2,
		".multilang(
			"'Намедни почетный житель нашего зоопарка - мышь Ромуальд победил на областной олимпиаде по кварковому строению протонов и нейтронов!',",
			"'Recently the honourable inhabitant of our zoo - mouse Romuald has won on the regional Olympic Games on to a structure of protons and neutrons!',",
			"'',"
		)."
		".multilang(
			"'<p>Победив, Ромуальд так и не понял в чем он участвовал. Да и первое место ему дали, потому что и судьи не знали, что это такое. Просто мышь был пьян и вел себя довольно странно. Вот и подумали, что он кварковое строение протонов и нейтронов изображает.<br />\n<br />\n Победителя ждет целый год жизни по типу &quot;все включено&quot;. Кобра теперь не ест Ромуальда, а своим раздвоенным язычком щекочет его пяточки и таит огромную злобу. Прошлого победителя олимпиады таинственно сожрали сразу на первый день после триумфального года, но доказать ничего не смогли...<br />\n<br />\nУдачи тебе, Ромуальд!!! </p>',",
			"'<p>Having won, and he has not understood Romuald in what participated. And the first place to it a distance because also judges did not know that this such. Simply the mouse it was drunk and behaved strange enough. Here also have thought that it кварковое represents a structure of protons and neutrons.</p><p>The winner is waited by the whole year of a life on type &quot;all inclusive&quot;. The cobra does not eat now Romualda, and the doubled uvula tickles him пяточки and conceals huge rage. The last winner of the Olympic Games have mysteriously gobbled up at once for the first day after triumphal year, but prove could nothing...</p><p>Good luck to you, Romuald!!!</p>',",
			"'',"
		)."
		'".time()."'
	)",

	"INSERT INTO {news} (
		id, ".multilang("nameLANG,")." ".multilang("actLANG,")." created, site_id, cat_id, ".multilang("anonsLANG,")." ".multilang("textLANG,")." timeedit
	) VALUES (
		11,
		".multilang("'Птица-клён',", "'Bird-maple',", "'',")."
		".multilang("'1',")."
		'".time()."',
		MODULE_SITE_ID,
		2,
		".multilang(
			"'Продается чудо-зверь: птица-клён в форме кленового листа. Чудо живет на деревьях, маскируясь под листья.',",
			"'The wonderful animal is on sale: a bird-maple in the form of a maple leaf. The miracle lives on trees, masking under leaves.',",
			"'',"
		)."
		".multilang(
			"'<p>Нужно еще сказать, что это чудо осенью опадает вместе с листьями, за зиму подгнивает на земле, а потом - весной карабкается на дерево, сворачивается, как почка, и снова пытается показать, что распускается. Достала нас эта птичка. Мы ее пытаемся вот уже третий год продать, но ее возвращают. <br />\n<br />\nВидели бы вы ее личико, когда она изображает увядший лист или натужное лицо при распускании...вы бы поняли наше желание избавиться от птички.<br />\n<br />\nЕсли птичку не купят в ближайшие выходные, мы натравим на нее злого апоссума... Спасите птичку!<br />\n<br />\n </p>',",
			"'<p>It is necessary to tell still that this miracle falls down together with leaves in the autumn, for a winter begins to rot on the earth, and then - clambers on a tree in the spring, is turned off, as the kidney, and again tries to show that is dismissed. This birdie has got us. We it try to sell already here the third year, but it return.</p><p>Would see you its face when it represents faded sheet or the strained person at blooming... You would understand our desire to get rid of a birdie.</p><p>If a birdie will not buy during coming week-end, we will set on it malicious opossum... Rescue a birdie!</p>',",
			"'',"
		)."
		'".time()."'
	);",

	"INSERT INTO {news_rel} (element_id, rel_element_id) VALUES (2, 4), (10, 1), (11, 1), (10, 11)",

	"INSERT INTO {news_category} (id, ".multilang("nameLANG,")." ".multilang("actLANG,")." sort, site_id, ".multilang("textLANG,")."timeedit) VALUES
	('1',".multilang("'Общие новости',","'',")."".multilang("'1',","'0',")."1, MODULE_SITE_ID,".multilang("'<p>Здесь у нас новости общего характера</p>',","'',")."'".time()."'),
	('2',".multilang("'О зверятах',","'',")."".multilang("'1',","'0',")."2, MODULE_SITE_ID,".multilang("'<p>Самые последние новости о наших зверятах</p>',","'',")."'".time()."')",

	"INSERT INTO {news_category_rel} (element_id, cat_id) VALUES (8,1),(3,1),(1,2),(2,2),(4,1),(5,2),(6,2),(7,2),(9,2),(10,2),(11,2);"
);

/**
 * Выполняет действия для установки примеров заполнения модуля
 * 
 * @return void
 */
function module_example_news()
{
	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/news'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/news', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/news/large'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/news/large', 0777);
	}

	if (! is_dir(ABSOLUTE_PATH.USERFILES.'/news/small'))
	{
		mkdir(ABSOLUTE_PATH.USERFILES.'/news/small', 0777);
	}
	$array = array(
		1  => array(3  => 'novyj-zver'),
		2  => array(8  => 'k-nam-priezzhal-kot-iz-multika'),
		4  => array(4  => 'dvoeuxij-zayac', 12 => 'dvoeuxij-zayac'),
		5  => array(5  => 'gost-iz-mezozoya', 13 => 'gost-iz-mezozoya'),
		6  => array(6  => 'zhirafij-stolbnyak'),
		7  => array(7  => 'razvernis-na-mne-katok'),
		9  => array(9  => 'koni-skachut', 14 => 'koni-skachut'),
		10 => array(10 => 'mysh-vyigrala-olimpiadu'),
		11 => array(11 => 'ptica-klen')
	);
	$module = 'news';
	foreach ($array as $k => $a)
	{
		foreach ($a as $id => $name)
		{
			$name = $name.'_'.$id.'.jpg';
			DB::query("INSERT INTO {images} (id, name, module_name, element_id, sort) VALUES ('%d', '%s', '%s', '%d', '%d')", $id, $name, $module, $k, $id);

			if (! file_exists(ABSOLUTE_PATH.USERFILES.'/original/'.$name))
			{
				copy(DEMO_PATH.$module.'/'.$name, ABSOLUTE_PATH.USERFILES.'/original/'.$name);
				copy(ABSOLUTE_PATH.USERFILES.'/original/'.$name, ABSOLUTE_PATH.USERFILES.'/'.$module.'/large/'.$name);
				copy(DEMO_PATH.$module.'/small/'.$name, ABSOLUTE_PATH.USERFILES.'/small/'.$name);
				copy(DEMO_PATH.$module.'/medium/'.$name, ABSOLUTE_PATH.USERFILES.'/'.$module.'/small/'.$name);
			}

			chmod(ABSOLUTE_PATH.USERFILES.'/small/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/original/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/'.$module.'/large/'.$name, 0777);
			chmod(ABSOLUTE_PATH.USERFILES.'/'.$module.'/small/'.$name, 0777);
		}
	}
}