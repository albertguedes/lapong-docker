/**
 * Sets the width of all elements with the given class name to the specified type of width.
 * @param {string} className - The class name to target.
 * @param {string} type - The type of width to set: 'min', 'max', or 'mean'.
 */
function setUniformWidth(className, type = 'max') {
    const elements = $(`.${className}`);

    if (!elements.length) {
        return;
    }

    const widths = elements.map((i, element) => $(element).width()).get();

    let targetWidth;

    switch (type) {
        case 'min':
            targetWidth = Math.min(...widths);
            break;
        case 'max':
            targetWidth = Math.max(...widths);
            break;
        case 'mean':
            targetWidth = widths.reduce((a, b) => a + b, 0) / widths.length;
            break;
        default:
            return;
    }

    elements.width(targetWidth);
}

/**
 * Sets the height of all elements with the given class name to the specified type of height.
 * @param {string} className - The class name to target.
 * @param {string} type - The type of height to set: 'min', 'max', or 'mean'.
 */
function setUniformHeight(className, type = 'max') {
    if (typeof className !== 'string' || className.trim() === '') {
        console.error('Invalid className');
        return;
    }

    if (typeof type !== 'string' || ['min', 'max', 'mean'].indexOf(type) === -1) {
        console.error('Invalid type');
        return;
    }

    const elements = $('.' + className);
    const heights = elements.map(function () {
        return $(this).height();
    }).get();

    let targetHeight;
    switch (type) {
        case 'min':
            targetHeight = Math.min(...heights);
            break;
        case 'max':
            targetHeight = Math.max(...heights);
            break;
        case 'mean':
            targetHeight = heights.reduce((total, height) => total + height, 0) / heights.length;
            break;
        default:
            console.error('Invalid type: must be "min", "max", or "mean"');
            return;
    }

    elements.height(targetHeight);
}

/**
 * Sets the width and height of all elements with the given class name to the maximum width or height of elements with that class name.
 * @param {string} className - The class name to target.
 */
function sameHeightWidth(className) {

    if (!className || className.trim() === '') {
        console.error('className is empty or null');
        return;
    }

    if (typeof className !== 'string') {
        console.error('className must be a string');
        return;
    }

    var widths = [];
    var heights = [];

    $('.' + className).each(function () {
        widths.push($(this).width());
        heights.push($(this).height());
    });

    var maxWidth = Math.max.apply(null, widths);
    var maxHeight = Math.max.apply(null, heights);

    var max = Math.max(maxWidth, maxHeight);

    $('.' + className).width(max);
    $('.' + className).height(max);
}

/**
 * Makes all elements with the given class name clickable by adding a click
 * event listener which redirects to the href in the data-url attribute.
 *
 * @param {string} className - The class name to target.
 */
function cardLink(className) {

    if (!className || className.trim() === '') {
        console.error('className is empty or null');
        return;
    }

    if (typeof className !== 'string') {
        console.error('className must be a string');
        return;
    }

    const cards = document.querySelectorAll('.' + className +  '[data-url]');
    cards.forEach(card => {
        card.addEventListener('click', () => {
            window.location.href = card.getAttribute('data-url');
        });
        card.addEventListener('mouseover', () => {
            card.style.cursor = 'pointer';
        });
        card.addEventListener('mouseout', () => {
            card.style.cursor = 'default';
        });
    });
}
