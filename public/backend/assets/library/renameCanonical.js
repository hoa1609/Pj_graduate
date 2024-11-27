document.addEventListener("DOMContentLoaded", function () {
    const titleInput = document.querySelector('input[name="name"]');
    const canonicalInput = document.querySelector('input[name="canonical"]'); 

    titleInput.addEventListener("input", function () {
        canonicalInput.value = titleInput.value; 
    });
});
