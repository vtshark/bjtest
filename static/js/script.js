var ROOT = "http://localhost/bjtest/";
//var ROOT = "/";

function closePreview() {
    $("#div-preview").hide();
}

$(document).ready(function() {

    $(".btn-danger").on("click", function (e) {
        if (confirm("Удалить сообщение?")) {
            var id = e.target.id;
            id = id.replace(/del/g, "");
            var url = ROOT + "main/delMsg/";
            $.post(url, {id: id},
                function (res) {
                    console.log(res);
                    $("#div-msg"+id).hide();
                });
        }
    });

    $(".btn-success").on("click", function (e) {
        var id = e.target.id;
        id = id.replace(/moder/g, "");
        var url = ROOT + "main/moder/";
        $.post(url, {id: id},
            function (res) {
                $("#div-moder"+id).html("принят");
            });
    });

    $(".btn-warning").on("click", function (e) {
        var id = e.target.id;
        id = id.replace(/not-moder/g, "");
        var url = ROOT + "main/notmoder/";
        $.post(url, {id: id},
            function (res) {
                $("#div-moder"+id).html("отклонен");
            });
    });

    $(".edit-btn").on("click", function (e) {
        var id = e.target.id;
        var obj;
        id = id.replace(/edit/g, "");
        var url = ROOT + "main/getmsg/";
        $.post(url, {id: id},
            function (res) {
                obj = JSON.parse(res);
                $("#idMsg").val(obj['id']);
                $("#userName").val(obj['user']);
                $("#email").val(obj['email']);
                $("#newMsg").val(obj['msg']);
            });
    });

    $("#btn-order").on("click", function() {
        location = ROOT + "main/index/1/" + $("#ordName").val() + "/" + $("#ordMode").val();
    });

    $("#preview-btn").on("click", function() {
        var url = ROOT + "Preview/";
        var user = $("#userName").val();
        var email = $("#email").val();
        var msg = $("#newMsg").val();

        $.post(url, {user: user, email: email, msg: msg},
            function (res) {
                $("#div-preview").html(res)
                $("#div-preview").show();
            });

    });


});