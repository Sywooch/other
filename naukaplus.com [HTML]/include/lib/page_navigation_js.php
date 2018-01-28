<?php
#
#     постранчная навигация(JS)
#




$_pagenaviagation['javascript']         = "<script language='JavaScript' type=\"text/javascript\">
<!--
function multi_page_jump( url_bit, total_posts, per_page, link_type )
{
pages = 1; cur_st = parseInt(\"{STFIRST}\"); cur_page  = 1;
if ( total_posts % per_page == 0 ) { pages = total_posts / per_page; }
 else { pages = Math.ceil( total_posts / per_page ); }
msg = \"Пожалуйста, введите номер страницы (от 1 до \" + pages + \") на которую вы хотите перейти.\";
if ( cur_st > 0 ) { cur_page = cur_st / per_page; cur_page = cur_page -1; }
show_page = 1;
if ( cur_page < pages )  { show_page = cur_page + 1; }
if ( cur_page >= pages ) { show_page = cur_page - 1; }
 else { show_page = cur_page + 1; }
userPage = prompt( msg, show_page );
if ( userPage > 0  ) {
        if ( userPage < 1 )     {    userPage = 1;  }
        if ( userPage > pages ) { userPage = pages; }
        if ( userPage == 1 )    {     link_type='/'; userPage = '';    }
        else { start = (userPage - 1) * per_page; }

        window.location = url_bit + link_type + userPage;
}
}
//-->
</script>";


$_pagenaviagation['javascript_revert']         = "<script language='JavaScript' type=\"text/javascript\">
<!--
function multi_page_jump( url_bit, total_posts, per_page, link_type )
{
pages = 1; cur_st = parseInt(\"{STFIRST}\"); cur_page  = 1;
if ( total_posts % per_page == 0 ) { pages = total_posts / per_page; }
 else { pages = Math.ceil( total_posts / per_page ); }
msg = \"Пожалуйста, введите номер страницы (от \" + pages + \" до 1) на которую вы хотите перейти.\";
if ( cur_st > 0 ) { cur_page = cur_st / per_page; cur_page = cur_page -1; }
show_page = 1;
if ( cur_page < pages )  { show_page = cur_page + 1; }
if ( cur_page >= pages ) { show_page = cur_page - 1; }
 else { show_page = cur_page + 1; }
userPage = prompt( msg, show_page );
if ( userPage > 0  ) {
        if ( userPage < 1 )     {    userPage = 1;  }
        if ( userPage > pages ) { userPage = pages; }
        if ( userPage == pages )    {     link_type='/'; userPage = '';    }
        else { start = (userPage - 1) * per_page; }

        window.location = url_bit + link_type + userPage;
}
}
//-->
</script>";

?>