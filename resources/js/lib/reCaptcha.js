import { ref } from 'vue';

export function useRecaptcha() {
    // Gán grecaptcha vào biến để sử dụng trong component
    const grecaptcha = window.grecaptcha;

    // Hàm getRecaptchaToken và getToken
    async function getRecaptchaToken(siteKey) {
        return new Promise((resolve) => {
            grecaptcha.ready(async () => {
                const token = await grecaptcha.execute(siteKey, { action: "submit" });
                resolve(token);
            });
        });
    }

    async function getToken() {
        const recaptchaSiteKey = "6Lf0DSsnAAAAADTdbcx3Tde3uiyJKjFvXy6jGrMP"; // Thay YOUR_RECAPTCHA_SITE_KEY bằng site key của bạn
        const token = await getRecaptchaToken(recaptchaSiteKey);
        return token;
    }

    return {
        getToken,
    };
}
