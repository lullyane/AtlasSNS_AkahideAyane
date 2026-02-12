// アコーディオンメニューの動き
$(function () {
  $('.menu_trigger').click(function () {
    //プルダウン .menu_triggerをタップすると、
    $(this).toggleClass('active');
    //タップしたプルダウン（.menu_trigger）に（.active）を追加・削除する。
    if ($(this).hasClass('active')) {
      //もし、プルダウン（.menu_trigger）に（.active）があれば、
      $('.menu_nav').addClass('active');
      //(.menu_nav)にも（.active）を追加する。
    } else {
      //それ以外の場合は、
      $('.menu_nav').removeClass('active');
      //(.menu_nav)にある（.active）を削除する。
    }
  });
  $('.nav_wrapper ul li a').click(function () {
    //各項目（.nav_wrapper ul li a）をタップすると、
    $('.menu_trigger').removeClass('active');
    //プルダウン（.menu_trigger）にある（.active）を削除する。
    $('.menu_nav').removeClass('active');
    //(.g_nav)にある（.active）も削除する。
  });
});
