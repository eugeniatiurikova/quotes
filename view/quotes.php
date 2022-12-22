<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title><?=$pageHeader?></title>
</head>
<body>
<?php include "menu.php";?>
<!--<form action="/?controller=quotes&action=add" method="post">-->
<!--    <textarea name="quote" placeholder="Add new quote" required autofocus="" rows="5"></textarea>-->
<!--    <input type="text" name="quote_author" placeholder="Author" required autofocus="">-->
<!--    <button type="submit" class="submitbutton">Add new quote</button>-->
<!--</form><br>-->
<div class="formq hiddenform" id="quoteform">
    <textarea class="formleft" id="addquotetext" name="quote" placeholder="New quote text" required rows="5"></textarea>
    <div class="formright">
        <input id="addauthor" class="inputheight" type="text" name="quote_author" placeholder="Author of the quote">
        <button id="addbtn" class="submitbutton inputheight" onclick="addQuoteByJs()">Add new quote</button>
    </div>
</div><br>
<!--<h2>Actual quotes:</h2>-->
<div class="actuals">
    <?php foreach ($quotesActual as $quote) :
    include 'quote-a.php';
endforeach;?>
</div>

<h2 class="archivettl">Not actual quotes:</h2>
<div class="archive">
    <?php foreach ($quotesUnimportant as $quote) :
    include 'quote-n.php';
endforeach;?>
</div>
<script>
    let archive = document.body.getElementsByClassName("archive");
    let actuals = document.body.getElementsByClassName("actuals");
    let addQuoteBtn = document.getElementById('addquote');
    let addQuoteForm = document.getElementById('quoteform');
    addQuoteBtn.addEventListener('click', () => {
        addQuoteForm.classList.toggle('hiddenform');
    });

    function deleteQuoteByJs(id) {
        let btn = document.getElementById("del"+id);
        let key = btn.getAttribute('data-id');
        (async () => {
                const response = await fetch('/?controller=quotes&action=delete&key=' + key); // + '&user=' + usr
                const answer = await response.json();
                if (answer.status === 'ok') {document.getElementById(answer.key).remove()}
            })();
    }

    function muteQuoteByJs(id) {
        let btn = document.getElementById("mute"+id);
        let key = btn.getAttribute('data-id');
        (async () => {
                const response = await fetch('/?controller=quotes&action=mute&key=' + key);
                const answer = await response.json();
                if (answer.status === 'ok') {
                    console.log(answer);
                    let atr = answer.author;
                    let usr = answer.user_name;
                    let desc = answer.description;
                    let newHtml = '<div id="' + key + '" class="quotewrap"><p class="quotesign">“</p><div class="quotebody"><p class="quotetext">' + desc;
                    newHtml += '</p><p class="author">' + atr + '</p>';
                    newHtml += '<p class="addedby">added by ' + usr + '</p>';
                    newHtml += '<button id="top' + key + '" class="top" data-id="' + key + '" onclick="topQuoteByJs(' + key + ')">[↑]</button>';
                    newHtml += '<button id="del' + key + '" class="del" data-id="' + key + '" onclick="deleteQuoteByJs(' + key + ')">[×]</button>';
                    newHtml += '</div></div>';
                    document.getElementById(key).remove();
                    archive[0].innerHTML = newHtml + archive[0].innerHTML;
                }
            })();
    }

    function topQuoteByJs(id) {
        var btn = document.getElementById("top"+id);
        let key = btn.getAttribute('data-id');
        (async () => {
                const response = await fetch('/?controller=quotes&action=top&key=' + key);
                const answer = await response.json();
                if (answer.status === 'ok') {
                    let atr = answer.author;
                    let usr = answer.user_name;
                    let desc = answer.description;
                    let newHtml = '<div id="' + key + '" class="quotewrap"><p class="quotesign">“</p><div class="quotebody"><p class="quotetext">' + desc;
                    newHtml += '</p><p class="author">' + atr + '</p>'
                    newHtml += '<p class="addedby">added by ' + usr + '</p>'
                    newHtml += '<button id="mute' + key + '" class="mute" data-id="' + key + '" onclick="muteQuoteByJs(' + key + ')">[↓]</button>';
                    newHtml += '</div></div>';
                    document.getElementById(key).remove();
                    actuals[0].innerHTML += newHtml;
                }
            })();
    }


    function addQuoteByJs() {
        var authbox = document.getElementById("addauthor");
        var textbox = document.getElementById("addquotetext");
        let auth = authbox.value ? authbox.value : 'Anonymus';
        let desc = textbox.value;
        // отправка через GET запрос
        // (async () => {
        //     const response = await fetch('/?controller=quotes&action=add&text=' + desc + '&author=' + auth);
        //     const answer = await response.json();
        //     if (answer.status === 'ok') {
        //         console.log(answer);
        //         let key = answer.key;
        //         let atr = answer.author;
        //         let usr = answer.user_name;
        //         let desc = answer.description;
        //         let newHtml = '<div id="' + key + '" class="quotebody"><p class="quotetext">' + desc;
        //         newHtml += '<span class="author">/' + atr + '</span></p>'
        //         newHtml += '<p class="addedby">added by ' + usr + '</p>'
        //         newHtml += '<button id="mute' + key + '" class="mute" data-id="' + key + '" onclick="muteQuoteByJs(' + key + ')">[↓]</button>';
        //         newHtml += '</div>';
        //         actuals[0].innerHTML = newHtml + actuals[0].innerHTML;
        //     }
        // })();

        (async () => {
            const response = await fetch('/?controller=quotes&action=add', {
                    method: 'post',
                    body: JSON.stringify({ 'author': auth, 'description': desc }),
                    headers: {
                        'content-type': 'application/json'
                }
            });
            const answer = await response.json();
                if (answer.status === 'ok') {
                    console.log(answer);
                    let key = answer.key;
                    let atr = answer.author;
                    let usr = answer.user_name;
                    let desc = answer.description;
                    let newHtml = '<div id="' + key + '" class="quotewrap"><p class="quotesign">“</p><div class="quotebody"><p class="quotetext">' + desc;
                    newHtml += '</p><p class="author">' + atr + '</p>'
                    newHtml += '<p class="addedby">added by ' + usr + '</p>'
                    newHtml += '<button id="mute' + key + '" class="mute" data-id="' + key + '" onclick="muteQuoteByJs(' + key + ')">[↓]</button>';
                    newHtml += '</div></div>';
                    actuals[0].innerHTML = newHtml + actuals[0].innerHTML;
                }
        })();
    }
</script>
</body>
</html>
