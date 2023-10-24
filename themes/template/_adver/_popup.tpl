
{foreach from = $arrListAdver key = i item = adver}
<div class="md-video md-video-{$i+1} modal fade" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body md-video__body">
                <button class="md-video__close" data-dismiss="modal"></button>
                <a href="{$adver.link}"><img class="d-block w-100" src="{$URL_UPLOADS}/{$adver.image}" alt="{$adver.title}" /></a>
            </div>
        </div>
    </div>
</div>
{/foreach}