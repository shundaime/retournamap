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
    div.scrollTop = div.scrollHeight; //Fait descendre le scroll à son niveau maximum
};

var $collectionHolder;

// setup an "add" link
var $addContractButton = $('<button type="button" class="add-link" title="Ajouter un contrat">+</button>');
var $newLinkLi = $('<div></div>').append($addContractButton);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of tags
    $collectionHolder = $('div.contracts');

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // add a delete link to all of the existing tag form li elements
    $collectionHolder.find('li').each(function() {
        addTagFormDeleteLink($(this));
    });

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addContractButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });
});


function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    var prototypePdfFile = $collectionHolder.data('prototype-pdf-file');
    var prototypeName = $collectionHolder.data('prototype-name');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('.contracts').append('<li class="col-md-6">'+prototypePdfFile+'</li><li class="col-md-5">'+prototypeName+'</li>')
    $newLinkLi.before($newFormLi);

    addTagFormDeleteLink($newFormLi);
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button">Supprimer</button>');
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}








