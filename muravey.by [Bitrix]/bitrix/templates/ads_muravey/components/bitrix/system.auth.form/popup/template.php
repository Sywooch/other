<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult['ERROR']))
{
    ?>
    <script type="text/javascript">
    $(document).ready(function()
    {
        $('.enter-form #modal_authorize').click();
    });
    </script>
    <?
}	
?>
<!-- Modal -->
<div class="modal fade" id="login">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>

            <div class="modal-title">
                Вход в личный кабинет
            </div>
            
            <div class="modal-errors">
            <?ShowMessage($arResult['ERROR_MESSAGE']);?>
            </div>
            
            <div class="modal-body">
                <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
                    <?foreach ($arResult["POST"] as $key => $value):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                    <?endforeach?>
                    <input type="hidden" name="AUTH_FORM" value="Y" />
                    <input type="hidden" name="TYPE" value="AUTH" />
                
                    <div class="field">
                        <div class="title">
                            Логин
                        </div>
                        <div class="value">
                            <input class="form-element" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" />
                        </div>
                    </div>

                    <div class="field">
                        <div class="title">
                            Пароль
                        </div>
                        <div class="value">
                            <input class="form-element" type="password" name="USER_PASSWORD" maxlength="50" size="17" />
                        </div>
                    </div>

                    <div class="field field--actions">
                        <div class="forgot-link">
                            <a href="/auth/?forgot_password=yes" rel="nofollow">Забыли логин или пароль?</a>
                        </div>

                        <input class="button button--submit" value="Вход" name="Login" type="submit">
                    </div>

                    <div class="registration-link">
                        <a href="/auth/?register=yes">Регистрация</a>
                    </div>
                </form>
                <!-- / form -->
            </div>
            <!-- / .modal-body -->
        </div>
        <!-- / .modal-content -->
    </div>
    <!-- / .modal-dialog -->
</div>
<!-- / .modal -->