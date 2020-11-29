
async function sentMail(target) {
   

    let result = await fetch(`${target.getAttribute("action")}`, {
        method: target.method,
       
    }).then(response => {
        if (response.status !== 200) {
            throw new Error(`Mail submission failed: ${response.status}`);

           }

        return response;
    })

    let mailStatus = await result.json();
    return mailStatus;
    
}

export { sentMail };