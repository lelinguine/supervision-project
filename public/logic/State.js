function checkTokenValidity() {
    const token = getCookie('token');
    if (!token) {
        return false;
    }
    return true;
}

$(document).ready(function() {
    const currentPath = window.location.pathname;
    if (currentPath.includes('view') && !checkTokenValidity()) {
        window.location.href = "/"
    }
});