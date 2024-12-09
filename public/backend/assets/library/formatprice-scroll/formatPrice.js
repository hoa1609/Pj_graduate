const formatPrice = (value) => {
    value = value.replace(/\D/g, '');
    if (!value) return '';
    return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
document.getElementById('priceInput').addEventListener('input', function() {
    let value = this.value;
    this.value = formatPrice(value);
});
