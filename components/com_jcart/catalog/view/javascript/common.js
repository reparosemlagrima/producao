item_id='';	
click_id=0;
http_serv_url='';
if(http_serv_url=='' && typeof(http_serv_url_oc) != 'undefined')
http_serv_url=http_serv_url_oc;

if(item_id=='' && typeof(item_id_oc) != 'undefined'){
	item_id=item_id_oc;	
	item_id=item_id.replace(/&amp;/g,'&');
}
function getURLVar(key) {
	var value = [];

	var query = String(document.location).split('?');
	if(key=='route' && query[0]){
		if(query[0].indexOf("/checkout")>0)
			return "checkout/checkout";
		if(query[0].indexOf("/cart")>0)
			return "checkout/cart";
	}
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

jQuery(document).ready(function() {
	if(http_serv_url=='' && typeof(http_serv_url_oc) != 'undefined')
	http_serv_url=http_serv_url_oc;
	if(jQuery('input[name=\'item_param_id\']').val()){
		item_id=jQuery('input[name=\'item_param_id\']').val();
		item_id=item_id.replace(/&amp;/g,'&');
	}		
		
	if(jQuery('input[name=\'http_serv\']').val())
		http_serv_url=jQuery('input[name=\'http_serv\']').val();
	if(http_serv_url=='' && jQuery('base').attr('href'))
	http_serv_url=jQuery('base').attr('href');
	
	// Highlight any found errors
	jQuery('.text-danger').each(function() {
		var element = jQuery(this).parent().parent();

		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});

	// Currency
	jQuery('#form-currency .currency-select').on('click', function(e) {
		e.preventDefault();

		jQuery('#form-currency input[name=\'code\']').attr('value', jQuery(this).attr('name'));

		jQuery('#form-currency').submit();
	});

	// Language
	jQuery('#form-language .language-select').on('click', function(e) {
		e.preventDefault();

		jQuery('#form-language input[name=\'code\']').attr('value', jQuery(this).attr('name').split('/').pop());

		jQuery('#form-language').submit();
	});

	/* Search */
	jQuery('#search-oc input[name=\'search\']').parent().find('button').on('click', function() {
		var url = http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=product/search';

		var value = jQuery('#search-oc  input[name=\'search\']').val();

		if (value) {
			url += '&search=' + encodeURIComponent(value);
		}

		location = url;
	});

	jQuery('#search-oc input[name=\'search\']').on('keydown', function(e) {
		if (e.keyCode == 13) {
			jQuery('#search-oc  input[name=\'search\']').parent().find('button').trigger('click');
		}
	});
	// search module
	jQuery('#search-oc input[name=\'search_mod_oc\']').parent().find('button').on('click', function() {
		url = http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=product/search';

		var value = jQuery('input[name=\'search_mod_oc\']').val();

		if (value) {
			url += '&search=' + encodeURIComponent(value);
		}

		location = url;
	});
	jQuery('#search-oc input[name=\'search_mod_oc\']').on('keydown', function(e) {
		if (e.keyCode == 13) {
			jQuery('input[name=\'search_mod_oc\']').parent().find('button').trigger('click');
		}
	});

	// Menu
	jQuery('#menu-oc .dropdown-menu').each(function() {
		var menu = jQuery('#menu-oc').offset();
		var dropdown = jQuery(this).parent().offset();

		var i = (dropdown.left + jQuery(this).outerWidth()) - (menu.left + jQuery('#menu-oc').outerWidth());

		if (i > 0) {
			jQuery(this).css('margin-left', '-' + (i + 5) + 'px');
		}
	});

	// Product List
	jQuery('#list-view').click(function() {
		jQuery('#content-oc .product-grid > .clearfix').remove();

		jQuery('#content-oc .row > .product-grid').attr('class', 'product-layout product-list col-xs-12');

		localStorage.setItem('display', 'list');
	});
	var cols = jQuery('#column-right, #column-left, #aside, #sidebar, .left1, .right1, .tm-sidebar-a, .art-sidebar1, #g-siderbar').length;
	// Product Grid
	jQuery('#grid-view').click(function() {
		// What a shame bootstrap does not take into account dynamically loaded columns

		if (cols >= 2) {
			jQuery('#content-oc .product-list').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
		} else if (cols == 1) {
			jQuery('#content-oc .product-list').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12');
		} else {
			jQuery('#content-oc .product-list').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12');
		}

		localStorage.setItem('display', 'grid');
	});

	if (localStorage.getItem('display') == 'list') {
		jQuery('#list-view').trigger('click');
	} else {
		jQuery('#grid-view').trigger('click');
	}

	if (cols >= 2 && jQuery('#list-view').length<=0 ) {
		jQuery('#content-oc .product-layout > .clearfix').remove();
		jQuery('#content-oc .product-layout > .col-lg-3').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
		
		jQuery('#content-oc .row > .clearfix').remove();
		jQuery('#content-oc .row > .col-lg-3').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
	}
	else if (cols == 1 && jQuery('#list-view').length<=0 ) {
		jQuery('#content-oc .product-layout > .clearfix').remove();
		jQuery('#content-oc .product-layout > .col-lg-3').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12');
		
		jQuery('#content-oc .row > .clearfix').remove();
		jQuery('#content-oc .row > .col-lg-3').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12');
	}
	
	// for shopping cart module
	loadCartContent();
	
	// Checkout
	jQuery(document).on('keydown', '#collapse-checkout-option input[name=\'email\'], #collapse-checkout-option input[name=\'password\']', function(e) {
		if (e.keyCode == 13) {
			jQuery('#collapse-checkout-option #button-login').trigger('click');
		}
	});

	// tooltips on hover
	jQuery('[data-toggle=\'tooltip\']').tooltip({container: 'body'});

	// dropdown on click
	jQuery('[data-toggle=\'dropdown\']').dropdown();
	
	// Makes tooltips work on ajax generated content
	jQuery(document).ajaxStop(function() {
		jQuery('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
	});
});
previous_toggle_id = '';
function collapseToggle(thisObj) {
	current_toggle_id='';
	
	if(jQuery(thisObj).attr("href"))
	current_toggle_id = jQuery(thisObj).attr("href");
	else if(jQuery(thisObj).attr("data-target"))
	current_toggle_id = jQuery(thisObj).attr("data-target");
	
	if(previous_toggle_id != '' && current_toggle_id != '' && previous_toggle_id != current_toggle_id)
	jQuery(previous_toggle_id).collapse('hide');
	
	if(previous_toggle_id != '' && current_toggle_id != '' && previous_toggle_id == current_toggle_id) {
		jQuery(previous_toggle_id).collapse('toggle');		
	} else {
		jQuery(current_toggle_id).collapse('show');			
	}
	previous_toggle_id = current_toggle_id;
}

function loadCartContent(){
	click_id=Math.floor(Math.random()*100);
	if (jQuery('#cart').length > 0)
	jQuery('#cart > ul').load(http_serv_url + 'index.php?option=com_jcart&'+item_id+'tmpl=component&click_id='+click_id+'&route=common/cart/info ul li');
	if(jQuery('#module-cart').length > 0)
	jQuery('#module-cart').load(http_serv_url + 'index.php?option=com_jcart&'+item_id+'tmpl=component&module_cart=yes&click_id='+click_id+'&route=common/cart/info');	
}
// Cart add remove functions
var cart = {
	'add': function(product_id, quantity) {
		jQuery.ajax({
			url: http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=checkout/cart/add',
			type: 'post',
			data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				if (jQuery('#cart').length > 0)
				jQuery('#cart > button').button('loading');
			},
			complete: function() {
				jQuery('#cart > button').button('reset');
			},
			success: function(json) {
				jQuery('.alert, .text-danger').remove();

				if (json['redirect']) {
					location = json['redirect'];
				}

				if (json['success']) {
					jQuery('#content-oc').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

					// Need to set timeout otherwise it wont update the total
					setTimeout(function () {
						jQuery('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
					}, 100);

					jQuery('#notification').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					jQuery('html, body').animate({ scrollTop: 0 }, 'slow');

					loadCartContent();

				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'update': function(key, quantity) {
		jQuery.ajax({
			url: http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=checkout/cart/edit',
			type: 'post',
			data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				jQuery('#cart > button').button('loading');
			},
			complete: function() {
				jQuery('#cart > button').button('reset');
			},
			success: function(json) {
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					jQuery('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
				}, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
					location = http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=checkout/cart';
				} else {
					loadCartContent();
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'remove': function(key) {
		jQuery.ajax({
			url: http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=checkout/cart/remove',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				jQuery('#cart > button').button('loading');
			},
			complete: function() {
				jQuery('#cart > button').button('reset');
			},
			success: function(json) {
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					jQuery('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
				}, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
					location = http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=checkout/cart';
				} else {
					loadCartContent();
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

var voucher = {
	'add': function() {

	},
	'remove': function(key) {
		jQuery.ajax({
			url: http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=checkout/cart/remove',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				jQuery('#cart > button').button('loading');
			},
			complete: function() {
				jQuery('#cart > button').button('reset');
			},
			success: function(json) {
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					jQuery('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
				}, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
					location = http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=checkout/cart';
				} else {
					loadCartContent();
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

var wishlist = {
	'add': function(product_id) {
		jQuery.ajax({
			url: http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=account/wishlist/add',
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			success: function(json) {
				jQuery('.alert').remove();

				if (json['redirect']) {
					location = json['redirect'];
				}

				if (json['success']) {
					jQuery('#content-oc').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				}

				jQuery('#wishlist-total span').html(json['total']);
				jQuery('#wishlist-total').attr('title', json['total']);

				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'remove': function() {

	}
}

var compare = {
	'add': function(product_id) {
		jQuery.ajax({
			url: http_serv_url + 'index.php?option=com_jcart&'+item_id+'route=product/compare/add',
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			success: function(json) {
				jQuery('.alert').remove();

				if (json['success']) {
					jQuery('#content-oc').parent().before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

					jQuery('#compare-total').html(json['total']);

					jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'remove': function() {

	}
}

/* Agree to Terms */
jQuery(document).delegate('.agree', 'click', function(e) {
	e.preventDefault();

	jQuery('#modal-agree').remove();

	var element = this;

	jQuery.ajax({
		url: jQuery(element).attr('href'),
		type: 'get',
		dataType: 'html',
		success: function(data) {
			html  = '<div id="modal-agree" class="modal-oc">';
			html += '  <div class="modal-dialog">';
			html += '    <div class="modal-content">';
			html += '      <div class="modal-header">';
			html += '        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			html += '        <h4 class="modal-title">' + jQuery(element).text() + '</h4>';
			html += '      </div>';
			html += '      <div class="modal-body">' + data + '</div>';
			html += '    </div';
			html += '  </div>';
			html += '</div>';

			jQuery('body').append(html);

			jQuery('#modal-agree').modal('show');
		}
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