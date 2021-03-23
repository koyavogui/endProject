$(document).ready(function () {
    $("#stat").click(function (e) { 
        e.preventDefault();
        $('#body').load("stat.php");
    });

    $("#admin").click(function (e) { 
        // e.preventDefault();
        $.post("./../../services/tabadmin.php",{page : 1},
            function (data) {
                $("#table").html(data);
            }
        );
    });
    $("#user").click(function (e) { 
        // e.preventDefault();
        $.post("./../../services/tabuser.php", {page : 1},
            function (data) {
                $("#table").html(data);
            }
        );
    });
    
});
function pagination(page, operation) {
    $(function () {
            const url = './../../services/'+operation +'.php';
            $.post(url, {page : page},
            function (data) {
                $("#table").html(data);
            }
        );
    });
}