export const previewFile = () => {
    const preview = document.getElementById('previewImg');
    const file = document.getElementById('formFileSm').files[0];
    const reader = new FileReader();

    reader.onload = () => {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    }
};

export const removeImage = () => {
    const preview = document.getElementById('previewImg');
    const fileInput = document.getElementById('formFileSm');
    const removeInput = document.getElementById('removeImg');
    const baseUrl = window.location.origin;
    preview.src = `${baseUrl}/storage/images/default.png`;
    fileInput.value = '';
    removeInput.value = '1';
};
