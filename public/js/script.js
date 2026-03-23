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
if (modalContent) {
    modalContent.addEventListener('click', (e) => {
        e.stopPropagation();
    });
}

// --------------------
// 投稿内容が151文字以上になったら、非表示のエラーメッセージを表示する
// --------------------
document.addEventListener('DOMContentLoaded', () => {

    // 投稿フォームのJS
    const textarea = document.querySelector('textarea[name="post"]');
    const errorMsg = document.getElementById('countError');
    const requiredError = document.querySelector('.error');

    if (textarea && errorMsg) {
        textarea.addEventListener('input', () => {
            const len = textarea.value.length;
            // 1〜150文字 → 入力必須メッセージ非表示
            if (len >= 1 && len <= 150) {
                requiredError?.classList.remove('has_error');
            }
            // 151文字以上 → 150文字以内での入力メッセージ表示
            if (len > 150) {
                errorMsg.classList.add('active');
                requiredError?.classList.remove('has_error');
            } else {
                errorMsg.classList.remove('active');
            }
            // requiredError?.の ?. はオプショナルチェーンといって、これのおかげで requiredError が null でも安全にスルーされる
        });
    }

    // モーダルのJS
    const modalTextarea = document.getElementById('editText');
    const modalErrorMsg = document.getElementById('modalCountError');
    const modalRequiredError = document.querySelector('.modal_required_error');
    const modalUpdateBtn = document.getElementById('modalUpdateBtn');

    if (modalTextarea && modalErrorMsg && modalRequiredError && modalUpdateBtn) {
        modalTextarea.addEventListener('input', () => {
            const len = modalTextarea.value.length;
            // 0文字 → 必須エラー表示
            if (len === 0) {
                modalRequiredError.textContent = "※投稿内容は必須です。";
                modalRequiredError.classList.add('active');
                modalErrorMsg.classList.remove('active');
                return;
            }
            // 1〜150文字 → 必須エラー消す
            if (len >= 1 && len <= 150) {
                modalRequiredError.textContent = "";
                modalRequiredError.classList.remove('active');
                modalErrorMsg.classList.remove('active');
                return;
            }
            // 151文字以上 → 150文字エラー表示
            if (len > 150) {
                modalRequiredError.textContent = "※投稿内容は150文字以内で入力してください。";
                modalErrorMsg.classList.add('active');
                modalRequiredError.classList.remove('active');
            }
        });
    }
});
