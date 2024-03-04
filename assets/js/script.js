function create_custom_dropdowns() {
  jQuery('select').each(function (i, select) {
      if (!jQuery(this).next().hasClass('dropdown-select')) {
          jQuery(this).after('<div class="dropdown-select wide ' + (jQuery(this).attr('class') || '') + '" tabindex="0"><span class="current"></span><div class="list"><ul></ul></div></div>');
          var dropdown = jQuery(this).next();
          var options = jQuery(select).find('option');
          var selected = jQuery(this).find('option:selected');
          dropdown.find('.current').html(selected.data('display-text') || selected.text());
          options.each(function (j, o) {
              var display = jQuery(o).data('display-text') || '';
              dropdown.find('ul').append('<li class="option ' + (jQuery(o).is(':selected') ? 'selected' : '') + '" data-value="' + jQuery(o).val() + '" data-display-text="' + display + '">' + jQuery(o).text() + '</li>');
          });
      }
  });

  jQuery('.dropdown-select ul').before('<div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()" class="dd-searchbox" type="text"></div>');
}

// Event listeners

// Open/close
jQuery(document).on('click', '.dropdown-select', function (event) {
  if(jQuery(event.target).hasClass('dd-searchbox')){
      return;
  }
  jQuery('.dropdown-select').not(jQuery(this)).removeClass('open');
  jQuery(this).toggleClass('open');
  if (jQuery(this).hasClass('open')) {
      jQuery(this).find('.option').attr('tabindex', 0);
      jQuery(this).find('.selected').focus();
  } else {
      jQuery(this).find('.option').removeAttr('tabindex');
      jQuery(this).focus();
  }
});

// Close when clicking outside
jQuery(document).on('click', function (event) {
  if (jQuery(event.target).closest('.dropdown-select').length === 0) {
      jQuery('.dropdown-select').removeClass('open');
      jQuery('.dropdown-select .option').removeAttr('tabindex');
  }
  event.stopPropagation();
});

function filter(){
  var valThis = jQuery('#txtSearchValue').val();
  jQuery('.dropdown-select ul > li').each(function(){
   var text = jQuery(this).text();
      (text.toLowerCase().indexOf(valThis.toLowerCase()) > -1) ? jQuery(this).show() : jQuery(this).hide();         
 });
};
// Search

// Option click
jQuery(document).on('click', '.dropdown-select .option', function (event) {
  jQuery(this).closest('.list').find('.selected').removeClass('selected');
  jQuery(this).addClass('selected');
  var text = jQuery(this).data('display-text') || jQuery(this).text();
  jQuery(this).closest('.dropdown-select').find('.current').text(text);
  jQuery(this).closest('.dropdown-select').prev('select').val(jQuery(this).data('value')).trigger('change');
});

// Keyboard events
jQuery(document).on('keydown', '.dropdown-select', function (event) {
  var focused_option = jQuery(jQuery(this).find('.list .option:focus')[0] || jQuery(this).find('.list .option.selected')[0]);
  // Space or Enter
  //if (event.keyCode == 32 || event.keyCode == 13) {
  if (event.keyCode == 13) {
      if (jQuery(this).hasClass('open')) {
          focused_option.trigger('click');
      } else {
          jQuery(this).trigger('click');
      }
      return false;
      // Down
  } else if (event.keyCode == 40) {
      if (!jQuery(this).hasClass('open')) {
          jQuery(this).trigger('click');
      } else {
          focused_option.next().focus();
      }
      return false;
      // Up
  } else if (event.keyCode == 38) {
      if (!jQuery(this).hasClass('open')) {
          jQuery(this).trigger('click');
      } else {
          var focused_option = jQuery(jQuery(this).find('.list .option:focus')[0] || jQuery(this).find('.list .option.selected')[0]);
          focused_option.prev().focus();
      }
      return false;
      // Esc
  } else if (event.keyCode == 27) {
      if (jQuery(this).hasClass('open')) {
          jQuery(this).trigger('click');
      }
      return false;
  }
});

jQuery(document).ready(function () {
  create_custom_dropdowns();
jQuery('.sh-wrapper.content').hide();
 jQuery('#selectField').change(function() {
    jQuery('.sh-wrapper.content').hide();
    jQuery('#' + jQuery(this).val()).show();
 });

});
