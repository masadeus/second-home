/**
 * scripts.js
 *
 * Second Home.
 *
 * Global JavaScript.
 */
 
var new_sp = "new_space0";

var form_item = '';

/**
 * fills form_item
 */
function form(cat) {
	
    form_item = '<div id="clear_' + cat + '" style="clear: both;"></div><form id="form_' + cat + '" class="get_in form_items" onsubmit="append_div_item(\'' + cat + '\'); add_q_i(\'' + cat + '\'); return false;"><input id="quantity_' + cat + '" class="add_field_quantity" name="quantity" placeholder="Quantity" autocomplete="off" autofocus/><input id="item_' + cat + '" class="add_field_item" name="item" placeholder="Item" autocomplete="off"/><input id="category_' + cat + '" type="hidden" name="category" value="' + cat + '"/><input type="submit" name="submit" value="Add" id="add_btn" /></form>';
}

/**
* Opens a div (h3) for each new category.
* Asigns a unique value.
+ Adds category to DB.
*/
function add_cat(cat) {

    cat = cat.toLowerCase();

    // erases spaces
    cat = cat.replace(/\s+/g, '')

    // validate submission
    if (!cat) {
        alert('Writte down the new category and press enter');
        $('#new_category').focus();
        return false;
    }

    var re = /[\u0028\u0029\u00C0-\u1FFF\u2C00-\uD7FF\w ]+$/;

    if (!re.test(cat)) {
        alert("Categories should only contain alphanumeric values");
        $('#new_category').val(''); // clears field after submission
        $('#new_category').focus();
        return false;
    }

    // checks if category already exists
    if (document.getElementById("title_" + cat)) {
        alert('The category "' + cat + '" already exists');
        $('#new_category').val('');
        return false;
    }

    // creates the new div for the list
    var list_div = document.createElement("div");
    list_div.id = "list_" + cat;
    list_div.className = "group";

    hash_list_div = "#" + list_div.id;

    var title_div = document.createElement("div");
    title_div.id = "title_" + cat;

    hash_title_div = "#" + title_div.id;

    // checks how many h3 elts in DOM
    var nodelist = document.getElementsByTagName("h3").length;
    var node = document.createElement("h3");
    node.id = "new_space" + nodelist;
    new_sp = "#" + node.id;
    node.className = "get_in";


    $("#categories").append(list_div);
    $(hash_list_div).append(title_div);
    $(hash_title_div).append(node);


    $(hash_list_div).append(form_item);

    // erases category
    var trash_icon = '<form onsubmit="erase_category(\'' + cat + '\'); return false;"><button class="ion-trash-b trash_category" contenteditable="false"></button></form>';

    // appends erase category
    var trash_cat_app = "title_" + cat;
    $('#title_' + cat).append(trash_icon);

    // adds category to DB
    var url = 'add_category.php?category=' + cat;

    $.getJSON(url, function(data) {
        $(new_sp).html(data[0].category);
        $('#new_category').val('');
    });
}

/**
 * Opens a div for each new item.
 * Assigns a unique value
 */
