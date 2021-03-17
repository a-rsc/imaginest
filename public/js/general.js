$(document).on({
    ajaxStart: function() {
        document.getElementsByTagName('body')[0].classList.add('loading');},
    ajaxStop: function() {
        document.getElementsByTagName('body')[0].classList.remove('loading');}
});

// Aceptar Politica de cookies
if (document.getElementById('cookies') !== null && typeof document.getElementById('cookies') !== 'undefined') {
    document.getElementById('btn-cookies').addEventListener('click', acceptCookies);
}

function acceptCookies(){
    document.getElementById('cookies').style.display = 'none';
    var d = new Date();
    // El tiempo que se almacena esta cookie es 1año
    d.setTime(d.getTime() + 1000*60*60*24*365);
    document.cookie = 'cookies=' + randomString() + ';expires=' + d.toGMTString() + ';domain=.' + location.host + ';path=/';
}

function randomString(length, characters) {
    var length = length || 24,
        characters = characters || '0123456789abcdefghijklmnopqrstuvwxyz',
        str = '',
        max = characters.length-1;
    for (var i = 0; i<length; i++) {
        str += characters[ Math.floor(Math.random() * (max+1)) ];
    }
    return str;
}

// Formularios
if (document.forms.length > 0){
    loop1:
    for (var i=0; i < document.forms.length; i++){
        loop2:
        for (var j=0; j < document.forms[i].elements.length; j++){
            var el = document.forms[i].elements[j];
            if (
                el.type !== 'fieldset' &&
                el.type !== 'hidden' &&
                el.type !== 'button' &&
                el.type !== 'file' &&
                el.type !== 'submit'
            ) {
                if (el.type === 'text'){
                    var strLength = el.value.length+1;
                    el.focus();
                    el.setSelectionRange(strLength, strLength);
                }else {
                    el.focus();
                }

                break loop1;
            }
        }
    }
}

var returnToTop = document.getElementById('return-to-top');

if (returnToTop !== null && typeof returnToTop !== 'undefined') {

    returnToTop.addEventListener('click', function(){
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    document.addEventListener('scroll', function() {
        if (document.documentElement.scrollTop > 0) {
            returnToTop.style.display = 'block';
        } else {
            returnToTop.style.display = 'none';
        }
    });
}
