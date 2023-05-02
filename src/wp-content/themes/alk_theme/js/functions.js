/**
 * Theme functions file
 *
 * Contains handlers for navigation, accessibility, header sizing
 * footer widgets and Featured Content slider
 *
 */
( function( $ ) {

	setTimeout((function() {
		$('body').addClass('loaded');
	}), 2000);

	var body    = $( 'body' ),
		_window = $( window ),
		nav, button, menu;

	nav = $( '#primary-navigation' );
	button = nav.find( '.menu-toggle' );
	menu = nav.find( '.nav-menu' );

	// Enable menu toggle for small screens.
	( function() {
		if ( ! nav || ! button ) {
			return;
		}

		// Hide button if menu is missing or empty.
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		button.on( 'click.twentyfourteen', function() {
			nav.toggleClass( 'toggled-on' );
			if ( nav.hasClass( 'toggled-on' ) ) {
				$( this ).attr( 'aria-expanded', 'true' );
				menu.attr( 'aria-expanded', 'true' );
			} else {
				$( this ).attr( 'aria-expanded', 'false' );
				menu.attr( 'aria-expanded', 'false' );
			}
		} );
	} )();

	/*
	 * Makes "skip to content" link work correctly in IE9 and Chrome for better
	 * accessibility.
	 *
	 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
	 */
	_window.on( 'hashchange.twentyfourteen', function() {
		var hash = location.hash.substring( 1 ), element;

		if ( ! hash ) {
			return;
		}

		element = document.getElementById( hash );

		if ( element ) {
			if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
				element.tabIndex = -1;
			}

			element.focus();

			// Repositions the window on jump-to-anchor to account for header height.
			window.scrollBy( 0, -80 );
		}
	} );

	$( function() {
		// Search toggle.
		$( '.search-toggle' ).on( 'click.twentyfourteen', function( event ) {
			var that    = $( this ),
				wrapper = $( '#search-container' ),
				container = that.find( 'a' );

			that.toggleClass( 'active' );
			wrapper.toggleClass( 'hide' );

			if ( that.hasClass( 'active' ) ) {
				container.attr( 'aria-expanded', 'true' );
			} else {
				container.attr( 'aria-expanded', 'false' );
			}

			if ( that.is( '.active' ) || $( '.search-toggle .screen-reader-text' )[0] === event.target ) {
				wrapper.find( '.search-field' ).focus();
			}
		} );

		/*
		 * Fixed header for large screen.
		 * If the header becomes more than 48px tall, unfix the header.
		 *
		 * The callback on the scroll event is only added if there is a header
		 * image and we are not on mobile.
		 */
		if ( _window.width() > 781 ) {
			var mastheadHeight = $( '#masthead' ).height(),
				toolbarOffset, mastheadOffset;

			if ( mastheadHeight > 48 ) {
				body.removeClass( 'masthead-fixed' );
			}

			if ( body.is( '.header-image' ) ) {
				toolbarOffset  = body.is( '.admin-bar' ) ? $( '#wpadminbar' ).height() : 0;
				mastheadOffset = $( '#masthead' ).offset().top - toolbarOffset;

				_window.on( 'scroll.twentyfourteen', function() {
					if ( _window.scrollTop() > mastheadOffset && mastheadHeight < 49 ) {
						body.addClass( 'masthead-fixed' );
					} else {
						body.removeClass( 'masthead-fixed' );
					}
				} );
			}
		}

		// Focus styles for menus.
		$( '.primary-navigation, .secondary-navigation' ).find( 'a' ).on( 'focus.twentyfourteen blur.twentyfourteen', function() {
			$( this ).parents().toggleClass( 'focus' );
		} );
	} );

	/**
	 * @summary Add or remove ARIA attributes.
	 * Uses jQuery's width() function to determine the size of the window and add
	 * the default ARIA attributes for the menu toggle if it's visible.
	 * @since Twenty Fourteen 1.4
	 */
	function onResizeARIA() {
		if ( 781 > _window.width() ) {
			button.attr( 'aria-expanded', 'false' );
			menu.attr( 'aria-expanded', 'false' );
			button.attr( 'aria-controls', 'primary-menu' );
		} else {
			button.removeAttr( 'aria-expanded' );
			menu.removeAttr( 'aria-expanded' );
			button.removeAttr( 'aria-controls' );
		}
	}

	_window
		.on( 'load.twentyfourteen', onResizeARIA )
		.on( 'resize.twentyfourteen', function() {
			onResizeARIA();
	} );

	_window.load( function() {
		// Arrange footer widgets vertically.
		if ( $.isFunction( $.fn.masonry ) ) {
			$( '#footer-sidebar' ).masonry( {
				itemSelector: '.widget',
				columnWidth: function( containerWidth ) {
					return containerWidth / 4;
				},
				gutterWidth: 0,
				isResizable: true,
				isRTL: $( 'body' ).is( '.rtl' )
			} );
		}

		// Initialize Featured Content slider.
		if ( body.is( '.slider' ) ) {
			$( '.featured-content' ).featuredslider( {
				selector: '.featured-content-inner > article',
				controlsContainer: '.featured-content'
			} );
		}
	} );

	var zindex = 99;
  
  $(".card").click(function(){
    var isShowing = false;

    if ($(this).hasClass("show")) {
      isShowing = true
    }

    if ($(".cards").hasClass("showing")) {
      // a card is already in view
      $(".card.show")
        .removeClass("show");

      if (isShowing) {
        // this card was showing - reset the grid
        $(".cards")
          .removeClass("showing");
      } else {
        // this card isn't showing - get in with it
        $(this)
          .css({zIndex: zindex})
          .addClass("show");

      }

      zindex++;

    } else {
      // no cards in view
      $("div.cards")
        .addClass("showing");
      $(this)
        .css({zIndex:zindex})
        .addClass("show");

      zindex++;
    }
    
  });

    $(window).scroll(function () {
        if ($(this).scrollTop()>$('#betonCarousel').height()) {
          $('.navbar').addClass('navbar-fixed-top');
        }else{
          $('.navbar').removeClass('navbar-fixed-top');
        }
        if ($(this).scrollTop() > 0) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });
    $('.back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 1500);
        return false;
    }); 

