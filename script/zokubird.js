$(document).ready(function(){
    $("#ressourceIframe").hide();
    var recognition = new webkitSpeechRecognition();
    recognition.lang = 'fr-FR';
    $('#mic').click(function () { 
        const valeur = $('#micListen').hasClass("text-zokubird");
        let question ="";
        // console.log(valeur);
        if (valeur) {
            $('#micListen').removeClass("bi bi-mic text-zokubird");
            $('#micListen').addClass("bi bi-stop-circle text-danger");
            $('#micListen').attr('onclik', "recognition.start()");
            $('#micListen').removeAttr('onclik', "recognition.stop()");
            recognition.start()
        }else{
            $('#micListen').toggleClass("bi bi-mic text-zokubird  bi bi-stop-circle text-danger");   
            $('#micListen').attr('onclik', "recognition.stop()");
            $('#micListen').removeAttr('onclik', "recognition.start()");
            recognition.stop()
            recognition.onresult = function(event) {
                if (event.results.length > 0) {
                    question = event.results[0][0].transcript;
                    console.log(question);
                    searchAnswer(question);
                }
            }   
        }
    });
    
    function searchAnswer(question) {
        $.post( "../services/zokubird.php", { questionIntellect: question, pageintellect : $("#idpage").val() }, function( data ) {
            let utterance = new SpeechSynthesisUtterance(data.result);
            speechSynthesis.speak(utterance);
            console.log(data.result);
            if(data.ressource !== ''){
                $("#ressourceIframe").children().attr({
                    src: data.ressource
                });
                $("#ressourcesImage").hide();
                $("#ressourceIframe").show();              
            }
        }, "json");
    }
})
