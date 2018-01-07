
<form action="" class="form cart" style="margin-bottom:50px;" data-session="{php} echo session_id(); {/php}">

                    <div class="table-responsive">
                        <table class="table">
                        
                        {php}
                       // echo "<pre>";
                       // print_r($this->page);
                       // echo "</pre>";
                        {/php}
                        	
                        
                        
                        
                        	{php}
                            $summ=0;
                            
                            if(count($this->page->cart)==0){
                            echo "Корзина пуста";
                            };
                            
                            foreach($this->page->cart as $value){
                            {/php}
                        	
                        
                        
                            <tr id="{php} echo $value['id'];  {/php}">
                                <td class="cart-product_img_wrapp">
                                    <img class="cart-product_img" src="{php} echo str_replace('[dir]','original',$value['image']); {/php}" alt="">
                                </td>
                                <td class="cart-product_info">
                                    <p>Артикул: {php} echo $value['art']; {/php}</p>
                                    <p><strong>{php} echo $value['title']; {/php}</strong></p>
                                    <p class="cart-product_size">{php} echo $value['size']; {/php}</p>
                                    <p class="cart-product_price">{php} echo $value['price']; {/php} P</p>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="cart-product_num" value="{php} echo $value['count']; {/php}">м2
                                </td>
                                <td class="text-right cart-product_final_price"><span>{php} echo $value['price']*$value['count']; 
                                $summ=$summ+($value['price']*$value['count']); {/php}</span> р.</td>
                                <td><button type="button" class="close-sm delete_btn" 
                                data-id="{php} echo $value['id'];  {/php}" data-type="{php} echo $value['type']; {/php}" 
                                data-session="{php} echo session_id(); {/php}"></button></td>
                            </tr>
                            
                            {php}
                            }
                            {/php}
                            
                            
                            
                            <tr class="cart-final_price">
                                <td colspan="4" class="text-right">Всего <span>{php} echo $summ; {/php}</span> Р</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>

                    <h2>Оформить заказ</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="name5">Имя</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="name5" name="name" placeholder="Введите имя" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="phone5">Телефон</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" id="phone5" name="phone" placeholder="+7">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="message5">Комментарий</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="" id="message5" name="message" placeholder="Ваш комментарий"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit">Отправить заказ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

