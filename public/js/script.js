// --------------------
// アコーディオンメニューの動き
// --------------------
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

// --------------------
// フォームのパスワードを伏字にする
// --------------------
function togglePasswordVisibility(input, passwordVisibleIcon, passwordHiddenIcon) {
  if (input.type === 'password') {
    input.type = 'text';
    // アイコンの表示を切り替え
  } else {
    input.type = 'password';
    // アイコンの表示を切り替え
  }
}

// --------------------
// 投稿内容更新
// --------------------
// モーダル要素
const modal = document.getElementById('editModal');

// 編集ボタン
document.querySelectorAll('.edit_btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.getElementById('editId').value = this.dataset.id;
    document.getElementById('editText').value = this.dataset.text;

    document.getElementById('editModal').style.display = 'block';
  });
});


// --------------------
// モーダル外クリックでモーダル閉じる
// --------------------
// 背景定義
const overlay = document.querySelector('.modal');
// モーダル本体定義
const modalContent = document.querySelector('.modal_content');

// 1. 背景をクリックした時、クリックされたのが背景自身（コンテンツ以外）の場合のみ閉じる
overlay.addEventListener('click', (e) => {
  // またはクラスを削除
  if (e.target === overlay) {
    overlay.style.display = 'none';
  }
});

// 2. モーダル本体をクリックした時は閉じないようにする
modalContent.addEventListener('click', (e) => {
  e.stopPropagation();
});
