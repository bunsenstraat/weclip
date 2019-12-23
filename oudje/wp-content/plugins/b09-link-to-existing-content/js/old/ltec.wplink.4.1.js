/* 
*	global ajaxurl, tinymce, linkToExistingContent.wpLinkL10n, setUserSetting, wpActiveEditor 
*
* 	B09 Link To Existing Content
*
*	Replacement for default wordpress script: wp-includes/js/wplink.js
*	
*	Search this code for "B09 Modification" to find all modifications made to the original script
*
*/

var wpLink, ltecWpLink;

( function( $ ) {
	var inputs = {}, rivers = {}, editor, searchTimer, River, Query;
	
	// B09 Modification
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
			return editor && ! editor.isHidden() && editor.id != "acf_settings";
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
	    
	    parseShortcodeToUrlField : function(editor, li) {
	    	
	    	var selection = false,
	    		textarea = wpLink.textarea,
	    		begin,
	    		end;
	    	
	    	if(wpLink.isMCE()){
	    		// TinyMCE
		    	editor.getDoc().execCommand("unlink", false, null);
		    	selection = editor.selection.getContent();
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
	    
	    mceInsertShortcode : function(editor, attrs) {
		    editor.getDoc().execCommand("unlink", false, null);

			var shortCode = inputs.url.val().split("]").join("");
				shortCode += attrs.target.length ? ' target="' + attrs.target + '"' : '';
				shortCode += ']';
			
			editor.selection.setContent(shortCode);
			editor.focus();
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
	// End B09 Modification
	
	wpLink = {
		timeToTriggerRiver: 150,
		minRiverAJAXDuration: 200,
		riverBottomThreshold: 5,
		keySensitivity: 100,
		lastSearch: '',
		textarea: '',

		init: function() {
			inputs.wrap = $('#wp-link-wrap');
			inputs.dialog = $( '#wp-link' );
			inputs.backdrop = $( '#wp-link-backdrop' );
			inputs.submit = $( '#wp-link-submit' );
			inputs.close = $( '#wp-link-close' );
			// URL
			inputs.url = $( '#url-field' );
			inputs.nonce = $( '#_ajax_linking_nonce' );
			// Secondary options
			inputs.title = $( '#link-title-field' );
			// Advanced Options
			inputs.openInNewTab = $( '#link-target-checkbox' );
			inputs.search = $( '#search-field' );
			// Build Rivers
			rivers.search = new River( $( '#search-results' ) );
			rivers.recent = new River( $( '#most-recent-results' ) );
			rivers.elements = inputs.dialog.find( '.query-results' );

			// Bind event handlers
			inputs.dialog.keydown( wpLink.keydown );
			inputs.dialog.keyup( wpLink.keyup );
			inputs.submit.click( function( event ) {
				event.preventDefault();
				wpLink.update();
			});
			inputs.close.add( inputs.backdrop ).add( '#wp-link-cancel a' ).click( function( event ) {
				event.preventDefault();
				wpLink.close();
			});

			$( '#wp-link-search-toggle' ).click( wpLink.toggleInternalLinking );

			rivers.elements.on( 'river-select', wpLink.updateFields );

			inputs.search.keyup( function() {
				var self = this;

				window.clearTimeout( searchTimer );
				searchTimer = window.setTimeout( function() {
					wpLink.searchInternalLinks.call( self );
				}, 500 );
			});
			
			// B09 Modification
			ltecWpLink.init();
			// End B09 Modification
		},

		open: function( editorId ) {
			var ed;
			
			wpLink.range = null;

			if ( editorId ) {
				window.wpActiveEditor = editorId;
			}

			if ( ! window.wpActiveEditor ) {
				return;
			}

			this.textarea = $( '#' + window.wpActiveEditor ).get( 0 );

			if ( typeof tinymce !== 'undefined' ) {
				ed = tinymce.get( wpActiveEditor );

				if ( ed && ! ed.isHidden() ) {
					editor = ed;
				} else {
					editor = null;
				}

				if ( editor && tinymce.isIE ) {
					editor.windowManager.bookmark = editor.selection.getBookmark();
				}
			}

			if ( ! wpLink.isMCE() && document.selection ) {
				this.textarea.focus();
				this.range = document.selection.createRange();
			}

			inputs.wrap.show();
			inputs.backdrop.show();

			wpLink.refresh();
		},

		isMCE : function() {
			// B09 Modification
			return ltecWpLink.isMCE();
			// End B09 Modification
		},

		refresh: function() {
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

		mceRefresh: function() {
			var e;

			// If link exists, select proper values.
			if ( e = editor.dom.getParent( editor.selection.getNode(), 'A' ) ) {
				// Set URL and description.
				inputs.url.val( editor.dom.getAttrib( e, 'href' ) );
				inputs.title.val( editor.dom.getAttrib( e, 'title' ) );
				// Set open in new tab.
				inputs.openInNewTab.prop( 'checked', ( '_blank' === editor.dom.getAttrib( e, 'target' ) ) );
				// Update save prompt.
				inputs.submit.val( linkToExistingContent.wpLinkL10n.update );

			// If there's no link, set the default values.
			} else {
				wpLink.setDefaultValues();
			}
		},

		close: function() {
			if ( ! wpLink.isMCE() ) {
				wpLink.textarea.focus();

				if ( wpLink.range ) {
					wpLink.range.moveToBookmark( wpLink.range.getBookmark() );
					wpLink.range.select();
				}
			} else {
				editor.focus();
			}

			inputs.backdrop.hide();
			inputs.wrap.hide();
		},

		getAttrs: function() {
			return {
				href: inputs.url.val(),
				title: inputs.title.val(),
				target: inputs.openInNewTab.prop( 'checked' ) ? '_blank' : ''
			};
		},

		update: function() {
			if ( wpLink.isMCE() )
				wpLink.mceUpdate();
			else
				wpLink.htmlUpdate();
		},

		htmlUpdate: function() {
			var attrs, html, begin, end, cursor, title, selection,
				textarea = wpLink.textarea;

			if ( ! textarea )
				return;

			attrs = wpLink.getAttrs();

			// If there's no href, return.
			if ( ! attrs.href || attrs.href == 'http://' )
				return;

			// Build HTML
			html = '<a href="' + attrs.href + '"';

			if ( attrs.title ) {
				title = attrs.title.replace( /</g, '&lt;' ).replace( />/g, '&gt;' ).replace( /"/g, '&quot;' );
				html += ' title="' + title + '"';
			}

			if ( attrs.target ) {
				html += ' target="' + attrs.target + '"';
			}

			html += '>';

			// Insert HTML
			// B09 Modification
			if(ltecWpLink.urlFieldContainsShortcode()) {
				
				ltecWpLink.htmlInsertShortcode(attrs);
				// End B09 Modification
				
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

				// If no text is selected, place the cursor inside the closing tag.
				if ( begin == end )
					cursor -= '</a>'.length;

				textarea.value = textarea.value.substring( 0, begin ) + html +
					textarea.value.substring( end, textarea.value.length );

				// Update cursor position
				textarea.selectionStart = textarea.selectionEnd = cursor;
			}

			wpLink.close();
			textarea.focus();
		},

		mceUpdate: function() {
			var link,
				attrs = wpLink.getAttrs();

			wpLink.close();
			editor.focus();

			if ( tinymce.isIE ) {
				editor.selection.moveToBookmark( editor.windowManager.bookmark );
			}

			link = editor.dom.getParent( editor.selection.getNode(), 'a[href]' );

			// If the values are empty, unlink and return
			if ( ! attrs.href || attrs.href == 'http://' ) {
				editor.execCommand( 'unlink' );
				return;
			}
			
			// B09 Modification
			if(ltecWpLink.urlFieldContainsShortcode()){
			
				ltecWpLink.mceInsertShortcode(editor, attrs);
				// End B09 Modification
				
			} else if ( link ) {
				editor.dom.setAttribs( link, attrs );
			} else {
				editor.execCommand( 'mceInsertLink', false, attrs );
			}

			// Move the cursor to the end of the selection
			editor.selection.collapse();
		},

		updateFields: function( e, li, originalEvent ) {
			
			// B09 Modification
			if(parseInt(linkToExistingContent.useShortcode) == 1){
				
				ltecWpLink.parseShortcodeToUrlField(editor, li);
				return;
				
			} else {
				inputs.url.val( li.children( '.item-permalink' ).val() );
				inputs.title.val( li.hasClass( 'no-title' ) ? '' : li.children( '.item-title' ).text() );
				if ( originalEvent && originalEvent.type == 'click' )
					inputs.url.focus();
			}
			// End B09 Modification
		},

		setDefaultValues: function() {
			// Set URL and description to defaults.
			// Leave the new tab setting as-is.
			inputs.url.val( 'http://' );
			inputs.title.val( '' );

			// Update save prompt.
			inputs.submit.val( linkToExistingContent.wpLinkL10n.save );
		},

		searchInternalLinks: function() {
			var t = $( this ), waiting,
				search = t.val();
			
			// B09 Modification
			if ( search.length > 2  || ltecWpLink.objectType == "taxonomies") {
				
				// End B09 Modification
				
				rivers.recent.hide();
				rivers.search.show();

				// Don't search if the keypress didn't change the title.
				if ( wpLink.lastSearch == search )
					return;

				wpLink.lastSearch = search;
				waiting = t.parent().find('.spinner').show();

				rivers.search.change( search );
				rivers.search.ajax( function() {
					waiting.hide();
				});
			} else {
				rivers.search.hide();
				rivers.recent.show();
			}
		},

		next: function() {
			rivers.search.next();
			rivers.recent.next();
		},

		prev: function() {
			rivers.search.prev();
			rivers.recent.prev();
		},

		keydown: function( event ) {
			var fn, id,
				key = $.ui.keyCode;

			if ( key.ESCAPE === event.keyCode ) {
				wpLink.close();
				event.stopImmediatePropagation();
			} else if ( key.TAB === event.keyCode ) {
				id = event.target.id;

				if ( id === 'wp-link-submit' && ! event.shiftKey ) {
					inputs.close.focus();
					event.preventDefault();
				} else if ( id === 'wp-link-close' && event.shiftKey ) {
					inputs.submit.focus();
					event.preventDefault();
				}
			}

			if ( event.keyCode !== key.UP && event.keyCode !== key.DOWN ) {
				return;
			}

			fn = event.keyCode === key.UP ? 'prev' : 'next';
			clearInterval( wpLink.keyInterval );
			wpLink[ fn ]();
			wpLink.keyInterval = setInterval( wpLink[ fn ], wpLink.keySensitivity );
			event.preventDefault();
		},

		keyup: function( event ) {
			var key = $.ui.keyCode;

			if ( event.which === key.UP || event.which === key.DOWN ) {
				clearInterval( wpLink.keyInterval );
				event.preventDefault();
			}
		},

		delayedCallback: function( func, delay ) {
			var timeoutTriggered, funcTriggered, funcArgs, funcContext;

			if ( ! delay )
				return func;

			setTimeout( function() {
				if ( funcTriggered )
					return func.apply( funcContext, funcArgs );
				// Otherwise, wait.
				timeoutTriggered = true;
			}, delay );

			return function() {
				if ( timeoutTriggered )
					return func.apply( this, arguments );
				// Otherwise, wait.
				funcArgs = arguments;
				funcContext = this;
				funcTriggered = true;
			};
		},

		toggleInternalLinking: function() {
			var visible = inputs.wrap.hasClass( 'search-panel-visible' );

			inputs.wrap.toggleClass( 'search-panel-visible', ! visible );
			setUserSetting( 'wplink', visible ? '0' : '1' );
			inputs[ ! visible ? 'search' : 'url' ].focus();
		}
	};

	River = function( element, search ) {
		var self = this;
		this.element = element;
		this.ul = element.children( 'ul' );
		this.contentHeight = element.children( '#link-selector-height' );
		this.waiting = element.find('.river-waiting');

		this.change( search );
		this.refresh();

		$( '#wp-link .query-results, #wp-link #link-selector' ).scroll( function() {
			self.maybeLoad();
		});
		element.on( 'click', 'li', function( event ) {
			self.select( $( this ), event );
		});
	};

	$.extend( River.prototype, {
		refresh: function() {
			this.deselect();
			this.visible = this.element.is( ':visible' );
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

			if ( li.hasClass( 'unselectable' ) || li == this.selected )
				return;

			this.deselect();
			this.selected = li.addClass( 'selected' );
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
			this.element.trigger( 'river-select', [ li, event, this ] );
		},
		deselect: function() {
			if ( this.selected )
				this.selected.removeClass( 'selected' );
			this.selected = false;
		},
		prev: function() {
			if ( ! this.visible )
				return;

			var to;
			if ( this.selected ) {
				to = this.selected.prev( 'li' );
				if ( to.length )
					this.select( to );
			}
		},
		next: function() {
			if ( ! this.visible )
				return;

			var to = this.selected ? this.selected.next( 'li' ) : $( 'li:not(.unselectable):first', this.element );
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
			this.element.scrollTop( 0 );
		},
		process: function( results, params ) {
			var list = '', alt = true, classes = '',
				firstPage = params.page == 1;

			if ( ! results ) {
				if ( firstPage ) {
					list += '<li class="unselectable"><span class="item-title"><em>' +
						linkToExistingContent.wpLinkL10n.noMatchesFound + '</em></span></li>';
				}
			} else {
				$.each( results, function() {
					classes = alt ? 'alternate' : '';
					classes += this.title ? '' : ' no-title';
					list += classes ? '<li class="' + classes + '">' : '<li>';
					list += '<input type="hidden" class="item-permalink" value="' + this.permalink + '" />';
					
					//	B09 Modification: add input with tax name to each of the results
					list += '<input type="hidden" class="item-tax-name" value="' + this['taxName'] + '" />';
					//	B09 Modification: add input with item id to each of the results
					list += '<input type="hidden" class="item-id" value="' + this['ID'] + '" />';
					
					list += '<span class="item-title">';
					list += this.title ? this.title : linkToExistingContent.wpLinkL10n.noTitle;
					list += '</span><span class="item-info">' + this.info + '</span></li>';
					alt = ! alt;
				});
			}

			this.ul[ firstPage ? 'html' : 'append' ]( list );
		},
		maybeLoad: function() {
			var self = this,
				el = this.element,
				bottom = el.scrollTop() + el.height();

			if ( ! this.query.ready() || bottom < this.contentHeight.height() - wpLink.riverBottomThreshold )
				return;

			setTimeout(function() {
				var newTop = el.scrollTop(),
					newBottom = newTop + el.height();

				if ( ! self.query.ready() || newBottom < self.contentHeight.height() - wpLink.riverBottomThreshold )
					return;

				self.waiting.show();
				el.scrollTop( newTop + self.waiting.outerHeight() );

				self.ajax( function() {
					self.waiting.hide();
				});
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
			return ! ( this.querying || this.allLoaded );
		},
		ajax: function( callback ) {
			var self = this,
				query = {
					// B09 Modification: our custom ajax action
					action : linkToExistingContent.ajaxAction,
					// B09 Modifictaion: what should be queried?
					objectType : ltecWpLink.objectType,
					
					page : this.page,
					'_ajax_linking_nonce' : inputs.nonce.val()
				};

			if ( this.search )
				query.search = this.search;

			this.querying = true;

			$.post( ajaxurl, query, function( r ) {
				self.page++;
				self.querying = false;
				self.allLoaded = ! r;
				callback( r, query );
			}, 'json' );
		}
	});

	$( document ).ready( wpLink.init );
})( jQuery );
