(function($) {

    $('#menu').find('a').on('click', function(e) {
        var $link = $(e.currentTarget),
            $content = $($link.attr('href')),
            displayFlag = $content.data('display-flag') || false;

        e.preventDefault();

        $('#menu').find('li').removeClass('menu-item-selected');
        $link.parent().addClass('menu-item-selected');

        $('#main').children('.content').removeClass('content-item-selected');
        $content.addClass('content-item-selected');

        if(!displayFlag) {
            $content.data('display-flag', true);
            $content.trigger('tabinit');
        }
    });

    $('#main').find('.smooth-scroll').on('click', function(e) {
        var $link = $(e.currentTarget),
            $target = $($link.attr('href'));

        $('html, body').animate( {
            scrollTop: $target.position().top
        });

        e.preventDefault();
    });

}(jQuery));