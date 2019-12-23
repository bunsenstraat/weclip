/*
* 	Class wpLink
*
*	Replacement for default wordpress script: wp-includes/js/wplink.js 
*	Handles all the linking stuff
*/

var wpLink, ltecWpLink;

(function($){
	var inputs = {}, rivers = {}, ed, River, Query;
	
	// Global change: linkToExistingContent.wpLinkL10n instead of wpLinkL10n
	// Custom functions for the shortcode functionality
	
	$(document).ready(function(){
		//$("#wp-link").parents("div").show().prependTo("body");
	})
	
	ltecWpLink = {
		
		objectType : "posts",
		
		init : function() {
			// Add Shortcode label span
			inputs.url.prev("span").addClass("label label-url").clone().insertAfter(".label-url:first").addClass("label label-shortcode").removeClass("label-url").text(linkToExistingContent.wpLinkL10n.shortcodeLabel);
			
			// Add clear-shortcode button
			inputs.url.after("<div id='clear-shortcode'> </div>");
			
			// Add click handler to url label
			inputs.url.parents("label:first").click(function(){
				if($(this).hasClass("has-shortcode")) {
					ltecWpLink.resetFields();	
				};
			})
			
			// Stop the search results from reacting to keyboard events in the url / title field
			$("#link-options").keydown(function(e){
				e.stopPropagation();
			})
			
			// If the url field contains a shortcode, adjust the submit button to show Add Shortcode
			inputs.url.keyup(function(){
				if(inputs.url.val().indexOf("["+linkToExistingContent.shortcodeName) == 0 && inputs.url.val().substr(-1) == "]" ) {
					inputs.submit.val(linkToExistingContent.wpLinkL10n.saveShortcode);
				} else {
					inputs.submit.val(linkToExistingContent.wpLinkL10n.save);
				}
			})
			
			// Update the shortcode title on key events in the title field
			inputs.title.keyup(ltecWpLink.updateShortcodeTitle);
			$("#link-options").click(ltecWpLink.updateShortcodeTitle);
			
			// Build the Post Type – Taxonomy Select
			$("#search-panel .link-search-wrapper label:first").clone().appendTo("#search-panel .link-search-wrapper").attr("id", "ltec-search-in");
			$("#ltec-search-in .search-label").text(linkToExistingContent.wpLinkL10n.searchIn)
			$("#ltec-search-in #search-field").remove();
			$("#ltec-search-in").append("<select id='ltec-search-select' class='link-search-field'></select>");
			inputs.searchSelect = $("#ltec-search-select");
			inputs.searchSelect.append("<option class='posts' value='posts' selected='selected'>"+linkToExistingContent.wpLinkL10n.searchPostsLabel+"</option>");
			inputs.searchSelect.append("<option class='taxonomies' value='taxonomies'>"+linkToExistingContent.wpLinkL10n.searchCategoriesLabel+"</option>");
			inputs.searchSelect.change(function(){
				wpLink.lastSearch = -1;
				ltecWpLink.objectType = inputs.searchSelect.find("option:selected").val();
				inputs.search.val("");
				inputs.search.trigger("keyup");
			})
			
		},
		
		isMCE : function () {
			// Fix for Advanced Custom Fields Plugin on the media edit screen
			return tinyMCEPopup && ( ed = tinyMCEPopup.editor ) && ! ed.isHidden() && ed.id != "acf_settings";
		},
		
		urlFieldContainsShortcode : function() {
			return (inputs.url.val().indexOf("[link") != -1);
		},
		
	    resetFields : function() {
			$("label.has-shortcode").removeClass("has-shortcode");
			inputs.url.val("http://").prop("readonly", false).trigger("keyup");
			inputs.title.val("");
			inputs.title.attr("placeholder", "");
		},
	    
	    parseShortcodeToUrlField : function(ed, li) {
	    	
	    	var selection = false,
	    		textarea = wpLink.textarea,
	    		begin,
	    		end;
	    	
	    	if(wpLink.isMCE()){
	    		// TinyMCE
		    	ed.getDoc().execCommand("unlink", false, null);
		    	selection = ed.selection.getContent();
	    	} else if ( document.selection && wpLink.range ) {
				// IE
				// Note: If no text is selected, IE will not place the cursor
				//       inside the closing tag.
				selection = wpLink.range.text;
				wpLink.range = null;
			} else if ( typeof textarea.selectionStart !== 'undefined' ) {
				// W3C
		    	begin       = textarea.selectionStart;
				end         = textarea.selectionEnd;
				selection   = textarea.value.substring( begin, end );
	    	}
		    
			
			var attrs = wpLink.getAttrs();
			var internalLinkId = li.find(".item-id").val();
			var taxName = li.find(".item-tax-name").val();

			
			var shortCode = '['+linkToExistingContent.shortcodeName;
				shortCode += ' id="' + internalLinkId + '"';
				shortCode += taxName != "undefined" ? ' tax="' + taxName + '"' : '';
				shortCode += selection ? ' text="' + selection + '"' : false;
			    shortCode += ']';
			
			linkToExistingContent.currentShortCode = shortCode;
			
			inputs.url.val(shortCode);
			inputs.url.prop('readonly', true).parents("label:first").addClass("has-shortcode");
			inputs.url.trigger("keyup");
			inputs.title.attr("placeholder", linkToExistingContent.wpLinkL10n.titlePlaceholder);
			inputs.title.val("");
			inputs.title.trigger("keyup");
			inputs.submit.val(linkToExistingContent.wpLinkL10n.saveShortcode);
			
	    },
	    
	    mceInsertShortcode : function(ed, attrs) {
		    ed.getDoc().execCommand("unlink", false, null);

			var shortCode = inputs.url.val().split("]").join("");
				shortCode += attrs.target.length ? ' target="' + attrs.target + '"' : '';
				shortCode += ']';
			
			ed.selection.setContent(shortCode);
			ed.focus();
	    },
	    
	    htmlInsertShortcode : function(attrs) {
		    
		    var html, begin, end, cursor,
				textarea = wpLink.textarea;
			
			var shortCode = inputs.url.val().split("]").join("");
				shortCode += attrs.target.length ? ' target="' + attrs.target + '"' : '';
				shortCode += ']';
			
			if ( document.selection && wpLink.range ) {
				// IE
				// Note: If no text is selected, IE will not place the cursor
				//       inside the closing tag.
				textarea.focus();
				wpLink.range.text = shortCode;
				wpLink.range.moveToBookmark( wpLink.range.getBookmark() );
				wpLink.range.select();

				wpLink.range = null;
			} else if ( typeof textarea.selectionStart !== 'undefined' ) {
				// W3C
				begin       = textarea.selectionStart;
				end         = textarea.selectionEnd;
				selection   = textarea.value.substring( begin, end );
				html        = shortCode;
				cursor      = begin + shortCode.length;

				textarea.value = textarea.value.substring( 0, begin )
				               + html
				               + textarea.value.substring( end, textarea.value.length );

				// Update cursor position
				textarea.selectionStart = textarea.selectionEnd = cursor;
			}
		    
	    },
	    
	    updateShortcodeTitle : function(){
			if(!$("label.has-shortcode").length) return;

			if(inputs.title.val() == ""){
				inputs.url.val(linkToExistingContent.currentShortCode);
			} else {
				var newShortCode = linkToExistingContent.currentShortCode.split("]").join(' title="'+inputs.title.val()+'"]');
				inputs.url.val(newShortCode);
			}
		}
	    
	}
	
	
	wpLink = {
		timeToTriggerRiver: 150,
		minRiverAJAXDuration: 200,
		riverBottomThreshold: 5,
		keySensitivity: 100,
		lastSearch: '',
		textarea: '',

		init : function() {
			inputs.dialog = $('#wp-link');
			inputs.submit = $('#wp-link-submit');
			// URL
			inputs.url = $('#url-field');
			inputs.nonce = $('#_ajax_linking_nonce');
			// Secondary options
			inputs.title = $('#link-title-field');
			// Advanced Options
			inputs.openInNewTab = $('#link-target-checkbox');
			inputs.search = $('#search-field');
			// Build Rivers
			rivers.search = new River( $('#search-results') );
			rivers.recent = new River( $('#most-recent-results') );
			rivers.elements = $('.query-results', inputs.dialog);

			// Bind event handlers
			inputs.dialog.keydown( wpLink.keydown );
			inputs.dialog.keyup( wpLink.keyup );
			inputs.submit.click( function(e){
				e.preventDefault();
				wpLink.update();
			});
			$('#wp-link-cancel').click( function(e){
				e.preventDefault();
				wpLink.close();
			});
			$('#internal-toggle').click( wpLink.toggleInternalLinking );

			rivers.elements.bind('river-select', wpLink.updateFields );

			inputs.search.keyup( wpLink.searchInternalLinks );

			inputs.dialog.bind('wpdialogrefresh', wpLink.refresh);
			inputs.dialog.bind('wpdialogbeforeopen', wpLink.beforeOpen);
			inputs.dialog.bind('wpdialogclose', wpLink.onClose);
			
			ltecWpLink.init();
			
		},

		beforeOpen : function() {
			wpLink.range = null;
			
			ltecWpLink.resetFields();
			
			if ( ! wpLink.isMCE() && document.selection ) {
				wpLink.textarea.focus();
				wpLink.range = document.selection.createRange();
			}
		},

		open : function() {
			if ( !wpActiveEditor )
				return;

			this.textarea = $('#'+wpActiveEditor).get(0);

			// Initialize the dialog if necessary (html mode).
			if ( ! inputs.dialog.data('wpdialog') ) {
				inputs.dialog.wpdialog({
					title: linkToExistingContent.wpLinkL10n.title,
					width: 480,
					height: 'auto',
					modal: true,
					dialogClass: 'wp-dialog',
					zIndex: 300000
				});
			}

			inputs.dialog.wpdialog('open');
		},

		isMCE : function() {
			
			return ltecWpLink.isMCE();
		},

		refresh : function() {
			// Refresh rivers (clear links, check visibility)
			rivers.search.refresh();
			rivers.recent.refresh();

			if ( wpLink.isMCE() )
				wpLink.mceRefresh();
			else
				wpLink.setDefaultValues();

			// Focus the URL field and highlight its contents.
			//     If this is moved above the selection changes,
			//     IE will show a flashing cursor over the dialog.
			inputs.url.focus()[0].select();
			// Load the most recent results if this is the first time opening the panel.
			if ( ! rivers.recent.ul.children().length )
				rivers.recent.ajax();
		},

		mceRefresh : function() {
			var e;
			ed = tinyMCEPopup.editor;

			tinyMCEPopup.restoreSelection();

			// If link exists, select proper values.
			if ( e = ed.dom.getParent(ed.selection.getNode(), 'A') ) {
				// Set URL and description.
				inputs.url.val( ed.dom.getAttrib(e, 'href') );
				inputs.title.val( ed.dom.getAttrib(e, 'title') );
				// Set open in new tab.
				if ( "_blank" == ed.dom.getAttrib(e, 'target') )
					inputs.openInNewTab.prop('checked', true);
				// Update save prompt.
				inputs.submit.val( linkToExistingContent.wpLinkL10n.update );

			// If there's no link, set the default values.
			} else {
				wpLink.setDefaultValues();
			}

			tinyMCEPopup.storeSelection();
		},

		close : function() {

			if ( wpLink.isMCE() )
				tinyMCEPopup.close();
			else
				inputs.dialog.wpdialog('close');
		},

		onClose: function() {
			if ( ! wpLink.isMCE() ) {
				wpLink.textarea.focus();
				if ( wpLink.range ) {
					wpLink.range.moveToBookmark( wpLink.range.getBookmark() );
					wpLink.range.select();
				}
			}
		},

		getAttrs : function() {
			return {
				href : inputs.url.val(),
				title : inputs.title.val(),
				target : inputs.openInNewTab.prop('checked') ? '_blank' : ''
			};
		},

		update : function() {
			if ( wpLink.isMCE() )
				wpLink.mceUpdate();
			else
				wpLink.htmlUpdate();
		},

		htmlUpdate : function() {
			var attrs, html, begin, end, cursor,
				textarea = wpLink.textarea;

			if ( ! textarea )
				return;
			
			attrs = wpLink.getAttrs();

			// If there's no href, return.
			if ( ! attrs.href || attrs.href == 'http://' )
				return;

			// Build HTML
			html = '<a href="' + attrs.href + '"';

			if ( attrs.title )
				html += ' title="' + attrs.title + '"';
			if ( attrs.target )
				html += ' target="' + attrs.target + '"';

			html += '>';
			
			if(ltecWpLink.urlFieldContainsShortcode()) {
				
				ltecWpLink.htmlInsertShortcode(attrs);
				
			} else if ( document.selection && wpLink.range ) {
				// IE
				// Note: If no text is selected, IE will not place the cursor
				//       inside the closing tag.
				textarea.focus();
				wpLink.range.text = html + wpLink.range.text + '</a>';
				wpLink.range.moveToBookmark( wpLink.range.getBookmark() );
				wpLink.range.select();

				wpLink.range = null;
			} else if ( typeof textarea.selectionStart !== 'undefined' ) {
				// W3C
				begin       = textarea.selectionStart;
				end         = textarea.selectionEnd;
				selection   = textarea.value.substring( begin, end );
				html        = html + selection + '</a>';
				cursor      = begin + html.length;

				// If no next is selected, place the cursor inside the closing tag.
				if ( begin == end )
					cursor -= '</a>'.length;

				textarea.value = textarea.value.substring( 0, begin )
				               + html
				               + textarea.value.substring( end, textarea.value.length );

				// Update cursor position
				textarea.selectionStart = textarea.selectionEnd = cursor;
			}

			wpLink.close();
			textarea.focus();
		},

		mceUpdate : function() {
			var ed = tinyMCEPopup.editor,
				attrs = wpLink.getAttrs(),
				e, b;

			tinyMCEPopup.restoreSelection();
			e = ed.dom.getParent(ed.selection.getNode(), 'A');
			

			// If the values are empty, unlink and return
			if ( ! attrs.href || attrs.href == 'http://' ) {
				if ( e ) {
					tinyMCEPopup.execCommand("mceBeginUndoLevel");
					b = ed.selection.getBookmark();
					ed.dom.remove(e, 1);
					ed.selection.moveToBookmark(b);
					tinyMCEPopup.execCommand("mceEndUndoLevel");
					wpLink.close();
				}
				return;
			}
			
			tinyMCEPopup.execCommand("mceBeginUndoLevel");
			
			// Modification: If there is a shortcode in the url field, add it
			if(ltecWpLink.urlFieldContainsShortcode()){
			
				ltecWpLink.mceInsertShortcode(ed, attrs);
				
			} else if (e == null) {
				ed.getDoc().execCommand("unlink", false, null);
				tinyMCEPopup.execCommand("mceInsertLink", false, "#mce_temp_url#", {skip_undo : 1});

				tinymce.each(ed.dom.select("a"), function(n) {
					if (ed.dom.getAttrib(n, 'href') == '#mce_temp_url#') {
						e = n;
						ed.dom.setAttribs(e, attrs);
					}
				});

				// Sometimes WebKit lets a user create a link where
				// they shouldn't be able to. In this case, CreateLink
				// injects "#mce_temp_url#" into their content. Fix it.
				if ( $(e).text() == '#mce_temp_url#' ) {
					ed.dom.remove(e);
					e = null;
				}
			} else {
				ed.dom.setAttribs(e, attrs);
			}

			// Don't move caret if selection was image
			if ( e && (e.childNodes.length != 1 || e.firstChild.nodeName != 'IMG') ) {
				ed.focus();
				ed.selection.select(e);
				ed.selection.collapse(0);
				tinyMCEPopup.storeSelection();
			}

			tinyMCEPopup.execCommand("mceEndUndoLevel");
			wpLink.close();
		},

		updateFields : function( e, li, originalEvent ) {
			
			var ed = tinyMCEPopup.editor;
			
			/*
			*	Modification: parse the shortcode to the value of the url-field
			*
			*/

			if(parseInt(linkToExistingContent.useShortcode) == 1){
				
				ltecWpLink.parseShortcodeToUrlField(ed, li);
				return;
				
			} else {
				inputs.url.val( li.children('.item-permalink').val() );
				inputs.title.val( li.hasClass('no-title') ? '' : li.children('.item-title').text() );
				if ( originalEvent && originalEvent.type == "click" )
					inputs.url.focus();
			}

		},
		setDefaultValues : function() {
			// Set URL and description to defaults.
			// Leave the new tab setting as-is.
			inputs.url.val('http://');
			inputs.title.val('');

			// Update save prompt.
			inputs.submit.val( linkToExistingContent.wpLinkL10n.save );
		},

		searchInternalLinks : function() {
			var t = $(this), 
				waiting,
				search = t.val();
			
			if ( search.length > 2 || ltecWpLink.objectType == "taxonomies") {
				rivers.recent.hide();
				rivers.search.show();

				// Don't search if the keypress didn't change the title.
				if ( wpLink.lastSearch == search )
					return;

				wpLink.lastSearch = search;
				waiting = t.parent().find('.spinner').show();

				rivers.search.change( search );
				rivers.search.ajax( function(){ waiting.hide(); });
			} else {
				rivers.search.hide();
				rivers.recent.show();
			}
		},

		next : function() {
			rivers.search.next();
			rivers.recent.next();
		},
		prev : function() {
			rivers.search.prev();
			rivers.recent.prev();
		},

		keydown : function( event ) {
			var fn, key = $.ui.keyCode;

			switch( event.which ) {
				case key.UP:
					fn = 'prev';
				case key.DOWN:
					fn = fn || 'next';
					clearInterval( wpLink.keyInterval );
					wpLink[ fn ]();
					wpLink.keyInterval = setInterval( wpLink[ fn ], wpLink.keySensitivity );
					break;
				default:
					return;
			}
			event.preventDefault();
		},
		keyup: function( event ) {
			var key = $.ui.keyCode;

			switch( event.which ) {
				case key.ESCAPE:
					event.stopImmediatePropagation();
					if ( ! $(document).triggerHandler( 'wp_CloseOnEscape', [{ event: event, what: 'wplink', cb: wpLink.close }] ) )
						wpLink.close();

					return false;
					break;
				case key.UP:
				case key.DOWN:
					clearInterval( wpLink.keyInterval );
					break;
				default:
					return;
			}
			event.preventDefault();
		},

		delayedCallback : function( func, delay ) {
			var timeoutTriggered, funcTriggered, funcArgs, funcContext;

			if ( ! delay )
				return func;

			setTimeout( function() {
				if ( funcTriggered )
					return func.apply( funcContext, funcArgs );
				// Otherwise, wait.
				timeoutTriggered = true;
			}, delay);

			return function() {
				if ( timeoutTriggered )
					return func.apply( this, arguments );
				// Otherwise, wait.
				funcArgs = arguments;
				funcContext = this;
				funcTriggered = true;
			};
		},

		toggleInternalLinking : function( event ) {
			var panel = $('#search-panel'),
				widget = inputs.dialog.wpdialog('widget'),
				// We're about to toggle visibility; it's currently the opposite
				visible = !panel.is(':visible'),
				win = $(window);

			$(this).toggleClass('toggle-arrow-active', visible);

			inputs.dialog.height('auto');
			panel.slideToggle( 300, function() {
				setUserSetting('wplink', visible ? '1' : '0');
				inputs[ visible ? 'search' : 'url' ].focus();

				// Move the box if the box is now expanded, was opened in a collapsed state,
				// and if it needs to be moved. (Judged by bottom not being positive or
				// bottom being smaller than top.)
				var scroll = win.scrollTop(),
					top = widget.offset().top,
					bottom = top + widget.outerHeight(),
					diff = bottom - win.height();

				if ( diff > scroll ) {
					widget.animate({'top': diff < top ?  top - diff : scroll }, 200);
				}
			});
			event.preventDefault();
		}
	}

	River = function( element, search ) {
		var self = this;
		this.element = element;
		this.ul = element.children('ul');
		this.waiting = element.find('.river-waiting');

		this.change( search );
		this.refresh();

		element.scroll( function(){ self.maybeLoad(); });
		element.delegate('li', 'click', function(e){ self.select( $(this), e ); });
	};

	$.extend( River.prototype, {
		refresh: function() {
			this.deselect();
			this.visible = this.element.is(':visible');
		},
		show: function() {
			if ( ! this.visible ) {
				this.deselect();
				this.element.show();
				this.visible = true;
			}
		},
		hide: function() {
			this.element.hide();
			this.visible = false;
		},
		// Selects a list item and triggers the river-select event.
		select: function( li, event ) {
			var liHeight, elHeight, liTop, elTop;

			if ( li.hasClass('unselectable') || li == this.selected )
				return;

			this.deselect();
			this.selected = li.addClass('selected');
			// Make sure the element is visible
			liHeight = li.outerHeight();
			elHeight = this.element.height();
			liTop = li.position().top;
			elTop = this.element.scrollTop();

			if ( liTop < 0 ) // Make first visible element
				this.element.scrollTop( elTop + liTop );
			else if ( liTop + liHeight > elHeight ) // Make last visible element
				this.element.scrollTop( elTop + liTop - elHeight + liHeight );

			// Trigger the river-select event
			this.element.trigger('river-select', [ li, event, this ]);
		},
		deselect: function() {
			if ( this.selected )
				this.selected.removeClass('selected');
			this.selected = false;
		},
		prev: function() {
			if ( ! this.visible )
				return;

			var to;
			if ( this.selected ) {
				to = this.selected.prev('li');
				if ( to.length )
					this.select( to );
			}
		},
		next: function() {
			if ( ! this.visible )
				return;

			var to = this.selected ? this.selected.next('li') : $('li:not(.unselectable):first', this.element);
			if ( to.length )
				this.select( to );
		},
		ajax: function( callback ) {
			var self = this,
				delay = this.query.page == 1 ? 0 : wpLink.minRiverAJAXDuration,
				response = wpLink.delayedCallback( function( results, params ) {
					self.process( results, params );
					if ( callback )
						callback( results, params );
				}, delay );

			this.query.ajax( response );
		},
		change: function( search ) {
			if ( this.query && this._search == search )
				return;

			this._search = search;
			this.query = new Query( search );
			this.element.scrollTop(0);
		},
		process: function( results, params ) {
			var list = '', alt = true, classes = '',
				firstPage = params.page == 1;

			if ( !results ) {
				if ( firstPage ) {
					list += '<li class="unselectable"><span class="item-title"><em>'
					+ linkToExistingContent.wpLinkL10n.noMatchesFound
					+ '</em></span></li>';
				}
			} else {
				$.each( results, function() {
					classes = alt ? 'alternate' : '';
					classes += this['title'] ? '' : ' no-title';
					
					
					list += '<li class="' + classes + '">';
					list += '<input type="hidden" class="item-permalink" value="' + this['permalink'] + '" />';
					
					//	Modified: add input with tax name to each of the results
					list += '<input type="hidden" class="item-tax-name" value="' + this['taxName'] + '" />';
					//	Modified: add input with item id to each of the results
					list += '<input type="hidden" class="item-id" value="' + this['ID'] + '" />';
					
					list += '<span class="item-title">';
					list += this['title'] ? this['title'] : linkToExistingContent.wpLinkL10n.noTitle;
					list += '</span><span class="item-info">' + this['info'] + '</span></li>';
					alt = ! alt;
				});
			}

			this.ul[ firstPage ? 'html' : 'append' ]( list );
		},
		maybeLoad: function() {
			var self = this,
				el = this.element,
				bottom = el.scrollTop() + el.height();

			if ( ! this.query.ready() || bottom < this.ul.height() - wpLink.riverBottomThreshold )
				return;

			setTimeout(function() {
				var newTop = el.scrollTop(),
					newBottom = newTop + el.height();

				if ( ! self.query.ready() || newBottom < self.ul.height() - wpLink.riverBottomThreshold )
					return;

				self.waiting.show();
				el.scrollTop( newTop + self.waiting.outerHeight() );

				self.ajax( function() { self.waiting.hide(); });
			}, wpLink.timeToTriggerRiver );
		}
	});

	Query = function( search ) {
		this.page = 1;
		this.allLoaded = false;
		this.querying = false;
		this.search = search;
	};

	$.extend( Query.prototype, {
		ready: function() {
			return !( this.querying || this.allLoaded );
		},
		ajax: function( callback ) {
			var self = this,
				query = {
					// Modification: our custom ajax action
					action : linkToExistingContent.ajaxAction,
					// Modifictaion: what should be queried?
					objectType : ltecWpLink.objectType,
					page : this.page,
					'_ajax_linking_nonce' : inputs.nonce.val()
				};

			if ( this.search )
				query.search = this.search;

			this.querying = true;
			
			$.post( ajaxurl, query, function(r) {
				self.page ++;
				self.querying = false;
				self.allLoaded = !r;
				callback( r, query );
			}, "json" );
		}
	});
	
	$(document).ready( wpLink.init );
})(jQuery);

