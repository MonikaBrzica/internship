const cvs = document.getElementById('cvs');

if (cvs) {
    cvs.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-article') {
            if (confirm('Are you sure?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/home/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }

        if (e.target.className === 'btn btn-success download-article') {
            const id = e.target.getAttribute('data-id');
            fetch(`/home/download/${id}`, {
                method: 'GET'
            });
        }

        if (e.target.className === 'btn btn-warning archive-article') {
            if (confirm('Are you sure?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/home/archive/${id}`, {
                    method: 'POST'
                }).then(res => window.location.reload());
            }
        }

        if (e.target.className === 'btn btn-warning activate-article') {
            if (confirm('Are you sure?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/home/active/${id}`, {
                    method: 'POST'
                }).then(res => window.location.reload());
            }
        }
    });
}

var active = document.getElementById("active");
var archived = document.getElementById("archived");

function showActive() {
    active.style.display = "block";
    archived.style.display = "none";
}

function showArchived() {
    active.style.display = "none";
    archived.style.display = "block";
}