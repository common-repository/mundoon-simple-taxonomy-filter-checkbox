jQuery(document).ready(function(){
    $ = jQuery;
    var box = $('.box-filters');
    var boxes = [];
    $(box).each(function(i) {
        boxes = $(box[i]).attr('id');
        var seletor = "#" + boxes;
        function verifica(){
            var valor = $(seletor + " input:hidden").val();
            if (valor != "") {
                $(seletor + " input:hidden").removeAttr('disabled');
            }else{
                $(seletor + " input:hidden").attr('disabled', 'disabled');
            }
        }
        verifica();
        $(seletor + " input:checkbox").on('change',function(){
            ids = [];
            $(seletor + " input:checkbox:checked").map(function(){
                ids.push($(this).val());
            });
            $(seletor + " input:hidden").val(ids);
            verifica();
            $("#mo-search").submit();
        });
    });
})