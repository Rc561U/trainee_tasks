const validation = new JustValidate('#create_form');

validation
    .addField('#name', [
        {
            rule: 'required',
        },
        {
            rule: 'customRegexp',
            value: /^[\w]{2,}\ [\w]{2,}$/,
            errorMessage: "Your first and last name"
        }

    ])
    .addField('#status', [
        {
            rule: 'required',
        }

    ])
    .addField('#gender', [
        {
            rule: 'required',
        }
    ])

    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () => {
                return fetch("/src/validation/check_email.php", {
                    method: 'POST',
                    body: JSON.stringify({'email': value}),
                })
                    .then(function (response) {
                        return response.json();
                    })

                    .then(function (json) {
                        return json.available;
                    });
            },
            errorMessage: "email already exists"
        }

    ])
    .onSuccess((event) => {
        document.getElementById("create_form").submit();
        // var form = document.getElementById("create_form");
        // var formdata = new FormData(form);
        //
        //
        // fetch('../models/save.php',{
        //     method: 'POST',
        //     body: formdata,
        // })
        //     .then(res => res.json())
        //     .then(data => {
        //         let statusMsg = document.getElementById('status');
        //         statusMsg.innerHTML=
        //         `<div class="alert alert-success" role="alert">
        //         ${data.status}
        //         </div>`
        //
        //
        //
        //     })
    });