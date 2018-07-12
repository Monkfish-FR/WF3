function postAjax(url, data, success) {
    let params = typeof data === 'string' ?
        data :
        Object.keys(data).map(
            function (k) { return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
        ).join('&');

    const xhr = new XMLHttpRequest();
    xhr.responseType = 'json';
    xhr.open('POST', url);

    xhr.onreadystatechange = function () {
        if (xhr.readyState > 3 && xhr.status === 200) {
            success(xhr.response);
        }
    };

    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);

    return xhr;
}

document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('addVehicle');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const brand = document.getElementById('brand');
        const model = document.getElementById('model');
        const year = document.getElementById('year');
        const color = document.getElementById('color');

        postAjax('http://localhost:8000/Ex_3/ajax/add_vehicle.php', {
            brand: brand.value,
            model: model.value,
            year: year.value,
            color: color.value
        }, function (data) {
            const main = document.querySelector('main');

            const oldAlert = main.querySelector('.alert');
            if (oldAlert) {
                main.removeChild(oldAlert);
            }

            const errors = main.querySelectorAll('.error');
            errors.forEach(function (element, index) {
                element.innerHTML = '';
            });

            let type = data.success ? 'success' : 'danger';

            let alert = document.createElement('div');
            alert.classList.add('alert', 'alert-' + type);
            alert.innerHTML = data.msg;

            main.insertBefore(alert, main.childNodes[0]);

            console.log(data.errors);
            for (let field in data.errors) {
                document.querySelector('.error-' + field).innerHTML = data.errors[field];
            }
        });
    });

});
