
async function sentMail(target) {
   
    let formData = new FormData(target);
    // TODO: examine the method and incrementally build out the fetch call. currently it assumes POST

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