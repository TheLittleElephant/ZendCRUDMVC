$(document).ready(function () {

    if ($((".accordion"))) {
        $('.ui.accordion').accordion();
    }
    
    if($("input#dateEmbauche")) {
        $date = $("input#dateEmbauche").val();
        $("input#dateEmbauche").val(moment($date).format("DD/MM/YYYY"));
        $('input#dateEmbauche').daterangepicker({singleDatePicker: true, opens: 'center', drops: 'up', format: "DD/MM/YYYY"});
        
    }
    
    $(".supprimer").on("click", function() {
        modal = $(this).attr('data-modal');
        $('#' + modal + '.modal').modal('show');
    });

    $('.button').on('click', function () {
        modal = $(this).attr('data-modal');
        $('#' + modal + '.modal').modal('show');
        console.log(modal);

        $.get("http://localhost/zfcrudmvc/public/ws?method=getLanguesParlees&arg=" + modal, function (xml) {
            console.log(xml);
            var liste = $('<ul class="ui bulleted list"></ul>');
            $(".ui.segment").addClass("loading");
            $(xml).find('Langue').each(function () {
                if ($(this).find("libelle").text() != "") {
                    liste.append($('<li class="item">' + $(this).find('libelle').text() + '</li>'));
                }
            });

            if (liste.find("li").length < 1) {
                liste = "Aucune langue étrangère n'est parlée par ce médecin";
            }

            if ($.find("#" + modal)) {
                $(".modal > .content > .segment").html(liste);
                $(".ui.segment").removeClass("loading");
            }
        });
    });
});
