jQuery(document).ready(function($) {
	$('select').each(function() {
		var $this = $(this),
		numberOfOptions = $(this).children('option').length;
		$this.addClass('s-hidden');
		$this.wrap('<div class="select"></div>');
		$this.after('<div class="styledSelect"></div>');
		var $styledSelect = $this.next('div.styledSelect');
		$styledSelect.html('<i class="filt fa fa-sliders"></i> ' + $this.children('option').eq(0).text());
		var $list = $('<ul />', {
			'class': 'options'
		}).insertAfter($styledSelect);
		for (var i = 0; i < numberOfOptions; i++) {
			$('<li />', {
				text: $this.children('option').eq(i).text(),
				rel: $this.children('option').eq(i).val()
			}).appendTo($list);
		}
		var $listItems = $list.children('li');
		$styledSelect.click(function(e) {
			e.stopPropagation();
			$('div.styledSelect.active').each(function() {
				$(this).removeClass('active').next('ul.options').hide();
			});
			$(this).toggleClass('active').next('ul.options').toggle();
		});
		if( $this.hasClass( "list-only" ) ){
			$styledSelect.click();
			$listItems.click(function(e) {
				e.stopPropagation();
				$this.val($(this).attr('rel'));
				$(this.parentNode).find('li').removeClass('active');
				$(this).addClass('active');
			});
		} else{
			$listItems.click(function(e) {
				e.stopPropagation();
				$styledSelect.text($(this).text()).removeClass('active');
				$this.val($(this).attr('rel'));
				$list.hide();
			});
			$(document).click(function() {
				$styledSelect.removeClass('active');
				$list.hide();
			});
		}
	});
	// $('#tabs a').click(function (e) {
	// 	e.preventDefault()
	// 	$(this).tab('show')
	// });
});