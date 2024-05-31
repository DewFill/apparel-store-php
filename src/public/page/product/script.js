$(document).ready(function () {
    $('.item_container .item_image_container .multiply_img_container img').on('click', function(){
        minif_img = $(this)
        style= null
        img_src = $(this).attr('src')
        minif_img.parent().find('img').each(function() {
            if($(this).attr('style') !== undefined){
                style = $(this).attr('style')
                $(this).attr('style', null)
                
            }
        })
        minif_img.attr('style', style)
        $('.item_container .item_image_container .main_image img').attr('src', img_src)
    })
    $('.item_container .item_inform_container .item_color_contaiter span').on('click', function(){
        $(this).parent().find('span').removeClass('active')
        $(this).addClass('active')
    })
    $('.item_container .item_inform_container .item_info_container img').on('click', function(){
        $(this).parent().toggleClass('closed')
    })
    $('.item_container .item_inform_container .top_item_container img').on('click', function(){
        path = $(this).attr('src').substring(0,$(this).attr('src').search($(this).attr('src').substr(-13)))
        if($(this).attr('src').substr(-13) === `hered_ico.svg`)
            $(this).attr('src', `${path}heart_ico.svg`)
        else $(this).attr('src', `${path}hered_ico.svg`)
    })
})