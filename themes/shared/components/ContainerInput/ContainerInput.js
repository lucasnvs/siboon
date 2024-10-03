export const ContainerInput = ({id, name, label, type = "text", value, isDisabled, style}) => {
    const container = document.createElement('div');
    const labelFor = document.createElement('label');
    const input = document.createElement('input');
    const span = document.createElement('span');

    container.className = 'input-container';

    if(id) labelFor.setAttribute('for', id);
    labelFor.textContent = label ? label + ":" : "Insira o valor:";

    input.className = 'default-input';
    input.type = type;
    input.value = value ?? "";
    input.disabled = isDisabled;
    if(name) input.name = 'email';
    if(id) input.id = id;
    if(style)  container.style = style;
    span.className = 'input-error';

    container.appendChild(labelFor);
    container.appendChild(input);
    container.appendChild(span);

    return container;
}