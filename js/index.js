(function() {

    "use strict";

    window.onload = init();

    function init(){
        
        if(navigator.language == 'es-AR'){
            window.location = "es.html";
        }
        else {
            window.location = "en.html";
        }
    };
});