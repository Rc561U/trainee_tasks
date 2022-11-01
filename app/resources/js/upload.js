function submitForm(event) {
    event.preventDefault();
    const form = document.getElementById('upload_form');
    const payload = new FormData(form);
    fetch('api/v1/uploads', {
        method: 'POST',
        body: payload
    })
        .then(response => response.json())
        .then(data => {
            let message = document.getElementById('message')
            if (data.status === 'true') {
                message.innerHTML =
                    `<div class="alert alert-success" role="alert">
				  		    ${data.response}
						</div>`;
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            } else {
                message.innerHTML =
                    `<div class="alert alert-danger" role="alert">
                            ${data.errors.status}
                        </div>`
            }
        });
}

