<?php
/**
 * @version        2.6.x
 * @package        K2
 * @author        JoomlaWorks http://www.joomlaworks.net
 * @copyright    Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license        GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>

<?php if (JRequest::getInt('print') == 1): ?>
    <!-- Print button at the top of the print page only -->
    <a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print();return false;">
        <span><?php echo JText::_('K2_PRINT_THIS_PAGE'); ?></span>
    </a>
<?php endif; ?>

<!-- Start K2 Item Layout -->
<span id="startOfPageId<?php echo JRequest::getInt('id'); ?>"></span>

<div id="k2Container" itemscope itemtype="http://schema.org/Product"
     class="productItem itemView<?php echo ($this->item->featured) ? ' itemIsFeatured' : ''; ?><?php if ($this->item->params->get('pageclass_sfx')) echo ' ' . $this->item->params->get('pageclass_sfx'); ?>">
    <div class="container-fluid">
        <div class="row">
            <!-- PRODUCT SLIDER -->
            <div class="col-sm-7 col-lg-8">
                <?php if ($this->item->params->get('itemExtraFields') && count($this->item->extra_fields)): ?>
                    <?php foreach ($this->item->extra_fields as $key => $extraField): ?>
                        <?php if ($extraField->name == 'product-images'):

                            $dir = $_SERVER['DOCUMENT_ROOT'];
                            $imgDir = JURI::root(true) . $extraField->value;
                            $src = $dir . $imgDir;
                            $content = array_diff(scandir($src, 1), array('..', '.'));
                            $images = array_filter($content, function ($item) {
                                $imgExtensions = array(
                                    'jpg',
                                    'jpeg',
                                    'gif',
                                    'png'
                                );
                                foreach ($imgExtensions as $img) {
                                    if (strpos(strtolower($item), $img) != false) {
                                        return $item;
                                    }
                                }
                            });

                            $src2 = $dir . $imgDir . '/more/';
                            if (file_exists($src2) && is_dir($src2)) {
                                # code...
                                $content2 = array_diff(scandir($src2, 1), array('..', '.'));
                                $more_images = array_filter($content2, function ($item) {
                                    $imgExtensions = array(
                                        'jpg',
                                        'jpeg',
                                        'gif',
                                        'png'
                                    );
                                    foreach ($imgExtensions as $img) {
                                        if (strpos(strtolower($item), $img) != false) {
                                            return $item;
                                        }
                                    }
                                });
                            }

                            ?>
                            <div class="pictures">
                                <div class="slider-for">
                                    <?php foreach ($images as $image): ?>
                                        <?php $src = $imgDir . $image; ?>

                                        <div>
                                            <img itemprop="image" class="img-responsive" src="<?php echo $src ?>"
                                                 alt=""/>
                                        </div>

                                    <?php endforeach; ?>
                                </div>
                                <div class="slider-nav">
                                    <?php foreach ($images as $image): ?>
                                        <?php $src = $imgDir . '/small/' . $image; ?>

                                        <div>
                                            <img class="img-responsive img-150-height" src="<?php echo $src ?>" alt=""/>
                                        </div>

                                    <?php endforeach; ?>
                                </div>
                            </div>

                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <!-- /.col- -->
            <div class="col-sm-5 col-lg-4">
                <!-- ItemHeader -->
                <div class="itemHeader">

                    <?php if ($this->item->params->get('itemDateCreated')): ?>
                        <!-- Date created -->
                        <span class="itemDateCreated">
						<?php echo JHTML::_('date', $this->item->created, JText::_('K2_DATE_FORMAT_LC2')); ?>
					</span>
                    <?php endif; ?>

                    <?php if ($this->item->params->get('itemTitle')): ?>
                        <!-- Item title -->
                        <h1 itemprop="name" class="itemTitle">
                            <?php if (isset($this->item->editLink)): ?>
                                <!-- Item edit link -->
                                <span class="itemEditLink">
							<a class="modal" rel="{handler:'iframe',size:{x:990,y:550}}"
                               href="<?php echo $this->item->editLink; ?>">
                                <?php echo JText::_('K2_EDIT_ITEM'); ?>
                            </a>
						</span>
                            <?php endif; ?>

                            <?php echo $this->item->title; ?>

                            <?php if ($this->item->params->get('itemFeaturedNotice') && $this->item->featured): ?>
                                <!-- Featured flag -->
                                <span>
					  	<sup>
                            <?php echo JText::_('K2_FEATURED'); ?>
                        </sup>
				  	</span>
                            <?php endif; ?>

                        </h1>
                    <?php endif; ?>

                    <!-- Item introtext -->
                    <?php if (!empty($this->item->fulltext)): ?>
                        <?php if ($this->item->params->get('itemIntroText')): ?>
                            <div class="itemIntroText" itemprop="description">
                                <?php echo $this->item->introtext; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ($this->item->params->get('itemAuthor')): ?>
                        <!-- Item Author -->
                        <span class="itemAuthor">
						<?php echo K2HelperUtilities::writtenBy($this->item->author->profile->gender); ?>&nbsp;
                            <?php if (empty($this->item->created_by_alias)): ?>
                                <a rel="author"
                                   href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
                            <?php else: ?>
                                <?php echo $this->item->author->name; ?>
                            <?php endif; ?>
					</span>
                    <?php endif; ?>

                </div>
                <!-- /.itemHeader -->

                <!-- ItemToolbar -->
                <?php if (
                    $this->item->params->get('itemFontResizer') ||
                    $this->item->params->get('itemPrintButton') ||
                    $this->item->params->get('itemEmailButton') ||
                    $this->item->params->get('itemSocialButton') ||
                    $this->item->params->get('itemVideoAnchor') ||
                    $this->item->params->get('itemImageGalleryAnchor') ||
                    $this->item->params->get('itemCommentsAnchor')
                ): ?>
                    <div class="itemToolbar">
                        <ul class="list-unstyled">
                            <?php if ($this->item->params->get('itemFontResizer')): ?>
                                <!-- Font Resizer -->
                                <li>
                                    <span class="itemTextResizerTitle"><?php echo JText::_('K2_FONT_SIZE'); ?></span>
                                    <a href="#" id="fontDecrease">
                                        <span><?php echo JText::_('K2_DECREASE_FONT_SIZE'); ?></span>
                                        <img
                                            src="<?php echo JURI::root(true); ?>/components/com_k2/images/system/blank.gif"
                                            alt="<?php echo JText::_('K2_DECREASE_FONT_SIZE'); ?>"/>
                                    </a>
                                    <a href="#" id="fontIncrease">
                                        <span><?php echo JText::_('K2_INCREASE_FONT_SIZE'); ?></span>
                                        <img
                                            src="<?php echo JURI::root(true); ?>/components/com_k2/images/system/blank.gif"
                                            alt="<?php echo JText::_('K2_INCREASE_FONT_SIZE'); ?>"/>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemPrintButton') && !JRequest::getInt('print')): ?>
                                <!-- Print Button -->
                                <li>
                                    <a class="itemPrintLink" rel="nofollow" href="<?php echo $this->item->printLink; ?>"
                                       onclick="window.open(this.href,'printWindow','width=900,height=600,location=no,menubar=no,resizable=yes,scrollbars=yes'); return false;">
                                        <span><?php echo JText::_('K2_PRINT'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemEmailButton') && !JRequest::getInt('print')): ?>
                                <!-- Email Button -->
                                <li>
                                    <a class="itemEmailLink" rel="nofollow" href="<?php echo $this->item->emailLink; ?>"
                                       onclick="window.open(this.href,'emailWindow','width=400,height=350,location=no,menubar=no,resizable=no,scrollbars=no'); return false;">
                                        <span><?php echo JText::_('K2_EMAIL'); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemSocialButton') && !is_null($this->item->params->get('socialButtonCode', NULL))): ?>
                                <!-- Item Social Button -->
                                <li>
                                    <?php echo $this->item->params->get('socialButtonCode'); ?>
                                </li>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemVideoAnchor') && !empty($this->item->video)): ?>
                                <!-- Anchor link to item video below - if it exists -->
                                <li>
                                    <a class="itemVideoLink k2Anchor"
                                       href="<?php echo $this->item->link; ?>#itemVideoAnchor"><?php echo JText::_('K2_MEDIA'); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)): ?>
                                <!-- Anchor link to item image gallery below - if it exists -->
                                <li>
                                    <a class="itemImageGalleryLink k2Anchor"
                                       href="<?php echo $this->item->link; ?>#itemImageGalleryAnchor"><?php echo JText::_('K2_IMAGE_GALLERY'); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && (($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1'))): ?>
                                <!-- Anchor link to comments below - if enabled -->
                                <li>
                                    <?php if (!empty($this->item->event->K2CommentsCounter)): ?>
                                        <!-- K2 Plugins: K2CommentsCounter -->
                                        <?php echo $this->item->event->K2CommentsCounter; ?>
                                    <?php else: ?>
                                        <?php if ($this->item->numOfComments > 0): ?>
                                            <a class="itemCommentsLink k2Anchor"
                                               href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
                                                <span><?php echo $this->item->numOfComments; ?></span> <?php echo ($this->item->numOfComments > 1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
                                            </a>
                                        <?php else: ?>
                                            <a class="itemCommentsLink k2Anchor"
                                               href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
                                                <?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <div class="clr"></div>
                    </div><!-- ./itemToolbar -->
                <?php endif; ?>
                <!-- Item Rating -->
                <?php if ($this->item->params->get('itemRating')): ?>

                    <div class="itemRatingBlock">
                        <span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>
                        <span id="votingPercentage" data-percent="<?php echo $this->item->votingPercentage; ?>"></span>

                        <div class="itemRatingForm">
                            <ul class="itemRatingList list-inline">

                                <!-- <li class="itemCurrentRating" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li> -->
                                <li><a href="#" data-id="<?php echo $this->item->id; ?>"
                                       title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star"><span
                                            class="stars glyphicon glyphicon-star-empty"></span><span
                                            class="hidden">1</span></a></li>
                                <li><a href="#" data-id="<?php echo $this->item->id; ?>"
                                       title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars"><span
                                            class="stars glyphicon glyphicon-star-empty"></span><span
                                            class="hidden">2</span></a></li>
                                <li><a href="#" data-id="<?php echo $this->item->id; ?>"
                                       title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars"><span
                                            class="stars glyphicon glyphicon-star-empty"></span><span
                                            class="hidden">3</span></a></li>
                                <li><a href="#" data-id="<?php echo $this->item->id; ?>"
                                       title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars"><span
                                            class="stars glyphicon glyphicon-star-empty"></span><span
                                            class="hidden">4</span></a></li>
                                <li><a href="#" data-id="<?php echo $this->item->id; ?>"
                                       title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars"><span
                                            class="stars glyphicon glyphicon-star-empty"></span><span
                                            class="hidden">5</span></a></li>
                            </ul>
                            <div id="itemRatingLog<?php echo $this->item->id; ?>"
                                 class="itemRatingLog"><?php echo $this->item->numOfvotes; ?></div>
                            <!-- models/item.php -->

                        </div>

                    </div><!-- /.itemRatingBlock -->
                <?php endif; ?>

                <!-- K2 Plugins: K@AfterDisplay -->
                <?php echo $this->item->event->K2AfterDisplay; ?>

                <!--button type="button" data-toggle="modal" data-target="#myQuickCall" id="quickOrder">Быстрый заказ</button-->

                <p>Hужна помощь? Перезвоните мы с удовольствием вас проконсультируем.</p>
            </div>
            <!-- /.col-sm-5 -->
        </div>
        <!-- /.row -->
    </div>

    <div id="myQuickCall" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="width: 600px !important; margin: auto auto !important;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Быстрый заказ</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12 col-xs-12" style="text-align: center !important;">
                <div id="form-messages"></div></br>
              </div>
              <div class="col-md-4 col-md-offset-4 col-xs-12">
                <div class="input-group">

                    <form id="ajax-contact" method="POST" action="mailer.php">
                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" class="form-control quick-input" id="quick-name-input" name="name" placeholder="Имя">
                        </div>
                        <div class="input-group">
                          <div class="input-group-addon"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></div>
                          <input type="text" class="form-control quick-input" id="quick-mobile-input" name="message">
                        </div>
                      </div>
                      <button class="btn btn-default" type="button" id="quick-mobile-button">Отправить</button>
                    </form>

                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>

    <!-- /.container -->
    <!-- Plugins: BeforeDisplay -->
    <?php echo $this->item->event->BeforeDisplay; ?>

    <!-- K2 Plugins: K2BeforeDisplay -->
    <?php echo $this->item->event->K2BeforeDisplay; ?>

    <!-- Plugins: AfterDisplayTitle -->
    <?php echo $this->item->event->AfterDisplayTitle; ?>

    <!-- K2 Plugins: K2AfterDisplayTitle -->
    <?php echo $this->item->event->K2AfterDisplayTitle; ?>





    <div class="itemBody container-fluid">

        <!-- Plugins: BeforeDisplayContent -->
        <?php echo $this->item->event->BeforeDisplayContent; ?>

        <!-- K2 Plugins: K2BeforeDisplayContent -->
        <?php echo $this->item->event->K2BeforeDisplayContent; ?>

        <?php if ($this->item->params->get('itemImage') && !empty($this->item->image)): ?>
            <!-- Item Image -->
            <div class="itemImageBlock">
		  <span class="itemImage">
		  	<a class="modal" rel="{handler: 'image'}" href="<?php echo $this->item->imageXLarge; ?>"
               title="<?php echo JText::_('K2_CLICK_TO_PREVIEW_IMAGE'); ?>">
                <img src="<?php echo $this->item->image; ?>"
                     alt="<?php if (!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>"
                     style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;"/>
            </a>
		  </span>

                <?php if ($this->item->params->get('itemImageMainCaption') && !empty($this->item->image_caption)): ?>
                    <!-- Image caption -->
                    <span class="itemImageCaption"><?php echo $this->item->image_caption; ?></span>
                <?php endif; ?>

                <?php if ($this->item->params->get('itemImageMainCredits') && !empty($this->item->image_credits)): ?>
                    <!-- Image credits -->
                    <span class="itemImageCredits"><?php echo $this->item->image_credits; ?></span>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        <?php if (!empty($this->item->fulltext)): ?>

            <!-- Item fulltext -->
            <?php if ($this->item->params->get('itemFullText')): ?>
                <div
                    class="itemFullText col-lg-8 col-lg-offset-2 col-xs-12 col-sm-10 col-sm-offset-1 pad-top-bottom-50">
                    <?php echo $this->item->fulltext; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <!-- Item text -->
            <div class="itemFullText pad-all-50">
                <?php echo $this->item->introtext; ?>
            </div>
        <?php endif; ?>

        <!-- Item video -->
        <div class="itemVideoBlock container-fluid">
            <?php if ($this->item->params->get('itemVideo') && !empty($this->item->video)): ?>

            <a name="itemVideoAnchor" id="itemVideoAnchor"></a>


            <div class="row images">
                <!-- video column -->
                <div class="col-sm-6">
                    <?php if ($this->item->videoType == 'embedded'): ?>

                        <div class="itemVideoEmbedded embed-responsive embed-responsive-16by9">
                            <?php echo $this->item->video; ?>
                        </div>
                    <?php else: ?>
                        <span class="itemVideo"><?php echo $this->item->video; ?></span>
                    <?php endif; ?>

                    <?php if ($this->item->params->get('itemVideoCaption') && !empty($this->item->video_caption)): ?>
                        <span class="itemVideoCaption"><?php echo $this->item->video_caption; ?></span>
                    <?php endif; ?>

                    <?php if ($this->item->params->get('itemVideoCredits') && !empty($this->item->video_credits)): ?>
                        <span class="itemVideoCredits"><?php echo $this->item->video_credits; ?></span>
                    <?php endif; ?>
                </div>
                <!-- /.col-sm-6 -->

                <!-- add 3 images -->
                <?php if (isset($more_images)): ?>
                <?php foreach ($more_images as $key => $image) : ?>

                    <div class="col-sm-6">
                        <img class="img-responsive" src="<?php echo $imgDir . 'more/' . $image; ?>" alt=""/>

                    </div><!-- /.col-sm-6 -->
                <?php endforeach; ?>
            </div>
            <!-- /.row.images -->

            <?php elseif (isset($images)): ?>
            <!-- no more images folder -->
            <div class="col-sm-6">
                <img class="img-responsive" src="<?php echo $imgDir . $images[3]; ?>" alt=""/>

            </div>
            <!-- /.col-sm-6 -->

        </div>
    <!-- /.row -->
        <div class="row images">
            <div class="col-sm-6">
                <img class="img-responsive" src="<?php echo $imgDir . $images[1]; ?>" alt=""/>
            </div>
            <!-- /.col-sm-6 -->
            <div class="col-sm-6">
                <img class="img-responsive" src="<?php echo $imgDir . $images[2]; ?>" alt=""/>
            </div>
            <!-- /.col-sm-6 -->
        </div>
        <!-- /.row -->
    <?php endif; ?>
        <!-- <div class="clr"></div> -->

    <?php else : ?>
        <!-- add 4 images -->
        <?php if (isset($more_images)): ?>
            <div class="row images">
                <?php foreach ($more_images as $key => $image) : ?>

                    <div class="col-sm-6">
                        <img class="img-responsive" src="<?php echo $imgDir . 'more/' . $image; ?>" alt=""/>

                    </div><!-- /.col-sm-6 -->
                <?php endforeach; ?>
            </div><!-- /.row.images -->

        <?php elseif (isset($images)): ?>
            <!-- no more images folder -->
            <div class="row images">
                <?php for ($i = 0; $i < 4; $i++) : ?>
                    <div class="col-sm-6">
                        <img class="img-responsive" src="<?php echo $imgDir . $images[$i]; ?>" alt=""/>

                    </div><!-- /.col-sm-6 -->
                <?php endfor; ?>
            </div><!-- /.row -->

        <?php endif; ?>
    <?php endif; ?>
    </div>
    <!-- Item extra fields -->
    <?php if ($this->item->params->get('itemExtraFields') && count($this->item->extra_fields)): ?>
        <div class="itemExtraFields container">
            <!-- <h3><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h3> -->
            <ul class="list-unstyled">
                <?php foreach ($this->item->extra_fields as $key => $extraField): ?>
                    <?php if ($extraField->value != '' && $extraField->name != 'product-images'): ?>
                        <li class="pad-top-bottom-50 <?php echo ($key % 2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
                            <?php if ($extraField->type == 'header'): ?>
                                <h4 class="itemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>

                            <?php else: ?>
                                <!-- <span class="itemExtraFieldsLabel"><?php echo $extraField->name; ?>:</span> -->
                                <span class="itemExtraFieldsValue"><?php echo $extraField->value; ?></span>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <div class="clr"></div>
        </div>
    <?php endif; ?>




    <?php if ($this->item->params->get('itemHits') || ($this->item->params->get('itemDateModified') && intval($this->item->modified) != 0)): ?>
        <div class="itemContentFooter">

            <!-- Item Hits -->
            <?php if ($this->item->params->get('itemHits')): ?>
                <span class="itemHits">
				<?php echo JText::_('K2_READ'); ?>
                    <b><?php echo $this->item->hits; ?></b> <?php echo JText::_('K2_TIMES'); ?>
			</span>
            <?php endif; ?>

            <?php if ($this->item->params->get('itemDateModified') && intval($this->item->modified) != 0): ?>
                <!-- Item date modified -->
                <span class="itemDateModified">
				<?php echo JText::_('K2_LAST_MODIFIED_ON'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?>
			</span>
            <?php endif; ?>

            <div class="clr"></div>
        </div>
    <?php endif; ?>

    <!-- Plugins: AfterDisplayContent -->
    <?php echo $this->item->event->AfterDisplayContent; ?>

    <!-- K2 Plugins: K2AfterDisplayContent -->
    <?php echo $this->item->event->K2AfterDisplayContent; ?>

    <div class="clr"></div>
</div>

<!-- Social sharing -->
<div class="itemSocialSharing">
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5502cb5b24863922"
            async="async"></script>
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="addthis_sharing_toolbox"></div>

    <!-- Social buttons dropped down by DIMA -->

</div><!-- /.itemSocialSharing -->

<?php if ($this->item->params->get('itemCategory') || $this->item->params->get('itemTags') || $this->item->params->get('itemAttachments')): ?>
    <div class="itemLinks">

        <?php if ($this->item->params->get('itemCategory')): ?>
            <!-- Item category -->
            <div class="itemCategory">
                <span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
                <a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
            </div>
        <?php endif; ?>

        <?php if ($this->item->params->get('itemTags') && count($this->item->tags)): ?>
            <!-- Item tags -->
            <div class="itemTagsBlock">
                <span><?php echo JText::_('K2_TAGGED_UNDER'); ?></span>
                <ul class="itemTags">
                    <?php foreach ($this->item->tags as $tag): ?>
                        <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <div class="clr"></div>
            </div>
        <?php endif; ?>

        <?php if ($this->item->params->get('itemAttachments') && count($this->item->attachments)): ?>
            <!-- Item attachments -->
            <div class="itemAttachmentsBlock">
                <span><?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS'); ?></span>
                <ul class="itemAttachments">
                    <?php foreach ($this->item->attachments as $attachment): ?>
                        <li>
                            <a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>"
                               href="<?php echo $attachment->link; ?>"><?php echo $attachment->title; ?></a>
                            <?php if ($this->item->params->get('itemAttachmentsCounter')): ?>
                                <span>(<?php echo $attachment->hits; ?> <?php echo ($attachment->hits == 1) ? JText::_('K2_DOWNLOAD') : JText::_('K2_DOWNLOADS'); ?>
                                    )</span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="clr"></div>
    </div>
<?php endif; ?>

<?php if ($this->item->params->get('itemAuthorBlock') && empty($this->item->created_by_alias)): ?>
    <!-- Author Block -->
    <div class="itemAuthorBlock">

        <?php if ($this->item->params->get('itemAuthorImage') && !empty($this->item->author->avatar)): ?>
            <img class="itemAuthorAvatar" src="<?php echo $this->item->author->avatar; ?>"
                 alt="<?php echo K2HelperUtilities::cleanHtml($this->item->author->name); ?>"/>
        <?php endif; ?>

        <div class="itemAuthorDetails">
            <h3 class="itemAuthorName">
                <a rel="author"
                   href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
            </h3>

            <?php if ($this->item->params->get('itemAuthorDescription') && !empty($this->item->author->profile->description)): ?>
                <p><?php echo $this->item->author->profile->description; ?></p>
            <?php endif; ?>

            <?php if ($this->item->params->get('itemAuthorURL') && !empty($this->item->author->profile->url)): ?>
                <span class="itemAuthorUrl"><?php echo JText::_('K2_WEBSITE'); ?> <a rel="me"
                                                                                     href="<?php echo $this->item->author->profile->url; ?>"
                                                                                     target="_blank"><?php echo str_replace('http://', '', $this->item->author->profile->url); ?></a></span>
            <?php endif; ?>

            <?php if ($this->item->params->get('itemAuthorEmail')): ?>
                <span
                    class="itemAuthorEmail"><?php echo JText::_('K2_EMAIL'); ?> <?php echo JHTML::_('Email.cloak', $this->item->author->email); ?></span>
            <?php endif; ?>

            <div class="clr"></div>

            <!-- K2 Plugins: K2UserDisplay -->
            <?php echo $this->item->event->K2UserDisplay; ?>

        </div>
        <div class="clr"></div>
    </div>
<?php endif; ?>

<?php if ($this->item->params->get('itemAuthorLatest') && empty($this->item->created_by_alias) && isset($this->authorLatestItems)): ?>
    <!-- Latest items from author -->
    <div class="itemAuthorLatest">
        <h3><?php echo JText::_('K2_LATEST_FROM'); ?> <?php echo $this->item->author->name; ?></h3>
        <ul>
            <?php foreach ($this->authorLatestItems as $key => $item): ?>
                <li class="<?php echo ($key % 2) ? "odd" : "even"; ?>">
                    <a href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="clr"></div>
    </div>
<?php endif; ?>

<?php
/*
Note regarding 'Related Items'!
If you add:
- the CSS rule 'overflow-x:scroll;' in the element div.itemRelated {…} in the k2.css
- the class 'k2Scroller' to the ul element below
- the classes 'k2ScrollerElement' and 'k2EqualHeights' to the li element inside the foreach loop below
- the style attribute 'style="width:<?php echo $item->imageWidth; ?>px;"' to the li element inside the foreach loop below
...then your Related Items will be transformed into a vertical-scrolling block, inside which, all items have the same height (equal column heights). This can be very useful if you want to show your related articles or products with title/author/category/image etc., which would take a significant amount of space in the classic list-style display.
*/
?>

