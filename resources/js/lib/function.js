
export function useFunction() {

    function getExpirType(value, productType) {
        return Object.keys(productType).find(key => productType[key] === value) || 'Không xác định';
    }
    const formatDateTime = (dateTimeStr) => {
        const options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
        };

        const formattedDateTime = new Date(dateTimeStr).toLocaleString(undefined, options);
        return formattedDateTime;
    };
    const truncateText = (text, maxLength) => {
        if (text.length > maxLength) {
            return text.slice(0, maxLength) + '...';
        } else {
            return text;
        }
    };
    return {
        getExpirType,
        formatDateTime,
        truncateText,
    };
}

