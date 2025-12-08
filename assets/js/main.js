jQuery(document).ready(function ($) {
    const showMoreBtn = document.querySelector('.massage_show_more_btn');
    const targetedElement = document.querySelector('.message_description');
    if (targetedElement) {
        showMoreBtn.addEventListener('click', function () {
            targetedElement.classList.toggle('expanded');
            showMoreBtn.innerText= 'Show Less'
        });
    }
})