"use strict";

$(document).on('change', '.custom-file-input', function () {
    let fileName = $(this).val().replace(/\\/g, '/').replace(/.*\//, '');
    $(this).parent('.custom-file').find('.custom-file-label').text(fileName);
});

$(window).on('load', function () {
    $('#overlay').fadeOut('1500');
});

$(document).ready(function () {

    var div = document.getElementById('scroll');
    if (div) {
        div.scrollTop = div.scrollHeight; //Fait descendre le scroll à son niveau maximum
    }

    $(window).scroll(function () {
        ScrollToTop();
        StopAnimation();
    });

    var $contracts;

    // setup an "add" link
    var $addContractButton = $('.add-contract-btn');

    // On récupère la div qui contient les contrats
    $contracts = $('div.contracts');

    $contracts.data('index', $contracts.find('.contract').length);

    // Au clic du bouton "add contract", on insère un formulaire de contrat à la volée
    $addContractButton.on('click', function (e) {
        addContractForm($contracts);
    });

    $('.delete-contract-form-btn').on('click', function (e) {
        var index = parseInt($(this).data('index'));
        $('.contract[data-index=' + index + ']').remove();
    });

    $("nav a").on("click", function (event) {
        event.preventDefault();

        var href = $(this).attr("href");

        window.history.pushState(null, null, href);

        $("nav a").removeClass("active");
        $(this).addClass("active");

        $.ajax({
            url:href,
            success: function (data) {
                $("main").fadeOut(250, function () {
                    var newPage = $(data).filter("main").html();

                    $("main").html(newPage);

                    $("main").fadeIn(250)
                })
            }
        })
    });
});

// On ajoute le formulaire d'un contrat
function addContractForm($contracts) {
    // On récupère le data-prototype
    var prototypePdfFile = $contracts.data('prototype-pdf-file');
    var prototypeName = $contracts.data('prototype-name');

    // On récupère le nouvel index
    var index = $contracts.data('index');

    var pdfFileWidget = prototypePdfFile;
    var nameWidget = prototypeName;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    pdfFileWidget = pdfFileWidget.replace(/__name__/g, index);
    nameWidget = nameWidget.replace(/__name__/g, index);

    // increase the index with one for the next item
    $contracts.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newContractForm = $('<div class="contract new row" data-index="' + index + '"><div class="col-md-6">' + pdfFileWidget + '</div><div class="col-md-5">' + nameWidget + '</div></div>');
    $('.contracts').append($newContractForm);

    addContractFormDeleteBtn($newContractForm, index);
}

// on fait apparaitre le bouton delete quand on ajoute un contrat à la volée
function addContractFormDeleteBtn($newContractForm, index) {
    var $removeFormButton = $('<div class="col-md-1"><button type="button" title="Supprimer le champ" class="delete-contract-form-btn contract-btn" data-index="' + index + '">-</button></div>');
    $newContractForm.append($removeFormButton);

    // Au clic d'un bouton delete d'un form de contrat, on supprime le formulaire
    $('.delete-contract-form-btn').on('click', function (e) {
        var index = parseInt($(this).data('index'));
        $('.contract[data-index=' + index + ']').remove();
    });
}

function ScrollToTop() {
    var s = $(window).scrollTop();
    if (s > 400) {
        $('.scrollUp').fadeIn();
    } else {
        $('.scrollUp').fadeOut();
    }

    $('.scrollUp').click(function () {
        $("html, body").animate({scrollTop: 0}, 500);
        return false;
    });
}

function StopAnimation() {
    $("html, body").bind("scroll mousedown DOMMouseScroll mousewheel keyup", function () {
        $('html, body').stop();
    });
}








