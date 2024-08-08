function setErrorLabel(element, text) {
    const hasErrorLabel = element.parentElement.querySelector(".input-error");
    if(hasErrorLabel) {
        hasErrorLabel.textContent = text;
    }
}

export const Validators = {
    email: 'email',
    password: 'password',
    required: 'required'
};

const ValidateAction = {
    email: (email) => {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!regex.test(email.value)) {
            setErrorLabel(email, "Email inválido.")
            return false;
        }

        setErrorLabel(email, "")
        return true;
    },
    password: (password) => {
        const regex = /^(?=.*\d)(?=.*[!@#$%^&*()])(.{8,})$/;
        if(!regex.test(password.value)) {
            setErrorLabel(password, "A senha deve ter no mínimo 8 caracteres, contendo pelo menos um caractere especial e um número.")
            return false;
        }

        setErrorLabel(password, "")
        return true;
    },
    required: (value) => {
        if(!value.value || value.value === " ") {
            setErrorLabel(value, "Este campo precisa ser preenchido!")
            return false;
        }

        setErrorLabel(value, "")
        return true;
    }
}

export const Validate = {
    validate: (element, validators = []) => {
        if(validators) {
            for(let i = 0; i < validators.length; i++) {
                let validator = validators[i];
                if(!ValidateAction[validator](element)) return false;
            }
        }

        return true;
    },
    validateConfirmPassword: (password, confirmPassword, validators = []) => {
        if(
            !Validate.validate(password, validators) ||
            !Validate.validate(confirmPassword, validators)
        ) return false;

        return password.value === confirmPassword.value;
    }
}
