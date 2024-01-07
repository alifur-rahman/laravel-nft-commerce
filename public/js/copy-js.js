// copy function------------------------
function copy_to_clipboard(containerid) {
  console.log(containerid);
  if (document.selection) {
    var range = document.body.createTextRange();
    range.moveToElementText(document.getElementById(containerid));
    range.select().createTextRange();
    document.execCommand("copy");
    // navigator.clipboard.writeText(range);
  } else if (window.getSelection) {
    var range = document.createRange();
    range.selectNode(document.getElementById(containerid));
    window.getSelection().addRange(range);
    document.execCommand("copy");
    // navigator.clipboard.writeText(range);
    //   alalert("Text has been copied, now paste in the text-area")
    notify('success', 'Copied Successfully, Please save it your safe zone', 'Copy to Clipboard')
  }
} 