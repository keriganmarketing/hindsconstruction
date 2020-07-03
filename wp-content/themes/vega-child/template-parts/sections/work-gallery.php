<?php
use Includes\Modules\KMAFacebook\FacebookController;

// Cursor before the returned data set
$before  = $_GET['before'] ?? null;
// Cursor after the returned data set
$after   = $_GET['after'] ?? null;

$albumId = $_GET['albumId'] ?? null;

$gallery = new FacebookController();
// $albums    = $gallery->getAlbums(12, $before, $after);
$badAlbums = ['Past builds', 'Profile Pictures', 'Mobile Uploads', 'Cover Photos', 'Timeline Photos', 'Untitled Album'];
$goodAlbums = [];

if($albums){
foreach ($albums->data as $album) {
    if ( ! in_array($album->name, $badAlbums)) {
        $goodAlbums[] = $album;
    }
}
if(count($goodAlbums) <= 12){
    unset($albums->paging->next);
}
?>

<div class="row photo-gallery grid">
	<?php
	foreach ($goodAlbums as $album) { ?>
        <div class="grid-item col-sm-6 col-md-3 mb-3">
            <figure class="image is-4by3">
                <a href="/our-work/?albumName=<?= $album->name ?>&albumId=<?= $album->id ?>">
                    <img src="<?= $album->cover_photo->images[4]->source ?>" alt="<?= $album->name ?>"
                         class="img-responsive">
                </a>
            </figure>
            <p class="has-text-centered"><?= $album->name ?></p>
        </div>
    <?php } ?>
</div>
<?php
$disabledPrevious = isset($albums->paging->previous) ? false : true;
$disabledNext = isset($albums->paging->next) ? false : true;
?>
<ul class="pagination text-center" role="navigation" aria-label="pagination">
    <?php if($disabledPrevious == false) { ?>
        <li><a class="pagination-previous"
                <?= ($disabledPrevious == false ? 'href="/our-work/?before=' . $albums->paging->cursors->before . '"' : ' disabled' ) ?>
            > Previous </a></li>
    <?php } ?>
    <?php if($disabledNext == false) { ?>
        <li><a class="pagination-next"
                <?= ($disabledNext == false ? 'href="/our-work/?after=' . $albums->paging->cursors->after . '"' : ' disabled' ) ?>
            > Next </a></li>
    <?php } ?>
</ul>
<?php } ?>