function append_div_item(cat) {

    var quantity = $('#quantity_' + cat).val();
    var item = $('#item_' + cat).val().toLowerCase();

    // validate submission
    if (isNaN(quantity)) {
        alert('Quantity must be a number');
        $('#quantity_' + cat).val('');
        $('#quantity_' + cat).focus();
        return false;
    }

    if (!item) {
        alert('Writte down the new item and press enter');
        $('#item_' + cat).focus();
        return false;
    }

    var re = /[\u0028\u0029\u00C0-\u1FFF\u2C00-\uD7FF\w ]+$/;

    if (!re.test(item)) {
        alert("Items should only contain alphanumeric values");
        $('#item_' + cat).val(''); // clears filed after submission
        $('#item_' + cat).focus();
        return false;
    }

    // if "list_in_" + cat doesn't exist it must be appended. It's the case when the cat has been asynchronously added
    var hash_list_cat = "#" + "list_in_" + cat;
    var list_cat = "list_in_" + cat;
    var li_exist = document.getElementById(list_cat);
    var list_in;

    var item_app_point = "clear_" + cat;

    // if(!hash_list_cat) append it
    if (!li_exist) {
        list_in = document.createElement("div");
        list_in.id = list_cat;
        list_in.className = "list";
        $("#" + item_app_point).before(list_in);
    }

    // counts items in list
    var list_count = $(hash_list_cat).children("ul").length;
    list_count += 1;

    // checks if item already exists in category
    for (var i = 1; i < list_count; i++) {
        if (($('#i_' + cat + '_' + i).html()) == item) {
            alert('This item already exists in ' + cat.toUpperCase() + '.\n\nPlease click the edit button if you want to change the quantity');
            $('#quantity_' + cat).val(''); // clear field after submission
            $('#item_' + cat).val('');

            $('#quantity_' + cat).focus();
            return false;
        }
    }

    // checks if item exists in all categories

    // counts categories
    var n_cats = $('#categories').children('div').length;

    // queries
    url_cats = 'query_cat.php';

    $.getJSON(url_cats, function(data) {
        for (var i = 0; i < n_cats; i++) {
            var cat_temp = data[i].category;

            var hash_list_cat_temp = "#" + "list_in_" + cat_temp;
            var list_count_temp = $(hash_list_cat_temp).children("ul").length;

            for (var j = 1; j <= list_count_temp; j++) {

                if (($('#i_' + cat_temp + '_' + j).html()) == item && cat_temp != cat) {
                    alert('Be aware that "' + item + '" already exists in ' + cat_temp.toUpperCase());
                    $('#quantity_' + cat).val(''); // clears field after submission
                    $('#item_' + cat).val('');
                    $('#quantity_' + cat).focus();
                }
            }

        }
    });

    // creates ul div to be counted by list_count
    var pair = document.createElement("ul");
    pair.id = "pair_" + cat + "_" + list_count;
    pair.className = "get_in";

    // appends pair to DOM
    $(hash_list_cat).append(pair);

    // # + id to append the elements q and i
    var hash_pair = "#" + pair.id;

    // creates fields and assign id 
    var field_q = document.createElement("li");
    field_q.id = "q_" + cat + "_" + list_count;

    var field_i = document.createElement("li");
    field_i.id = "i_" + cat + "_" + list_count;

    // assigns class
    field_q.className = "quantity";
    field_i.className = "item";

    // variable for function(data) in JSON call
    hash_field_q = "#" + field_q.id;
    hash_field_i = "#" + field_i.id;

    // appends new space. disable class="get_in" in order to see
    $(hash_pair).append(field_q);
    $(hash_pair).append(field_i);

    var i_erase = $('#item_' + cat).val();

    // appends erase item
    var trash_icon = '<form onsubmit="erase_item(\'' + i_erase + '\', \'' + cat + '\', \'' + list_count + '\'); return false;"><button class="ion-trash-b trash_item" contenteditable="false"></button></form>';

    $(hash_pair).append(trash_icon);

    // appends pencil icon
    $(hash_pair).append($('<button />', {
        "class": "ion-edit edit_item",
        "contenteditable": "false",
        click: function() {

            $(hash_field_q).attr('contenteditable', 'true');

            smart_edit(hash_field_q, hash_field_i, cat, hash_pair);

            $(this).hide();
        }
    }));

    $(hash_field_q).on('keydown', function(ev) {
        if (ev.keyCode === 13) return false;
    })

    $('#quantity_' + cat).focus();
}

/**
 * Pencil icon
 */
function pencil(cat, i_count) {

    var hash_pair = '#pair_' + cat + '_' + i_count;
    var hash_field_q = '#q_' + cat + '_' + i_count;
    var hash_field_i = '#i_' + cat + '_' + i_count;
    var hash_pen_but = '#b_' + cat + '_' + i_count;

    $(hash_field_q).attr('contenteditable', 'true');

    smart_edit(hash_field_q, hash_field_i, cat, hash_pair);

    $(hash_pen_but).hide();

    $(hash_pair).on('keydown', function(ev) {
        if (ev.keyCode === 13) return false;
    })

}

/**
 * AJAX. Asynchronously adds quantity and item
 */
function add_q_i(cat) {

    var quantity = $('#quantity_' + cat).val();
    var item = $('#item_' + cat).val();

    // security checks
    if (isNaN(quantity)) {
        quantity = 0;
    }

    if (!item) {
        return false;
    }

    // only alphanumeric characters and spaces
    var re = /[\u0028\u0029\u00C0-\u1FFF\u2C00-\uD7FF\w ]+$/;

    if (!re.test(item)) {
        return false;
    }

    var url = 'add_item.php?category=' + cat + '&' + 'quantity=' + $('#quantity_' + cat).val() + '&' + 'item=' + $('#item_' + cat).val();

    $.getJSON(url, function(data) {

        $(hash_field_q).html(data[0].quantity);
        $(hash_field_i).html(data[0].item);

        // clear field after submission
        $('#quantity_' + cat).val('');
        $('#item_' + cat).val('');
    });
}

function erase_item(item, cat, count) {
    hash_pair = "#pair_" + cat + "_" + count;
    var url = 'erase_item.php?category=' + cat + '&item=' + item;

    $.getJSON(url, function(data) {
        $(hash_pair).addClass('get_out')
            .one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
                $(this).remove();
            });
    });
}

