function update_category_room(id, name) {
    show_update_category_room("block");
    show_delete_category_room("none");
    show_add_category_room("none");
    document.getElementById("id_category_room_update").value = id;
    document.getElementById("name_category_room_update").value = name;
}

function delete_category_room(id, name) {
    show_update_category_room("none");
    show_delete_category_room("block");
    show_add_category_room("none");
    document.getElementById("id_category_room_delete").value = id;
    document.getElementById("name_category_room_delete").innerHTML = name;
}


function add_category_room() {
    show_update_category_room("none");
    show_delete_category_room("none");
    show_add_category_room("block");
}

function show_update_category_room(style_view) {
    var container_button_update_category_room = document.getElementById("container_button_update_category_room");
    container_button_update_category_room.style.display = style_view;
}

function show_add_category_room(style_view) {
    var container_button_add_category_room = document.getElementById("container_button_add_category_room");
    container_button_add_category_room.style.display = style_view;
}


function show_delete_category_room(style_view) {
    var container_button_delete_category_room = document.getElementById("container_button_delete_category_room");
    container_button_delete_category_room.style.display = style_view;
}