let $collectionHolder;

// setup an "add a item" link
let $addTagLink = $('<hr><button type="button" class="float-right btn btn-sm btn-info add_item_link"><i class="fa fa-plus" aria-hidden="true"></i></a>');
let $newLinkLi = $('<div></div>').append($addTagLink);

jQuery(document).ready(function () {
    // Get the ul that holds the collection of items
    $collectionHolder = $('#wish_list_items');

    // add the "add a item" anchor and li to the items ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTagLink.on('click', function (e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new item form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });

    $collectionHolder.find("div[id^='wish_list_items_']").each(function () {
        addTagFormDeleteLink($(this));
    });
});

function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    let prototype = $collectionHolder.data('prototype');

    // get the new index
    let index = $collectionHolder.data('index');

    let newForm = prototype;
    // You need this only if you didn't set 'label' => false in your items field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    $newLinkLi.before(newForm);

    // add a delete link to the new form
    addTagFormDeleteLink($newLinkLi.prev().find("div[id^='wish_list_items_']"));
}

function addTagFormDeleteLink($tagFormLi) {
    let $removeFormA = $('<button type="button" class="float-right btn btn-sm btn-danger add_item_link"><i class="fa fa-trash" aria-hidden="true"></i></a>');
    $tagFormLi.prepend($removeFormA);

    $removeFormA.on('click', function (e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}