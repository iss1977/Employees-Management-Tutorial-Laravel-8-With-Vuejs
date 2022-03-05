/***********************************************************
* Confirm delete button action
* Parameters : event, that -> reference to the pressed button, formElement is the form that has to be sent
*/
window.deleteButtonClick = function(event, that, formElement, countryName) {
    event.preventDefault();
    event.stopPropagation();
    const title= that.dataset.confirmationWindowTitle;
    const message = that.dataset.confirmationWindowText;
    const actionButtonText = that.dataset.confirmationWindowButton;
    window.setupConfirmationModal(title, message,actionButtonText,formElement); // confirmationDialogObject will be created and filled
    window.showConfirmationModal();
}

window.executeFormSubmision = function(){
    window.confirmationDialogObject.formElement.submit();
}


/***********************************************************
 *  Set up modal window for delete button click confirmation
 */

window.setupConfirmationModal = function (title, message, actionButtonText, form) {
    console.log('2.Running setupConfirmationModal function');
    //check if confirmation dialog object already defined.
    if (typeof(confirmationDialogObject) !== 'object') {
        window.confirmationDialogObject = new Function();
    }
    // setup dialog title, message, action button text and callback (on action button click)
    confirmationDialogObject.title = (typeof(title) === 'string') ? title : '';
    confirmationDialogObject.message = (typeof(message) === 'string') ? message : '';
    confirmationDialogObject.actionButtonText = (typeof(actionButtonText) === 'string') ? actionButtonText : '';
    confirmationDialogObject.formElement = (typeof(form) === 'object') ? form : '';

}

/** Display the confirmation dialog*/
window.showConfirmationModal = function () {
    console.log('4.Running showConfirmationModal function');



    var temp = document.getElementById("delete-confirmation-modal"); // gets reference to template
    debugger;
    temp.querySelector('#confirmation-dialog').innerText="BlaBla";



    var clon = temp.content.cloneNode(true);
    document.body.appendChild(clon);
    $('#confirmation-dialog-modal').modal('show')
}


