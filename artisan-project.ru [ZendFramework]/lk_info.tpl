<div class="mainPart zeroBox">
        <h1>Личные данные</h1>
        <form action="#" name="mainData">
            <table class="mainData">
                <tbody>
                
                
                {foreach from=$fields key=fn item=fv}
            		{if $fn != 'legal_entities'}
            		<tr>
                		<td>{$fv.title}</td>
                        <td><input type="text" value="{$data.$fn}" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);"></td>
            		</tr>
            		{/if}
        		{/foreach}
                
                
                <!--
                <tr>
                
                
                    <td>
                        Наименование
                    </td>
                    <td>
                        <input type="text" value="Дилер №1" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Город
                    </td>
                    <td>
                        <input type="text" value="Москва" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Логин
                    </td>
                    <td>
                        <input type="text" value="diler1" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Описание
                    </td>
                    <td>
                        <input type="text" value="Описание" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Электронная почта
                    </td>
                    <td>
                        <input type="email" value="diler@mail.ru" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Телефон
                    </td>
                    <td>
                        <input type="tel" value="+7 123 456-78-90" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Юридическое лицо
                    </td>
                    <td>
                        <input type="text" value="ООО Дилер №1" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Юридический адрес
                    </td>
                    <td>
                        <input type="text" value="Косыгина 15" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Фактический адрес
                    </td>
                    <td>
                        <input type="text" value="Нахимовский, 85" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        ИНН/КПП
                    </td>
                    <td>
                        <input type="text" value="123456789" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        БИК
                    </td>
                    <td>
                        <input type="text" value="123456789" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Расчетний счет
                    </td>
                    <td>
                        <input type="text" value="123456789" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Наименование банка
                    </td>
                    <td>
                        <input type="text" value="ВТБ24" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                <tr>
                    <td>
                        Корреспондентский счет
                    </td>
                    <td>
                        <input type="text" value="123456789" disabled="" style="color: rgb(0, 0, 0); border-color: transparent; background-color: rgb(249, 249, 249);">
                    </td>
                </tr>
                -->
                
                
                
            </tbody></table>
            <a class="button editInfo" href="javascript:void(0)">Редактировать</a>
            <input class="pair1" type="submit" value="Сохранить" style="display: none;">
            <a class="button pair1" href="javascript:void(0)" style="display: none;">Отменить</a>
        </form>
        
        <div class="passwordBlock">
            <a class="button togglePassword" href="javascript:void(0)">Изменить пароль</a>
            <form action="#" class="password">
                <table class="passwordData">
                    <tbody><tr>
                        <td>
                            Старый пароль
                        </td>
                        <td>
                            <input type="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Новый праоль
                        </td>
                        <td>
                            <input type="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Повторите пароль
                        </td>
                        <td>
                            <input type="password">
                        </td>
                    </tr>
                </tbody></table>
                <input class="pair2" type="submit" value="Сохранить">
                <a class="button pair2" href="javascript:void(0)">Отменить</a>
            </form>
        </div>
    </div>