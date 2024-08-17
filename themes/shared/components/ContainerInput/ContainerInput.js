export const ContainerInput = ({id, name, label, type = "text"}) => {
    const container = document.createElement('div');
    const labelFor = document.createElement('label');
    const input = document.createElement('input');
    const span = document.createElement('span');

    container.className = 'input-container';

    labelFor.setAttribute('for', id);
    labelFor.textContent = label ? label + ":" : "Insira o valor:";

    input.className = 'default-input';
    input.type = type;
    if(name) input.name = 'email';
    if(id) input.id = id;

    span.className = 'input-error';

    container.appendChild(labelFor);
    container.appendChild(input);
    container.appendChild(span);

    return container;
}