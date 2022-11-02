const validation = new JustValidate("#signup");

validation
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
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

    .onSuccess((event) => {
        console.log('onSuccess')


    });
