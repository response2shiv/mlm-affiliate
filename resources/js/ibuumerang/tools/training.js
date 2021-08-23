$(document).ready(function () {
  let videos = $('template[data-type="vimeo"]');

  $.each(videos, function (index, video) {
    let src = $(video).data('src');

    $.ajax({
      url: `https://vimeo.com/api/oembed.json?url=${src}`,
      method: 'GET',
      success: function (res) {
        $(video).replaceWith(res.html);
      }
    });
  });
});
