$(function() {


    $('.button.edit').click(function() {
        var form = $(this).attr('data-target-form');
        var info = $(this).attr('data-target-info');
        var $form = $('#' + form);
        
        var spans = info.split(' ');
        for (var i = 0; i < spans.length; i++) {
            var $span = $('#' + spans[i]);
            $form.find('input[name=' + spans[i] + ']').val($span.text().trim());
            $form.find('select[name=' + spans[i] + '] option').filter(function() {
                return $(this).text().trim() === $span.text().trim();
            }).prop('selected', true);

            $span.hide();
        }


        $form.show();
        $(this).hide();
        $(this).siblings('a').show();
    });

    $('a#edit-preference').click(function() {
        var $info = $('.preference-hide')

        $('.preference-hide').each(function() {
            var preference = $(this);
            $('select[name=' + $(this).attr('id') + '] option').filter(function() {
                return $(this).text().trim() === preference.text().trim() ;
            }).prop('selected', true);
            $(this).hide();
        });
        $('.country-select').show();
        $(this).parent().css('margin-top', 15);
        $(this).hide();
        $(this).siblings().show();
    });

        $('.button.submit').click(function() {
        //var form = $(this).attr('data-target-form');
        var target = $(this).attr('data-target-button');
        //var $form = $('#' + form);
        var $target = $('#' + target);
        //$form.submit();
        if(target == "numbers-form-submit"){
            if(confirm("You are changing the size of your delegation! Please confirm this action. If you are changing the number of delegates or faculty advisors in attendance please go to you delegation page to update the names accordingly.")){
            $target.click();
            }else {
                location.reload();
            }
        }else {
            $target.click();
        }
    });

    $('#preference-submit').click(function() {
        var $form = $('#' + $(this).attr('data-target-form'));
        var $selects = $form.find('select');
        var countries = {};
        var error = false
        $selects.each(function() {
            if (error) return;
            var country = $(this).find('option').filter(function() {
                return $(this).prop('selected');
            }).text().trim();
            if (countries[country] != undefined || countries[country] != null) {
                $(this).addClass('error');
                countries[country].addClass('error');
                $(this).parent().append('<small class="error">' 
                                        + 'Country requested multiple times' +
                                        '</small>');
                countries[country].parent().append('<small class="error">' 
                                        + 'Country requested multiple times' +
                                        '</small>');
                error = true;
                return;
            }
            countries[country] = $(this);
        });
        console.log(countries);
        if (!error) {
           var target = $(this).attr('data-target-button');
            //var $form = $('#' + form);
            var $target = $('#' + target);
            $target.click();
        }
    });

    $('.country-preference').click(function() {
        var $info = $(this).find('span.info');
        var $form = $(this).find('form');

        $form.find('option').filter(function() {
            return $(this).text().trim() === $info.text().trim();
        }).prop('selected', true);

        $info.hide();
        $form.show();
        
    });

});
