const create_validation = new JustValidate('#create_form');

create_validation
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

    .onSuccess((event) => {
        document.getElementById("create_form").submit();

    });