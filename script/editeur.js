$(document).ready(function(){  
    
    /**
     * Modal de modification
     */
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id') // Extract info from data-* attributes
        var modal = $(this)
        // traitement de formulaire pour recuperer les données
        $.post( "../../services/editeur.php", { idEdit: id}, function( data ) {
            modal.find('.modal-body #editQuestion').html(data.question)
            modal.find('.modal-body #editAnswers').html(data.reponse)
            modal.find('.modal-body #edtImageQuestion').html(data.image) 
            modal.find('.modal-body #youtube').val(data.ressource)
            modal.find('.modal-body #id').val(data.id)
          }, "json");
          
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    })
    /**
     * Modal de  de suppression
     */
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('delete')
        var modal = $(this)
        modal.find('.modal-body #deleteInput').val(id)
        console.log(id);
    })
    $('#delete').click(function () {  
        const id =  $('#deleteInput').val() // Extract info from data-* attributes
        console.log(id)
        $.post( "../../services/editeur.php", {idDelete: id}, function( data ) {
            if (data.reponse == "success") {
                $( "#tbody" ).load( "tabe.php" );
                 $('#deleteModal').modal('hide')
            }
        }, "json");
    }) 

    /**
     * editer une intélligence
     */

    $("#edit").click(function () { 
        $( "#modalForm" ).submit(function (event) {  
            event.preventDefault();
        });
        const form = $("#modalForm");
        var formdata = new FormData(form[0]);
        $.ajax({
            method: "POST",
            enctype: 'multipart/form-data',
            url: '../../services/editeur.php',
            processData: false,
            contentType: false,
            cache: false,
            dataType: "JSON",
            data: formdata,
            success: function (response) {
                 if (response.editResult == "success") {
                    $( "#tbody" ).load( "tabe.php" );
                    $('#editModal').modal('hide')
                 }
            }
        });

        // $.post( "traitement.php", $( "#modalForm" ).serialize(), "json", "multipart/form-data");
        // $.ajax({url: "demo_ajax_script.js", dataType: "script"});
         
     })

     /**
     * Enregistrement d'une intélligence
     */

    $("#intellectForm").submit(function (event) {
        event.preventDefault();
        const form = $(this);
        var formdata = new FormData(form[0]);
        $.ajax({
            type: "POST",
            url: "../../services/editeur.php",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (r) {
                if (r.result == "success") {
                    location.href = "./index.php";
                }
            },
            dataType: "JSON",
        });
    });

/**
 * Modification de profile
 */

    /**
     * verification de mail 
     */

    $("#email").keyup(function () {
        // $(selector).keyup(function (e) { 
            
        // });
        const email = $("#email").val();
        if(email !== ' '){
            $.post( "../../services/registrer.php", { checkEmail : email }, function( data ) {
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
       * Verification d'email
       */

    //   $("#email").focusout(function () {
    //     const email = $("#email").val();
    //     if(email !== ''){
    //         $.post( "../../services/registrer.php", { checkEmail : email }, function( data ) {
    //             if (data.resultCheckEmail == 1) {
    //                 if (!$("#email").is(".is-invalid")) {
    //                     $( "#email" ).toggleClass("is-invalid");
    //                 }
    //                 if ($("#email").is(".is-valid")) {
    //                     $( "#email" ).toggleClass("is-invalid", "is-valid");
    //                 }
    //             } else {
    //                 if (!$("#email").is(".is-valid")) {
    //                     $( "#email" ).toggleClass("is-valid");
    //                 }
    //                 if ($("#email").is(".is-invalid")) {
    //                     $( "#email" ).toggleClass("is-invalid", "is-valid");
    //                 }
    //             }
    //             }, "json");
    //     }
    //   })
})