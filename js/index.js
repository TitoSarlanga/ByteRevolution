"use strict";

window.onload = init();

function init(){
    
    var strLang = navigator.language.substring(0,2);
    if(strLang == 'es'){
        window.location = "es.html";
    }
    else {
        window.location = "en.html";
    }
};