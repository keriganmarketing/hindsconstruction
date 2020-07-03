<?php
use Includes\Modules\KMAFacebook\FacebookController;

// Cursor before the returned data set
$before  = $_GET['before'] ?? null;
// Cursor after the returned data set
$after   = $_GET['after'] ?? null;

$albumId = $_GET['albumId'] ?? null;

$gallery = new FacebookController();
// $photos  = $gallery->getPhotos($albumId, 36, $before, $after);
?>
<h2><?php echo $_GET['albumName']; ?> <a href="/our-work/" class="btn btn-default btn-sm pagination-link">Back to main gallery</a></h2>

<div class="row photo-gallery grid">
	<?php

	if(isset($photos->data) && is_array($results->posts)){
		$i = 0;
		foreach ($photos->data as $photo) {
			$thumbnail = '';
			if ( ! isset($photo->images[4]->source)) {
				$thumbnail = $photo->images[0]->source;
			} else {
				$thumbnail = $photo->images[4]->source;
			}
			?>
			<div class="grid-item col-sm-6 col-md-3 mb-3">
				<figure class="image is-4by3">
					<a href="<?= $photo->images[0]->source; ?>" data-lightbox="<?php echo $albumId; ?>" data-title="<?= $photo->images[0]->name ?>">
						<img src="<?= $thumbnail ?>" alt="<?= $photo->images[0]->name ?>" class="img img-responsive">
					</a>
				</figure>
			</div>
			<?php
			$modalContent .= '<img src="'.$photo->images[0]->source.'" alt="'.$photo->images[0]->name.'" :index="'.$i.'" >';
			$i++;
		}
	} else { ?>
		<p></p>
	<?php } ?>
</div>
<?php
$disabledPrevious = isset($photos->paging->previous) ? false: true;
$disabledNext     = isset($photos->paging->next) ? false: true;
$albumName        = $_GET['albumName'];
?>
<ul class="pagination text-center" role="navigation" aria-label="pagination">
    <?php if($disabledPrevious == false) { ?>
    <li><a class="pagination-previous"
		<?= ($disabledPrevious == false ? 'href="/our-work/?albumId='. $albumId . '&albumName='. $albumName .  '&before=' . $photos->paging->cursors->before . '"' : ' disabled' ) ?>
    > Previous </a></li>
    <?php } ?>
    <?php if($disabledNext == false) { ?>
    <li><a class="pagination-next"
		<?= ($disabledNext == false ? 'href="/our-work/?albumId='. $albumId . '&albumName='. $albumName . '&after=' . $photos->paging->cursors->after . '"' : ' disabled' ) ?>
    > Next </a></li>
    <?php } ?>
</ul>
<script src="/wp-content/themes/vega-child/lightbox.js"></script>
