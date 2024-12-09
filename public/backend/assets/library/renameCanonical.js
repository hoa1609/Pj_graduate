document.addEventListener("DOMContentLoaded", function () {
    const titleInput = document.querySelector('input[name="name"]');
    const canonicalInput = document.querySelector('input[name="canonical"]'); 

    function toSlug(text) {
        return text
            .toLowerCase() 
            .normalize('NFD') 
            .replace(/[\u0300-\u036f]/g, '') 
            .replace(/đ/g, 'd') // Thay 'đ' thành 'd'
            .replace(/[^a-z0-9\s-]/g, '') // Xóa ký tự không hợp lệ
            .trim() // Loại bỏ khoảng trắng ở đầu và cuối
            .replace(/\s+/g, '-') // Thay khoảng trắng bằng gạch ngang
            .replace(/-+/g, '-'); // Loại bỏ gạch ngang thừa
    }

    titleInput.addEventListener("input", function () {
        canonicalInput.value = toSlug(titleInput.value);
    });
});
