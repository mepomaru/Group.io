document.addEventListener('DOMContentLoaded', function () {
  const textarea = document.getElementById('passion');
  const charCount = document.getElementById('charCount');

  textarea.addEventListener('input', function () {
    const textLength = textarea.value.length;

    // 現在の文字数を表示
    charCount.textContent = `${textLength}/512`;

    if (textLength > 512) {
      charCount.style.color = 'red';
    } else {
      charCount.style.color = '#025373';
    }
  });
});

//ラジオボタンの判定
document.getElementById('myForm').addEventListener('submit', function (event) {
  var names = ['gender', 'm_concentration', 'm_cooperation', 'l_goal', 'l_prioritize', 'p_achieve', 'p_precedence', 'r_contact', 'r_tool'];
  var allChecked = true;

  names.forEach(function (name) {
    var radios = document.querySelectorAll('input[name="' + name + '"]');
    var checked = Array.prototype.slice.call(radios).some(x => x.checked);
    if (!checked) {
      allChecked = false;
      alert('Please select an option for ' + name.replace('_', ' ') + '.');
    }
  });

  // Validate textarea
  var textarea = document.querySelector('textarea[name="comments"]');
  if (textarea.value.trim() === '') {
    allChecked = false;
    alert('Please fill out the comments field.');
  }

  if (!allChecked) {
    event.preventDefault();
  }
});

//チェックボックスの判定
document.getElementById('myForm').addEventListener('submit', function (event) {
  var checkboxes = document.querySelectorAll('input[name="roles[]"]');
  var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
  if (!checkedOne) {
    event.preventDefault();
    alert('Please select at least one option.');
  }
});