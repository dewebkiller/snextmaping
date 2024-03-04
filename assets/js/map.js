jQuery(document).ready(function () {
  var map_svg = '';
  var mapUrl = map_svg;
  // register parts
  if (jQuery('html').hasClass('no-svg')) {
    mapUrl = mapUrl;
  }
  var numKeys = 250; // Set the number of keys you have
  var areas = [];

  for (var i = 1; i <= numKeys; i++) {
    var keyName = 'heart' + i;
    var area = {
      altImageOpacity: 1,
      fillColor: 'ff0000',
      fill: true,
      fillOpacity: 0.5,
      stroke: true,
      key: keyName,
      altImage: mapUrl
    };
    areas.push(area);
  }

  jQuery('#estonia-map').mapster({
    mapKey: 'name',
    configTimeout: 300000,
    singleSelect: true,
    isDeselectable: false,
    fadeDuration: 0,
    areas: areas
  }).mapster('set', true, 'harjumaa');

  // map resize
  jQuery('#estonia-map').mapster('resize', jQuery('.map-wrapper').width(), 0, 0);
  jQuery(window).resize(function() {
    jQuery('#estonia-map').mapster('resize', jQuery('.map-wrapper').width(), 0, 0);
  });
});
jQuery('.sh-wrapper.content').hide();
for (var i = 1; i <= 250; i++) {
  var areaClass = ".area" + i;
  var optionId = "#option" + i;

  jQuery(areaClass).on("click", {
    optionId: optionId
  }, function(e) {
    e.preventDefault();
    jQuery(e.data.optionId + '.sh-wrapper.content').show();
    jQuery('.sh-wrapper.content:not(' + e.data.optionId + ')').hide();
    jQuery('.sh-wrapper .marquee').css({
      "display": "none"
    });
  });
}
jQuery('#selectField').on('change', function() {
  /*changes*/
  const $this = jQuery(this);
  const currentValue = $this.val();
  jQuery('.' + currentValue).trigger('click');
  /*changes*/
  // var selectvalue = $('#selectField option:selected').text();
  // console.log(selectvalue);
  if (selectvalue == 'Search') {
    jQuery('.sh-wrapper .marquee').css({
      "display": "block"
    });
  } else {
    jQuery('.sh-wrapper .marquee').css({
      "display": "none"
    });
  }

});