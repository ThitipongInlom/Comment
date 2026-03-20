import { helpers } from '@vuelidate/validators';

const messages = {
    required: { en: 'This field is required', th: 'กรุณากรอกข้อมูล' },
    email: { en: 'Please enter a valid email', th: 'กรุณากรอกอีเมลที่ถูกต้อง' },
    minLength: { en: (min) => `Must be at least ${min} characters`, th: (min) => `ต้องมีอย่างน้อย ${min} ตัวอักษร` },
    integer: { en: 'Must be a whole number', th: 'กรุณากรอกตัวเลขจำนวนเต็ม' },
    minValue: { en: (min) => `Must be at least ${min}`, th: (min) => `ต้องมีค่าอย่างน้อย ${min}` },
};

export function useValidators(locale = 'en') {
    const lang = locale === 'th' ? 'th' : 'en';

    const required = helpers.withMessage(messages.required[lang], (value) => {
        if (value === null || value === undefined) return false;
        if (typeof value === 'string') return value.trim().length > 0;
        return !!value;
    });

    const email = helpers.withMessage(messages.email[lang], (value) => {
        if (!value) return true;
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    });

    const minLength = (min) =>
        helpers.withMessage(messages.minLength[lang](min), (value) => {
            if (!value) return true;
            return String(value).length >= min;
        });

    const integer = helpers.withMessage(messages.integer[lang], (value) => {
        if (!value && value !== 0) return true;
        return Number.isInteger(Number(value));
    });

    const minValue = (min) =>
        helpers.withMessage(messages.minValue[lang](min), (value) => {
            if (!value && value !== 0) return true;
            return Number(value) >= min;
        });

    return { required, email, minLength, integer, minValue };
}
