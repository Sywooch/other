<?php
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && check_bitrix_sessid()) {
    $result=array();
    $result['valid']=false;
    $result['email_error']=false;
    $result['password_error']=false;
    $arrPost = filter_var_array(
        $_POST['REGISTER'],
        array(

            'EMAIL' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'PASSWORD'=>FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'CONFIRM_PASSWORD'=>FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            )
    );
    if($arrPost['PASSWORD']!==$arrPost['CONFIRM_PASSWORD']){
        $result['password_error']=true;
    }
    $order = array('sort' => 'asc');
    $tmp = 'sort';
    $dbUser=CUser::GetList(
        $order,
        $tmp,
        array(
            'EMAIL'=>$arrPost['EMAIL']
        )
    );
    if($resUser=$dbUser->Fetch()){
        $result['email_error']=true;
    }
    if(!$result['email_error']&& !$result['password_error']){
        $result['valid']=true;

        }
           echo json_encode($result);
        }


?>
