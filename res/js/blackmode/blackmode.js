document.querySelector('#switch').checked = document.querySelector('[name=blackMode]').value;

blackMode(document.querySelector('[name=blackMode]').value);

document.querySelector('#switch').addEventListener('change', () => {

    document.querySelector('#switch').checked = !document.querySelector('#switch').checked;

    blackMode(document.querySelector('#switch').checked);

    document.querySelector('[name=blackMode]').value = (document.querySelector('#switch').checked)
    ? '1': '';

});

function blackMode(state) {

    document.querySelector('body').style.backgroundColor = (state)
        ? '#000' : '#fff';

    document.querySelectorAll('.whiteText').forEach(item => {

        item.style.color = (state)
        ? '#fff' : '#000';

    });

}