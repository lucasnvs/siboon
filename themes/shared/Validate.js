export const Validators = {
    email: 'email',
    password: 'password',
    required: 'required'
};

const ValidateAction = {
    email: (email) => {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    },
    password: (password) => {
        return true;
    },
    required: (value) => {
        return !(value === "" || value === " ");
    }
}

export const Validate = {
    validate: (element, validators = []) => {
        if(validators) {
            validators.forEach(validator => {
                if(!ValidateAction[validator](element.value)) return false;
            })
        }

        return true;
    },
    validateConfirmPassword: (password, confirmPassword, validators = []) => {
        if(
            !Validate.validate(password, [Validators.password, Validators.required]) ||
            !Validate.validate(confirmPassword, [Validators.password, Validators.required])
        ) return false;

        return password.value === confirmPassword.value;
    }
}
