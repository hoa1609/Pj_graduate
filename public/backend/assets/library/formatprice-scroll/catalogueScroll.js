document.addEventListener('scroll', function() {
    var fixedSaveProduct = document.querySelector('.fixed-save-product');
    if (window.scrollY > 150) {
        fixedSaveProduct.classList.add('active');
    } else {
        fixedSaveProduct.classList.remove('active');
    }
});