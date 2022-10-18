const post = async (url, params) => {
    const response = await fetch(url, {
        method: 'POST',
        body: JSON.stringify(params),
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        }
    })
    const data = await response.json()
    return data
}

addEventListener("click", function (event) {
    // const button = document.querySelector("#deleteBtn")
    // let value = event.target.value


    if (event.target.className === "btn btn-dark") {
        const button = document.querySelector("#deleteBtn")
        let value = event.target.value
        // console.log(value)


        // Then use it like so with async/await:
        (async () => {
            const data = await post('../models/delete.php', {
                'user_id':value
            })
            console.log(data.status)
        })()
    }



})

// fetch("../models/delete.php", {
//     method: 'POST',
//     body: JSON.stringify({'user_id':value}),
// })
//     .then(res => res.json())
//     .then(data => {
//
//         let statusMsg = document.getElementById('reed_status');
//         console.log(data.status)
//         statusMsg.innerHTML=
//             `<div class="alert alert-success" role="alert">
//             ${data.status}
//             </div>`
//     })

// })

