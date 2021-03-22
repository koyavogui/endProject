<?php
    /**
     * Recuperaption de la variable de connexion à la base de données.
     */
    session_start();
 
    $pieces = explode("/", $_SERVER['REQUEST_URI']);
    $nomPage = $pieces[2] ;
    require "../database/database.php";
    $page = $db->prepare("SELECT * FROM pages WHERE nomDossierPage=:nomPage");
    $page->bindParam(':nomPage', $nomPage);
    $page->execute();
    if ($page->rowCount() == 1) {
        $page = $page->fetch(PDO::FETCH_OBJ);
    }else {
         exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../includes/head.php';?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- <script src="artyom.js"></script> -->
    <script src="../script/artyom.window.min.js"></script>
    <title>Mobile</title>
</head>
<body class="container">
    <section class="container-fluid position-absolute top-50 start-50 translate-middle">
        <section class="d-flex flex-column mt-5 align-items-center align-self-center ">
            <article class="p-2">
                <img src="./../images/zbird.png" alt="logo de zokubird" srcset="" id="imglogo" class="img-fluid mx-auto d-block" style="max-height :30vh;">
            </article>
            <article class="text-center">
                <p class="fs-3">Bonjour, posez-moi une question j’écoute !</p>
            </article>
            <article class="btn" style="font-size: 3em;" id="mic">
                <i class="bi bi-mic text-zokubird" id="micListen"></i> 
</svg>
            </article>
        </section>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
    <script>
    const zoku = new Artyom();
    zoku.initialize({
    lang:"fr-FR",
    debug:true, // Show what recognizes in the Console
    listen:false, // Start listening after this
    speed:0.9, // Talk a little bit slow
    mode:"normal" // This parameter is not required as it will be normal by default
    });
    const resultat="ok";
    var settings = {
        continuous:false, // Don't stop never because i have https connection
        onResult:function(text){
            // Show the Recognized text in the console
            alert("Recognized text: ", text);

        },
        onStart:function(){
            alert("reconnaissance à demarrer");
        }
    };
//     var commands = [
//     {
//         indexes: ["bonjour"],
//         action: function(){
//             alert("Bonjour, comment vous allez ?");
//         }
//     },
//     {
//         indexes: ["Je vais bien."],
//         action: function(){
//             alert("Super. que puis-je faire pour vous ?");
//         }
//     }
// ];
// zoku.addCommands(commands);
var commandHello = [
    {
        indexes:["Bonjour", "salut", "hey"], // These spoken words will trigger the execution of the command
        action:function(){ // Action to be executed when a index match with spoken word
            zoku.say("Salut, comment vous allez ?");
        }
    }
];

zoku.addCommands(commandHello);
    $(document).ready(function(){
        $("#ressourceIframe").hide();
        $('#imglogo').click(function (e) { 
            e.preventDefault();
            zoku.say("Bonjour ! Je suis ZokouBird. appuyer sur le micro et posez-moi une question.");
            zoku.fatality();
        });
        var utilisateur = zoku.newDictation(settings);
        // recognition.lang = 'fr-FR';
        $('#mic').click(function () { 
            const valeur = $('#micListen').hasClass("text-zokubird");
            let question ="";
            // console.log(valeur);
        if (valeur) {
            $('#micListen').toggleClass("bi bi-mic text-zokubird   bi-stop-circle text-danger");
                utilisateur.start();
            $('#micListen').attr('onclik', "recognition.start()");
            $('#micListen').removeAttr('onclik', "recognition.stop()");
        }else{
            $('#micListen').toggleClass(" bi bi-mic text-zokubird  bi-stop-circle text-danger");   
             
                utilisateur.stop()
            $('#micListen').attr('onclik', "recognition.stop()");
            $('#micListen').removeAttr('onclik', "recognition.start()");
            // utilisateur.onresult = function(event) {
            //     if (event.results.length > 0) {
            //         question = event.results[0][0].transcript;
            //         console.log(question);
            //         searchAnswer(question);
            //     }
            // }
            // console.log(recognition.onresult );
        }
        // console.log(valeur);
    });
    
    function searchAnswer(question) {
        $.post( "../services/zokubird.php", { questionIntellect: question, pageintellect : $("#idpage").val() }, function( data ) {
            let utterance = new SpeechSynthesisUtterance(data.result);
            speechSynthesis.speak(utterance);
            console.log(data.result);
            if(data.ressource !== ''){
                // $("#ressources").html(data.ressource);
                $("#ressourceIframe").children().attr({
                    src: data.ressource
                });
                $("#ressourcesImage").hide();
                $("#ressourceIframe").show();
 /* <iframe width="1189" height="669" src="https://www.youtube.com/embed/ogAhBq2CrvY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> */
                
            }
        }, "json");
    }
})

    </script>
</body>
</html>