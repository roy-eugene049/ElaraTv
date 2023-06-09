<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php echo e(__('Watch Trailer')); ?> - <?php echo e($movie->title); ?></title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1 user-scalable=no" />
		
		<link rel="stylesheet" type="text/css"  href="<?php echo e(url('content/global.css')); ?>"/>
		<?php
	    	$cpy = App\PlayerSetting::first();
	    	$text = $cpy->cpy_text;
	    	$app_url = config('app.url');
		?>
		
		<script type="text/javascript">
			var cpy = "<?= $text ?>";
			var app_url = "<?= $app_url ?>";
		</script>
		<script type="text/javascript" src="<?php echo e(asset('java/FWDUVPlayer.js')); ?>"></script>
		
		<!-- Setup video player-->
		<script type="text/javascript">
			FWDUVPUtils.onReady(function(){

				new FWDUVPlayer({		
					//main settings
					instanceName:"player1",
					parentId:"myDiv",
					playlistsId:"playlists",
					mainFolderPath:"<?php echo e(url('content')); ?>",
					skinPath:"minimal_skin_dark",
					displayType:"fullscreen",
					initializeOnlyWhenVisible:"no",
					useVectorIcons:"no",
					fillEntireVideoScreen:"yes",
					fillEntireposterScreen:"yes",
					goFullScreenOnButtonPlay:"yes",
					playsinline:"yes",
					fillEntireVideoScreen:"no",
					privateVideoPassword:"428c841430ea18a70f7b06525d4b748a",
					useHEXColorsForSkin:"no",
					normalHEXButtonsColor:"#FF0000",
					selectedHEXButtonsColor:"#000000",
					<?php if(isset($cpy->chromecast) && $cpy->chromecast == 1): ?>
					showChromecastButton:"yes",
					<?php else: ?>
					showChromecastButton:"no",
					<?php endif; ?>
					<?php if(isset($cpy->player_google_analytics_id)): ?>
					googleAnalyticsTrackingCode:"<?php echo e($cpy->player_google_analytics_id); ?>",
					<?php else: ?>
					googleAnalyticsTrackingCode:"",
					<?php endif; ?>
					useDeepLinking:"no",
					<?php if($cpy->is_resume ==1): ?>
					useResumeOnPlay:"yes",
					<?php else: ?>
					useResumeOnPlay:"no",
					<?php endif; ?>
					showPreloader:"yes",
					preloaderBackgroundColor:"#000000",
					preloaderFillColor:"#FFFFFF",
					rightClickContextMenu:"developer",
					addKeyboardSupport:"yes",
					autoScale:"yes",
					showButtonsToolTip:"yes", 
					stopVideoWhenPlayComplete:"no",
					playAfterVideoStop:"no",
					<?php if($cpy->auto_play ==1): ?>
					autoPlay:"yes",
					<?php else: ?>
					autoPlay:"no",
					<?php endif; ?>
					//autoPlay:"yes",
					loop:"no",
					shuffle:"no",
					showErrorInfo:"yes",
					maxWidth:980,
					maxHeight:552,
					buttonsToolTipHideDelay:1.5,
					volume:.8,
					backgroundColor:"#000000",
					videoBackgroundColor:"#000000",
					posterBackgroundColor:"#000000",
					buttonsToolTipFontColor:"#5a5a5a",
					//logo settings
					<?php if($cpy->logo_enable ==1): ?>
					showLogo:"yes",
					<?php else: ?>
					showLogo:"no",
					<?php endif; ?>
					hideLogoWithController:"yes",
					logoPosition:"topRight",
					logoLink:"<?php echo e(config('app.url')); ?>",
					logoMargins:5,
					//playlists/categories settings
					showPlaylistsSearchInput:"yes",
					usePlaylistsSelectBox:"yes",
					showPlaylistsButtonAndPlaylists:"yes",
					showPlaylistsByDefault:"no",
					thumbnailSelectedType:"opacity",
					startAtPlaylist:0,
					buttonsMargins:15,
					thumbnailMaxWidth:350, 
					thumbnailMaxHeight:350,
					horizontalSpaceBetweenThumbnails:40,
					verticalSpaceBetweenThumbnails:40,
					inputBackgroundColor:"#333333",
					inputColor:"#999999",
					//playlist settings
					showPlaylistButtonAndPlaylist:"yes",
					playlistPosition:"right",
					showPlaylistByDefault:"no",
					showPlaylistName:"yes",
					showSearchInput:"no",
					showLoopButton:"yes",
					showShuffleButton:"yes",
					showNextAndPrevButtons:"yes",
					showThumbnail:"yes",
					forceDisableDownloadButtonForFolder:"no",
					addMouseWheelSupport:"yes", 
					startAtRandomVideo:"no",
					stopAfterLastVideoHasPlayed:"no",
					folderVideoLabel:"VIDEO ",
					playlistRightWidth:310,
					playlistBottomHeight:599,
					startAtVideo:0,
					maxPlaylistItems:50,
					thumbnailWidth:70,
					thumbnailHeight:70,
					spaceBetweenControllerAndPlaylist:2,
					spaceBetweenThumbnails:2,
					scrollbarOffestWidth:8,
					scollbarSpeedSensitivity:.5,
					playlistBackgroundColor:"#000000",
					playlistNameColor:"#FFFFFF",
					thumbnailNormalBackgroundColor:"#1b1b1b",
					thumbnailHoverBackgroundColor:"#313131",
					thumbnailDisabledBackgroundColor:"#272727",
					searchInputBackgroundColor:"#000000",
					searchInputColor:"#999999",
					youtubeAndFolderVideoTitleColor:"#FFFFFF",
					folderAudioSecondTitleColor:"#999999",
					youtubeOwnerColor:"#888888",
					youtubeDescriptionColor:"#888888",
					mainSelectorBackgroundSelectedColor:"#FFFFFF",
					mainSelectorTextNormalColor:"#FFFFFF",
					mainSelectorTextSelectedColor:"#000000",
					mainButtonBackgroundNormalColor:"#212021",
					mainButtonBackgroundSelectedColor:"#FFFFFF",
					mainButtonTextNormalColor:"#FFFFFF",
					mainButtonTextSelectedColor:"#000000",
					//controller settings
					showController:"yes",
					showControllerWhenVideoIsStopped:"yes",
					showNextAndPrevButtonsInController:"no",
					showRewindButton:"yes",
					showPlaybackRateButton:"yes",
					showVolumeButton:"yes",
					showTime:"yes",
					showQualityButton:"yes",
					showInfoButton:"yes",
					showDownloadButton:"yes",
					
					<?php if($cpy->share_opt ==1): ?>
					showShareButton:"yes",
					<?php else: ?>
					showShareButton:"no",
					<?php endif; ?>
					
					showEmbedButton:"no",
					showFullScreenButton:"yes",
					disableVideoScrubber:"no",
					showMainScrubberToolTipLabel:"yes",
					showDefaultControllerForVimeo:"no",
					repeatBackground:"yes",
					controllerHeight:37,
					controllerHideDelay:3,
					startSpaceBetweenButtons:7,
					spaceBetweenButtons:8,
					scrubbersOffsetWidth:2,
					mainScrubberOffestTop:14,
					timeOffsetLeftWidth:5,
					timeOffsetRightWidth:3,
					timeOffsetTop:0,
					volumeScrubberHeight:80,
					volumeScrubberOfsetHeight:12,
					timeColor:"#888888",
					youtubeQualityButtonNormalColor:"#888888",
					youtubeQualityButtonSelectedColor:"#FFFFFF",
					scrubbersToolTipLabelBackgroundColor:"#FFFFFF",
					scrubbersToolTipLabelFontColor:"#5a5a5a",
					//advertisement on pause window
					aopwTitle:"Advertisement",
					aopwWidth:400,
					aopwHeight:240,
					aopwBorderSize:6,
					aopwTitleColor:"#FFFFFF",
					//subtitle
					subtitlesOffLabel:"Subtitle on",
					//popup add windows
					showPopupAdsCloseButton:"yes",
					//embed window and info window
					embedAndInfoWindowCloseButtonMargins:0,
					borderColor:"#333333",
					mainLabelsColor:"#FFFFFF",
					secondaryLabelsColor:"#a1a1a1",
					shareAndEmbedTextColor:"#5a5a5a",
					inputBackgroundColor:"#000000",
					inputColor:"#FFFFFF",
					//loggin
					isLoggedIn:"yes",
					playVideoOnlyWhenLoggedIn:"yes",
					loggedInMessage:"Please login to view this video.",
					//audio visualizer
					audioVisualizerLinesColor:"#0099FF",
					audioVisualizerCircleColor:"#FFFFFF",
					//lightbox settings
					lightBoxBackgroundOpacity:.6,
					lightBoxBackgroundColor:"#000000",
					//sticky on scroll
					stickyOnScroll:"no",
					stickyOnScrollShowOpener:"yes",
					stickyOnScrollWidth:"700",
					stickyOnScrollHeight:"394",
					//sticky display settings
					showOpener:"yes",
					showOpenerPlayPauseButton:"yes",
					verticalPosition:"bottom",
					horizontalPosition:"center",
					showPlayerByDefault:"yes",
					animatePlayer:"yes",
					openerAlignment:"right",
					mainBackgroundImagePath:"<?php echo e(url('content/minimal_skin_dark/main-background.png')); ?>",
					openerEqulizerOffsetTop:-1,
					openerEqulizerOffsetLeft:3,
					offsetX:0,
					offsetY:0,
					//playback rate / speed
					defaultPlaybackRate:1, //0.25, 0.5, 1, 1.25, 1.2, 2
					//cuepoints
					executeCuepointsOnlyOnce:"no",
					//annotations
					showAnnotationsPositionTool:"no",
					//ads
					openNewPageAtTheEndOfTheAds:"no",
					playAdsOnlyOnce:"no",
					adsButtonsPosition:"left",
					skipToVideoText:"You can skip to video in: ",
					skipToVideoButtonText:"Skip Ad",
					adsTextNormalColor:"#888888",
					adsTextSelectedColor:"#FFFFFF",
					adsBorderNormalColor:"#666666",
					adsBorderSelectedColor:"#FFFFFF",
					//a to b loop
					useAToB:"yes",
					atbTimeBackgroundColor:"transparent",
					atbTimeTextColorNormal:"#888888",
					atbTimeTextColorSelected:"#FFFFFF",
					atbButtonTextNormalColor:"#888888",
					atbButtonTextSelectedColor:"#FFFFFF",
					atbButtonBackgroundNormalColor:"#FFFFFF",
					atbButtonBackgroundSelectedColor:"#000000",
					// context menu
                    showContextmenu:'yes',
                    showScriptDeveloper:"no",
                    contextMenuBackgroundColor:"#1F1F1F",
                    contextMenuBorderColor:"#1F1F1F",
                    contextMenuSpacerColor:"#333",
                    contextMenuItemNormalColor:"#888888",
                    contextMenuItemSelectedColor:"#FFFFFF",
                    contextMenuItemDisabledColor:"#333",
//thumbnails preview
                    thumbnailsPreviewWidth:196,
                    thumbnailsPreviewHeight:110,
                    thumbnailsPreviewBackgroundColor:"#000000",
                    thumbnailsPreviewBorderColor:"#666",
                    thumbnailsPreviewLabelBackgroundColor:"#666",
                    thumbnailsPreviewLabelFontColor:"#FFF",
                    rewindTime:10
				});

				
			});

			

			
		</script>
		
	</head>

	<body style="background-color:#999999; padding:0px; margin:0px;">	
		
		<div id="myDiv" style="position:relative; left:1000px; top:5000px;"></div>
	
		<!--  Playlists -->
		<ul id="playlists" style="display:none;">
		
		  <li data-source="trailer" data-playlist-name="<?php echo e($movie->title); ?>" data-thumbnail-path="<?php echo e(asset('images/movies/thumbnails/'.$movie->thumbnail)); ?>">
       <!--  <p class="minimalDarkCategoriesTitle"><span class="minimialDarkBold"><?php echo e(__('title')); ?>: <?php echo e($movie->title); ?></span></p>
        <p class="minimalDarkCategoriesDescription"><span class="minimialDarkBold"><?php echo e(__('description')); ?>: </span><?php echo e($movie->detail); ?></p> -->
      	</li>


			
		</ul>

		<ul id="trailer">
			<?php
			$url = str_replace("https://youtu.be/", "https://youtube.com/watch?v=", $movie->trailer_url)
			?>
			<li data-subtitle-soruce="[{source:'<?php echo e(url('subtitles/english_subtitle.txt')); ?>', label:'English'}]" data-thumb-source="<?php echo e(asset('images/movies/thumbnails/'.$movie->thumbnail)); ?>" data-video-source="<?php echo e($url); ?>" data-downloadable="yes" data-poster-source="<?php echo e(asset('images/movies/posters/'.$movie->poster)); ?>"> 
			    <!-- <div data-video-short-description="">
			    	 <p class="minimalDarkCategoriesTitle"><span class="minimialDarkBold"><?php echo e(__('Title')); ?>: </span><?php echo e($movie->title); ?></p>
        <p class="minimalDarkCategoriesDescription"><span class="minimialDarkBold"><?php echo e(__('Description')); ?>: </span><?php echo e($movie->detail); ?></p>
			    </div> -->
			</li>
		</ul>
		
	</body>
</html>




<?php /**PATH /home3/elaratvc/elaratv.in/resources/views/watch.blade.php ENDPATH**/ ?>