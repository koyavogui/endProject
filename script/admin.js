$(document).ready(function () {
    $("#addUser").hide();
    $("#btnAdd").click(function (e) { 
        e.preventDefault();
        $('#addModal').modal('show');
    });
      /**
       * Enregistrement d'un opérateur
       */
    $("#btnAddUserForm").click(function (e) { 
        e.preventDefault();
        $.post( "../../services/admin.php", $("#addUserFom").serialize(), function (data) {
            if (data.result == "success") {
                $('#addModal').modal('hide');
                $("#successToast").toast('show');
                $("#listUser").load("gestion-user.php #listUser");
            } else {
                $("#errorToast").toast('show');
            }
        },"json")
    });
    /**
     * Modification des informations de la page 
     */
    $("#formPage").submit(function (event) {
        event.preventDefault();
        const form = $(this);
        var formdata = new FormData(form[0]);
        $.ajax({
            type: "POST",
            url: "../../services/admin.php",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (r) {
                if(r.result ="P-success"){
                    $("#admin").load("./admin.php #admminMineur")
                }
            },
            dataType: "JSON",
        });
    });
    /**
     * Modification d'un opérateur
     */
    $("#btnEditUserForm").click(function (e) { 
        e.preventDefault();
        $.post( "../../services/admin.php", $("#editUserFom").serialize(), function (data) {
            if (data.result == "E-success") {
                $('#editModal').modal('hide');
                $("#successToast").toast('show');
                $("#listUser").load("gestion-user.php #listUser");
            } else {
                $("#errorToast").toast('show');
            }
        },"json")
    });

    /**
     *  lancement du modal de vérification
     */
    $("#editModal").on('show.bs.modal', function (event) {
        const id = event.relatedTarget.getAttribute('data-id'); 
        $("#editIdUser").val(id);
        $.post( "../../services/admin.php", {identifiant : id}, function(r) {
            $("#editfullNames").text(r.fullNames);
            $("#editemail").text(r.email);
            $("#editphone").text(r.phone);
            $("#editrole").val(r.role);
            $("#fullNameEdit").val(r.fullNames);
            console.log($("#editroleUser1").val());
            if(r.status == 1){
                $( "#editroleUser1").prop( "checked",  true);
                $( "#editroleUser2").prop( "checked",  false);
            }else{
                $( "#editroleUser2").prop( "checked",  true);
                $( "#editroleUser1").prop( "checked",  false);
            }
        }, "json")

     })
    
     /**
     * verification de mail 
     */
    $("#email").focusout(function () {
        const email = $("#email").val();
        if(email !== ''){
            $.post( "./../../services/registrer.php", { checkEmail : email }, function( data ) {
                if (data.resultCheckEmail == 1) {
                    if (!$("#email").is(".is-invalid")) {
                        $( "#email" ).toggleClass("is-invalid");
                    }
                    if ($("#email").is(".is-valid")) {
                        $( "#email" ).toggleClass("is-invalid", "is-valid");
                    }
                } else {
                    if (!$("#email").is(".is-valid")) {
                        $( "#email" ).toggleClass("is-valid");
                    }
                    if ($("#email").is(".is-invalid")) {
                        $( "#email" ).toggleClass("is-invalid", "is-valid");
                    }
                }
                }, "json");
        }
      })

      /**
       * activé modal de modification de mot de passe
       */
    $("#pmKey").click(function (e) { 
        e.preventDefault();
        $("#passwordModal").modal('show');
    });
    //    var passwordModal = new bootstrap.Modal(document.getElementById('passwordModal'), {
    //     keyboard: false
    //   })
    //   $("#pmKey").click(function (e) { 
    //       e.preventDefault();
    //       passwordModal.show()
    //   });
    
});