<?php

class Digest {
    /**
     * Public
     */
    public function defaultAction()
    {
        global $otapilib;
        $sid = @$_SESSION['sid'];
        $webui = $otapilib->GetWebUISettings($sid);
        if ($otapilib->error_message == 'SessionExpired' || $sid == '')
        {
            header('Location: index.php?expired');
            die;
        }
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
					$digest = $cms->GetAllPosts();
            if ($digest === -1) $digest = $cms->GetAllPosts();
        } else {
            include(TPL_DIR . 'cms.php');
            die;
        }
        
        include(TPL_DIR . 'digest.php');
    }
    
    public function editAction()
    {
        global $otapilib;
        $sid = @$_SESSION['sid'];
        $webui = $otapilib->GetWebUISettings($sid);
        if ($otapilib->error_message == 'SessionExpired' || $sid == '')
        {
            header('Location: index.php?expired');
            die;
        }
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
            $id = $_GET['id'];
            settype($id, 'int');
            $post = $cms->GetPostByID($id);
						$cats = $cms->getAllDigestCategories();
            
            $webui = $otapilib->GetWebUISettings($sid);
        } else {
            include(TPL_DIR . 'cms.php');
            die;
        }
        
        include(TPL_DIR . 'cms/editdigest.php');
    }

    private function setActiveLang(){
        if(@$_GET['lang'])
            $_SESSION['menu_lang'] = @$_GET['lang'];
        if(!@$_SESSION['menu_lang']){
            $_SESSION['menu_lang'] = 'en';
        }
        return $_SESSION['menu_lang'];
    }
    
    public function addAction()
    {
        global $otapilib;
        $sid = @$_SESSION['sid'];
        $webui = $otapilib->GetWebUISettings($sid);
        if ($otapilib->error_message == 'SessionExpired' || $sid == '')
        {
            header('Location: index.php?expired');
            die;
        }
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
            $post = array('id' => 'new');
            
			$cats = $cms->getAllDigestCategories();

            $webui = $otapilib->GetWebUISettings($sid);
        
        } else {
            include(TPL_DIR . 'cms.php');
            die;
        }
        
        include(TPL_DIR . 'cms/editdigest.php');
    }

    public function delAction()
    {
        global $otapilib;
        $sid = @$_SESSION['sid'];
        $webui = $otapilib->GetWebUISettings($sid);
        if ($otapilib->error_message == 'SessionExpired' || $sid == '')
        {
            header('Location: index.php?expired');
            die;
        }
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
            $id = $_GET['id'];
            settype($id, 'int');
            $cms->DeletePostByID($id);
            header('Location: ?cmd=digest');
        }
        header('Location: ?cmd=digest');
    }

    public function editsaveAction()
    {
        global $otapilib;
        $sid = @$_SESSION['sid'];
        $webui = $otapilib->GetWebUISettings($sid);
        if ($otapilib->error_message == 'SessionExpired' || $sid == '')
        {
            header('Location: index.php?expired');
            die;
        }
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
            $id = $_POST['id'];
            if ($id === 'new')
            {
                if (empty($_POST['title']))
                {
                    header('Location: ?cmd=digest');
                    die;
                }
                $cms->CreatePost($_POST);
            } else {
                settype($id, 'int');
                $cms->UpdatePostByID($id, $_POST);
            }
            header('Location: ?cmd=digest');
            die;
        }
        header('Location: ?cmd=digest');
    }
 /*   
    public function blocksaveAction()
    {
        global $otapilib;
        $sid = @$_SESSION['sid'];
        $webui = $otapilib->GetWebUISettings($sid);
        if ($otapilib->error_message == 'SessionExpired' || $sid == '')
        {
            header('Location: index.php?expired');
            die;
        }
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
        {
            $id = $_POST['id'];
            settype($id, 'int');
            $cms->UpdateText($id, $_POST['text']);
            
            if(@$_POST['id'])
                header('Location: ../?p=digest&id='.$_POST['id']);
            else
                header('Location: ../?p=alldigest');
            
            die;
        }
        if(@$_POST['pid'])
            header('Location: ../?p='.@$_POST['back'].'&pid='.$_POST['pid']);
        else
            header('Location: ../?p='.@$_POST['back']);
    }
	*/ 
    public function menuAction(){
        if (!Login::auth()){
            include(TPL_DIR.'login.php');
            return false;
        } 
        
        $cms = new CMS();
        if (!$cms->Check()){
            include(TPL_DIR . 'db_connection_fail.php');
            die;
        }
        
        $cms->checkTable('site_langs');
        $cms->checkTable('site_translations');
        $cms->checkTable('site_translation_keys');
        $langs = $cms->getLanguages();
        $current_lang = $this->setActiveLang();
        
        $all_docs = $cms->GetPagesByLang($current_lang);
        
        $cms->checkTable('site_blocks');
        $top_menu_json = $cms->getBlock('top_menu_'.$current_lang);
        
        $top_menu = array();
        if($top_menu_json){
            $top_menu = json_decode($top_menu_json);
        }
        
        include(TPL_DIR . 'menu/index.php');
    }

		public function addcatAction() {
        $cms = new CMS();
        $status = $cms->Check();
        if ($status)
				{
					if (isset($_GET['addcategory'])){
					$cms->CreateDigestCategory($_GET['title'], $_GET['desc'], $_GET['lang']);
					$cats = $cms->getAllDigestCategories();
					echo json_encode($cats);
					}

				}
		}

		public function getitemsAction() {
			global $otapilib;
			$results = "";

			if (isset($_GET['ids'])) {
				$ids = $_GET['ids'];
				$exploded = explode(",", $ids);
				$c = count($exploded);

				if (($c % 4) == 0) {
					$mod = 4;
				} elseif ($c == 1) {
					$mod = 1;
				} else {
					$mod = 3;
				}

				for ($i = 0; $i < count($exploded); $i++) {
					$results[$i] = @$otapilib->GetItemInfo($exploded[$i]);
				}
			}

			if ($results) {
					$ids = array();
					$titles = array();
					$prices = array();
					$imgs = array();

					foreach ($results as $res) {
						$ids[] = $res['id'];
						$titles[] = $res['title'];
						$prices[] = $res['Price']['ConvertedPrice'] . $res['Price']['currencyname'];
						$imgs[] = $res['mainpictureurl'];
					}

					$k = ceil(count($results)/($mod));
					$post_page = '<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:100%; " width="624">';
					for ($i = 0; $i < $k; $i++) {
						$post_page .= '<tr>';
						$j = $mod*$i;
						for ($x=0; $x < $mod; $x++) {
							if ($x+$j >= count($ids)) break;
							$post_page .= '<td><p align="center"><a href="index.php?p=item&id='.$ids[$x+$j].'">'.$titles[$x+$j].'</a></p></td>';
						};
						$post_page .= '</tr><tr>';
						for ($x=0; $x < $mod; $x++) {
							if ($x+$j >= count($ids)) break;
							$post_page .= '<td><p align="center"><strong>' . $prices[$x+$j] . '</strong></p></td>';
						};
						$post_page .= '</tr><tr>';
						for ($x=0; $x < $mod; $x++) {
							if ($x+$j >= count($ids)) break;
							$post_page .= '<td><p align="center"><a href="index.php?p=item&id='.$ids[$x+$j].'"><img src="' . $imgs[$x+$j] . '" width="310px" height="310px"></a></p></td>';
						}
						$post_page .= '</tr><tr class="linebreak" colspan='.$mod.'><td>&nbsp;</td></tr>';
					}
					$post_page .= '</table>';
					echo $post_page;
				}
				return;
		}

		function drawTD($data) {
			$post_page = '';
			$post_page .= '<td style="height:24px;">';
			$post_page .= '<p align="center"><a href="index.php?p=' . $data['id'] . '">' . $data['title'] . '</a></p>';
			$post_page .= '<p align="center"><a href="index.php?p=' . $data['id'] . '">';
			$post_page .= '<img src="' . $data['mainpictureurl'] . '" width="310px" height="310px">';
			$post_page .= '</a></p>';
			$post_page .= '<p align="center" style="margin-left:-1.5pt;"><strong>' . $data['Price']['ConvertedPrice'] . ' ' . $data['Price']['currencyname'] . '</strong></p>';
			$post_page .= '</td>';
			return $post_page;
		}

}

?>
