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
        var form = document.getElementById("upload_form");
        var formdata = new FormData(form);


        fetch('test.php', {
            method: 'POST',
            body: formdata,
        })
            .then(res => res.json())
            .then(data => {
                console.log(data)


            })
    });