<!-- Related items by tag -->

<?php if ($this->item->params->get('itemRelated') && isset($this->relatedItems)): ?>
    <hr>
    <div class="itemRelated">
        <span class="headingh3 text-center"><?php echo JText::_("K2_RELATED_ITEMS_BY_TAG"); ?></span>

        <div class="center slicked">
            <?php
            $hidden = array();
            foreach ($this->item->tags as $key => $tag) {
                $pos = strpos($tag->name, '_');
                if ($pos) {
                    $name = substr($tag->name, 0, $pos);
                    $hidden[] = $name;
                }
            }
            foreach ($this->relatedItems as $key => $item): ?>
                <?php if (!in_array($item->alias, $hidden)): ?>


                    <?php $price = json_decode($item->plugins)->k2storeitem_price; ?>
                    <div>
                        <!-- <li class="<?php echo ($key % 2) ? "odd" : "even"; ?>"> -->

                        <?php if ($this->item->params->get('itemRelatedCategory')): ?>
                            <div class="itemRelCat"><?php echo JText::_("K2_IN"); ?> <a
                                    href="<?php echo $item->category->link ?>"><?php echo $item->category->name; ?></a>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->item->params->get('itemRelatedAuthor')): ?>
                            <div class="itemRelAuthor"><?php echo JText::_("K2_BY"); ?> <a rel="author"
                                                                                           href="<?php echo $item->author->link; ?>"><?php echo $item->author->name; ?></a>
                            </div>
                        <?php endif; ?>

                        <!-- image -->
                        <?php if ($this->item->params->get('itemRelatedImageSize')): ?>
                            <a href="<?php echo $item->link ?>">
                                <img style="width:auto; max-height:300px;"
                                     class="itemRelImg img-responsive block-center" src="<?php echo $item->image; ?>"
                                     alt="<?php K2HelperUtilities::cleanHtml($item->title); ?>"/>
                            </a>
                        <?php endif; ?>
                        <!-- title -->
                        <?php if ($this->item->params->get('itemRelatedTitle', 1)): ?>
                            <p class="text-center">
                                <a class="itemRelTitle text-uppercase"
                                   href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
                                <?php if (isset($price)) : ?>
                                    <br>
                                    <span class="price"><?php echo 'от ' . $price . ' грн.'; ?></span>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                        <!-- intro -->
                        <?php if ($this->item->params->get('itemRelatedIntrotext')): ?>
                            <div class="itemRelIntrotext"><?php echo $item->introtext; ?></div>
                        <?php endif; ?>

                        <?php if ($this->item->params->get('itemRelatedFulltext')): ?>
                            <div class="itemRelFulltext"><?php echo $item->fulltext; ?></div>
                        <?php endif; ?>

                        <?php if ($this->item->params->get('itemRelatedMedia')): ?>
                            <?php if ($item->videoType == 'embedded'): ?>
                                <div class="itemRelMediaEmbedded"><?php echo $item->video; ?></div>
                            <?php else: ?>
                                <div class="itemRelMedia"><?php echo $item->video; ?></div>
                            <?php endif; ?>
                        <?php endif; ?>


                        <?php if ($this->item->params->get('itemRelatedImageGallery')): ?>
                            <div class="itemRelImageGallery"><?php echo $item->gallery; ?></div>
                        <?php endif; ?>
                        <!-- </li> -->
                    </div>
                <?php endif ?>
            <?php endforeach; ?>

        </div>
        <!-- /.center slicked -->
        <!-- <ul>
			<?php foreach ($this->relatedItems as $key => $item): ?>
			<li class="<?php echo ($key % 2) ? "odd" : "even"; ?>">

				<?php if ($this->item->params->get('itemRelatedTitle', 1)): ?>
				<a class="itemRelTitle" href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
				<?php endif; ?>

				<?php if ($this->item->params->get('itemRelatedCategory')): ?>
				<div class="itemRelCat"><?php echo JText::_("K2_IN"); ?> <a href="<?php echo $item->category->link ?>"><?php echo $item->category->name; ?></a></div>
				<?php endif; ?>

				<?php if ($this->item->params->get('itemRelatedAuthor')): ?>
				<div class="itemRelAuthor"><?php echo JText::_("K2_BY"); ?> <a rel="author" href="<?php echo $item->author->link; ?>"><?php echo $item->author->name; ?></a></div>
				<?php endif; ?>

				<?php if ($this->item->params->get('itemRelatedImageSize')): ?>
				<img style="width:<?php echo $item->imageWidth; ?>px;height:auto;" class="itemRelImg" src="<?php echo $item->image; ?>" alt="<?php K2HelperUtilities::cleanHtml($item->title); ?>" />
				<?php endif; ?>

				<?php if ($this->item->params->get('itemRelatedIntrotext')): ?>
				<div class="itemRelIntrotext"><?php echo $item->introtext; ?></div>
				<?php endif; ?>

				<?php if ($this->item->params->get('itemRelatedFulltext')): ?>
				<div class="itemRelFulltext"><?php echo $item->fulltext; ?></div>
				<?php endif; ?>

				<?php if ($this->item->params->get('itemRelatedMedia')): ?>
				<?php if ($item->videoType == 'embedded'): ?>
				<div class="itemRelMediaEmbedded"><?php echo $item->video; ?></div>
				<?php else: ?>
				<div class="itemRelMedia"><?php echo $item->video; ?></div>
				<?php endif; ?>
				<?php endif; ?>

				<?php if ($this->item->params->get('itemRelatedImageGallery')): ?>
				<div class="itemRelImageGallery"><?php echo $item->gallery; ?></div>
				<?php endif; ?>
			</li>
			<?php endforeach; ?>
			<li class="clr"></li>
		</ul> -->
    </div>
