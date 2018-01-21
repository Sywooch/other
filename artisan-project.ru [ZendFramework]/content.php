<?php
/**
 * @package louis
 */
?>



<article class=" ">
    <div class="box-card dvd" data-cardtype="release">
        <div class="preview-image">
        <div style="display:none;">
		<?php
		$id_post=the_ID();
		
		$post = get_post($id_post);
		$tmp=0;
		if($post->post_content==""){
		$tmp=1;
		}
		?>
        </div>
        
        
        
        
        <?php if($tmp==1){  ?>
        <div style="    position: absolute;
    right: 0px;
    top: 0px;
    background-color: #fff;
    color: #494949;
    z-index: 9999;
    padding: 7px;
    font-weight: bold;
    font-size: 14px;">НЕТ ВИДЕО</div>
        <?php } ?>
            <a href="#" onClick="video('<?php the_ID(); ?>');" data-id="<?php the_ID(); ?>">
                <img src="<?php the_field('image'); ?>" alt="<?php the_title(); ?>" class="">
                                <div class="play">
                    <span class="overlay"></span>
                                    </div>
            </a>

        </div>
        <div class="title-bar">
            <div class="title-text">
                <h4 style="text-overflow: ellipsis;">
                                            <span style="left: 0px;">
                                                        <a href="#" onClick="video('<?php the_ID(); ?>');" data-id="<?php the_ID(); ?>">
                                <?php the_title(); ?>                            </a>
                        </span>
                                    </h4>
            </div>
            <div class="icon-bar">
    <a href="/nats/join/ldma/" id="favorite" class="button favorite" rel="nofollow" title="Add To Favorites">
        <span class="icon icon-favorite"></span>
    </a>
    <a href="/nats/join/ldma/" id="watchlater" class="button" rel="nofollow" title="Watch Later" data-trackid="DP:TOUR:MOVIES:LINK trailer add to watchlist -   sceneid=47971 dvd">
        <span class="icon icon-watchlist"></span>
    </a>
</div>        </div>
        <div class="release-info">
            <div class="info-left">
                <div class="subtitle-container">
                    <h4 style="text-overflow: ellipsis;">
                        <span class="subtitle" style="left: 0px;">
                            <a href="/movies/trailer/48671/sex-machina-a-xxx-parody/" adid="ID:47971-subtitleClick_CurrentURL:/movies/_TargetURL:/movies/trailer/48671/sex-machina-a-xxx-parody/" cerebro-trackid="ID:47971-subtitleClick_CurrentURL:/movies/_TargetURL:/movies/trailer/48671/sex-machina-a-xxx-parody/" class="track" title="" data-trackid="DP:TOUR:MOVIES:LINK trailer subtitle -   sceneid=47971 dvd"><?php the_field('scenes'); ?> <strong>сцен</strong></a>
                        </span>
                    </h4>
                </div>
                <span class=""><span><?php the_field('duration'); ?></span></span>
                <span><?php the_field('date'); ?></span>
            </div>
                            <div class="info-right">
                    <span class="likes">387<span class="icon icon-likes"></span></span>
                    <span class="middle">60532<span class="icon icon-views"></span></span>
                    <span>
                        <span data-cc-enabled="true" data-cc-objecttype="v" data-cc-objectid="47971" data-cc-appid="dp">2</span><span class="icon icon-comments"></span>
                    </span>
                </div>
                    </div>
    </div>
    
    
    <div id="video_<?php the_ID(); ?>" style="width:90%; height:90%; top:5%; left:5%; position:fixed; z-index:99999; background-color:#fff; display:none; border:2px black solid;">
    <div class="close_button"></div>
    <?php
		the_content();
	?>
    </div>
    
    
    
</article>


<!--
<div class="col-1-3">
      <div class="wrap-col">
      
      <div <?php post_class( 'blogpost' ); ?>>
      <div class="blogimage tmp1">
       <a href="<?php the_permalink();?>" class="blogimagelink"><?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'louis-frontpage-news', array( 'class' => '' ) );
								} else { ?>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default.gif" alt="<?php the_title(); ?>" />
						<?php } ?><i class="fa fa-chevron-right"></i></a>
      </div>
                        
      <h3 class="blogposttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <div class="blogposttext"><?php the_excerpt(); ?></div>
      <p class="blogpostmeta"><i class="fa fa-calendar"></i> <a href="<?php the_permalink(); ?>"><?php the_time('l, F jS, Y') ?></a></p>
      </div>

 
</div>
</div>--><!-- end col-1-3 -->