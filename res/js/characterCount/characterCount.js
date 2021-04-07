document.querySelector('[name=tweet]').addEventListener('input', () => {

    document.querySelector('#characterCount').innerHTML = parseInt(
        document.querySelector('[name=tweet]').value.length
    ) + '/280';

});