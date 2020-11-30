import { sentMail } from "./components/mailerror.js";

(() => {
    let mailSubmit = document.querySelector('.submitContainer');

    function MailFail(result) {
     // Alerts if the process failed
        console.table(result); 
        alert("Error " + result.message);
    } 

    function MailOk(result) {
    // Alerts if its an success
        console.log(result); 
        alert('Email went through successfully');
    }

    function formValidator(form) // Checks for proper submission
    {
      if(form.firstname.value === "") {
        alert("Enter your  first name");
        form.firstname.focus();
        return false;
      }
      if(form.lastname.value === "") {
        alert("Enter your last name");
        form.lastname.focus();
        return false;
      }
      var flag;
      if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(form.email.value)){
          flag = true;
      } else {
          flag = false;
      }
      if(form.email.value === "" || flag === false ) {
        alert("Please enter a valid Email address");
        form.email.focus();
        return false;
      } else {
          return true;
      }
    }

    function mailprocess(event) {
        //function processes email and catches error if there are any
        event.preventDefault();

        if(formValidator(this.parentNode)){
        // email is processed 
        sentMail(this.parentNode)
            .then(data => MailOk(data))
            .catch(err => MailFail(err));
      //handles error
      }

              }

    // Listens for click event ....when clicked fires processMail func
    mailSubmit.addEventListener("click", mailprocess);

})();