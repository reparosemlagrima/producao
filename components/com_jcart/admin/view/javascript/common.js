function getURLVar(key) {
	var value = [];

	var query = String(document.location).split('?');

	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');

			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}

		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
}
function ocFileManager(field_name, url, type, win) {
	//alert(field_name + ':' + url + ':' + type + ':' + win);
	jQuery('#modal-image').remove();	
	jQuery.ajax({
		url: 'index.php?option=com_jcart&tmpl=component&route=common/filemanager&token=' + getURLVar('token') +  '&target='+field_name,
		dataType: 'html',
		beforeSend: function() {
			jQuery('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
			jQuery('#button-image').prop('disabled', true);
		},
		complete: function() {
			jQuery('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
			jQuery('#button-image').prop('disabled', false);
		},
		success: function(html) {
			jQuery('body').append('<div id="modal-image" class="modal-oc" style="z-index:99999;">' + html + '</div>');

			jQuery('#modal-image').modal('show');
		}
	});	
	return false;
}
jQuery(document).ready(function() {
	//Form Submit for IE Browser
	jQuery('button[type=\'submit\']').on('click', function() {
		jQuery("form[id*='form-']").submit();
	});

	// Highlight any found errors
	jQuery('.text-danger').each(function() {
		var element = jQuery(this).parent().parent();

		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});

	// Set last page opened on the menu
	jQuery('#menu-oc a[href]').on('click', function() {
		sessionStorage.setItem('menu', jQuery(this).attr('href'));
	});

	if (!sessionStorage.getItem('menu')) {
		jQuery('#menu-oc #dashboard').addClass('active');
	} else {
		// Sets active and open to selected page in the left column menu.
		jQuery('#menu-oc a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('li').addClass('active open');
	}

	if (localStorage.getItem('column-left') == 'active') {
		jQuery('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');

		jQuery('#column-left').addClass('active');

		// Slide Down Menu
		jQuery('#menu-oc li.active').has('ul').children('ul').addClass('collapse in');
		jQuery('#menu-oc li').not('.active').has('ul').children('ul').addClass('collapse');
	} else {
		jQuery('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');

		jQuery('#menu-oc li li.active').has('ul').children('ul').addClass('collapse in');
		jQuery('#menu-oc li li').not('.active').has('ul').children('ul').addClass('collapse');
	}

	// Menu button
	jQuery('#button-menu').on('click', function() {
		// Checks if the left column is active or not.
		if (jQuery('#column-left').hasClass('active')) {
			localStorage.setItem('column-left', '');

			jQuery('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');

			jQuery('#column-left').removeClass('active');

			jQuery('#menu-oc > li > ul').removeClass('in collapse');
			jQuery('#menu-oc > li > ul').removeAttr('style');
		} else {
			localStorage.setItem('column-left', 'active');

			jQuery('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');

			jQuery('#column-left').addClass('active');

			// Add the slide down to open menu items
			jQuery('#menu-oc li.open').has('ul').children('ul').addClass('collapse in');
			jQuery('#menu-oc li').not('.open').has('ul').children('ul').addClass('collapse');
		}
	});

	// Menu
	jQuery('#menu-oc').find('li').has('ul').children('a').on('click', function() {
		if (jQuery('#column-left').hasClass('active')) {
			jQuery(this).parent('li').toggleClass('open').children('ul').collapse('toggle');
			jQuery(this).parent('li').siblings().removeClass('open').children('ul.in').collapse('hide');
		} else if (!jQuery(this).parent().parent().is('#menu-oc')) {
			jQuery(this).parent('li').toggleClass('open').children('ul').collapse('toggle');
			jQuery(this).parent('li').siblings().removeClass('open').children('ul.in').collapse('hide');
		}
	});

	// Tooltip remove fixed
	jQuery(document).delegate('[data-toggle=\'tooltip\']', 'click', function(e) {
		jQuery('body > .tooltip').remove();
	});
/*
	// Override summernotes image manager
	jQuery('.summernote').each(function() {
		var element = this;
		
		jQuery(element).summernote({
			disableDragAndDrop: true,
			height: 300,
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'underline', 'clear']],
				['fontname', ['fontname']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'image', 'video']],
				['view', ['fullscreen', 'codeview', 'help']]
			],
			buttons: {
    			image: function() {
					var ui = jQuery.summernote.ui;

					// create button
					var button = ui.button({
						contents: '<i class="fa fa-image" />',
						tooltip: jQuery.summernote.lang[jQuery.summernote.options.lang].image.image,
						click: function () {
							jQuery('#modal-image').remove();
						
							jQuery.ajax({
								url: 'index.php?option=com_jcart&tmpl=component&route=common/filemanager&token=' + getURLVar('token'),
								dataType: 'html',
								beforeSend: function() {
									jQuery('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
									jQuery('#button-image').prop('disabled', true);
								},
								complete: function() {
									jQuery('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
									jQuery('#button-image').prop('disabled', false);
								},
								success: function(html) {
									jQuery('body').append('<div id="modal-image" class="modal-oc">' + html + '</div>');

									jQuery('#modal-image').modal('show');
									
									jQuery('#modal-image').delegate('a.thumbnail', 'click', function(e) {
										e.preventDefault();
										
										jQuery(element).summernote('insertImage', jQuery(this).attr('href'));
																	
										jQuery('#modal-image').modal('hide');
									});
								}
							});						
						}
					});
				
					return button.render();
				}
  			}
		});
	});
*/
	jQuery(document).delegate('button[data-toggle=\'image\']', 'click', function() {
		jQuery('#modal-image').remove();

		jQuery(this).parents('.note-editor').find('.note-editable').focus();

		jQuery.ajax({
			url: 'index.php?option=com_jcart&tmpl=component&route=common/filemanager&token=' + getURLVar('token'),
			dataType: 'html',
			beforeSend: function() {
				jQuery('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				jQuery('#button-image').prop('disabled', true);
			},
			complete: function() {
				jQuery('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
				jQuery('#button-image').prop('disabled', false);
			},
			success: function(html) {
				jQuery('body').append('<div id="modal-image" class="modal-oc">' + html + '</div>');

				jQuery('#modal-image').modal('show');
			}
		});
	});

	// Image Manager
	jQuery(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
		e.preventDefault();

		jQuery('.popover').popover('hide', function() {
			jQuery('.popover').remove();
		});

		var element = this;

		jQuery(element).popover({
			html: true,
			placement: 'right',
			trigger: 'manual',
			content: function() {
				return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
			}
		});

		jQuery(element).popover('show');

		jQuery('#button-image').on('click', function() {
			jQuery('#modal-image').remove();

			jQuery.ajax({
				url: 'index.php?option=com_jcart&tmpl=component&route=common/filemanager&token=' + getURLVar('token') + '&target=' + jQuery(element).parent().find('input').attr('id') + '&thumb=' + jQuery(element).attr('id'),
				dataType: 'html',
				beforeSend: function() {
					jQuery('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
					jQuery('#button-image').prop('disabled', true);
				},
				complete: function() {
					jQuery('#button-image i').replaceWith('<i class="fa fa-pencil"></i>');
					jQuery('#button-image').prop('disabled', false);
				},
				success: function(html) {
					jQuery('body').append('<div id="modal-image" class="modal-oc">' + html + '</div>');

					jQuery('#modal-image').modal('show');
				}
			});

			jQuery(element).popover('hide', function() {
				jQuery('.popover').remove();
			});
		});

		jQuery('#button-clear').on('click', function() {
			jQuery(element).find('img').attr('src', jQuery(element).find('img').attr('data-placeholder'));

			jQuery(element).parent().find('input').attr('value', '');

			jQuery(element).popover('hide', function() {
				jQuery('.popover').remove();
			});
		});
	});

	// tooltips on hover
	jQuery('[data-toggle=\'tooltip\']').tooltip({container: 'body', html: true});

	// dropdown on click
	jQuery('[data-toggle=\'dropdown\']').dropdown();
	// Makes tooltips work on ajax generated content
	jQuery(document).ajaxStop(function() {
		jQuery('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
	});

	// https://github.com/opencart/opencart/issues/2595
	jQuery.event.special.remove = {
		remove: function(o) {
			if (o.handler) {
				o.handler.apply(this, arguments);
			}
		}
	}

	jQuery('[data-toggle=\'tooltip\']').on('remove', function() {
		jQuery(this).tooltip('destroy');
	});
});

// Autocomplete */
(function($) {
	$.fn.autocomplete = function(option) {
		return this.each(function() {
			this.timer = null;
			this.items = new Array();

			$.extend(this, option);

			$(this).attr('autocomplete', 'off');

			// Focus
			$(this).on('focus', function() {
				this.request();
			});

			// Blur
			$(this).on('blur', function() {
				setTimeout(function(object) {
					object.hide();
				}, 200, this);
			});

			// Keydown
			$(this).on('keydown', function(event) {
				switch(event.keyCode) {
					case 27: // escape
						this.hide();
						break;
					default:
						this.request();
						break;
				}
			});

			// Click
			this.click = function(event) {
				event.preventDefault();

				value = $(event.target).parent().attr('data-value');

				if (value && this.items[value]) {
					this.select(this.items[value]);
					this.hide();
				}
			}

			// Show
			this.show = function() {
				var pos = $(this).position();

				$(this).siblings('ul.dropdown-menu').css({
					top: pos.top + $(this).outerHeight(),
					left: pos.left
				});

				$(this).siblings('ul.dropdown-menu').show();
			}

			// Hide
			this.hide = function() {
				$(this).siblings('ul.dropdown-menu').hide();
			}

			// Request
			this.request = function() {
				clearTimeout(this.timer);

				this.timer = setTimeout(function(object) {
					object.source($(object).val(), $.proxy(object.response, object));
				}, 200, this);
			}

			// Response
			this.response = function(json) {
				html = '';

				if (json.length) {
					for (i = 0; i < json.length; i++) {
						this.items[json[i]['value']] = json[i];
					}

					for (i = 0; i < json.length; i++) {
						if (!json[i]['category']) {
							html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
						}
					}

					// Get all the ones with a categories
					var category = new Array();

					for (i = 0; i < json.length; i++) {
						if (json[i]['category']) {
							if (!category[json[i]['category']]) {
								category[json[i]['category']] = new Array();
								category[json[i]['category']]['name'] = json[i]['category'];
								category[json[i]['category']]['item'] = new Array();
							}

							category[json[i]['category']]['item'].push(json[i]);
						}
					}

					for (i in category) {
						if(category[i]['item']) {
						html += '<li class="dropdown-header">' + category[i]['name'] + '</li>';

						for (j = 0; j < category[i]['item'].length; j++) {
							html += '<li data-value="' + category[i]['item'][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[i]['item'][j]['label'] + '</a></li>';
						}
						}
					}
				}

				if (html) {
					this.show();
				} else {
					this.hide();
				}

				$(this).siblings('ul.dropdown-menu').html(html);
			}

			$(this).after('<ul class="dropdown-menu"></ul>');
			$(this).siblings('ul.dropdown-menu').delegate('a', 'click', $.proxy(this.click, this));	

		});
	}
})(window.jQuery);
// MooTools
if(typeof MooTools != 'undefined' ) {
	window.addEvent('domready',function() {
		Element.prototype.hide = function() {       
			// Do nothing
		};
	});
}