function erase_category(cat) {

    cat_id = "#list_" + cat;
    var url = 'erase_category.php?category=' + cat;
    var exist = $("#list_in_" + cat).children().length;

    // checks if category has items
    if (exist > 0) {
        if (confirm("This category contains items which will be erased too.\n\n Do you want to proceed?")) {

            $.getJSON(url, function(data) {
                $(cat_id).addClass('get_out')
                    .one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
                        $(this).remove();
                    });
            });
        } else {
            return false;
        }
    } else {
        $.getJSON(url, function(data) {
            $(cat_id).addClass('get_out')
                .one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e) {
                    $(this).remove();
                });
        });
    }
}

// smart_editing
function smart_edit(q, i, cat, p) {

    $(q).focus()
        .addClass("q_focus");

    $(p).append($('<button />', {
        "class": "ion-refresh save_edited",
        "id": "refr_" + q,
        click: function() {

            $(q).attr('contenteditable', 'false');

            var newcontent_q = $(q).text();
            var newcontent_i = $(i).text();

            var url = 'edit_item.php?category=' + cat + '&' + 'quantity=' + newcontent_q + '&' + 'item=' + newcontent_i;

            $.getJSON(url, function(data) {
                $(q).html(data[0].quantity);
            });
            $(this).remove();
            $('.ion-edit').show();
            $(q).removeClass("q_focus");

        }
    }));
}

/**
 * Login validate submission
 */
function check_form_login(form) {

    var re = /^[\w ]+$/;
    var errors = [];

    if (!re.test(form.username.value)) {
        errors.push("· The housename should only contain alphanumeric characters and spaces");
    }

    if (form.password.value == "") {
        errors.push("· Please enter your password");
    }

    if (errors.length > 0) {
        var msg = "";
        for (var i = 0; i < errors.length; i++) {
            msg += errors[i] + "\n\n";
        }
        alert(msg);
        return false;
    }

    //validation was sucessful
    return true;
}

/**
 * Register validate submission
 */
function check_form_reg(form) {

    var errors = [];

    // only alphanumeric characters and spaces
    var re = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    // validates
    if (!re.test(form.email.value) && form.email.value != "") {
        errors.push("· Invalid email address");
    }

    if (form.password.value.length < 4 || form.password.value.length > 10) {
        errors.push("· The password length must be between 4 and 10 characters");
    } else if (form.password.value != form.confirmation.value) {
        errors.push("· Passwords don't match");
    }

    if (errors.length > 0) {
        var msg = "";
        for (var i = 0; i < errors.length; i++) {
            msg += errors[i] + "\n\n";
        }
        alert(msg);
        return false;
    }

    //validation sucessful
    return true;
}



function check_houses(form) {
    var url = 'login.php?username=' + form.username.value + '&passsword=' + form.password.value;

    console.log(url);

    $.getJSON(url, function(data) {
        if (data[0]) {
            return true;
        } else {
            alert("Invalid housename and/or password.");
            console.log('pw no correcte');
            return false;
        }
    });

}

/**
 * Scrolls dow the page
 */
$(document).ready(function() {
    function filterPath(string) {
        return string
            .replace(/^\//, '')
            .replace(/(index|default).[a-zA-Z]{3,4}$/, '')
            .replace(/\/$/, '');
    }
    var locationPath = filterPath(location.pathname);
    var scrollElem = scrollableElement('html', 'body');

    $('a[href*=#]').each(function() {
        var thisPath = filterPath(this.pathname) || locationPath;
        if (locationPath == thisPath && (location.hostname == this.hostname || !this.hostname) && this.hash.replace(/#/, '')) {
            var $target = $(this.hash),
                target = this.hash;
            if (target) {
                var targetOffset = $target.offset().top;
                $(this).click(function(event) {
                    event.preventDefault();
                    $(scrollElem).animate({
                        scrollTop: targetOffset
                    }, 1200, function() {
                        location.hash = target;
                    });
                });
            }
        }
    });

    // use the first element that is "scrollable"
    function scrollableElement(els) {
        for (var i = 0, argLength = arguments.length; i < argLength; i++) {
            var el = arguments[i],
                $scrollElement = $(el);
            if ($scrollElement.scrollTop() > 0) {
                return el;
            } else {
                $scrollElement.scrollTop(1);
                var isScrollable = $scrollElement.scrollTop() > 0;
                $scrollElement.scrollTop(0);
                if (isScrollable) {
                    return el;
                }
            }
        }
        return [];
    }
});