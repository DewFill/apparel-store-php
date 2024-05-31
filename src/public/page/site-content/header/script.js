$(document).ready(function () {
    version = true
    origin = $('header').html()
    resize($(window))
    $(window).on('resize', function(){
        var win = $(this)
        resize(win)
        
    })
})
function resize(win){
    if (win.width() < 768 && version) {
        version = false
        header_toMobile()
    }else if(win.width() > 768 && version===false){
        version = true
        header_toDesktop()
    }
}
function header_toMobile(){
    header_icons_container = $('div.header_icons_container').remove()
    header_icons_container.find('a').each(function() {
        parent = $( this )
        img = $( this ).find('img')
        parent.append($('<p>',{
            'text': img.attr('alt')
        }))
    })
    header_navigator = $('nav.header_navigator').remove()
    header_search = $('form.header_search').remove()
    left_navigation_menu = $('<nav>',{
        'class': 'left_navigation_menu'
    }).append(header_navigator)
    left_navigation_header = $('<h2>', {
        'class': 'left_navigation_header',
        'text': 'Разделы'
    })
    bottom_navigation_menu = $('<nav>',{
        'class': 'bottom_navigation_menu'
    })
    bottom_navigation_menu.append(header_icons_container)
    $('body').append( bottom_navigation_menu )
    $('body').prepend( left_navigation_menu.addClass('hiden') )
 
    header_search.insertAfter($('body').find('header'))
    
    $('div.top_instrumental').append(left_navigation_header.addClass('opacity_0')).append(
        $('<button>',{
            'class': 'burger'
        }).on('click', function(){
            left_navigation_menu.toggleClass('hiden')
            left_navigation_header.toggleClass('opacity_0')
            t_btn = $(this)
            t_btn.toggleClass('closed')
            if( !t_btn.hasClass('closed')){
                $('body').append($('<div>',{
                    'class': 'back_counter'
                }).on('click', function(){
                    $(this).remove()
                    left_navigation_menu.toggleClass('hiden')
                    left_navigation_header.toggleClass('opacity_0')
                    t_btn.toggleClass('closed')
                }))
            }else{
                $('body').find('.back_counter').remove()
            }
        }).addClass('closed')
    )

}
function header_toDesktop(){
    $('body').find('.header_search').remove()
    $('body').find('.bottom_navigation_menu').remove()
    $('body').find('.left_navigation_menu').remove()
    $('body').find('.back_counter').remove()
    $('header').html(origin)
}