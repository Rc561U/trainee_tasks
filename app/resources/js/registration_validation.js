const validation = new JustValidate("#signup", {
    errorFieldCssClass: "is-invalid",
    errorFieldStyle: {
        border: "1px solid red",
    },
    errorLabelCssClass: "is-label-invalid",
    errorLabelStyle: {
        color: "#CF4A2E",
        textDecoration: "underlined",
    },
});
validation
    .addField("#firstName", [
        {
            rule: "required"
        },

    ])
    .addField("#lastName", [
        {
            rule: "required"
        },

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
                return fetch("api/v1/validate", {
                    method: 'POST',
                    body: JSON.stringify({'email': value, "signup": "ts"}),
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
    .addField("#confirmEmail", [
        {
            rule: "required"
        },
        {
            validator: (value, fields) => {
                return value === fields["#email"].elem.value;
            },
            errorMessage: "Email should match"
        }
    ])

    .addField("#password", [
        {
            rule: "required"
        },
        {
            rule: 'customRegexp',
            value: /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{3,}$/,
            errorMessage: "Minimum 3 characters, at least one letter and one number"
        },

    ])
    .addField("#confirmPassword", [
        {
            rule: "required"
        },
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords should match"
        }
    ])

    .onSuccess((event) => {
        document.getElementById("signup").submit();


    });
