function update_sale_category(id, articulo, precio, cantidad, id_article, name_article) {
    console.log(id, articulo, precio, cantidad, id_article);
    show_update_category_room("block");
    show_delete_category_room("none");
    show_add_category_room("none");
    document.getElementById("id_category_room_update").value = id;
    document.getElementById("name_article_sale_article_update").innerHTML = name;
    document.getElementById("quality_article_sale_article_update").value = cantidad;
    document.getElementById("before_quantity_article_sale_article_update").value = cantidad;
    document.getElementById("name_article_sale_article_update").innerHTML = name_article;
    document.getElementById("article_update").value = id_article;
}

function delete_sale_category(id, articulo, precio, cantidad, id_article, name_article) {
    show_update_category_room("none");
    show_delete_category_room("block");
    show_add_category_room("none");
    document.getElementById("id_sale_article_delete").value = id;
    document.getElementById("name_article_sale_article_delete").innerHTML = name;
    document.getElementById("price_article_sale_article_delete").innerHTML = "$ " + precio;
    document.getElementById("quality_article_sale_article_delete").innerHTML = cantidad;
    document.getElementById("all_sale_article_delete").innerHTML = "$ " + (cantidad * precio);
    document.getElementById("article_id_delete").value = id_article;
    document.getElementById("quantity_delete").value = cantidad;
    document.getElementById("name_article_sale_article_delete").innerHTML = name_article;
}

function add_sale_category() {
    show_update_category_room("none");
    show_delete_category_room("none");
    show_add_category_room("block");

}


function show_update_category_room(style_view) {
    var container_button_update_category_room = document.getElementById("container_button_update_sale_article");
    container_button_update_category_room.style.display = style_view;
}

function show_add_category_room(style_view) {
    var container_button_add_category_room = document.getElementById("container_button_add_sale_article");
    container_button_add_category_room.style.display = style_view;
}


function show_delete_category_room(style_view) {
    var container_button_delete_category_room = document.getElementById("container_button_delete_sale_article");
    container_button_delete_category_room.style.display = style_view;
}