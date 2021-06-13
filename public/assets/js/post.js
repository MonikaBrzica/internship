const form = document.getElementById("formElem");

form.onsubmit = async (e) => {
    e.preventDefault();
    let response = await fetch('/job', {
        method: 'POST',
        body: new FormData(form)
    });

    let result = await response.json();
    window.location.reload();
};