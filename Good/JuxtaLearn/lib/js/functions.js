function swap(element)
{
	element.toggle();
};

function swapParent()
{
	$("#parent").each(function(index, element) {
		$(element).toggle();
	});
};

function clearFilter()
{
	$("#SearchFor").val("");
	$("#SearchIn").val("Description");
	$("form#search").submit();
};

 	function FillImageAnnotationDialog(id, title, description, topic, subject, url, action, role)
	{
		$("#imgTitle").val(title);
		$("#imgTopic").val(topic);
		$("#imgSubject").val(subject);
		$("#imgDescription").val(description);
		$("#imgUrl").val(url);
		$("#imgId").val(id);
		$("#role").val(role);
	};
	
	function StoreCurrent(id, title, $image->description, $image->topic, $image->subject)
	{
	
	};

  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:340,
      modal: true,
      buttons: {
        Yes: function() {
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });

  $(function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      emailRegex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,
      imgDescription = $( "#imgDescription" ),
      imgTopic = $( "#imgTopic" ),
      imgTitle = $( "#imgTitle" ),
	  imgSubject = $( "#imgSubject" ),
	  action = $( "#action" ),
	  role = $( "#role" ),
	  imgId = $( "#imgId" ),
	  imgUrl = $( "#imgUrl" ),
      allFields = $( [] ).add( imgDescription ).add( imgTopic ).add( imgTitle ).add( imgId ).add( action ).add( role ).add( imgUrl ).add( imgSubject),
      tips = $( ".validateTips" );
 
 

	
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    };
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    };
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    };
 
    function annotateImage() {
      var valid = true;
      allFields.removeClass( "ui-state-error" );
 
      valid = valid && checkLength( imgDescription, "description", 3, 80 );
      //valid = valid && checkLength( imgTitle, "title", 1, 40 );
      //valid = valid && checkLength( imgTopic, "topic", 1, 25 );
 
      //valid = valid && checkRegexp( imgDescription, /^[a-z]([0-9a-z_\s])+$/i, "Description may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
	  //valid = valid && checkRegexp( imgTitle, /^[a-z]([0-9a-z_\s])+$/i, "Description may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
	  //valid = valid && checkRegexp( imgTopic, /^[a-z]([0-9a-z_\s])+$/i, "Description may consist of a-z, 0-9, underscores, spaces and must begin with a letter." );
      //valid = valid && checkRegexp( email, emailRegex, "ie. yourname@lnu.se" );
      //valid = valid && checkRegexp( password, /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
      if ( valid ) {
		var url = "http://www.paulius.nl/4ME102FA/JuxtaLearn/save.php?";
		
		url = url + "action=" + action.val();
		url = url + "&id=" + imgId.val();
		url = url + "&topic=" + imgTopic.val();
		url = url + "&title=" + imgTitle.val();
		url = url + "&subject=" + imgSubject.val();
		url = url + "&desc=" + imgDescription.val() ;//+ " (edited by: " + role.val() + ")";
		url = url + "&type=annotation";
		
		window.location.href = encodeURI(url);
        /*$( "#users tbody" ).append( "<tr>" +
          "<td>" + name.val() + "</td>" +
          "<td>" + email.val() + "</td>" +
          "<td>" + password.val() + "</td>" +
        "</tr>" ); */
        dialog.dialog( "close" );
      }
      return valid;
    };
 
    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 600,
      modal: true,
      buttons: {
        "Save": annotateImage,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
		dialog.dialog( "close" );
		//$(this).dialog("destroy");
        //form[ 0 ].reset();
        //allFields.removeClass( "ui-state-error" );
      }
    });
 
    form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      annotateImage();
    });
	
	/*$( "#annotate-image").each( function(index, element) {
		$(element).click( function() {
			dialog.dialog( "open" );
			return false;
		});
	});*/
	
	$("[id^=annotate-image]").each(function(){
	$(this).click(function() {
			dialog.dialog( "open" );
			return false;
		});
  });
 
    //$( "#annotate-image" ).button().on( "click", function() {
    //  dialog.dialog( "open" );
    //});
  });

  $(function() {
    $( "#accordion" )
      .accordion({
        header: "> div > h3",
		heightStyle: "content",
		collapsible: true
      })
     /* .sortable({
        axis: "y",
        handle: "h3",
        stop: function( event, ui ) {
          // IE doesn't register the blur when sorting
          // so trigger focusout handlers to remove .ui-state-focus
          ui.item.children( "h3" ).triggerHandler( "focusout" );
 
          // Refresh accordion to handle new order
          $( this ).accordion( "refresh" );
        }
      });*/
  });
  
  $(function() {
    $( "#accordionHistory99" ).accordion({
        header: "> div > h3",
		heightStyle: "content",
		collapsible: true
	  })
     /* .sortable({
        axis: "y",
        handle: "h3",
        stop: function( event, ui ) {
          // IE doesn't register the blur when sorting
          // so trigger focusout handlers to remove .ui-state-focus
          ui.item.children( "h3" ).triggerHandler( "focusout" );
 
          // Refresh accordion to handle new order
          $( this ).accordion( "refresh" );
        }
      });*/
  });
  
  $(function() {
  $("[id^=accordionHistory]").each(function(){
	$(this).accordion({
        header: "> div > h3",
		heightStyle: "content",
		collapsible: true,
		active: false
	  })
  });
  
  });