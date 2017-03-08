(function($) {
    $(function() {

        $('#top').on('tabinit', function() {
            $('#sample1').carousel3d();
        });

        $('#options').on('tabinit', function() {
            $('#sample2').carousel3d( {
                perspective: 1500
            });
            $('#sample3').carousel3d( {
                duration: 5000
            });
            $('#sample4').carousel3d( {
                width: 800
            });
            $('#sample5').carousel3d( {
                progress: false
            });
            $('#sample6').carousel3d( {
                controller: false
            });
            $('#sample7').carousel3d( {
                prevText: '前へ'
            });
            $('#sample8').carousel3d( {
                nextText: '次へ'
            });
        });

        $('#methods').on('tabinit', function() {
            $('#sample7').carousel3d();
            $('#method-next-btn').on('click', function() {
                $('#sample7').carousel3d('next');
            });

            $('#sample8').carousel3d();
            $('#method-prev-btn').on('click', function() {
                $('#sample8').carousel3d('prev');
            });

            $('#sample9').carousel3d();
            $('#method-move-btn').on('click', function() {
                $('#sample9').carousel3d('move', 8);
            });

            $('#sample10').carousel3d();
            $('#method-refresh-btn').on('click', function() {
                $('#sample10').carousel3d('refresh', {
                    perspective: 800,
                    duration: 100,
                    width: 200,
                    progress: false
                });
            });

            $('#sample11').carousel3d();
            $('#method-destroy-btn').on('click', function() {
                $('#sample11').carousel3d('destroy');
            });
        });

        $('.pure-menu-heading').click();
    });
}(jQuery));