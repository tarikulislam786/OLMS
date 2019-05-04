/**
 * Created by ALAMGIR on 27-Sep-15.
 */

jQuery(document).ready(function ($)
{
    $(".iframe-btn").fancybox({
        maxWidth	: 1280,
        maxHeight	: 800,
        fitToView	: false,
        width		: '95%',
        height		: '95%',
        autoSize	: false,
        closeClick	: false,
        openEffect	: 'none',
        type	    : 'iframe',
        closeEffect	: 'none'
    });

    $glo="";

    function OnMessage(e){
        var event = e.originalEvent;
        if(event.data.sender === 'responsivefilemanager'){
            $glo = event;
            if(event.data.field_id){
                var fieldID=event.data.field_id;

                var url=event.data.url;

                $('#'+fieldID).val(url).trigger('change');

                //var upload_url = $('#'+fieldID).val();
                var upload_url = $('#'+fieldID).val();
                //$("#text_uploaded_image2").val(upload_url);

                $("#text_uploaded_image").val(upload_url);

                $("#selected_preview_image").attr('src',"/wbms/public/uploads/source/"+upload_url).show();


                $.fancybox.close();
                $(window).off('message', OnMessage);
            }
        }
    }

    $('.iframe-btn').on('click',function(){
        $(window).on('message', OnMessage);
    });
});