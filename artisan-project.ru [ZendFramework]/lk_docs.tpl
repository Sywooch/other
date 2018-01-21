 <link rel="stylesheet" href="/public/site1/lk/styles/pretenzii.css">
 <div class="mainPart zeroBox" style="min-height:600px;">
        <h1>Документы
        {php} 
        if(isset($_GET['folder'])){
        {/php}
            <a class="docs_back" href="/requests/docs/" style="color:#3c3f45; text-decoration:underline;">НАЗАД К СПИСКУ</a>
        {php}
        }	        
        {/php}
        </h1>
        {php} 
        if(isset($_GET['folder'])){
        {/php}
        <div style="clear:both;"></div>
        <span class="docs_name"  style="color:#3c3f45; text-decoration:none; font-size:22px; 
        margin-top:-5px; margin-bottom:20px; display:inline-block; text-transform:none;">{$folder_name}</span>
        {php}
        }	        
        {/php}
        <div class="personal_table">
            <ul>
            	
                {php}
                if(isset($_GET['folder'])){
                {/php}
                
                {foreach from=$docs item=doc name=doc}
               		<li style="margin-bottom:15px;"><a target="_blank" href="/requests/download/?link={$doc.file}" style=" color: #363636; border-bottom: 1px solid #47bdd4; text-decoration: none; font-size:14px; font-style: italic;">{$doc.title}</a><span style="font-style: italic; font-size:14px;">{$doc.ext}</span><br>
					</li>
                {/foreach}
               	
                {php}
                }else{
                {/php}
            	{foreach from=$folders item=doc name=doc}
               		<li><a href="{php} echo $_SERVER['REQUEST_URI']; {/php}?folder={$doc.id}" style=" color: #363636; border-bottom: 1px solid #47bdd4; text-decoration: none;">{$doc.title}</a><span style="font-style: italic;"></span><br>
					</li>
                {/foreach}
               	{php}
                }
                {/php}
                
            </ul>
        </div>
    </div>