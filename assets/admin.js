const $ = require('jquery');

$('document').ready(function(){
    console.log('ready !');
    $('.proccessBtn').click(function(e){
        e.preventDefault();
        var path = $(this).attr('href');
        $.ajax({
            url: path,
            success: function(data){
                let id = data.id;
                // recupère le td contenant l'id pour supprimer le bouton et remplacer par span
                $('#msg-'+id).html('<span class="text-primary">Traitée</span>');
            },
            error: function(xhr){
                console.log('error');
            }
        });
    });
});

