/* Author: Paat Sinsuwan

*/
var tmp_div = "";
getWorkListJson = function(){
	items = {};
	i = 0;
	work_list = jQuery('#work-list');
	jQuery(work_list).children().each(function(){
		a = jQuery(this).find('.video-item');
		items[i] = {};
		items[i]['video_id'] = jQuery(a[0]).attr('video_id');
		items[i]['host'] = jQuery(a[0]).attr('host_name');
		items[i]['ele'] = a;
		i++;
	});
	return items;
}

getThumbnail = function(video_id, host, ele){
	thumb = "";
	hostApiUrl = "";
	switch(host){
		case "vimeo":
			hostApiUrl = "http://vimeo.com/api/v2/video/"+video_id+".json?callback=?";
			jQuery.getJSON(hostApiUrl, function(res){
				jQuery(ele).children().first().children().first().append(jQuery("<img />").attr({
					"src" : res[0]["thumbnail_medium"],
					"class" : 'post-video-item'
				}));
				
			});
			break;
		case "youtube":
			hostApiUrl = "https://gdata.youtube.com/feeds/api/videos/"+video_id+"?v=2&alt=json&callback=?";
			jQuery.getJSON(hostApiUrl, function(res){
				jQuery(ele).children().first().children().first().append(jQuery("<img />").attr({
					"src" : res.entry["media$group"]["media$thumbnail"][1]['url'], 
					"class" : 'post-video-item'
				}));
			
			});
			
			break;
		default :
			break;
	}
}
loadThumbnailsAjax = function(){
	work_list_items = getWorkListJson();
	jQuery.each(work_list_items, function(arrayID, item){	
		getThumbnail(item.video_id, item.host, item.ele);
	});
}

jQuery().ready(function(){
	// fancybox stuffs
	jQuery('.fancybox').fancybox({
		autoSize : false,
		width : 850,
		minHeight: 300
	});
	
	if(jQuery('#work-list')){
		loadThumbnailsAjax();
		jQuery('#loading-wrapper').fadeOut(400, function(){
			jQuery('#work-list').fadeIn(400);
		});
		jQuery('.work-item-wrapper').hover(function(){
			jQuery(this).addClass('flip');
		}, function(){
			jQuery(this).removeClass('flip');
		});
		// jQuery('.work-item-front').mouseenter(function(){
		// 			jQuery(this).flip({
		// 				direction:'lr',
		// 				content: jQuery('.work-item-back')
		// 			});
		// 		});
		// 		jQuery('.work-item-front').mouseout(function(){
		// 			jQuery(this).revertFlip();
		// 		});
	}
});