<?php endif; ?>


<?php if ($this->item->params->get('itemImageGallery') && !empty($this->item->gallery)): ?>
    <!-- Item image gallery -->
    <a name="itemImageGalleryAnchor" id="itemImageGalleryAnchor"></a>
    <div class="itemImageGallery">
        <h3><?php echo JText::_('K2_IMAGE_GALLERY'); ?></h3>
        <?php echo $this->item->gallery; ?>
    </div>
<?php endif; ?>

<?php if ($this->item->params->get('itemNavigation') && !JRequest::getCmd('print') && (isset($this->item->nextLink) || isset($this->item->previousLink))): ?>
    <!-- Item navigation -->
    <!--
  <div class="itemNavigation">
  	<span class="itemNavigationTitle"><?php echo JText::_('K2_MORE_IN_THIS_CATEGORY'); ?></span>

		<?php if (isset($this->item->previousLink)): ?>
		<a class="itemPrevious" href="<?php echo $this->item->previousLink; ?>">
			&laquo; <?php echo $this->item->previousTitle; ?>
		</a>
		<?php endif; ?>

		<?php if (isset($this->item->nextLink)): ?>
		<a class="itemNext" href="<?php echo $this->item->nextLink; ?>">
			<?php echo $this->item->nextTitle; ?> &raquo;
		</a>
		<?php endif; ?>

  </div>
  -->
