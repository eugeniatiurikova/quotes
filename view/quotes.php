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

<form class="formq hiddenform" id="quoteform" >
    <textarea class="formleft" id="addquotetext" name="quote" placeholder="New quote text" required rows="5"></textarea>
    <div class="formright">
        <input id="addauthor" class="inputheight" type="text" name="quote_author" placeholder="Author of the quote">
        <button type="submit" id="addbtn" class="submitbutton inputheight">Add new quote</button>
    </div>
</form><br>

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

    addQuoteForm.addEventListener('submit', (e) => {
        e.preventDefault();
        addQuoteByJs();
        e.target.reset();
    })

    let svgup = '<svg class="svgicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.2 12.2"><path class="cls-1" d="M0,11.16V1H2.51V2H1.21v8.27h1.3v.93Z"/><path class="cls-1" d="M9.69,11.16v-.93H11V2H9.69V1H12.2V11.16Z"/><path class="cls-1" d="M5.61,4.69l-1.9,2L3,5.93,6.1,2.79,9.23,5.93l-.73.74-1.92-2,0,1.4V9.41H5.57V6.09Z"/></svg>';
    let svgdn = '<svg class="svgicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.2 12.2"><path class="cls-1" d="M0,11.16V1H2.51V2H1.21v8.27h1.3v.93Z"/><path class="cls-1" d="M5.57,2.79H6.63V6.11l0,1.4,1.92-2,.73.73L6.1,9.41,3,6.26l.75-.73,1.9,2,0-1.4Z"/><path class="cls-1" d="M9.69,11.16v-.93H11V2H9.69V1H12.2V11.16Z"/></svg>';
    let svgcls = '<svg class="svgicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.2 12.2"><path class="cls-1" d="M0,11.16V1H2.51V2H1.21v8.27h1.3v.93Z"/><path class="cls-1" d="M9.69,11.16v-.93H11V2H9.69V1H12.2V11.16Z"/><path class="cls-1" d="M6.88,6.1,8.47,7.69l-.77.78L6.1,6.87,4.5,8.47l-.78-.78L5.33,6.1,3.72,4.49l.78-.77,1.6,1.6,1.6-1.6.77.77Z"/></svg>'
    //[↑][↓][×]

    function handleMoveToActuals(key, atr, usr, desc) {
        let newHtml = '<div id="' + key + '" class="quotewrap"><p class="quotesign">“</p><div class="quotebody"><p class="quotetext">' + desc;
        newHtml += '</p><p class="author">' + atr + '</p>'
        newHtml += '<p class="addedby">added by ' + usr + '</p>'
        newHtml += '<button id="mute' + key + '" class="mute" data-id="' + key + '" onclick="muteQuoteByJs(' + key + ')">' + svgdn + '</button>';
        newHtml += '</div></div>';
        return newHtml
    }

    function handleMoveToUnactuals(key, atr, usr, desc) {
        let newHtml = '<div id="' + key + '" class="quotewrap"><p class="quotesign">“</p><div class="quotebody"><p class="quotetext">' + desc;
        newHtml += '</p><p class="author">' + atr + '</p>';
        newHtml += '<p class="addedby">added by ' + usr + '</p>';
        newHtml += '<button id="top' + key + '" class="top" data-id="' + key + '" onclick="topQuoteByJs(' + key + ')">' + svgup + '</button>';
        newHtml += '<button id="del' + key + '" class="del" data-id="' + key + '" onclick="deleteQuoteByJs(' + key + ')">' + svgcls + '</button>';
        newHtml += '</div></div>';
        return newHtml
    }

    function deleteQuoteByJs(id) {
        let btn = document.getElementById("del"+id);
        let key = btn.getAttribute('data-id');
        (async () => {
                const response = await fetch('/?controller=quotes&action=delete&key=' + key);
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
                    document.getElementById(key).remove();
                    archive[0].innerHTML = handleMoveToUnactuals(key, answer.author, answer.user_name, answer.description) + archive[0].innerHTML;
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
                    document.getElementById(key).remove();
                    actuals[0].innerHTML += handleMoveToActuals(key, answer.author, answer.user_name, answer.description);
                }
            })();
    }

    function addQuoteByJs() {
        let authbox = document.getElementById("addauthor");
        let textbox = document.getElementById("addquotetext");
        let auth = authbox.value ? authbox.value : 'Anonymus';
        let desc = textbox.value;
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
                    actuals[0].innerHTML = handleMoveToActuals(answer.key, answer.author, answer.user_name, answer.description) + actuals[0].innerHTML;
                }
        })();
    }
</script>
</body>
</html>
