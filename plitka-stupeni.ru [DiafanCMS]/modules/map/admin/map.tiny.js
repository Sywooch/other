var diafan_init_elem=false;

function diafan_map(elem,parent_id)
{
    $.ajax({
        url : tinymce.documentBaseURL,
        type : 'POST',
        dataType : 'html',
        data : {
            action: "tiny_list",
            module: 'map',
            parent_id: parent_id,

        },
        success : (function(response)
        {
            elem.append(response);

            if(!diafan_init_elem)
            {

                $("#diafan_map").on('click','a.plus',function()
                {
                    var li=$(this).parent("li");
                    var parent_id=parseInt(li.attr("site_id"),10);

                    diafan_map(li,parent_id);

                    $(this).removeClass("plus").addClass("expand").text("—");

                    return false;
                });

                $("#diafan_map").on('click','a.expand',function()
                {
                    var li=$(this).parent("li");
                    var parent_id=parseInt(li.attr("site_id"),10);

                    $("#diafan_map").find("ul[parent_id="+parent_id+"]").remove();
                    $(this).removeClass("expand").addClass("plus").text("+");

                    return false;
                });

                $("#diafan_map").on('click','a.link',function()
                {
                    $("#href").val($(this).attr("href"));
                    return false;
                });


                diafan_init_elem=true;
            }
        })
    });
}

tinyMCEPopup.onInit.add((function(){ diafan_map($('#general_panel'),0); }));