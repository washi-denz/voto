document.getElementById('archive_csv').onchange = function () {
    if (typeof (document.getElementById('archive_csv').files[0].name) != undefined)
        document.getElementById('file_csv').innerHTML = document.getElementById('archive_csv').files[0].name;
    else
        document.getElementById('file_csv').innerHTML = "";
}

// Send SMS
function sendSMS($phone, $message) {
    return {
        data: {},
        phone: $phone,
        isFail: false,
        isSuccess: false,
        message: $message,
        alert: '',
        fetchSMS() {
            if (this.phone.length != 9 || this.message == '') {
                this.isSuccess = false;
                this.alert = 'No se puede enviar el mensaje'
            } else {
                this.data = JSON.parse(localStorage.getItem('D' + this.phone) || '[]')
                if (Object.keys(this.data).length > 0) {
                    this.isSuccess = true;
                    this.alert = 'Mensaje ya enviado'
                    localStorage.setItem('D' + this.phone, JSON.stringify(this.data))
                } else {
                    var form = new FormData()
                    form.append('numero', this.phone)
                    form.append('mensaje', this.message)
                    this.isLoading = true;
                    fetch('https://merhosting.net/v1/768e068e9269acfa9a35a965169c3576/sms/', {
                        method: 'POST',
                        body: form
                    }).then(res => res.json())
                        .then(data => {
                            this.data = data;
                            if (Object.keys(this.data).length > 0) {
                                this.isSuccess = true;
                                this.alert = 'Mensaje enviado'
                                localStorage.setItem('D' + this.phone, JSON.stringify(this.data))
                            } else {
                                this.isFail = true;
                                this.alert = 'Servidor no responde'
                            }
                        }).catch(() => {
                            this.data = {};
                            this.alert = 'Imposible conectar al servidor'
                            this.isFail = true;
                        }).finally(() => {
                            console.log(this.data)
                        })
                }
            }
        },
    };
}
