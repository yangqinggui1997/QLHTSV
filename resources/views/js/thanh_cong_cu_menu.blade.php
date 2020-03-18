<script>
$(function(){
	try
	{
		var lastScrollTop = 0;
		var khoaMenu = $("#a__id__khoaMenu");
		var left_menu = $("#div__id__left_menu");
		var span_km = $('#span__id__khoaMenu');
		var navMenu = $('#nav__id__nav_menu');
		var lenDT = $("#a__id__lenDauTrang");
		var toanMH = $('#a__id__toanManHinh');
		var spanTMH = $('#span__id__toanManHinh');
		/*Khoá / mở khoá menu*/
		if(khoaMenu.length)
			khoaMenu.on('click', function (){
				if(left_menu.hasClass('menu_fixed'))
				{
					left_menu.removeClass('menu_fixed');
					span_km.removeAttr('class');
					khoaMenu.attr('data-original-title', 'Khoá menu');
					khoaMenu.attr('data-original-title', 'Khoá menu');
					khoaMenu.tooltip('show');
					span_km.attr('class', 'glyphicon glyphicon-eye-close');
					left_menu.mCustomScrollbar("destroy");
				}
				else
				{
					left_menu.addClass("menu_fixed");
					span_km.removeAttr('class');
					span_km.attr('class', 'glyphicon glyphicon-eye-open');
					khoaMenu.attr('data-original-title', 'Mở khoá menu');
					khoaMenu.tooltip('show');init_sidebar_fixed();
				}
			});
		
		/*Cố định menu khi scroll top*/
		$(window).scroll(function(event){
			var st = $(this).scrollTop();
			if (st <= lastScrollTop)
			{
				/* upscroll code*/
				if(!st)
					navMenu.removeAttr('style');
				else
				{
					navMenu.css('background','#EDEDED');
					navMenu.css('position', 'fixed');
					navMenu.css('top', '0');
					navMenu.css('width', '-webkit-fill-available');
					navMenu.css('right', '0');
					if($('body').is('.nav-sm'))
						navMenu.css('margin-left', '70px');
					else
						navMenu.css('margin-left', '230px');
					navMenu.css('z-index', '1899');
				}
			}
			else
			{
				/*downscroll code*/
				var attribute = navMenu.attr('style');
				if(typeof attribute !== typeof undefined || attribute)
					navMenu.removeAttr('style');
			}
			lastScrollTop = st;
		});

		/*lên đầu trang*/
		if(lenDT.length)
			lenDT.click(function(){
				$('html,body').animate({scrollTop:0}, 'slow')
			});

		/*toàn màn hình*/
		if(toanMH.length)
		{
			var requestFullscreen = function(ele){
				if(ele.requestFullscreen)
					ele.requestFullscreen();
				else if(ele.webkitRequestFullscreen)
					ele.webkitRequestFullscreen();
				else if(ele.mozRequestFullScreen)
					ele.mozRequestFullScreen();
				else if(ele.msRequestFullscreen)
					ele.msRequestFullscreen();
				else
					console.log('Fullscreen API is not supported.');
			};

			var exitFullscreen = function(){
				if(document.exitFullscreen)
					document.exitFullscreen();
				else if(document.webkitExitFullscreen)
					document.webkitExitFullscreen();
				else if(document.mozCancelFullScreen)
					document.mozCancelFullScreen();
				else if(document.msExitFullscreen)
					document.msExitFullscreen();
				else
					console.log('Fullscreen API is not supported.');
			};

			var fsDocButton = document.getElementById('a__id__toanManHinh');
			fsDocButton.addEventListener('click', function(e){
				e.preventDefault();
				if(spanTMH.hasClass('glyphicon-resize-small'))
				{
					exitFullscreen();
					spanTMH.removeAttr('class');
					spanTMH.attr('class', 'glyphicon glyphicon-fullscreen');
					toanMH.attr('data-original-title', 'Toàn màn hình');
					toanMH.tooltip('show');
				}
				else
				{
					requestFullscreen(document.documentElement);
					spanTMH.removeAttr('class');
					spanTMH.attr('class', 'glyphicon glyphicon-resize-small');
					toanMH.attr('data-original-title', 'Thoát toàn màn hình');
					toanMH.tooltip('show');
				}
			});
		}

		return true;
	}
	catch(err)
	{
		alert('Lỗi: ' + err.stack + '!');
		return false;
	}
});
</script>