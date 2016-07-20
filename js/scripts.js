$(document).ready(function(){
    $('form').submit(function(){
        var form = $(this);
        //Проверка полей на не пустоту для старых браузеров
        var error = '';
        form.find('.required input').each(function(){
            if( !$(this).val().length )
            {
                error = error + 'Поле "'+$(this).closest('label').text()+'" обязательно к заполнению<br>';
                if( !error.length ) $(this).focus();
                
            }                
        });
        //Проверка поля емайла на валидность для старых браузеров
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        if(!pattern.test($('input[type=email]').val()) && $('input[type=email]').val().length){
            error = error + 'Поле "E-mail" неверного формата.';
            if( !error.length ) $('input[type=email]').focus();
        }
        if( error.length )
        {
            $('.message').addClass('error').html(error).show();
        }
        else {
            $.ajax({
                url: form.attr("action"),
                data: form.serialize(),
                method: "POST",
                success: function( result ) {
                    var msg = JSON.parse ( result );
                    if(msg.success) $('.message').removeClass('error').html('ok:'+msg.message).show();
                    else $('.message').addClass('error').html('error:'+msg.message).show();
                }
            });
            
        }
        return false;
    });
})