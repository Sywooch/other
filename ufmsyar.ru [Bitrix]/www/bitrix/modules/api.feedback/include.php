<?
Class CApiFeedback
{
	function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
	{/*
		if($GLOBALS['APPLICATION']->GetGroupRight("main") < "R")
			return;

		$MODULE_ID = basename(dirname(__FILE__));
		$aMenu = array(
			//"parent_menu" => "global_menu_services",
			"parent_menu" => "global_menu_settings",
			"section" => $MODULE_ID,
			"sort" => 50,
			"text" => $MODULE_ID,
			"title" => '',
//			"url" => "partner_modules.php?module=".$MODULE_ID,
			"icon" => "",
			"page_icon" => "",
			"items_id" => $MODULE_ID."_items",
			"more_url" => array(),
			"items" => array()
		);

		if (file_exists($path = dirname(__FILE__).'/admin'))
		{
			if ($dir = opendir($path))
			{
				$arFiles = array();

				while(false !== $item = readdir($dir))
				{
					if (in_array($item,array('.','..','menu.php')))
						continue;

					if (!file_exists($file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.$MODULE_ID.'_'.$item))
						file_put_contents($file,'<'.'? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/'.$MODULE_ID.'/admin/'.$item.'");?'.'>');

					$arFiles[] = $item;
				}

				sort($arFiles);

				foreach($arFiles as $item)
					$aMenu['items'][] = array(
						'text' => $item,
						'url' => $MODULE_ID.'_'.$item,
						'module_id' => $MODULE_ID,
						"title" => "",
					);
			}
		}
		$aModuleMenu[] = $aMenu;
	*/}

	function Send($event_name, $site_id, $arFields, $Duplicate="Y", $message_id=false, $user_mess=false, $semi_rand=false)
	{
		if(!$user_mess)
			foreach(GetModuleEvents('api.feedback', "OnBeforeEmailSend", true) as $arEvent)
				ExecuteModuleEventEx($arEvent, array(&$event_name, &$site_id, &$arFields, &$message_id));

        if(!$semi_rand)
            $semi_rand = md5(time());

		$arFilter = Array(
			//"ID"            => $message_id,
			"TYPE_ID"       => $event_name,
			"SITE_ID"       => $site_id,
			"ACTIVE"        => "Y",
		);
        if($message_id)
            $arFilter['ID'] = $message_id;

        $arMess = array();
		$rsMess = CEventMessage::GetList($by="id", $order="asc", $arFilter);
		while($obMess = $rsMess->GetNext())
			$arMess[] = $obMess;

		$strFields = "";
        $bReturn = false;
		if(!empty($arMess))
		{
			$SITE_NAME = COption::GetOptionString("main", "site_name", $GLOBALS["SERVER_NAME"]);


            // boundary
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

            foreach($arMess as $k => $v)
			{
                $email_from = !$user_mess ? $arFields[str_replace('#','',$v['EMAIL_FROM'])] : $arFields['EMAIL_FROM'];
                $headers = "From: ". $email_from;

                // headers for attachment
                $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed; charset=\"". SITE_CHARSET ."\";\n" . " boundary=\"{$mime_boundary}\"";


                if($v['BODY_TYPE'] == 'text')
					$v['BODY_TYPE'] = 'plain';

				if(strpos($v['SUBJECT'],'#AUTHOR_MESSAGE_THEME#') !== false)
					$subject = "=?". SITE_CHARSET ."?B?". base64_encode(str_replace('#AUTHOR_MESSAGE_THEME#',$arFields['AUTHOR_MESSAGE_THEME'],$v['SUBJECT'])) . "?=";
				else
					$subject = "=?". SITE_CHARSET ."?B?". base64_encode(str_replace('#SITE_NAME#',$SITE_NAME,$v['SUBJECT'])) . "?=";

				if(!empty($arFields))
				{
					foreach($arFields as $k2=>$v2)
					{
						$search[] = '#'. $k2 .'#';
						$replace[] = $v2;
					}
					$strFields = str_replace($search,$replace,$v['MESSAGE']);

					if(strpos($strFields,'#SITE_NAME#') !== false)
						$strFields = str_replace('#SITE_NAME#',$SITE_NAME,$strFields);
				}

				// multipart boundary
				$message = "--{$mime_boundary}\n" . "Content-Type: text/". $v['BODY_TYPE'] ."; charset=". SITE_CHARSET .";\n" .
						"Content-Transfer-Encoding: 8bit\n\n" . htmlspecialcharsback($strFields) . "\n\n";//iso-8859-1 ::  text/plain

				$message .= "--{$mime_boundary}--";

                if(bxmail($arFields[str_replace('#','',$v['EMAIL_TO'])], $subject, $message,$headers))
				{
					if(!$user_mess)
						foreach(GetModuleEvents('api.feedback', "OnAfterEmailSend", true) as $arEvent)
							ExecuteModuleEventEx($arEvent, array(&$event_name, &$site_id, &$arFields, &$message_id));

                    $bReturn = true;
				}
				else
					return false;
			}

            if($bReturn)
                return true;

		}
		else
			return false;

	}
}