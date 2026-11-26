function changeLayout(layout) {

    const items = document.querySelectorAll('.gallery-item');

    items.forEach(function(item) {

        item.classList.remove('col-md-3', 'col-md-4', 'col-12');

        if (layout === 3) {
            item.classList.add('col-md-4');
        }

        else if (layout === 4) {
            item.classList.add('col-md-3');
        }

        else if (layout === 'list') {
            item.classList.add('col-12');
        }

    });

}