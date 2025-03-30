<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Album> $albums
 */
?>
<div class="albums index content">
    <?= $this->Html->link(__('New Album'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Albums') ?></h3>
    <div class="card-container">
        <?php printCards($albums); ?>
    </div>
</div>

<style>
    .card-container{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2rem;

        & .card{
            padding: 1rem;
            border-radius: 1rem;

            &:hover{
                background-color: lightgrey;
                cursor: pointer;
            }
        }
    }
</style>

<?php

function printCards($albums){
    foreach($albums as $albums){

        if($albums->image->url == null){
            $tempSrc = "https://placehold.co/400";
        }
        else{
            $tempSrc = $albums->image->url;
        }

        if($albums->artist->name == null){
            $tempArtist = "Inconnu";
        }
        else{
            $tempArtist = $albums->artist->name;
        }

        echo "
            <div class=\"card\" style=\"width: 18rem;\" onclick=\"location.href='albums/view/{$albums->id}'\">
                <img src=\"{$tempSrc}\" class=\"card-img-top\" alt=\"...\">
                <div class=\"card-body\">
                    <h5 class=\"card-title\">{$albums->title}</h5>
                    <p class=\"card-artist\">{$tempArtist}</p>
                    <a href=\"albums/view/{$albums->id}\" class=\"btn btn-primary\">Voir</a>
                </div>
            </div>
        ";
    }
}

?>