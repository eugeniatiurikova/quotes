<div id="<?=$quote->getId()?>" class="quotewrap">
    <p class="quotesign">“</p>
    <div class="quotebody"><p class="quotetext"><?=$quote->getDescription()?></p>
        <p class="author"><?=$quote->getAuthor()?></p>
    <p class="addedby">added by <?=$quote->getUserName()?></p>
    <button id="top<?=$quote->getId()?>"
            class="top"
            data-id="<?=$quote->getId()?>"
            onclick="topQuoteByJs(<?=$quote->getId()?>)">[↑]</button><button id="del<?=$quote->getId()?>"
            class="del"
            data-id="<?=$quote->getId()?>"
            onclick="deleteQuoteByJs(<?=$quote->getId()?>)">[×]</button>
</div>
</div>