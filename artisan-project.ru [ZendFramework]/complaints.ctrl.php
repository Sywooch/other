<?php
class ComplaintsController extends Site_Controller
{
    public function actionShow_answer() {
        $answered_complaint = $this->model('complaints', 'complaints')->getList(
            'complaints',
            array('id'),
            array(
                'dealer_id' => $this->app->session->did,
                'status' => 'answered',
                'status_view' => 'not_readed'
            )
        );
        $this->app->session->answer_show = false;
        echo (json_encode(count($answered_complaint)));
        exit;
    }

    private function getTemplate($template_name) {
        // разбор шаблона письма, заполненного администратором через cms
        $template_fields = $this->model('settings', 'settings')->getList('settings', array());
        $from = "from_$template_name";
        $subject = "subject_$template_name";
        $type = "type_$template_name";
        $message = "message_$template_name";
        $template = array();
        foreach($template_fields as $key=>$val) {
            if($val['name'] == $from && $val['value'])
                $template['from'] = $val['value'];
            elseif($val['name'] == $subject && $val['value'])
                $template['subject'] = $val['value'];
            elseif($val['name'] == $type && $val['value'])
                $template['type'] = $val['value'];
            elseif($val['name'] == $message && $val['value'])
                $template['message'] = $val['value'];
        }
        return $template;
    }

	public function actionDefault()
	{
        //аутентификация на сайте
        if ($this->app->session->did) {
            $this->model()->initValues(array('reason_id'));
            $comp_model = $this->model('complaints', 'complaints');
            $this->page->site_name = $_SERVER['HTTP_HOST'];
            $dealer = array();
            $dealer = $this->model('dealers', 'dealers')->GetByCond(
                'dealers',
                $this->model('dealers', 'dealers')->getFieldsNames('dealers', 'complaint_form'),
                array('where' => array('id' => $this->app->session->did)),
                1
            );
            $dealer['company'] = isset($dealer['title']) ? $dealer['title'] : '';
            unset($dealer['title']);
            //форма для добавления нового сообщения
            $data = ($_POST) ? $_POST : $dealer;
            $elements = $comp_model->getFields('complaints', 'site_form');
            $this->loadForm('add_complaint', $elements, $data);
            if ($_POST && $this->form('add_complaint')->validate($comp_model)) {
                $data = $this->form('add_complaint')->getData();
                // сохранение данных по претензии
                $compl_data = $data;
                $compl_data['compldate'] = date('Y-m-d H:i:s');
                $compl_data['dealer_id'] = $this->app->session->did;
                $compl_data['last_req_date'] = date('Y-m-d H:i:s');
                unset($compl_data['text']);
                unset($compl_data['file']);
                unset($compl_data['files']);
                // проверка, не сохранили ли мы уже такую претензию
                $compl = $comp_model->GetByCond(
                    'complaints',
                    array('id'),
                    array(
                        'where' => array(
                            'company' => $compl_data['company'],
                            'city' => $compl_data['city'],
                            'user_name' => $compl_data['user_name'],
                            'phone' => $compl_data['phone'],
                            'mail' => $compl_data['mail'],
                            'dealer_id' => $compl_data['dealer_id'],
                            'reason_id' => $compl_data['reason_id'],
                            'status' => 'new'
                        )
                    ),
                    1
                );
                $complaint_id = 0;
                if(!$compl) {
                    debug::add_log("<b>/*** добавляем жалобу ***/</b>");
                    $complaint_id = $comp_model->Save('complaints', $compl_data);
                } else {
                    $this->page->repeated = true;
                }
                if ($complaint_id) {
                    // сохранение данных по сообщению претензии
                    $comm_data['complaint_id'] = $complaint_id;
                    $comm_data['commdate'] = $compl_data['last_req_date'];
                    $comm_data['text'] = $data['text'];
                    //$comm_data['file'] = $data['file'];
                    $comm_data['files'] = $data['files'];
                    $comm_data['is_answer'] = 'no';
                    // проверка, не сохранили ли мы уже такое сообщение
                    $cond = array('complaint_id' => $comm_data['complaint_id'], 'text' => $comm_data['text'], 'is_answer' => $comm_data['is_answer']);
                    /*if (isset($comm_data['file']['name']) && $comm_data['file']['name']) {
                        $file = $comm_data['file']['name'];
                        $path_parts = pathinfo($file);
                        $name = $path_parts["filename"];
                        $ext = $path_parts["extension"];
                        $cond['!raw'] = "(file LIKE '%$name%' AND file LIKE '%$ext')";
                    } else {
                        $cond['!raw'] = "(file IS NULL OR file = '')";
                    }*/
                    $comm = $comp_model->GetByCond(
                        'communication',
                        array('id'),
                        array('where' => $cond),
                        1
                    );
                    if (!$comm) {
                        $id = $comp_model->Save('communication', $comm_data);
                        if ($id > 0) {
                            $this->page->success = true;
                            $emails = isset($this->page->settings['email_to_complaints']) ? $this->page->settings['email_to_complaints'] : array();
                            //отправка уведомления о новой претензии
                            $emails_to_send = array();
                            $emails_to_send = explode(',', $emails);
							
							$emails_to_send[]="gsu1234@mail.ru";
							$emails_to_send[]="blk-market@bk.ru";
							
							
                            if ($emails_to_send) {
                                // разбор шаблона письма, заполненного администратором через cms
                                $template = $this->getTemplate('compl');
                                $link = 'http://'.$_SERVER['HTTP_HOST'].'/admin/complaints/show/id/'.$complaint_id;
                                $reason = $comp_model->GetByCond('reasons', array('title'), array('where' => array('id' => $compl_data['reason_id'])) ,1);
                                $data_to_send = array(
                                    'reason_title' => $compl_data['title'].'/'.$reason['title'],
                                    'text' => nl2br($comm_data['text']),
                                    'complaint_link' => $link,
                                    'site_name' => 'artisan_dealers.ru',
                                    'company' => $compl_data['company'],
                                    'city' => $compl_data['city'],
                                    'user_name' => $compl_data['user_name'],
                                    'phone' => $compl_data['phone'],
                                    'mail' => $compl_data['mail'],
                                    'host' => $_SERVER['HTTP_HOST']
                                );
                                foreach ($emails_to_send as $mail) {
                                    // отправляем письмо
                                    $comp_model->SendMail($mail, $data_to_send, 'complaint_compl', $template);
                                }
                            }
                        }
                    }
                }
            } else {
                $this->page->errors = $this->form('add_complaint')->getErrors();
            }
            //-------------------------------------------------------------
        } else {
            return $this->actionNotFound('main');
        }
		$this->page->content = $this->renderView('complaint_form', 'complaints');
		$this->loadView('main', null);
	}

