<?php
use trk\uikit\Uikit;
use open20\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

//echo $item ['icon_type'];
/*echo $item ['icon_name'];
echo $item ['info_type'];
echo $item ['info_date'];*/
if ($item['image']) {
    $attrs_image['class'][] = 'el-image';
    $attrs_image['alt'] = $item['image_alt'];
    $attrs_image['uk-cover'] = true;
    if (Uikit::isImage($item['image']) == 'gif') {
        $attrs_image['uk-gif'] = true;
    }
    if (Uikit::isImage($item['image']) == 'svg') {
        $image = Uikit::image($item['image'], array_merge($attrs_image, ['width' => $item['image_width'], 'height' => $item['image_height']]));
    } elseif ($item['image_width'] || $item['image_height']) {
        $image = Uikit::image([$item['image'], 'thumbnail' => [$item['image_width'], $item['image_height']], 'sizes' => '80%,200%'], $attrs_image);
    } else {
        $image = Uikit::image($item['image'], $attrs_image);
    }
}

/*echo $item ['title'];
echo $item ['content'];
echo $item ['link'];*/

?>



<div class="it-single-slide-wrapper">
    <div class="uk-container">
        <div class="row it-single-slide-wrapper mx-0">
            <!--parte tipo, data, testo, tag-->
            <div class="col-md-6 it-text-slider-wrapper-outside card-wrapper h-100">
                <div class="card">
                    <div class="card-body pb-0 flex-grow-1 d-flex flex-column">
                        <div class="category-top uk-margin">
                            <span style="color: #435a70;"><strong><?= $item ['info_type'] ?></strong> - <?=  str_replace('-', '/', gmdate("d-m-Y", $item ['info_date'] ))?></span>
                        </div>
                        <h5 class="card-title big-heading text-black">
                            <a href="<?= $item ['link'] ?>" target="_blank" title="Vai alla pagina <?= $item ['title']?> " class="el-link"><?= $item ['title'] ?></a> 
                        </h5>
                        <div >
                            <p><?= $item ['content'] ?></p>
                        </div>
                        
                        <!--parte leggi di più-->
                        <div class="read-more flex-grow-1 align-items-end d-flex text-uppercase font-weight-bold small uk-margin">
                            <a href="<?= $item ['link'] ?>" target="_blank" title="Vai alla pagina <?= $item ['title'] ?>" >Leggi di più →</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--parte immagine-->
            <div class="col-md-6 image-container-carousel" style="max-height:380px">
                <div>
                    <a href="<?= $item ['link'] ?>" class="el-link" title="Vai alla pagina <?= $item ['title'] ?>">
                        <img src="<?= $item['image']?>" class="el-image" alt="<?= $attrs_image['alt'] ?>">
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</div>