var url = 'http://shoellery.com.devel';
window.addEventListener("load", function () {
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    // Boton de like
    function like() {
        $('.btn-like').unbind('click').click(function () {
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url + '/img/heart-red.png');

            $.ajax({
                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('Te ha gustado esta foto');
                    } else {
                        console.log('Error al dar like');
                    }
                }
            });

            dislike();
        });
    }
    like();

    // Boton de deslike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function () {
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url + '/img/heart-black.png');
            $.ajax({
                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {
                    if (response.like) {
                        console.log('No te ha gustado esta foto');
                    } else {
                        console.log('Error al dar dislike');
                    }
                }
            });
            like();
        });
    }
    dislike();

    // Método del buscador
    $("#buscador").submit(function () {
        $(this).attr('action', url + '/gente/' + $('#buscador #search').val());
    });


    // Boton de deslike
    function showPassword() {
        var change = document.getElementById('password-confirm');
        $('#show_password').unbind('click').click(function () {

            if (change.type === "password") {
                change.type = "text";
                $('i').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                change.type = "password";
                $('i').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        });

    }
    showPassword();

    function showPasswordConfirmation() {
        var change = document.getElementById('new-password-confirm');
        $('#show_password_confirmation').unbind('click').click(function () {
            if (change.type === "password") {
                change.type = "text";
                $('i').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
            } else {
                change.type = "password";
                $('i').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
            }
        });
    }
    showPasswordConfirmation();

    var words = document.getElementsByClassName('word');
    var wordArray = [];
    var currentWord = 0;

    words[currentWord].style.opacity = 1;
    for (var i = 0; i < words.length; i++) {
        splitLetters(words[i]);
    }

    function changeWord() {
        var cw = wordArray[currentWord];
        var nw = currentWord == words.length - 1 ? wordArray[0] : wordArray[currentWord + 1];
        for (var i = 0; i < cw.length; i++) {
            animateLetterOut(cw, i);
        }

        for (var i = 0; i < nw.length; i++) {
            nw[i].className = 'letter behind';
            nw[0].parentElement.style.opacity = 1;
            animateLetterIn(nw, i);
        }

        currentWord = (currentWord == wordArray.length - 1) ? 0 : currentWord + 1;
    }

    function animateLetterOut(cw, i) {
        setTimeout(function () {
            cw[i].className = 'letter out';
        }, i * 80);
    }

    function animateLetterIn(nw, i) {
        setTimeout(function () {
            nw[i].className = 'letter in';
        }, 340 + (i * 80));
    }

    function splitLetters(word) {
        var content = word.innerHTML;
        word.innerHTML = '';
        var letters = [];
        for (var i = 0; i < content.length; i++) {
            var letter = document.createElement('span');
            letter.className = 'letter';
            letter.innerHTML = content.charAt(i);
            word.appendChild(letter);
            letters.push(letter);
        }

        wordArray.push(letters);
    }

    changeWord();
    setInterval(changeWord, 4000);

    function numberTo(n){
        x = (''+n).length;
        p = Math.pow;
        d = p(10,true);
        x -= x%3;
        return Math.round(n*d/p(10,x))/d+" kMGTPE"[x/3];
    }
    numberTo();   

    
});




