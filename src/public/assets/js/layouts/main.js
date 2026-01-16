$(function() {
    stayFooter("footer");
});

/**
 * Adjusts the position of the footer to ensure it stays at the bottom of the page.
 * If the content height is less than the viewport height, the footer will be positioned
 * at the bottom of the viewport. Otherwise, the footer will remain in its natural position.
 *
 * @param {string} footerId - The ID of the footer element to be adjusted.
 */
function stayFooter(footerId) {
    if (typeof footerId !== "string" || footerId === "") {
        return;
    }

    const viewportHeight = $(window).height();
    const contentHeight = $(document.body).outerHeight(true);
    const footer = $(`#${footerId}`);

    if (contentHeight < viewportHeight) {
        footer.css({
            position: "fixed",
            bottom: "0px",
            width: "100%"
        });
        $(document.body).css({
            paddingBottom: footer.outerHeight(true)
        });
    } else {
        footer.css({
            position: "static",
            width: "auto"
        });
        $(document.body).css({
            paddingBottom: 0
        });
    }
}