if($(window).scroll()>$('#betonCarousel').height()){
  $('.navbar').addClass('navbar-fixed-top');
};

 // These are the constraints used to validate the form
  var constraints = {
  	name:{
  		presence: true,
		format: {
			pattern: "[А-Яа-яa-zA-Z\\s]+",
			message: "^Недопустимые символы"
		}
  	},
    email: {
      email: {
      	message: "^E-mail некорректный"
    	},
    },
    telefon: {
      // Zip is optional but if specified it must be a 5 digit long number
      presence: true,
      format: {
        pattern: "^[\\+\\-\\d\\s\\/\\,]{6,20}$",
        message: "^Номер телефона некорректный"
      }
    }
  };

  // Hook up the form so we can prevent it from being posted
  var form = document.querySelector("form#contact-form");
  form.addEventListener("submit", function(ev) {
    ev.preventDefault();
    handleFormSubmit(form);
  });

  // Hook up the inputs to validate on the fly
  var inputs = document.querySelectorAll("input, select")
  for (var i = 0; i < inputs.length; ++i) {
    inputs.item(i).addEventListener("change", function(ev) {
      var errors = validate(form, constraints) || {};
      showErrorsForInput(this, errors[this.name])
    });
  }

  function handleFormSubmit(form, input) {
    // validate the form aainst the constraints
    var errors = validate(form, constraints);
    // then we update the form to reflect the results
    showErrors(form, errors || {});
    if (!errors) {
      showSuccess();
    }
  }

  // Updates the inputs with the validation errors
  function showErrors(form, errors) {
    // We loop through all the inputs and show the errors for that input
    _.each(form.querySelectorAll("input[name], select[name]"), function(input) {
      // Since the errors can be null if no errors were found we need to handle
      // that
      showErrorsForInput(input, errors && errors[input.name]);
    });
  }

  // Shows the errors for a specific input
  function showErrorsForInput(input, errors) {
    // This is the root of the input
    var formGroup = closestParent(input.parentNode, "form-group")
      // Find where the error messages will be insert into
      , messages = formGroup.querySelector(".messages");
    // First we remove any old messages and resets the classes
    resetFormGroup(formGroup);
    // If we have errors
    if (errors) {
      // we first mark the group has having errors
      formGroup.classList.add("has-error");
      // then we append all the errors
      _.each(errors, function(error) {
        addError(messages, error);
      });
    } else {
      // otherwise we simply mark it as success
      formGroup.classList.add("has-success");
    }
  }

  // Recusively finds the closest parent that has the specified class
  function closestParent(child, className) {
    if (!child || child == document) {
      return null;
    }
    if (child.classList.contains(className)) {
      return child;
    } else {
      return closestParent(child.parentNode, className);
    }
  }

  function resetFormGroup(formGroup) {
    // Remove the success and error classes
    formGroup.classList.remove("has-error");
    formGroup.classList.remove("has-success");
    // and remove any old messages
    _.each(formGroup.querySelectorAll(".help-block.error"), function(el) {
      el.parentNode.removeChild(el);
    });
  }

  // Adds the specified error with the following markup
  // <p class="help-block error">[message]</p>
  function addError(messages, error) {
    var block = document.createElement("p");
    block.classList.add("help-block");
    block.classList.add("error");
    block.innerText = error;
    messages.appendChild(block);
  }

  function showSuccess() {
    // We made it \:D/
    alert("Success!");
  };


$('#alk-submit').click(function(){
	var alkInputs = $('input.alk-class-input'),
	emptyInputs = [];
	for (var i = 0; i < alkInputs.length; ++i) {
		if (!alkInputs[i].value) {
			$(alkInputs[i]).parent().addClass('has-error');
			emptyInputs.push(alkInputs[i]);
		} else {
			if ($(alkInputs[i]).parents().hasClass('has-success')) {
				} else if ($(alkInputs[i]).parent().hasClass('has-error')) {
			}
		}
	}
	if (!emptyInputs.length == 0){
		alertify.error("Выделенные поля обязательны для заполнения");
	}else{
		submitForm();
	};
})


function submitForm(){
    var form = $('form#contact-form');
    var name = $('#contact-name').val();
    var data = {};
    form.serializeArray().map(function(x){data[x.name] = x.value;});
    $.ajax({
      url: PJS.ajax_url,
      type: 'POST', 
      dataType: 'json',
      data: {
          action: 'action_alkadd_form',
          data: data
      }, 
      success:function(results){
      	alertify.success(name + ' Ваша заявка принята! Мы в скором времени вам перезвоним');
		$('#alk-submit').attr('disabled',true);	
      }
    })
};

} )( jQuery );

