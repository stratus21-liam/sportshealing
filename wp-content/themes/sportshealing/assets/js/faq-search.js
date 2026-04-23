(function () {
    'use strict';

    /**
     * Filter FAQ accordion items by the visible question and answer text.
     */
    function initialiseFaqSearch(searchInput) {
        var section = searchInput.closest('.faq-section');
        var items = section ? Array.prototype.slice.call(section.querySelectorAll('.accordion-item')) : [];
        var form = searchInput.closest('form');

        if (!items.length) {
            return;
        }

        if (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
            });
        }

        searchInput.addEventListener('input', function () {
            var query = searchInput.value.trim().toLowerCase();
            var visibleCount = 0;

            items.forEach(function (item) {
                var text = item.textContent.toLowerCase();
                var isVisible = !query || text.indexOf(query) !== -1;

                item.style.display = isVisible ? '' : 'none';

                if (isVisible) {
                    visibleCount += 1;
                }
            });

            section.toggleAttribute('data-faq-no-results', visibleCount === 0);
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        Array.prototype.slice.call(document.querySelectorAll('#faqsearch')).forEach(initialiseFaqSearch);
    });
}());
