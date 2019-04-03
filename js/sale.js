function update_sale(id, fecha, id_usuario) {
    console.log(id, fecha, id_usuario);
    show_update_category_room("block");
    show_delete_category_room("none");
    show_add_category_room("none");
    document.getElementById("id_sale_update").value = id;
    document.getElementById("date_sale_update").value = fecha;

}

function delete_sale(id, fecha, id_usuario, all) {
    show_update_category_room("none");
    show_delete_category_room("block");
    show_add_category_room("none");
    document.getElementById("date_sale_delete").innerHTML = fecha;
    document.getElementById("all_sale_delete").innerHTML = "$ " + all;
    document.getElementById("name_users_sale_delete").innerHTML = id_usuario;
    document.getElementById("id_sale_delete").value = id;
}

function add_sale() {
    show_update_category_room("none");
    show_delete_category_room("none");
    show_add_category_room("block");

}


function show_update_category_room(style_view) {
    var container_button_update_category_room = document.getElementById("container_button_update_sale");
    container_button_update_category_room.style.display = style_view;
}

function show_add_category_room(style_view) {
    var container_button_add_category_room = document.getElementById("container_button_add_sale");
    container_button_add_category_room.style.display = style_view;
}


function show_delete_category_room(style_view) {
    var container_button_delete_category_room = document.getElementById("container_button_delete_sale");
    container_button_delete_category_room.style.display = style_view;
}