<div id="<?=$quote->getId()?>" class="quotewrap">
    <p class="quotesign">“</p>
    <div class="quotebody"><p class="quotetext"><?=$quote->getDescription()?></p>
        <p class="author"><?=$quote->getAuthor()?></p>
    <p class="addedby">added by <?=$quote->getUserName()?></p>
    <button id="top<?=$quote->getId()?>"
            class="top"
            data-id="<?=$quote->getId()?>"
            onclick="topQuoteByJs(<?=$quote->getId()?>)">
        <svg class="svgicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.2 12.2"><path class="cls-1" d="M0,11.16V1H2.51V2H1.21v8.27h1.3v.93Z"/><path class="cls-1" d="M9.69,11.16v-.93H11V2H9.69V1H12.2V11.16Z"/><path class="cls-1" d="M5.61,4.69l-1.9,2L3,5.93,6.1,2.79,9.23,5.93l-.73.74-1.92-2,0,1.4V9.41H5.57V6.09Z"/></svg>
    </button><button id="del<?=$quote->getId()?>"
            class="del"
            data-id="<?=$quote->getId()?>"
            onclick="deleteQuoteByJs(<?=$quote->getId()?>)">
            <svg class="svgicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.2 12.2"><path class="cls-1" d="M0,11.16V1H2.51V2H1.21v8.27h1.3v.93Z"/><path class="cls-1" d="M9.69,11.16v-.93H11V2H9.69V1H12.2V11.16Z"/><path class="cls-1" d="M6.88,6.1,8.47,7.69l-.77.78L6.1,6.87,4.5,8.47l-.78-.78L5.33,6.1,3.72,4.49l.78-.77,1.6,1.6,1.6-1.6.77.77Z"/></svg>
        </button>
</div>
</div>