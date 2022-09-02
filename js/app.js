jQuery(function ($) {
  $('.carousel').carousel();
  $('.next').click(function () {
    $('.carousel').carousel('next');
    return false;
  });
  $('.prev').click(function () {
    $('.carousel').carousel('prev');
    return false;
  });
});

Object.assign(document.querySelector('.embed-container iframe'), {
  width: '1000px',
  height: '562.50px',
});
