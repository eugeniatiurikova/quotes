<div id="<?=$quote->getId()?>" class="quotewrap">
    <p class="quotesign">“</p>
    <div class="quotebody"><p class="quotetext"><?=$quote->getDescription()?></p>
        <p class="author"><?=$quote->getAuthor()?></p>
    <p class="addedby">added by <?=$quote->getUserName()?></p>
    <button id="mute<?=$quote->getId()?>"
            class="mute"
            data-id="<?=$quote->getId()?>"
            onclick="muteQuoteByJs(<?=$quote->getId()?>)">[↓]</button>
</div>
</div>