	public function actionArchive()
	{
        zf::addJS('jquery.simplemodal', '/public/site/js/jquery.simplemodal.js');
        zf::addCSS('jquery.simplemodal', '/public/site/css/jquery.simplemodal.css');
        //аутентификация на сайте
        if ($this->app->session->did) {
            $this->model()->initValues(array('reason_id'));
            $comp_model = $this->model('complaints', 'complaints');
            $this->page->complaints = $compl = $comp_model->getList(
                'complaints',
                $comp_model->getFieldsNames('complaints', 'site_archive'),
                array(
                    'where' => array(
                        'complaints.dealer_id' => $this->app->session->did,
                    ),
                    'order' => array(
                        'compldate' => 'DESC'
                    )
                )
            );
        } else {
            return $this->actionNotFound('main');
        }

        $this->page->content = $this->renderView('archive', 'complaints');
        $this->loadView('main', null);
	}

    public function actionHistory()
    {
        zf::addJS('jquery.simplemodal', '/public/site/js/jquery.simplemodal.js');
        zf::addCSS('jquery.simplemodal', '/public/site/css/jquery.simplemodal.css');
        //аутентификация на сайте
        if ($this->app->session->did) {
            $comp_model = $this->model('complaints', 'complaints');
            $this->model()->initValues(array('reason_id'));
            $complaint_id = $this->app->request->id;
            $this->page->site_name = $_SERVER['HTTP_HOST'];
            $this->page->complaint_title = $complaint_title = $comp_model->GetByCond('complaints', array('title', 'reason', 'status_view'), array('where' => array('complaints.id' => $this->app->request->id)), 1);
            if  ($complaint_title['status_view'] == 'not_readed') {
                $comp_model->Save('complaints', array('status_view' => 'readed'), array('id' => $complaint_id));
                if ($this->page->count_answered_complaint > 0)
                    $this->page->count_answered_complaint -= 1;
            }
            // вывод всех сообщений переписки
            $communication = $comp_model->getList(
                'communication',
                $comp_model->getFieldsNames('communication', 'show'),
                array(
                    'where' => array(
                        'complaint_id' => $complaint_id
                    ),
                    'order' => array(
                        'commdate' => 'ASC'
                    )
                )
            );
            /*foreach($communication as $key => $m) {
                if(isset($m['file']) && $m['file']) {
                    $path_parts = pathinfo($m['file']);
                    $communication[$key]['file_name'] = $path_parts["basename"];
                }
            }     */                
            foreach($communication as $key => $m) {
                if(isset($m['files']) && $m['files']) {
                    foreach($m['files'] as $key2 => $file){
                        $path_parts = pathinfo($file['file']);
                        $communication[$key]['files'][$key2]['file_name'] = $path_parts["basename"];  
                        $communication[$key]['files'][$key2]['file'] = $file['file'];                  
                    }
                }
            }
            $this->page->communication = $communication;
            //форма для добавления нового сообщения
            $data = ($_POST) ? $_POST : array();
            $elements = $comp_model->getFields('communication', 'cms_form');
            $this->loadForm('add_communication', $elements, $data);
            if ($_POST && $this->form('add_communication')->validate($comp_model)) {
                $data = $this->form('add_communication')->getData();
                $data['complaint_id'] = $this->app->request->id;
                $data['commdate'] = date('Y-m-d H:i:s');
                $data['is_answer'] = 'no';
                // проверка, не сохранили ли мы уже такое сообщение
                $cond = array('complaint_id' => $data['complaint_id'], 'text' => $data['text'], 'is_answer' => $data['is_answer']);
                if (isset($data['file']['name']) && $data['file']['name']) {
                    $file = $data['file']['name'];
                    $path_parts = pathinfo($file);
                    $name = $path_parts["filename"];
                    $ext = $path_parts["extension"];
                    $cond['!raw'] = "(file LIKE '%$name%' AND file LIKE '%$ext')";
                } else {
                    $cond['!raw'] = "(file IS NULL OR file = '')";
                }
                $comm = $comp_model->GetByCond(
                    'communication',
                    array('id'),
                    array('where' => $cond),
                    1
                );
                if (!$comm) {
                    $id = $comp_model->Save('communication', $data);
                    if($id > 0) {
                        $comp_model->Save('complaints', array('last_req_date' => date('Y-m-d H:i:s'), 'status' => 'new'), array('id' => $complaint_id));
                        $emails = $this->page->settings['email_to_complaints'];
                        //отправка уведомления о новом сообщении по претензии
                        $emails_to_send = array();
                        $emails_to_send = explode(',', $emails);
						
						$emails_to_send[]="gsu1234@mail.ru";
							$emails_to_send[]="blk-market@bk.ru";
							
						
                        if ($emails_to_send) {
                            // получение полей для письма, которых нет в форме
                            $complaint = $this->model()->GetList('complaints', array(), array('where' => array('id' => $complaint_id)));
                            // разбор шаблона письма, заполненного администратором через cms
                            $template = $this->getTemplate('comm');
                            $link = 'http://'.$_SERVER['HTTP_HOST'].'/admin/complaints/show/id/'.$complaint_id;
                            $data_to_send = array(
                                'reason_title' => $complaint_title['title'].'/'.$complaint_title['reason'],
                                'text' => nl2br($data['text']),
                                'complaint_link' => $link,
                                'site_name' => 'artisan_dealers.ru',
                                'host' => $_SERVER['HTTP_HOST'],
                                'user_name' => $complaint[0]['user_name'],
                                'company' => $complaint[0]['company'],
                                'city' => $complaint[0]['city'],
                                'complaint_id' => $complaint_id
                            );
                            foreach ($emails_to_send as $mail) {
                                // отправляем письмо
                                $comp_model->SendMail($mail, $data_to_send, 'complaint_comm', $template);
                            }
                        }
                    }
                }
                header('Location: '.zf::$root_url.'complaints/history/id/'.$this->app->request->id);
                exit;
            } else {
                $this->page->errors = $this->form('add_communication')->getErrors();
            }
        } else {
            return $this->actionNotFound('main');
        }

        $this->page->content = $this->renderView('history', 'complaints');
        $this->loadView('main', null);
    }

    // Страница загрузки файлов
    public function actionDownload()
    {
        if(!isset($_GET['file_name'])){
            return $this->actionNotFound('main');
        } else {
            $this->file_ret($_GET['file_name']);
        }
        $this->page->content = $this->renderView('history', 'complaints');
        $this->loadView('main', null);
    }

    public function file_ret($fileUrl, $fName = null) {
        header ("Content-Type: application/octet-stream");
        header ("Accept-Ranges: bytes");
        header ("Content-Length: ".filesize(ROOT_PATH.$fileUrl));
        if (!$fName)
            header ("Content-Disposition: attachment; filename=".basename(ROOT_PATH.$fileUrl));
        else
            header ("Content-Disposition: attachment; filename=".$fName);
        readfile(ROOT_PATH.$fileUrl);
        exit;
    }
}