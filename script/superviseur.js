$(document).ready(function () {
    $("#stat").click(function (e) { 
        e.preventDefault();
        $('#body').load("stat.php");
    });

    $("#admin").click(function (e) { 
        // e.preventDefault();
        console.log('admin');
        $(".userRow").hide();
        $(".adminRow").show();
    });
    $("#user").click(function (e) { 
        // e.preventDefault();
        console.log('admin');
        $(".userRow").show();
        $(".adminRow").hide();
    });
});