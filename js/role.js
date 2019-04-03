function update_role(id, name,sele) {
    show_update_category_room("block");
    show_delete_category_room("none");
    show_add_category_room("none");
    document.getElementById("id_role_update").value = id;
    document.getElementById("name_role_update").value = name;
    console.log(sele);

    for(var i=0;i<document.getElementsByClassName("radio_btn").length;i++)
    {
        console.log(document.getElementsByClassName("radio_btn")[i].value);
        if(document.getElementsByClassName("radio_btn")[i].value==sele){          
            document.getElementsByClassName("radio_btn")[i].checked=true;
            console.log("hola");
        }else {
            console.log("no");
        }
    }
}

function delete_role(id, name) {
    show_update_category_room("none");
    show_delete_category_room("block");
    show_add_category_room("none");
    document.getElementById("id_role_delete").value = id;
    document.getElementById("name_role_delete").innerHTML = name;
}

function add_role() {
    show_update_category_room("none");
    show_delete_category_room("none");
    show_add_category_room("block");

}


function show_update_category_room(style_view) {
    var container_button_update_category_room = document.getElementById("container_button_update_role");
    container_button_update_category_room.style.display = style_view;
}

function show_add_category_room(style_view) {
    var container_button_add_category_room = document.getElementById("container_button_add_role");
    container_button_add_category_room.style.display = style_view;
}


function show_delete_category_room(style_view) {
    var container_button_delete_category_room = document.getElementById("container_button_delete_role");
    container_button_delete_category_room.style.display = style_view;
}