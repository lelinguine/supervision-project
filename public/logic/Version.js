async function getVersion() {

    try {
        const response = await $.ajax({
            url: apiUrl + "version",
            type: 'GET',
            dataType: 'json'
        });
        console.log('Service version', response.data.app.version);
    } catch (error) {
        console.error('Erreur de connexion au service', error.message);
    }
}

getVersion();