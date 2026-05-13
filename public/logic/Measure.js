async function getMeasure() {
    const requestData = {
        data: {
            user: {
                token: getCookie('token')
            }
        },
    };

    try {
        const response = await $.ajax({
            url: apiUrl + "/metric",
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify(requestData)
        });
        return response.data.metric.level;
    } catch (error) {
        return 0;
    }
    
}

getMeasure();