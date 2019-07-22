"use strict";
window.onload = function () {

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

$(window).scroll(function () {
    ScrollToTop();
    StopAnimation();
});

    var div = document.getElementById('scroll');
    if (div) {
        div.scrollTop = div.scrollHeight; //Fait descendre le scroll à son niveau maximum
    }
};

var $contracts;

// setup an "add" link
var $addContractButton = $('.add-contract-btn');

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    $contracts = $('div.contracts');

    // add the "add a tag" anchor and li to the tags ul
    //$contracts.append($newLinkLi);

    // add a delete link to all of the existing tag form li elements
    $contracts.find('.contract').each(function() {
        addContractFormDeleteBtn($(this));
    });

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $contracts.data('index', $contracts.find('.contract').length); // là on est bon je pense ok  epna frai t sans le -1

    // au clic du bouton "add contract", on insère un formulaire de contrat à la volée
    $addContractButton.on('click', function(e) {
        addContractForm($contracts);
    });

    // Au clic d'un bouton delete d'un form de contrat, on supprime le formulaire
    $('.delete-contract-form-btn').on('click', function(e) {
        var index = parseInt($(this).data('index'));
        // remove the li for the tag form
        $('.contract[data-index='+index+']').remove();
    });
});

// On ajoute le formulaire d'un contrat
function addContractForm($contracts) {
    // Get the data-prototype explained earlier
    var prototypePdfFile = $contracts.data('prototype-pdf-file');
    var prototypeName = $contracts.data('prototype-name');

    // get the new index
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
    var $newContractForm = $('<div class="contract row" data-index="'+index+'"><div class="col-md-5">'+pdfFileWidget+'</div><div class="col-md-6">'+nameWidget+'</div></div>');
    $('.contracts').append($newContractForm);

    addContractFormDeleteBtn($newContractForm, index);
}

// on fait apparaitre le bouton delete quand on ajoute un contrat à la volée
function addContractFormDeleteBtn($newContractForm, index) {
    var $removeFormButton = $('<button type="button" class="delete-contract-form-btn contract-btn" data-index="'+index+'">-</button>');
    $newContractForm.append($removeFormButton);
}








