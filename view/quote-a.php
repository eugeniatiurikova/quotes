<div id="<?=$quote->getId()?>" class="quotewrap">
    <p class="quotesign">“</p>
    <div class="quotebody"><p class="quotetext"><?=$quote->getDescription()?></p>
        <p class="author"><?=$quote->getAuthor()?></p>
    <p class="addedby">added by <?=$quote->getUserName()?></p>
<?php if($user && ($controller === 'quotes')) : ?>
    <button id="mute<?=$quote->getId()?>"
            class="mute"
            data-id="<?=$quote->getId()?>"
            onclick="muteQuoteByJs(<?=$quote->getId()?>)">
            <svg class="svgicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.2 12.2"><path class="cls-1" d="M0,11.16V1H2.51V2H1.21v8.27h1.3v.93Z"/><path class="cls-1" d="M5.57,2.79H6.63V6.11l0,1.4,1.92-2,.73.73L6.1,9.41,3,6.26l.75-.73,1.9,2,0-1.4Z"/><path class="cls-1" d="M9.69,11.16v-.93H11V2H9.69V1H12.2V11.16Z"/></svg>
    </button>
<?php endif ?>
</div>
</div>
