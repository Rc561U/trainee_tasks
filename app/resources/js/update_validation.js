const update_validation = new JustValidate('#update_form');
const user_id = document.getElementById("user_id")
update_validation
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () => {
                return fetch("api/v1/validate", {
                    method: 'POST',
                    body: JSON.stringify({'email': value, "user_id": user_id.value}),
                })
                    .then(function (response) {
                        return response.json();
                    })

                    .then(function (json) {
                        return json.available;
                    });
            },
            errorMessage: "Email already exists"
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

    .onSuccess((event) => {
        document.getElementById("update_form").submit();
    });