<?php endif; ?>

<!-- Plugins: AfterDisplay -->
<?php echo $this->item->event->AfterDisplay; ?>

<?php if ($this->item->params->get('itemComments') && (($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1'))): ?>
    <!-- K2 Plugins: K2CommentsBlock -->
    <?php echo $this->item->event->K2CommentsBlock; ?>
<?php endif; ?>

<!-- Item comments -->
<hr>
<?php if ($this->item->params->get('itemComments') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2')) && empty($this->item->event->K2CommentsBlock)): ?>
    <a name="itemCommentsAnchor" id="itemCommentsAnchor"></a>

<div class="itemComments container-fluid">

    <!-- Item comments form -->
    <div class="row">
        <?php if ($this->item->params->get('commentsFormPosition') == 'above' && $this->item->params->get('itemComments') && !JRequest::getInt('print') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
            <div class="itemCommentsForm">
                <?php echo $this->loadTemplate('comments_form'); ?>
            </div>
        <?php endif; ?>
    </div>
    <!-- /.row -->


    <!-- Item user comments -->
    <div class="row">
        <?php if ($this->item->numOfComments > 0 && $this->item->params->get('itemComments') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2'))): ?>
            <div class="itemCommentsCounter text-center bordered-bottom">
                <span><?php echo $this->item->numOfComments; ?></span> <?php echo ($this->item->numOfComments > 1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
            </div>

            <ul class="itemCommentsList media-list">
                <?php foreach ($this->item->comments as $key => $comment): ?>
                    <li class="<?php echo ($key % 2) ? "odd" : "even";
                    echo (!$this->item->created_by_alias && $comment->userID == $this->item->created_by) ? " authorResponse" : "";
                    echo ($comment->published) ? '' : ' unpublishedComment'; ?>">

                        <?php if ($comment->userImage): ?>
                            <span class="media-left">
						<img src="<?php echo $comment->userImage; ?>"
                             alt="<?php echo JFilterOutput::cleanText($comment->userName); ?>"
                             width="<?php echo $this->item->params->get('commenterImgWidth'); ?>"/>
					</span>
                        <?php endif; ?>

                        <div class="media-body">
						<span class="commentDate">
				    	<?php echo JHTML::_('date', $comment->commentDate, JText::_('K2_DATE_FORMAT_LC2')); ?>
				    </span>

				    <span class="commentAuthorName">
					    <?php echo JText::_('K2_POSTED_BY'); ?>
                        <?php if (!empty($comment->userLink)): ?>
                            <a href="<?php echo JFilterOutput::cleanText($comment->userLink); ?>"
                               title="<?php echo JFilterOutput::cleanText($comment->userName); ?>" target="_blank"
                               rel="nofollow">
                                <?php echo $comment->userName; ?>
                            </a>
                        <?php else: ?>
                            <?php echo $comment->userName; ?>
                        <?php endif; ?>
				    </span>

                            <p><?php echo $comment->commentText; ?></p>

                            <?php if ($this->inlineCommentsModeration || ($comment->published && ($this->params->get('commentsReporting') == '1' || ($this->params->get('commentsReporting') == '2' && !$this->user->guest)))): ?>
                            <span class="commentToolbar">
							<?php if ($this->inlineCommentsModeration): ?>
                                    <?php if (!$comment->published): ?>
                                        <a class="commentApproveLink"
                                           href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=publish&commentID=' . $comment->id . '&format=raw') ?>"><?php echo JText::_('K2_APPROVE') ?></a>
                                    <?php endif; ?>

							<a class="commentRemoveLink"
                               href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=remove&commentID=' . $comment->id . '&format=raw') ?>"><?php echo JText::_('K2_REMOVE') ?></a>
                                <?php endif; ?>

                                <?php if ($comment->published && ($this->params->get('commentsReporting') == '1' || ($this->params->get('commentsReporting') == '2' && !$this->user->guest))): ?>
                                    <a class="modal" rel="{handler:'iframe',size:{x:560,y:480}}"
                                       href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=report&commentID=' . $comment->id) ?>"><?php echo JText::_('K2_REPORT') ?></a>
                                <?php endif; ?>

                                <?php if ($comment->reportUserLink): ?>
                                    <a class="k2ReportUserButton"
                                       href="<?php echo $comment->reportUserLink; ?>"><?php echo JText::_('K2_FLAG_AS_SPAMMER'); ?></a>
                                <?php endif; ?>

						</span>
                        </div>
                        <!-- /.media-body -->
                    <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="itemCommentsPagination">
                <?php echo $this->pagination->getPagesLinks(); ?>
                <div class="clr"></div>
            </div>
        <?php endif; ?>
    </div>
    <!-- /.row -->


    <!-- Item comments form -->
    <div class="row col-xs-12">
        <?php if ($this->item->params->get('commentsFormPosition') == 'below' && $this->item->params->get('itemComments') && !JRequest::getInt('print') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))): ?>
            <div class="itemCommentsForm">
                <?php echo $this->loadTemplate('comments_form'); ?>
            </div>
        <?php endif; ?>

        <?php $user = JFactory::getUser();
        if ($this->item->params->get('comments') == '2' && $user->guest): ?>
            <div><?php echo JText::_('K2_LOGIN_TO_POST_COMMENTS'); ?></div>
        <?php endif; ?>
        <br/>
    </div>
    <!-- /.row -->


    <?php endif; ?>
</div><!-- /.itemComments .container-->

<!-- Back to topp -->
<?php if (!JRequest::getCmd('print')): ?>
    <!--<div class="itemBackToTop">
		<a class="k2Anchor" href="<?php echo $this->item->link; ?>#startOfPageId<?php echo JRequest::getInt('id'); ?>">
			<?php echo JText::_('K2_BACK_TO_TOP'); ?>
		</a>
	</div> -->
<?php endif; ?>

<div class="clr"></div>

<!-- NEW SOCIAL BUTTONS OVERLAY -->
<div class="itemSocialSharing">

    <!-- Social buttons dropped down by DIMA -->
    <?php if ($this->item->params->get('itemTwitterButton', 1) || $this->item->params->get('itemFacebookButton', 1) || $this->item->params->get('itemGooglePlusOneButton', 1)): ?>

        <?php if ($this->item->params->get('itemTwitterButton', 1)): ?>
            <!-- Twitter Button -->
            <div class="itemTwitterButton">
                <a href="https://twitter.com/share" class="twitter-share-button"
                   data-count="horizontal"<?php if ($this->item->params->get('twitterUsername')): ?> data-via="<?php echo $this->item->params->get('twitterUsername'); ?>"<?php endif; ?>>
                    <?php echo JText::_('K2_TWEET'); ?>
                </a>
                <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
            </div>
        <?php endif; ?>

        <?php if ($this->item->params->get('itemFacebookButton', 1)): ?>
            <!-- Facebook Button -->
            <div class="itemFacebookButton">
                <div id="fb-root"></div>
                <script type="text/javascript">
                    (function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
                <div class="fb-like" data-send="false" data-width="200" data-show-faces="true"></div>
            </div>
        <?php endif; ?>

        <?php if ($this->item->params->get('itemGooglePlusOneButton', 1)): ?>
            <!-- Google +1 Button -->
            <div class="itemGooglePlusOneButton">
                <g:plusone annotation="inline" width="120"></g:plusone>
                <script type="text/javascript">
                    (function () {
                        window.___gcfg = {lang: 'en'}; // Define button default language here
                        var po = document.createElement('script');
                        po.type = 'text/javascript';
                        po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0];
                        s.parentNode.insertBefore(po, s);
                    })();
                </script>
            </div>
        <?php endif; ?>

        <div class="clr"></div>

    <?php endif; ?>
</div>


<!-- END SOCIAL OVERLAY -->

<!-- End K2 Item Layout -->
<script>

    var fabricValues = [];
    jQuery(document).ready(function ($) {
        var root = "<?php echo JURI::root(true)?>";
        var voting = jQuery('#votingPercentage');
        var rating = Math.floor(voting.attr('data-percent') / 20);
        var stars = jQuery('.stars');
        var Data;
        var wHeight = $(window).height();
        NavBarView.addSlick.center();
        NavBarView.addSlick.synced();
        /*stars*/
        NavBarView.ratingStars(stars, rating);
        // getFabrics(this);
        jQuery('.btn-fabric').one('click', function (e) {
            getFabrics(this);
        });


        var ajaxContactForm = jQuery('#ajax-contact');
        var formMessages = jQuery('#form-messages');
        var quickMobileButton =jQuery('#quick-mobile-button');

        jQuery(ajaxContactForm).submit(function(event) {
            event.preventDefault();
        });

        jQuery(quickMobileButton).click(function() {

            var ajaxContactFormData = jQuery(ajaxContactForm).serialize();

            jQuery.ajax({
              type: 'POST',
              url: jQuery(ajaxContactForm).attr('action'),
              data: ajaxContactFormData
            })
            .done(function(response) {
              jQuery(formMessages).removeClass('error');
              jQuery(formMessages).addClass('success');

              jQuery(formMessages).text(response);

              console.log('1');
            })
            .fail(function(data) {
              jQuery(formMessages).removeClass('success');
              jQuery(formMessages).addClass('error');
              if (data.responseText !== '') {
                jQuery(formMessages).text(data.responseText);
              } else {
                jQuery(formMessages).text('Oops! An error occured and your message could not be sent.');
              }

            });
        });


        jQuery("#quickOrder")
        .hover(function(){
            var offset = $(this).offset();
            $(this).offset({top: offset.top + 2, left: offset.left + 2});
        })
        .mouseleave(function(){
            var offset = $(this).offset();
            $(this).offset({top: offset.top - 4, left: offset.left - 4});
        });


        function getFabrics(el) {
			
            console.log('getFabrics');
            var jqxhr = jQuery.get(root + "/includes/fabrics/fetch_fabrics.php",
                function (data) {
                    //
                }, "json")
                .done(function (data) {
                    Data = data;
					
					
                    dataWork(data);
                    NavBarView.addAccordion($);
                    addHandlers(el);
					
					
					
					
					
					
					
					
                })
                .fail(function (err) {
					
                });
				
			
			
			
			
				
        }

        function dataWork(data, expand) {

            var fabricsBodies = jQuery('.fabrics-body');
            fabricsBodies.hide();
            // console.log(jQuery(this));
			//alert("jQuery");
			//alert(jQuery(this));
            var fabrics = fabricsBodies.map(function () {
                var opt = jQuery.trim(jQuery(this).find('.fabric-title label').text());
				//alert("opt="+opt);
                var filterAndTemplate = filterByAndTemplate('name', opt, jQuery(this));//////////////////////////////////
				//alert("dataWork");
				//alert(filterAndTemplate);
				//
                return data.filter(filterAndTemplate);
				//return data;
            });
            if (expand) {
                fabricsBodies.find('.panel-collapse').addClass('in');
				
            } else {
                fabricsBodies.find('.panel-collapse').removeClass('in').first().addClass('in');
            }

        };

        function template(el, itemObject) {
			
            /*@el - '.fabrics-body'
             @itemObject - 'one fabrics array element'
             */
			//alert("template");
            var content = '<li class="fabric-group">' +
                '<div class="fabric-pic" data-toggle="tooltip" data-placement="bottom" title data-original-title="{name}">' +
                '<span class="icon-zoomin" data-input="#{inputId}">' +
                '<img id="{id}" class="img-thumbnail img-fabric" src="' + root + '{src}" alt="" />' +
                '</span>' +
                '</div>' +
                '</li>';
            var input = el.find('input[type="radio"]');
            var itemsList = el.find('.fill-fabrics');
            itemsList.html('');

            var inputId = (input) ? input[0].id : 0;
            var itemObjectItems = itemObject.items;
            itemObject.category = (input.attr('data-category') | 0) + '';

            itemObjectItems.forEach(function (item, index, array) {
                var src = getImage(item).replace('fabrics', 'sm-fabrics');
                var html = content.replace('{name}', item.colorOrigin)
                    .replace('{id}', item.colorOrigin)
                    .replace('{src}', src)
                    .replace('{inputId}', inputId);
                itemsList.append(html.replace("{inputId}", inputId));
            });
            el.find('.fabric-descr').html(itemObject.description);

            function getImage(item) {
                if (item.image) {
                    return item.image;
                } else if (item.extra_fields) {
                    return item.extra_fields[0].value;
                }
            }

            function getExtraFieldValue(argument) {
                item.extra_fields.forEach()
            }
        }


        function addHandlers(elt, data) {
            //
            var $elt = jQuery(elt);
            var modal = jQuery($elt.attr('data-target'));
            var index = modal.attr('data-index');
            var modalDialog = modal.find('.modal-dialog');
            var apply = {};
            var dropdown = modal.find('.dropdown');

            function zoomIn(event) {
				data_index=$('.fabricsModal.in').attr("data-index");
                event.preventDefault();
                var el = $(this);
                var img = el.find('.img-fabric');
                var src = img[0].src.replace('sm-', '');
                var imgZoom = $('#img-zoom');
                img.closest('.panel-body').prepend(imgZoom);
                imgZoom.attr('data-input', el.attr('data-input')).css('background-image', 'url(' + src + ')').show();
                adjustModalHeight();
                imgZoom.attr('data-fabric', img.attr('id'));
				
				$('html').on('click','#img-zoom', function () {                               
       			 	$('.fabricsModal').fadeOut(200);
					$('body').removeClass('modal-open'); 
					var id=$(this).attr("data-input");
					var id_m=id.split("-");
					id=id_m[2]; 
					
					$('.material_id_'+data_index).html(id);
    			});
				
				
            };
            function adjustModalHeight() {
                // modal.scrollTop(100);
                var height = Math.max(wHeight, modalDialog.height() + 100);
                $('.modal-backdrop').height(height);
            }

            function filtersTemplate(applied) {
                var $filtersUl = jQuery('#applied-filters' + index);
                $filtersUl.html('');
                if (Object.keys(applied).length) {
                    var content = '<li>{filter} : <span class="label label-default" data-filter="#{field}-filter' + index + '">{value} <span class="glyphicon glyphicon-remove"></span></span></li>';
                    var html = '<li>Фильтры</li>';
                    var clear = '<li ><span class="label label-default" id="clear-filters">Убрать фильтры<span class="glyphicon glyphicon-remove"></span></span></li>';

                    for (var filter in applied) {
                        if (applied[filter] != 'all') {
                            var type = jQuery.trim(jQuery('#fabric-' + filter + index).text()),
                                label = jQuery.trim(jQuery('#' + filter + '-filter' + index + '>li.active[data-field="' + applied[filter] + '"]').text());
                            html += content.replace('{filter}', type)
                                .replace('{field}', filter)
                                .replace('{value}', label);
                        }
                    }
                    html += clear;
                    $filtersUl.append(html);
                }
            }

            function pickFabric(event) {
                var bckg = jQuery(this).css('background-image');
                var input = $($(this).attr('data-input'));

                if (elt.classList.contains('btn-fabric')) {
                    $elt.css('background-image', bckg);
                }
                fabricValues.push({
                    name: 'fabric[fabric]',
                    value: $(this).attr('data-fabric')
                });
                input.change();
                modal.modal('hide');
            }


            function filters() {
                var elt;
                return function (event) {
                    event.preventDefault();

                    // body...
                    var filtered = Data.slice(0);
                    /*.dropdown-menu li*/
                    var $el = jQuery(this);
                    var $parent = $el.parent();
                    var key = $parent[0].id.replace('-filter' + index, '');
                    var value = $el.attr('data-field').toLowerCase();

                    $parent.find('.active').removeClass('active');
                    $el.addClass('active');

                    if (value === "all") {
                        delete apply[key];
                    } else {
                        apply[key] = value;
                    }

                    filtersTemplate(apply);

                    elt = $el;
                    for (var field in apply) {
                        filter(field, filtered);
                    }

                    if (Object.keys(apply).length) {
                        dataWork(filtered, true);
                    } else {
                        dataWork(filtered);
                    }
                    adjustModalHeight();

                    function filter(field, objArr) {
                        var compare = apply[field];
                        var filterFn = filterBy(field, compare);
                        if (field === 'color') {
                            var temp = objArr.slice(0).map(mapFn(field, compare));
                            filtered = temp.filter(function (element) {
                                return element.items.length;
                            });
                        } else {
                            filtered = objArr.filter(filterFn);
                        }
                        return filtered;

                    }
                }
            }

            function removeFilter(event) {

                var $el = jQuery(this);
                if (this.id === 'clear-filters' || $el.is(modal)) {
                    $('#applied-filters' + index).html('');
                    dropdown.find('.active').removeClass('active');
                    apply = {};
                    dataWork(Data);
                    adjustModalHeight();
                } else {
                    var dataField = $el.attr('data-filter');
                    $(dataField + ' li[data-field="all"]').click();
                }

            }

            modal.find('[data-toggle="tooltip"]').tooltip();
            /*tooltip init*/
            modal.find('.fabrics-accordion').on('click', '.icon-zoomin', zoomIn);

            modal.on('click', '.pick', pickFabric);
            modal.on('hidden.bs.modal', removeFilter);
            dropdown.on('click', '.dropdown-menu li', filters());

            $('#applied-filters' + index).on('click', '.label', removeFilter);

        };

        function filterByAndTemplate(field, value, elt) {
		    //alert("filterByAndTemplate");
            jQuery('[data-toggle="tooltip"]').tooltip();
			//alert("filterByAndTemplate1");
			
			//alert("control1");
			
			
			
			
			
			
			
            return function (element, index, array) {
				
                if (element[field] && element[field].toLowerCase() == value.toLowerCase()) {
                    elt.show();
					template(elt, element);
                    return element;
                }
            }
        }


        function mapFn(field, value) {
            /*color 'red'*/
            return function (element, index, array) {
                var temp = Object.create(element);
                temp.items = element.items.filter(filterBy(field, value));

                return temp;

            }
        }

        function filterBy(field, value) {
            return function (element, index, array) {
                if (element[field] && element[field].toLowerCase() == value.toLowerCase()) {
                    return element;
                }
            }
        }
    });
</script>