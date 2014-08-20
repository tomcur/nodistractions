const eleHtml = document.getElementsByTagName('html')[0];
eleHtml.classList.remove('no-js');
eleHtml.classList.add('js');

document.addEventListener("DOMContentLoaded", function() {
    eleHtml.classList.remove('load');
});
