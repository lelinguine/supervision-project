async function getConnect() {
    const requestData = {
        data: {
            user : {
                pseudo: $('#pseudo').val(),
                password: $('#password').val()
            }
        }
    };

    try {
        const response = await $.ajax({
            url: apiUrl + "/connect",
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(requestData),
        });
        if (response.data.user.token) {
            setCookie('token', response.data.user.token, 7);
            window.location.href = apiUrl + '/view';
        }
    } catch (error) {
        console.error(error);
    }
}