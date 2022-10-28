const update_validation = new JustValidate('#upload_form');
update_validation

    .addField('#fileToUpload', [
        {
            rule: 'files',
            value: {
                files: {
                    types: ['image/jpeg', 'text/plain'],

                },
            },
        },
    ])

    .onSuccess((event) => {
        form = document.getElementById("upload_form");
        form.addEventListener("submit", function (evt) {
            //... do something cool.
            form.submit();
        });
    });