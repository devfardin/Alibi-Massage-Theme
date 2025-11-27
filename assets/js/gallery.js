jQuery(document).ready(function ($) {
    const ul = $('.eael-filter-gallery-control ul');
    const li = $('<li></li>');
    li.attr({
        'data-load-more-status': '0',
        'data-first-init': '0',
        'data-filter': '.eael-cf-fardin',
        'tabindex': '-1'
    });
    li.addClass('control');
    li.text('Masseuses');
    ul.append(li);

    setTimeout(() => {
        const galleryContainer = $('.eael-filter-gallery-container');
        if (galleryContainer.length) {
            const forData = new FormData();
            forData.append('action', 'post_data_ajax');
            forData.append('nonce', filterable_gallery_params.nonce);

            fetch(filterable_gallery_params.ajax_url, {
                method: 'POST',
                body: forData
            }).then(response => response.json()).then(data => {
                const items = [];
                data?.data.forEach((item, index) => {
                    const masseuseItem = $('<div></div>');
                    masseuseItem.addClass('eael-filterable-gallery-item-wrap eael-cf-fardin');
                    masseuseItem.html(`
                        <div class="eael-gallery-grid-item">
                            <div class="gallery-item-thumbnail-wrap">
                                <img src="${item.thumbnail}" alt="${item.title}" class="gallery-item-thumbnail" data-lazy-src="http://alibi-massage.local/wp-content/uploads/2025/11/b162154a5459d85edb24265ae1c819f9.jpg" />
                            </div>
                            <a area-hidden="true" aria-label="eael-magnific-link" href="${item.thumbnail}" class="eael-magnific-link eael-magnific-link-clone active media-content-wrap" data-elementor-open-lightbox="yes" title="">
                                <div class="gallery-item-caption-wrap caption-style-hoverer eael-slide-up">
                                    <div class="gallery-item-hoverer-bg"></div>
                                    <div class="gallery-item-caption-over">
                                        <h2 class="fg-item-title">${item.title}</h2>
                                        <div class="fg-item-content">
                                            <p>Masseuses</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    `);
                    items.push(masseuseItem[0]);
                });

                galleryContainer.append(items);
                const isotope = galleryContainer.data('isotope');
                if (isotope) {
                    isotope.appended(items);
                    isotope.layout();
                }
            });
        }
    }, 1500);
});